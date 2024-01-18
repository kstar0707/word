<?php
header("Access-Control-Allow-Origin: *");

if(isset($_GET['checkpdf']))
{
    $_POST['body'] = 'Test Content';
    $_POST['size'] = 'A4';
}

if(!isset($_POST['body'])){
    echo '{"status":"failed"}';
}
else {

    require_once('tcpdf_include.php');

    $body = $_POST['body'];
    $size = $_POST['size'];

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array('100','89'), true, 'UTF-8', false);


    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('KeiPro');
    $pdf->SetTitle('Word PDF');
    $pdf->SetSubject('Word PDF Print');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 061', PDF_HEADER_STRING);


    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


    //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    
    $pdf->SetMargins(5, 0, 5);
    //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);


    if (@file_exists(dirname(__FILE__) . '/lang/jpn.php')) {
        require_once(dirname(__FILE__) . '/lang/jpn.php');
        $pdf->setLanguageArray($l);
    }
    
    

// ---------------------------------------------------------

    $font1 = TCPDF_FONTS::addTTFfont('fonts/msmincho.ttf', 'TrueTypeUnicode', '', 96);
    $font2 = TCPDF_FONTS::addTTFfont('fonts/msgothic.ttf', 'TrueTypeUnicode', '', 96);


    $pdf->SetFont('helvetica', '', 10);

    $pdf->SetFont($font2);

    $pdf->SetFont($font1);

    $pdf->AddPage('P', $size);


    ob_start();
    ?>
<!DOCTYPE html>
<html lang="jp" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<style>.page_separator{text-align:right;display:none;}p,span{margin-bottom:0px;}</style>
</head>

<body>
<?=$body?>
</body>
</html>
<?php

    $html = ob_get_clean();

    $pdf->writeHTML($html, true, false, true, false, '');


    $pdf->lastPage();


    $string = $pdf->Output('word.pdf', 'S');



    $path = 'download/word_'.uniqid().'.pdf';

    file_put_contents($path, $string);

    echo '{"status":"success","url":"'.$path.'"}';

}

exit();
