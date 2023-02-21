<?php

include_once('fpdf.php');


$doc = new FPDF();
$doc->AddPage();
$doc->SetFont('Arial','',11);
$doc->Ln();
$doc->Cell(50,9, 'Pais: '.$_POST['country'],0,2,'L' );
$doc->Cell(50,9, 'Nombre: '.$_POST['c_fname'],0,2,'L' );
$doc->Cell(50,9, 'Apellido: '.$_POST['c_lname'],0,2,'L' );
$doc->Cell(50,9, 'Nombre de la Compañia: '.$_POST['c_companyname'],0,2,'L' );
$doc->Cell(50,9, 'Direccion: '.$_POST['c_address'],0,2,'L' );
$doc->Cell(50,9, 'Estado/Pais: '.$_POST['c_state_country'],0,2,'L' );
$doc->Cell(50,9, 'Postal/zip: '.$_POST['c_postal_zip'],0,2,'L' );
$doc->Cell(50,9, 'Direccion Email: '.$_POST['c_email_address'],0,2,'L' );
$doc->Cell(50,9, 'Telefono: '.$_POST['c_phone'],0,2,'L' );



$doc->Output();
                 
?>