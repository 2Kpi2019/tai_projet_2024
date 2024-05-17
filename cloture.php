<?php
// do all necessary includes first
require_once(__DIR__."/model/php/SerieModel.php");
require_once(__DIR__."/tcpdf/tcpdf.php");
// Check if the user comes from the form...

    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idSerie']))  {
            session_start();
    // Tous les champs sont fournis, procéder à l'enregistrement des données de l'utilisateur
    $userModel = new UserModel();
    $info = $userModel->get_serie($_POST['idSerie']);
    $pieces = $userModel->get_all_piece($_POST['idSerie']);
    $pdf = new TCPDF('P', 'cm', 'A4', true, 'UTF-8', false);
    /// Création du compte rendu en pdf
// Définir les informations du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kalitest');
$pdf->SetTitle('Compte Rendu');
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
$titleWidth = floatval($pdf->GetStringWidth('Compte rendu Kalitest'));
$titleX = ($pdf->GetPageWidth() - $titleWidth) / 2;
 
// Calculer la position Y pour placer le titre au milieu de la page
$titleY = ($pdf->GetPageHeight() - 24) / 2;
 
// Définir la couleur du texte en noir
$pdf->SetTextColor(0, 0, 0);
 
// Écrire le titre au milieu de la page
$pdf->Text($titleX, $titleY +2 ,  'Compte rendu Kalitest');
 
// Encadrer le titre
$pdf->Rect($titleX - 5, $titleY - 2, $titleWidth + 10, 10);
// Définir la position initiale du texte
 
// Définir la police et la taille du texte pour le contenu
$pdf->SetFont('helvetica', '', 12);
if (isset($info[0]['picture']) && !empty($info[0]['picture'])) {
    // Code pour traiter l'image
   // on récupère la taille de l'image
    $imageBlob = $info[0]['picture'];
    $imageSize = getImageSizeFromString($imageBlob);
    $imageWidth = $imageSize[0];
    $imageHeight = $imageSize[1];
    $taillemax = 13*30; // définir une taille max
    $hautmax = 10*30;
    if ($imageWidth > $taillemax) { // si on est trop grand on réduit l'image tout en restant proportionelle
       $ratio = $imageWidth / $taillemax;
       $imageWidth = $taillemax;
       $imageHeight = $imageHeight / $ratio;
    }
    if ($imageHeight > $hautmax) { // si on est trop grand on réduit l'image tout en restant proportionelle
        $ratio = $imageHeight / $hautmax;
        $imageHeight = $hautmax;
        $imageWidth = $imageWidth / $ratio;
     }
    // Affichez l'image sur le PDF avec une taille fixe
    $pdf->SetAutoPageBreak(false, 0);
    $pageWidth = $pdf->getPageWidth();
 
// Calculer la position x pour centrer l'image
$imageStartX = ($pageWidth - ($imageWidth / 30)) / 2;
 
// Afficher l'image sur le PDF en la centrant horizontalement
$pdf->Image('@' . $imageBlob, $imageStartX, 13, $imageWidth / 30, $imageHeight / 30); // Convertir les dimensions en cm
$policyText = "Chez KALITEST, nous nous engageons à offrir des services de tests de conformité de pièces de qualité supérieure. Notre politique d'entreprise repose sur les principes suivants :
 
    Précision et Fiabilité : Nous nous efforçons de dépasser les attentes de nos clients en fournissant des tests précis, fiables et innovants. Chaque pièce est évaluée avec une rigueur professionnelle et une attention méticuleuse aux détails, assurant ainsi sa conformité aux normes et spécifications.
"; // Ajustez la position Y en fonction de la hauteur de l'image
    // Calculer la largeur de la cellule pour centrer le texte
    $pageWidth = $pdf->getPageWidth();
    $margins = $pdf->getMargins();
    $contentWidth = $pageWidth - $margins['left'] - $margins['right'];
    $xPos = $margins['left'] + ($contentWidth - 12) / 2; // Ajuster 12 si vous changez la largeur de la cellule
 
    // Afficher le texte centré sous l'image
    $pdf->SetXY($imageStartX, 13 + ($imageHeight / 30) + 1);
    $pdf->MultiCell(12, 0.5, $policyText, 0, 'C', 0, 1, $xPos, 13 + ($imageHeight / 30) + 1);
} else {
    $pdf->Text(10, 10, "L'image n'existe pas.");
}
 
 
 
 
$y = 2;
$pdf->AddPage();
// Ajouter les données de l'info
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Text(8, $y +3 , 'INFORMATION DE LA SERIE :');
$i =-2;
$y +=3; // Position de départ en y
foreach ($info as $data) {
   
    $pdf->Text(3 + $i, $y + 5, 'Nom : ' . $data['name']);
    $y += 0; // Incrémenter la position en y pour la prochaine ligne
    $pdf->Text(16 + $i, $y + 5, 'Matière : ' . $data['matter']);
    $y += 0;
    $pdf->Text( 3 + $i, $y + 6, 'Référence : ' . $data['reference']);
    $y += 0;
    $pdf->Text(16 + $i, $y + 6, 'Poids : ' . $data['weight']);
    $y += 0;
    $pdf->Text(3 + $i, $y + 7, 'Hauteur : ' . $data['height']);
    $y += 0;
    $pdf->Text(16 + $i, $y + 7, 'Longueur : ' . $data['length']);
    $y += 0;
    $pdf->Text(3 + $i, $y + 8, 'Résistance : ' . $data['resistance']);
    $y += 0;
    $pdf->Text(16 + $i, $y + 8, 'Couleur : ' . $data['color']);
    $y += 0;
    $pdf->Text(3 + $i, $y + 9, 'Description : ' . $data['description']);
    $y += 0;
    $pdf->Text(16 + $i, $y + 9, 'Nb de pièce : ' . $data['nb_piece']);
    $y += 0;
    $pdf->Text(3 + $i, $y + 10, 'Demandé le : ' . $data['creation_date']);
    $y += 0;
    $pdf->Text(16 + $i, $y +10, 'Éffectuer le : ' . $data['closing_date']);
    $y += 0;
    $pdf->Text(3 + $i, $y + 11, 'Deadline : ' . $data['deadline']);
    $y += 0;
    $pdf->Text(16 + $i, $y + 11, 'Erreur (%) : ' . $data['percentage_of_error']);
    $y += 0;
    $prenom = $userModel->get_prenom($data['id_workers(createur)']);
    $nom = $userModel->get_nom($data['id_workers(createur)']);
    $prenom2 = $userModel->get_prenom($data['id_workers(ingenieur)']);
    $nom2 = $userModel->get_nom($data['id_workers(ingenieur)']);
    $pdf->Text(3 + $i, $y + 19, 'Responsable : ' .$prenom[0]['first_name'].' '.$nom[0]['name']);
    $y += 0;
    $pdf->Text(3 + $i, $y + 20, 'Ingénieur : ' . $prenom2[0]['first_name'].' '.$nom2[0]['name']);
    $y += 0; // Ajouter plus d'espace entre les enregistrements
   
    // Réinitialiser la position en y pour le prochain enregistrement
}
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 12);
$y = 2; // Augmenter la position Y
$pdf->Text(10, $y, '');
$colWidths = array(2, 3, 3, 2, 3, 2, 4);
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
    $ingeW3c = 2;
        require_once(__DIR__."/view/php/inge.php");
} else {
    require_once(__DIR__."/view/php/vide.php"); // pour douiller votre système de vérification w3c
}
        ?>