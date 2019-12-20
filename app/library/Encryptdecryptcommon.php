<?php
//require('dompdf/dompdf_config.inc.php');
require('mpdf/mpdf.php');
require('phpencrypt/PhpEncryptFiles.inc.php');
Class Encryptdecryptcommon extends Phalcon\Mvc\User\Component 
{

    public function getpdf($pdf_content,$rsname,$typeof) 
    {   
        $startingpdf = $this->getcsselement();
        $endingpdf = '</div></body></html>';
        $fullhtmlcontent =  $startingpdf.$pdf_content.$endingpdf;
        $time= time();
        /*$dompdf = new DOMPDF();*/
        $getrandomcode = $this->validationcommon->randomcodegen_capsalphanum(10);
        if(!empty($getrandomcode))
        {$getrandomcode = $getrandomcode;}
        else
        {$getrandomcode = 'codeedforencryption';}

        if($typeof=="configAgreement"){$path = $this->contractagreementdir.'/pdffiles';}
        else if($typeof=="configSummary"){$path = $this->contractagreementdir.'/resolutionpdf';}
        else if($typeof=="configvlaw"){$path = $this->contractagreementdir.'/pdffiles';}
        else{$path='';}

        if($typeof=="configAgreement"){$stylesheet = file_get_contents('css/pdf/pdf.css');}
        else if($typeof=="configSummary"){$stylesheet = file_get_contents('css/pdf/summarypdf.css');}
        else if($typeof=="configvlaw"){$stylesheet = file_get_contents('css/pdf/vlaw_pdf.css');}
        else{$path='';$stylesheet='';}
        
        //echo $stylesheet; exit;
        $filename = $rsname.'_'.$time.'-'.$getrandomcode.'.pdf';        
        //echo $fullhtmlcontent;exit; 
        //$finalkey = 'cGFzc3dkQDEyMw==';
        //$file_encrypted = fileencrypt($fullhtmlcontent, $finalkey); 

        //echo $file_encrypted;exit;     

        $mpdf = new mPDF();
        //$mpdf->SetProtection(array('print'));
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($fullhtmlcontent,2);            
        $output = $mpdf->Output($path.'/'.$filename);
        //echo $output;exit;
       // echo $path.'/'.$filename; exit;
        $content = file_get_contents($path.'/'.$filename);
        $finalkey = 'cGFzc3dkQDEyMw==';
        $randomnumbers = rand(10,100);
        $file_encrypted = fileencrypt($content, $finalkey);        
        $completepath = $path.'/'.$filename;
        //echo $completepath; exit; 
        $myfile = fopen($completepath, "w") or die("Unable to open file!");
        $txt = $file_encrypted;         
        //echo $file_encrypted; exit;       
        fwrite($myfile, $file_encrypted);
        fclose($myfile);
        chmod($completepath,0777);
        //echo $completepath; exit;   
        return $completepath; 
        //echo  $file_encrypted;exit;              
        //return $path.'/'.$filename;
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


    

    /****************  Start PDF file decrypt  **************************/
    public function getdecrptedpdffile($pdf_url)
    {   
        //echo $pdf_url; exit;
        $time = time();     
        $pdf_content = file_get_contents($pdf_url);
        //print_r($pdf_content);exit;
        //$content = utf8_decode($pdf_content);
        $finalkey = 'cGFzc3dkQDEyMw==';
        $file_decrypted = filedecrypt($pdf_content, $finalkey);
              
        $getrandomcode = 'decrypted_file';
        $filename = $getrandomcode.'_'.$time.'.pdf';  
        $path = $this->contractagreementdir."/pdffiles/temp";
        $filpath = $path.'/'.$filename;      
        $myfile = fopen($filpath, "w") or die("Unable to open file!");               
        fwrite($myfile, $file_decrypted);        
        chmod($filpath,0777);
        fclose($myfile); 
        //echo $filpath; exit; 
        return $filpath;       
    }
     public function getdecrptedinfofile($pdf_url)
    {   
        //echo $pdf_url; exit;
        $time = time();     
        $pdf_content = file_get_contents($pdf_url);
        // $upload_path = $this->infoshareattachment."/";  
        //print_r($pdf_content);exit;
        //$content = utf8_decode($pdf_content);
        $finalkey = 'cGFzc3dkQDEyMw==';
        $file_decrypted = filedecrypt($pdf_content, $finalkey);
              
        $getrandomcode = 'decrypted_file';
        $filename = $getrandomcode.'_'.$time.'.pdf';  

        $path = $this->infoshareattachment;
        $filpath = $path.'/'.$filename;      
        $myfile = fopen($filpath, "w") or die("Unable to open file!");               
        fwrite($myfile, $file_decrypted);        
        chmod($filpath,0777);
        fclose($myfile); 
        //echo $filpath; exit; 
        return $filpath;       
    }
    /****************  End of pdf file decrypt  *******************/ 

    /****************  Start PDF file encrypt  **************************/
    public function getpdffileencrypt($pdf_content,$pdfpath)
    {   
        //echo $pdf_url; exit;
        $time = time();
        $finalkey = 'cGFzc3dkQDEyMw==';  
        $file_encrypted = fileencrypt($pdf_content, $finalkey);         
        //echo $completepath; exit; 
        $myfile = fopen($pdfpath, "w") or die("Unable to open file!");              
        fwrite($myfile, $file_encrypted);
        fclose($myfile);
        chmod($pdfpath,0777);
        // echo $pdfpath; exit;   
        return $pdfpath;      
    }
    /****************  End of pdf file encrypt  *******************/ 
    
    /* ********* Merge pdf file start ********* */
    public function mergePDFFiles($filelist,$oppdfpath,$insertpageno) 
    {
        $mpdf = new mPDF();
//           echo "ur files ";echo '<pre>'; print_r($filelist);
        $mergepath = $mpdf->mergePDFFiles($filelist, $oppdfpath);
//         echo "ur files after";echo '<pre>'; print_r($mergepath); exit;
        return $mergepath;
    }
    /* ********* Merge pdf file end ********* */
    

    public function getword($word_content,$rsname) 
    {
        $time = time();
                
        //$word_content = html_entity_decode($word_content, ENT_QUOTES, "UTF-8");
        //print_r($word_content); exit;
        $StrArr = str_split($word_content); $NewStr = '';
        foreach ($StrArr as $Char)
        {
            $CharNo = ord($Char);
            if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £
            if ($CharNo > 31 && $CharNo < 127) {
            $NewStr .= $Char;
            }
        }

        $word_content = $NewStr;
        $wordcss = file_get_contents("css/pdf/word.css");
        // echo $wordcss ; exit;
        //echo $word_content ; exit;
        $description = $word_content.$wordcss;
        $content ='';
        $content.= '<html><head><style>'.$wordcss.'</style></head>';

        $content.= $word_content;

        //echo $content; exit;
        $filename = $rsname.'_'.rand().".docx";
        $path = $this->contractagreementdir."/wordfiles";
        //echo $path; exit;
        $filpath = $path.'/'.$filename;
        //echo $filpath; 

        //chmod($filpath,0777);
        $myfile = fopen($filpath, "w") or die("Unable to open file!");
        $txt = $content;
         //$randomnumber = rand(10,1000);
         //$finalkey = md5(uniqid($randomnumber, true));
         //print_r($finalkey);exit;
        $finalkey = 'cGFzc3dkQDEyMw==';
        $file_encrypted = fileencrypt($txt, $finalkey);
        //echo $file_encrypted; exit;       
        fwrite($myfile, $file_encrypted);
        fclose($myfile);
        chmod($filpath,0777);
        //echo $myfile; exit;   
        return $filpath;
    }


    /************************ Generate request word file ***************/

    public function getwordreq($word_content,$rsname) 
    {
        $time = time();
                
        //$word_content = html_entity_decode($word_content, ENT_QUOTES, "UTF-8");
        //print_r($word_content); exit;
        $StrArr = str_split($word_content); $NewStr = '';
        foreach ($StrArr as $Char)
        {
            $CharNo = ord($Char);
            if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £
            if ($CharNo > 31 && $CharNo < 127) {
            $NewStr .= $Char;
            }
        }

        $word_content = $NewStr;
        $wordcss = file_get_contents("css/pdf/word.css");
        // echo $wordcss ; exit;
        //echo $word_content ; exit;
        $description = $word_content.$wordcss;
        $content ='';
        $content.= '<html><head><style>'.$wordcss.'</style></head>';

        $content.= $word_content;

         //echo "dff";print_r($rsname); exit;
        //$filename = $rsname;
        $path = $this->contractagreementdir."/req_wordfiles";
        //echo $path; exit;
        $filpath = $path.'/'.$rsname;
         //print_r($filpath); exit; 

        //chmod($filpath,0777);
        $myfile = fopen($filpath, "w") or die("Unable to open file!");
        $txt = $content;
         //$randomnumber = rand(10,1000);
         //$finalkey = md5(uniqid($randomnumber, true));
         //print_r($finalkey);exit;
        $finalkey = 'cGFzc3dkQDEyMw==';
        $file_encrypted = fileencrypt($txt, $finalkey);
        //echo $file_encrypted; exit;       
        fwrite($myfile, $file_encrypted);
        fclose($myfile);
        chmod($filpath,0777);
        //echo $myfile; exit;   
        return $filpath;
    }

    /****************  Start decrypt the file **************************/

    public function getdecrptedfile($word_url) 
    {
        $time = time();                
     
        $word_content = file_get_contents($word_url);
        //echo $word_content ; exit;
        $content.= $word_content;

        //echo $content; exit;
        $filename = 'decrypt'.'_'.rand().".doc";
        $path = $this->contractagreementdir."/wordfiles/temp";
        //echo $path; exit;
        $filpath = $path.'/'.$filename;
        //echo $filpath; 

        //chmod($filpath,0777);
        $myfile = fopen($filpath, "w") or die("Unable to open file!");
        $txt = $content;
         //$randomnumber = rand(10,1000);
         //$finalkey = md5(uniqid($randomnumber, true));
         //print_r($finalkey);exit;
        $finalkey = 'cGFzc3dkQDEyMw==';
        $file_decrypted = filedecrypt($content, $finalkey);
        //echo "reached here".$file_decrypted; exit;       
        fwrite($myfile, $file_decrypted);
        fclose($myfile);
        chmod($filpath,0777);
        //echo $myfile; exit;   
        return $filpath;
    }
    
    /****************  End of Start decrypt the file *******************/ 

      public function encryptmyfile($content)
    {   
        // echo $wordurl; exit;
        $time = time();     
        // $pdf_content = file_get_contents($pdf_url);
        //print_r($pdf_content);exit;
        // $content = utf8_decode($wordurl);
        $filename = 'decrypt'.'_'.rand().".docx";
        $path = $this->contractagreementdir."/wordfiles/temp";
        //echo $path; exit;
        $filpath = $path.'/'.$filename;
        $finalkey = 'cGFzc3dkQDEyMw==';
        $myfile = fopen($filpath, "w") or die("Unable to open file!");
        $fileencrypt = fileencrypt($content, $finalkey);        
        fwrite($myfile, $fileencrypt);
        fclose($myfile);
        chmod($filpath,0777);
        //echo $myfile; exit;   
        return $filpath;
        // return $filpath;       
    }


    public function getdecrptfileforxeo($pdf_url,$agname)
    {   
        //echo $pdf_url; exit;
        $time = time();     
        $pdf_content = file_get_contents($pdf_url);
        //print_r($pdf_content);exit;
        //$content = utf8_decode($pdf_content);
        $finalkey = 'cGFzc3dkQDEyMw==';
        $file_decrypted = filedecrypt($pdf_content, $finalkey);
              
        $getrandomcode = 'decrypted_file';
        $filename = $agname.'_'.$time.'.pdf';  
        $path = $this->contractagreementdir."/pdffiles/temp";
        $filpath = $path.'/'.$filename;      
        $myfile = fopen($filpath, "w") or die("Unable to open file!");               
        fwrite($myfile, $file_decrypted);        
        chmod($filpath,0777);
        fclose($myfile); 
        //echo $filpath; exit; 
        return $filpath;       
    }

}