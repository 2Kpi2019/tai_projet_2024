<?php
// do all necessary includes first
require_once(__DIR__."/model/php/SerieModel.php");
require_once(__DIR__."/tcpdf/tcpdf.php");
// Check if the user comes from the form...

        session_start();
    // Tous les champs sont fournis, procéder à l'enregistrement des données de l'utilisateur
    $userModel = new UserModel();
    $info = $userModel->get_serie($_POST['idSerie']);
    $pieces = $userModel->get_all_piece($_POST['idSerie']);
    $pdf = new TCPDF('P', 'cm', 'A4', true, 'UTF-8', false);
    
// Définir les informations du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kalitest');
$pdf->SetTitle('Titre du document');
$pdf->SetSubject('Sujet du document');
$pdf->SetKeywords('TCPDF, PDF, exemple, test, guide');

// Définir les marges
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Définir l'espacement des lignes
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetFont('helvetica', 'B', 24);
// Ajouter une page
$pdf->AddPage();
$titleWidth = $pdf->GetStringWidth('Compte rendu Kalitest');
$titleX = ($pdf->GetPageWidth() - $titleWidth) / 2;

// Calculer la position Y pour placer le titre au milieu de la page
$titleY = ($pdf->GetPageHeight() - 24) / 2;

// Définir la couleur du texte en noir
$pdf->SetTextColor(0, 0, 0);

// Écrire le titre au milieu de la page
$pdf->Text($titleX, $titleY, 'Compte rendu Kalitest');

// Encadrer le titre
$pdf->Rect($titleX - 5, $titleY - 2, $titleWidth + 10, 10);
// Définir la position initiale du texte

// Définir la police et la taille du texte pour le contenu
$pdf->SetFont('helvetica', '', 12);

// Convertir le blob en format d'image (JPEG, PNG, etc.)
 // Remplacez 'image_blob.jpg' par le chemin de votre image blob
$imageData = base64_encode($info[0]['picture']);

// Afficher l'image sur le PDF
$pdf->Image('@' . $imageData, 1, 2, 6,4); // Image positionnée à 10 mm du bord gauche, hauteur automatique, largeur automatique, hauteur de 50 mm

$y = 2;
$pdf->AddPage();
// Ajouter les données de l'info
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Text(8, $y, 'Informations de la série :');
$i =-2;
$y +=3; // Position de départ en y
foreach ($info as $data) {
    
    $pdf->Text(10 + $i, $y, 'Nom : ' . $data['name']);
    $y += 1; // Incrémenter la position en y pour la prochaine ligne
    $pdf->Text(10 + $i, $y, 'Matière : ' . $data['matter']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Référence : ' . $data['reference']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Poids : ' . $data['weight']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Hauteur : ' . $data['height']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Longueur : ' . $data['length']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Résistance : ' . $data['resistance']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Couleur : ' . $data['color']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Description : ' . $data['description']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Nb de pièce : ' . $data['nb_piece']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Demandé le : ' . $data['creation_date']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Éffectuer le : ' . $data['closing_date']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Deadline : ' . $data['deadline']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Erreur (%) : ' . $data['percentage_of_error']);
    $y += 1;
    $prenom = $userModel->get_prenom($data['id_workers(createur)']);
    $nom = $userModel->get_nom($data['id_workers(createur)']);
    $prenom2 = $userModel->get_prenom($data['id_workers(ingenieur)']);
    $nom2 = $userModel->get_nom($data['id_workers(ingenieur)']);
    $pdf->Text(10 + $i, $y, 'Responsable : ' .$prenom[0]['first_name'].' '.$nom[0]['name']);
    $y += 1;
    $pdf->Text(10 + $i, $y, 'Ingénieur : ' . $prenom2[0]['first_name'].' '.$nom2[0]['name']);
    $y += 10; // Ajouter plus d'espace entre les enregistrements
    
    // Réinitialiser la position en y pour le prochain enregistrement
}
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 12);
$y = 2; // Augmenter la position Y
$pdf->Text(10, $y, '');
$colWidths = array(2, 3, 3, 2, 3, 2, 3);
// Position de départ du tableau
// Position de départ du tableau
$marginLeft = 1; // Marge gauche de 10 mm

// En-tête du tableau
$header = array('N° pièce', 'Conformité', 'Résistance', 'Hauteur', 'Longueur', 'Poids', 'Info');

// Ajouter une ligne pour l'en-tête du tableau
$pdf->SetX($marginLeft); // Position de départ du tableau
foreach ($header as $column) {
    $pdf->Cell($colWidths[array_search($column, $header)], 2, $column, 1, 0, 'C');
}
$pdf->Ln(); // Saut de ligne après l'en-tête

// Remplir le tableau avec les données
foreach ($pieces as $piece) {
    // Réinitialiser la position de départ du tableau pour chaque ligne
    $pdf->SetX($marginLeft);
    $pdf->Cell($colWidths[0], 2, $piece['n_piece'], 1, 0, 'C');
    $pdf->Cell($colWidths[1], 2, $piece['compliance'], 1, 0, 'C');
    $pdf->Cell($colWidths[2], 2, $piece['resistance'], 1, 0, 'C');
    $pdf->Cell($colWidths[3], 2, $piece['height'], 1, 0, 'C');
    $pdf->Cell($colWidths[4], 2, $piece['length'], 1, 0, 'C');
    $pdf->Cell($colWidths[5], 2, $piece['weight'], 1, 0, 'C');
    $pdf->Cell($colWidths[6], 2, $piece['info'], 1, 0, 'C');
    $pdf->Ln(); // Saut de ligne après chaque ligne du tableau
}


$pdf->SetFont('helvetica', '', 12);
$y += 10; // Augmenter la position Y


// Ajouter les données des pièces

$pdf->SetFont('helvetica', '', 12);


// Enregistrer le document sous forme de fichier
$pdfBlob = $pdf->Output('exemple.pdf', 'S');

    $userModel->cloturetest($_POST['idSerie'],$pdfBlob);
    
        require_once(__DIR__."/view/php/inge.php");
        echo '<script>afficherMessageBox2("Test Cloturer")</script>';
        ?>