<?php
//require('dompdf/dompdf_config.inc.php');
require('mpdf/mpdf.php');
Class Dompdfgen extends Phalcon\Mvc\User\Component {


  public function getpdf($pdf_content,$servicename,$companyname,$typeof) {
        $newcontet = $this->getcsselement();
        $endingpdf = '</div></body></html>';
        $newcontet =  $newcontet.$pdf_content.$endingpdf;
        $time= time();
        /*$dompdf = new DOMPDF();*/
        $getrandomcode = $this->validationcommon->randomcodegen_capsalphanum(10);
        if(!empty($getrandomcode))
        {$getrandomcode = $getrandomcode;}
        else
        {$getrandomcode = 'codeedforencryption';}

        if($typeof=="configvcs"){$path = $this->pdfdownloadresolutiondir;}
        else if($typeof=="configvlaw"){$path = $this->pdfdownloadagrrementdir;}
        else if($typeof=="configFormb"){$path = $this->sebiDir.'/formb';}
        else if($typeof=="configFormc"){$path = $this->sebiDir.'/formc';}
        else if($typeof=="configFormd"){$path = $this->sebiDir.'/formd';}
        else if($typeof=="initialdeclarationpdf"){$path = $this->declarationDir.'/initdeclar';}
        else if($typeof=="annualdeclarationpdf"){$path = $this->declarationDir.'/annualdeclare';}
        else if($typeof=="configFormpct"){$path = $this->declarationDir.'/formpct';}
        else if($typeof=="configFormaprvl"){$path = $this->declarationDir.'/formaprvl';}
        else if($typeof=="configNonReport"){$path = $this->declarationDir.'/reportingnonexe';}
        else if($typeof=="configReport"){$path = $this->declarationDir.'/reportingexe';}
        else if($typeof=="misrecip"){$path = 'img/mis';}
        else if($typeof=="mispersnlinfo"){$path = 'img/mis';}
        else if($typeof=="FormI"){$path = 'img/preclearance_request/form1';}
        else if($typeof=="FormII"){$path = 'img/preclearance_request/form2';}
        else if($typeof=="coi"){$path = $this->coiDir.'/coi_pdfpath';}
        else if($typeof=="configCoi"){$path = $this->coiDir.'/coi_exports';}
        else{$path='';}

        if($typeof=="configvcs"){$stylesheet = file_get_contents('css/pdf/pdf.css');}
        else if($typeof=="configvlaw"){$stylesheet = file_get_contents('css/pdf/vlaw_pdf.css');}
        else if($typeof=="configFormb"){$stylesheet = file_get_contents('css/pdf/formbpdf.css');}
        else if($typeof=="configFormc"){$stylesheet = file_get_contents('css/pdf/formcpdf.css');}
        else if($typeof=="configFormd"){$stylesheet = file_get_contents('css/pdf/formdpdf.css');}
        else if($typeof=="configFormpct"){$stylesheet = file_get_contents('css/pdf/formpctpdf.css');}
        else if($typeof=="initialdeclarationpdf"){$stylesheet = file_get_contents('css/pdf/initialpdf.css');}
        else if($typeof=="annualdeclarationpdf"){$stylesheet = file_get_contents('css/pdf/initialpdf.css');}
        else if($typeof=="configFormaprvl"){$stylesheet = file_get_contents('css/pdf/formaprvlpdf.css');}
        else if($typeof=="configReport"){$stylesheet = file_get_contents('css/pdf/reportingpdf.css');}
        else if($typeof=="configNonReport"){$stylesheet = file_get_contents('css/pdf/nonreportingpdf.css');}
        else if($typeof=="misrecip"){$stylesheet = file_get_contents('css/pdf/misrecip.css');}
        else if($typeof=="mispersnlinfo"){$stylesheet = file_get_contents('css/pdf/mispersnlinfo.css');}
        else if($typeof=="FormI"){$stylesheet = file_get_contents('css/pdf/preclerance.css');}
        else if($typeof=="FormII"){$stylesheet = file_get_contents('css/pdf/preclerance.css');}
        else if($typeof=="coi"){$stylesheet = file_get_contents('css/pdf/coi.css');}
        else if($typeof=="configCoi"){$stylesheet = file_get_contents('css/pdf/coi.css');}
        else{$path='';$stylesheet='';}
        
        //echo $stylesheet; exit;
        $filename = $companyname.'-'.$servicename.'-'.$time.'-'.$getrandomcode.'.pdf';

        
        //echo $filename;exit;

//        $dompdf = new DOMPDF();
//        $dompdf->load_html($newcontet);
//        $dompdf->set_paper('A4', 'portrait');
//        $dompdf->render();
//        $output = $dompdf->output();

        $mpdf = new mPDF();
        $mpdf->SetProtection(array('print'));
        $mpdf->keep_table_proportions = false;
        if($typeof=='configFormb' || $typeof=='configFormc' || $typeof=='configFormd' || $typeof=="annualdeclarationpdf" || $typeof=="mispersnlinfo") 
        {  
            $mpdf->AddPage('L');
        }
        else
        {
            $mpdf->AddPage();
        }      
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($newcontet,2);
        
        $output = $mpdf->Output($path.'/'.$filename);

        //echo $newcontet; exit;
        //chmod($path.'/'.$filename,0755);
        //echo $output;exit;
        //chmod($path.'/'.$filename,0755);
        //file_put_contents($path.'/'.$filename, $output);
        return $path.'/'.$filename;


    }
    public function getcsselement()
    {
        $r  ='';
        $r .='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

            <style>';
        $r .='';
        $r .='</style></head><body><div class="vlaw_dompdf">';
        return $r;
    }
    
    public function geninvpdf($pdf_content,$filepath) {
        

        $mpdf = new mPDF();
        $mpdf->SetProtection(array('print'));
        
        $stylesheet='
        .invbody{padding: 20px;} 
        .invbody{padding: 0; margin: 0; font-family: arial;color: #000;}
        h1, h2, h3, h4, h5, h6, p{margin: 0; padding: 0; color: #000;}
        td, th{border:1px solid #000000;padding: 10px;}
        .maintableget tr,.annexure .annex tr{font-size:14px;}
        table{border-collapse: collapse;}
        @media print {
        * { -webkit-print-color-adjust: exact;}
        html { background: none; padding: 0; }
        .invbody { box-shadow: none; margin: 0; }
        span:empty { display: none; }
        .add, .cut { display: none; }
        }
        .maintableget{margin-top:20px; width:100%;}
        .uppercasecl{text-transform: uppercase;text-align: left;}
        .fontweightbold{font-weight: bold;}
        .textalingleft{text-align: left;}
        .maintableget{
          /*page-break-after:always;*/
        }';
        
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($pdf_content,2);
        $output = $mpdf->Output($filepath);
        //echo $newcontet; exit;
        //chmod($path.'/'.$filename,0755);
        //echo $output;exit;
        //chmod($path.'/'.$filename,0755);
        //file_put_contents($path.'/'.$filename, $output);
        return $filepath;


    }
    public function gencommentpdf($pdf_content,$typeof,$path) {
        //echo $typeof; exit;
        $newcontet = $this->getcsselement();
        $endingpdf = '</div></body></html>';
        //echo $newcontet.$pdf_content;exit;
        $newcontet =  $newcontet.$pdf_content.$endingpdf;
        $time= time();
        /*$dompdf = new DOMPDF();*/
        $getrandomcode = $this->validationcommon->randomcodegen_capsalphanum(10);
        if(!empty($getrandomcode))
        {$getrandomcode = $getrandomcode;}
        else
        {$getrandomcode = 'codeedforencryption';}


        $getdirectoryname = $this->session->profilecommondir['createdirname'];
        //echo $getdirectoryname; exit;
        $getcurrentyear = date("Y");
        $getcurrentmonth = date("M");

        $path = $this->pdfeditdocdir.'/'.$getdirectoryname.'/'.$getcurrentyear.'/'.$getcurrentmonth.'/newcooment';


       // echo $typeof; exit;

        if($typeof=="config_vcs_resolution"){$stylesheet = file_get_contents('css/pdf/pdf.css');}
        else if($typeof=="configalldocument"){$stylesheet = file_get_contents('css/pdf/pdf.css');}
        else if($typeof=="configvlaw"){$stylesheet = file_get_contents('css/pdf/vlaw_pdf.css');}
        else if($typeof=="configincorp"){$stylesheet = file_get_contents('css/pdf/incorp_pdf.css');}
        else if($typeof=="configdeptl"){$stylesheet = file_get_contents('css/pdf/pdf.css');}
        else if($typeof=="config_notice_resolution"){$stylesheet = file_get_contents('css/pdf/notice_pdf.css');}
        else if($typeof=="configsharecertificate"){$stylesheet = file_get_contents('css/pdf/sharecertificate_pdf.css');}
        else if($typeof=="configfte"){$stylesheet = file_get_contents('css/pdf/fasttrackexit_pdf.css');}
        else if($typeof=="config_minutes_resolution"){$stylesheet = file_get_contents('css/pdf/minutes_pdf.css');}
        else if($typeof=="config_agenda_resolution"){$stylesheet = file_get_contents('css/pdf/agenda_pdf.css');}
        else if($typeof=="configsecaudit"){$stylesheet = file_get_contents('css/pdf/secaudit_pdf.css');}
        else if($typeof=="configregister"){$stylesheet = file_get_contents('css/pdf/register_pdf.css');}
        else{$stylesheet = file_get_contents('css/pdf/agenda_pdf.css');}
        //echo $stylesheet; exit;
        //echo $stylesheet; exit;
        $filename = 'CommentedPDF-'.$time.'-'.$getrandomcode.'.pdf';


        $mpdf = new mPDF();
        $mpdf->title2annots = true;


        //echo $newcontet; exit;
        $mpdf->SetProtection(array('print'));
        $mpdf->WriteHTML($stylesheet,1);
        //$mpdf->AddPage();
        $mpdf->WriteHTML($newcontet,2);
        //echo $newcontet;exit;

        /*$mpdf->SetImportUse();
        // Import the last page of the source PDF file
        //$pagecount = $mpdf->SetSourceFile('img/chanakya_neeti_amey_hegde.pdf');

        $mpdf->SetImportUse();
        $pagecount = $mpdf->SetSourceFile('img/Revolution and Counter revolution.pdf');
        for ($i=1; $i<=($pagecount); $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $size = $mpdf->getTemplateSize($import_page);
            //echo '<pre>';print_r($size);
            //$mpdf->UseTemplate($import_page, '', '', $size['w']-44, $size['h']-44,false);
            $mpdf->UseTemplate($import_page, '', '', $size['w'], $size['h'], FALSE);
        }*/
        //exit;


        $output = $mpdf->Output($path.'/'.$filename);

       //echo '<pre>'; print_r($output); exit;
        //chmod($path.'/'.$filename,0755);
        //echo $output;exit;
        //chmod($path.'/'.$filename,0755);
        //file_put_contents($path.'/'.$filename, $output);
        return $path.'/'.$filename;


    }


    public function mergePDFFiles($filelist,$oppdfpath,$insertpageno) {
        $mpdf = new mPDF();
        //echo "ur files ";echo '<pre>'; print_r($filelist); exit;
        $mergepath = $mpdf->mergePDFFiles($filelist, $oppdfpath, $insertpageno);
        return $mergepath;
    }
    

}
