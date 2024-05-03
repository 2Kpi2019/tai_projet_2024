<?php
// do all necessary includes first
require_once(__DIR__."/model/php/SerieModel.php");
require_once(__DIR__."/tcpdf/tcpdf.php");
// Check if the user comes from the form...

        session_start();
    // Tous les champs sont fournis, procéder à l'enregistrement des données de l'utilisateur
    $userModel = new UserModel();
    $info = $userModel->get_serie($_POST['idSerie']);
    $piece = $userModel->get_all_piece($_POST['idSerie']);
    $pdf = new TCPDF('P', 'cm', 'A4', true, 'UTF-8', false);
    
// Définir les informations du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Votre nom');
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
$pdf->SetFont('helvetica', '', 12);

// Ajouter une page
$pdf->AddPage();

// Définir la position initiale du texte
$y = 10;

// Ajouter les données de l'info
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Text(10, $y, 'Informations de la série :');
$pdf->SetFont('helvetica', '', 12);
$y += 10; // Augmenter la position Y


// Ajouter les données des pièces
$pdf->SetFont('helvetica', 'B', 12);
$y += 10; // Augmenter la position Y
$pdf->Text(10, $y, 'Liste des pièces :');
$pdf->SetFont('helvetica', '', 12);


// Enregistrer le document sous forme de fichier
$pdfBlob = $pdf->Output('exemple.pdf', 'S');

    $userModel->cloturetest($_POST['idSerie'],$pdfBlob);
    
        require_once(__DIR__."/view/php/inge.php");
    
        ?>