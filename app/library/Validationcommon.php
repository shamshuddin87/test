<?php
use Phalcon\Mvc\User\Component;
use Phalcon\Filter;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\ValidatorInterface;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Message;

class Validationcommon extends Component
{
    public function emailfilter($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "email");
            return $getvalue;
        }
    public function stripescapesHTML($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "string");
            return $getvalue;
        }
    public function getint($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "int");
            return $getvalue;
        }
    public function getfloat($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "float");
            return $getvalue;
        }
    public function getalphanum($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "alphanum");
            return $getvalue;
        }
    public function striptagshtml($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "striptags");
            return $getvalue;
        }
    public function whitespaceleftright($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "trim");
            return $getvalue;
        }
    public function strlower($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "lower");
            return $getvalue;
        }
    public function strupper($getstring)
        {
            $filter = new Filter();
            $getvalue = $filter->sanitize($getstring, "upper");
            return $getvalue;
        }
    public function emailvalidate($email)
    {
        //echo $this->emailfilter($email);
        //exit;
        $email = $this->emailfilter($email);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {
            return false;
        }
    }
    public function dobvalidate($date,$month,$year)
    {

        $dob = checkdate($month,$date,$year);
        if(!$dob === false) {
            return true;
        } else {
            return false;
        }
    }
    public function telephone()
    {
        $controllerName = $this->view->getControllerName();
        //echo $controllerName ;
        //exit();
        return $validate;
    }
    public function geturlsegment($geturl,$segementnum)
    {
        $getsegment = parse_url($geturl, PHP_URL_PATH);
        $segments = explode('/', $getsegment);
        $currentSegment = $segments[$segementnum];
        //$numSegments = count($segments);
        //$currentSegment = $segments[$numSegments - $segementnum];
        //echo $currentSegment;exit;

        return $currentSegment;
    }
    ##########################################################################################################
    # IMAGE FUNCTIONS                                                                                         #
    # You do not need to alter these functions                                                                 #
    ##########################################################################################################
    public function resizeImage($image,$width,$height,$scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);

        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$image,90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$image);
                break;
        }

        chmod($image, 0777);
        return $image;
    }
    //You do not need to alter these functions
    public function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);

        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$thumb_image_name,90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$thumb_image_name);
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }
    //You do not need to alter these functions
    public function getHeight($image) {
        $size = getimagesize($image);
        $height = $size[1];
        return $height;
    }
    //You do not need to alter these functions
    public function getWidth($image) {
        $size = getimagesize($image);
        $width = $size[0];
        return $width;
    }
    public function randomcodegen_alpha($getlength)
    {
    $lengthfilename = $getlength;
    $stringfilename = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $lengthfilename);
    return $stringfilename;
    }
    public function randomcodegen_alphanum($getlength)
    {
    $lengthfilename = $getlength;
    $stringfilename = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $lengthfilename);
    return $stringfilename;
    }
    public function randomcodegen_capsalphanum($getlength)
    {
    $lengthfilename = $getlength;
    $stringfilename = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $lengthfilename);
    return $stringfilename;
    }
    public function randomcodegennum($getlength)
    {
    $lengthfilename = $getlength;
    $stringfilename = substr(str_shuffle("0123456789"), 0, $lengthfilename);
    return $stringfilename;
    }

    public function getfileext($getext)
    {
        $ext = pathinfo($getext);
        $extension = $ext['extension'];
        return $extension;
    }
    public function getfilebasename($getext)
    {
        $ext = pathinfo($getext);
        $extension = $ext['filename'];
        return $extension;
    }
    public function special_chars($str)
    {
        /*//function used to convert spl char into html entities*/
        $str = htmlentities($str);
        //$str = preg_replace('/&(.)(acute|cedil|circ|lig|grave|ring|tilde|uml);/', "$1", $str);
        return $str;
    }
    public function get_vimeo_video_id($url) {
            $url = str_replace("https://", "", $url);
            $url = str_replace("http://", "", $url);
            $segments = explode("/", $url);
            $media = array();
            if ($segments[1] != "") {
                $video_id = $segments[1];
                return $video_id;
            }
            return FALSE;
    }
    public function get_youtube_video_id($url){
        if(!empty($url)) {
            $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
            preg_match($pattern, $url, $matches);
            if (isset($matches[1])) {
                return $matches[1];
            }
        }
        return FALSE;
    }

    public function videoType($url) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }
    public function zipcreate($upload_path,$filename,$fget)
    {
        $zip = new ZipArchive();

        $getres = $fget;
        //echo '<pre>';print_r($getres);exit;

        $zip_name = $upload_path.'/'.$filename.".zip"; // Zip name
        //$zip_name = 'img/agenda_merger/1_Main/xyz.zip';
        //echo $zip_name; exit;
        $filenameog = $filename.".zip";
        
        $zip->open($zip_name,  ZipArchive::CREATE);
        //echo '<pre>';print_r($getres);exit;
        foreach ($getres as $file) 
        {
            $path = $file;
            //print_r($path);
            if(file_exists($path))
            {
               //echo "hello";exit;
                $zip->addFromString(basename($path),  file_get_contents($path));
                $dataget = true;                
            }
            else
            {
                $dataget = false;
            }
        }

        $zip->close();
        
        return $zip_name;
    }
    public function getvideoforpost($getpostedvidurl)
    {
          $vType = $this->videoType($getpostedvidurl);

          if($vType === 'youtube'){
            $id = $this->get_youtube_video_id($getpostedvidurl);
            $media = '<div class="videowrapper">
              <iframe height="300" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>
            </div>';
          }
          else if($vType === 'vimeo') {
            $id = $this->get_vimeo_video_id($getpostedvidurl);
            $media = '<div class="videowrapper">
              <iframe src="http://player.vimeo.com/video/'.$id.'" height="300" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            </div>';
          }
          else
          {
              $media ='';
          }
          return $media;
    }

    public function validateip($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6) === false) {
            /*echo("$ip is a valid IP address");*/
            return true;
        } else {
            /*echo("$ip is not a valid IP address");*/
            return false;
        }
    }
    public function cleansplcharall($string)
    {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
       $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

       return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }
    public function cleansplcharforexcel($string)
    {
       $string = str_replace(' ', ' ', $string); // Replaces all spaces with hyphens.
       $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.

       return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }
    public function cleanchar($m)
    {
        $kevalm = str_replace('&nbsp;','',$m);
        $kevalm = trim(strtolower($kevalm));
        $kevalm = str_replace(' ','',$kevalm);
        $kevalm = str_replace('-','',$kevalm);
        $kevalm = str_replace('_','',$kevalm);
        $kevalm = preg_replace('/[^A-Za-z0-9\-]/', '', $kevalm);
        return $kevalm;
    }
    public function fixarraykey($arr)
    {
        $arr=array_combine(array_map(function($str)
        { $str = str_replace(" ","",$str) ;return str_replace("-","",$str);
        },array_keys($arr)),array_values($arr));
        foreach($arr as $key=>$val)
        {
            if(is_array($val)) fixArrayKey($arr[$key]);
        }
        return $arr;
    }
    public function arrayext($needle, $haystack) {
                 if(in_array($needle, $haystack)) {
                      return true;
                 }
                 foreach($haystack as $element) {
                      if(is_array($element) && $this->arrayext($needle, $element))
                           return true;
                 }
               return false;
    }
    public function numbertoword($data) {
        // Replace all number words with an equivalent numeric value
        $data = strtr(
            $data,
            array(
                'zero'      => '0',
                'a'         => '1',
                'one'       => '1',
                'two'       => '2',
                'three'     => '3',
                'four'      => '4',
                'five'      => '5',
                'six'       => '6',
                'seven'     => '7',
                'eight'     => '8',
                'nine'      => '9',
                'ten'       => '10',
                'eleven'    => '11',
                'twelve'    => '12',
                'thirteen'  => '13',
                'fourteen'  => '14',
                'fifteen'   => '15',
                'sixteen'   => '16',
                'seventeen' => '17',
                'eighteen'  => '18',
                'nineteen'  => '19',
                'twenty'    => '20',
                'thirty'    => '30',
                'forty'     => '40',
                'fourty'    => '40', // common misspelling
                'fifty'     => '50',
                'sixty'     => '60',
                'seventy'   => '70',
                'eighty'    => '80',
                'ninety'    => '90',
                'hundred'   => '100',
                'thousand'  => '1000',
                'million'   => '1000000',
                'billion'   => '1000000000',
                'and'       => '',
            )
        );

        // Coerce all tokens to numbers
        $parts = array_map(
            function ($val) {
                return floatval($val);
            },
            preg_split('/[\s-]+/', $data)
        );

        $stack = new SplStack; // Current work stack
        $sum   = 0; // Running total
        $last  = null;

        foreach ($parts as $part) {
            if (!$stack->isEmpty()) {
                // We're part way through a phrase
                if ($stack->top() > $part) {
                    // Decreasing step, e.g. from hundreds to ones
                    if ($last >= 1000) {
                        // If we drop from more than 1000 then we've finished the phrase
                        $sum += $stack->pop();
                        // This is the first element of a new phrase
                        $stack->push($part);
                    } else {
                        // Drop down from less than 1000, just addition
                        // e.g. "seventy one" -> "70 1" -> "70 + 1"
                        $stack->push($stack->pop() + $part);
                    }
                } else {
                    // Increasing step, e.g ones to hundreds
                    $stack->push($stack->pop() * $part);
                }
            } else {
                // This is the first element of a new phrase
                $stack->push($part);
            }

            // Store the last processed part
            $last = $part;
        }

        return $sum + $stack->pop();
    }

    public function validatearray($array)
    {
        $return_array = array();
        if (!empty($array)) {
            for ($i=0; $i < sizeof($array); $i++) {
                   $return_array[] = strip_tags(trim($array[$i]));
               }
        }
           return $return_array; // Replaces multiple hyphens with single one.
    }

    public function get_addproject($string){
        if($string){
            $trimmed_str = explode("_", $string);
            return $trimmed_str;
        }
    }

    public function get_query($array){
        $array_length = sizeof($array);
        $abc = "(";
        for($i=0;$i<=($array_length - 1);$i++){
            $abc .= "'";
            $abc .= $array[$i];
            $abc .= "'";
            if($i < ($array_length - 1)){
                $abc .= ",";
            }
        }
        $abc .= ")";
        return $abc;
    }
    
    public function commaarrayval($idrao)
    {
        $numItemsnot = count($idrao);
        $valuenot = '';
            $j=1;
            foreach($idrao as $valuegetnot)
            {
                    if($j !== $numItemsnot) {

                        $valuenot .= $valuegetnot.',';
                    }
                    else
                    {
                        $valuenot .= $valuegetnot;
                    }
                $j++;
            }
            $getvalue = $valuenot;
        return $getvalue;
    }
    public function logval($v)
    {
        if($v=='empl'){$val = 2;}
        else if($v=='superadmin'){$val = 1; }
        else{$val = 0;}
        return $val;
    }
    public function initminifiedjscript()
    {
        $timestampfile = time();
        $this->assets->collection('common')
        ->addJs('js/jquery.min.js')
        ->addJs('js/jquery-migrate.js')
        ->addJs('js/ajaxform.js')
        ->join(true)
        ->setTargetPath('js/minified/webiste-admin.js')
        ->setTargetUri('js/minified/webiste-admin.js')
        ->addFilter($this->jsmin);

        $this->assets->collection('commonmaterial')
        ->addJs('js/core/libraries/bootstrap.min.js')
        ->addJs('js/core/libraries/bootstrap-tagsinput.min.js')    
        ->addJs('js/plugins/notifications/pnotify.min.js')
        ->addJs('js/common.js')
        ->join(true)
        ->setTargetPath('js/minified/webiste-admin-common.js')
        ->setTargetUri('js/minified/webiste-admin-common.js?var='.$timestampfile)
        ->addFilter($this->jsmin);



        $this->assets->collection('validatejs')
        ->addJs('js/plugins/validation/jquery.validate.js')
        ->addJs('js/plugins/validation/jquery.form.js')
        // ->addJs('js/plugins/datepicker/bootstrap-material-datetimepicker.js')
        ->addJs('js/plugins/validation/additional-methods.min.js')
        ->join(true)
        ->setTargetPath('js/minified/validationjquery.js')
        ->setTargetUri('js/minified/validationjquery.js?var='.$timestampfile)
        ->addFilter($this->jsmin);

        $this->assets->collection('daterangepicker')
        ->addJs('js/plugins/moment/moment.min.js')
        ->addJs('js/plugins/datepicker/bootstrap-material-datetimepicker.js')
        ->addJs('js/plugins/datepicker/bootstrap-datetimepicker.min.js')
        ->join(true)
        ->setTargetPath('js/minified/daterangeget.js')
        ->setTargetUri('js/minified/daterangeget.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        $this->assets->collection('customscroll')
        ->addJs('js/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js')
        ->setTargetPath('js/minified/customscroll.js')
        ->setTargetUri('js/minified/customscroll.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        /*$this->assets->collection('visualization')
        ->addJs('js/plugins/visualization/d3/d3.min.js')
        ->addJs('js/plugins/visualization/d3/d3_tooltip.js')
        ->join(true)
        ->setTargetPath('js/minified/webiste-visualization.js')
        ->setTargetUri('js/minified/webiste-visualization.js?var='.$timestampfile)
        ->addFilter($this->jsmin);



        $this->assets->collection('multiselect')
        ->addJs('js/plugins/select/select2.full.js')
        ->join(true)
        ->setTargetPath('js/minified/webiste-multiselect.js')
        ->setTargetUri('js/minified/webiste-multiselect.js?var='.$timestampfile)
        ->addFilter($this->jsmin);

        */
        $this->assets->collection('multiselect')
        ->addJs('js/plugins/select/bootstrap-multiselect.js')     
        //->addJs('js/plugins/select/select2.full.js')    
        ->join(true)
        ->setTargetPath('js/minified/webiste-multiselect.js')
        ->setTargetUri('js/minified/webiste-multiselect.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        $this->assets->collection('chatpanel')
        ->addJs('js/chatplug/chat.js')    
        ->addJs('js/chatplug/TweenMax.min.js')  
        ->join(true)    
        ->setTargetPath('js/minified/chatpanel.js')
        ->setTargetUri('js/minified/chatpanel.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        $this->assets->collection('datatablemn')
        ->addJs('js/plugins/datatables/js/jquery.dataTables.min.js')
        ->addJs('js/plugins/datatables/js/dataTables.buttons.min.js')
        ->addJs('js/plugins/datatables/js/buttons.flash.min.js')
        ->addJs('js/plugins/datatables/js/jszip.min.js')                                 
        ->join(true)
        ->setTargetPath('js/minified/datatablechn.js')
        ->setTargetUri('js/minified/datatablechn.js?var='.$timestampfile)
        ->addFilter($this->jsmin);       

        $this->assets->collection('tableexport')        
        ->addJs('js/plugins/datatables/js/buttons.html5.min.js')         
        ->addJs('js/plugins/datatables/js/FileSaver.js')       
        ->addJs('js/plugins/datatables/js/tableexport.js')                  
        ->join(true)
        ->setTargetPath('js/minified/tblexports.js')
        ->setTargetUri('js/minified/tblexports.js?var='.$timestampfile)
        ->addFilter($this->jsmin);       

         $this->assets->collection('commingsoon')
        ->addJs('js/animation/three.js')
        ->setTargetPath('js/minified/commingsoon.js')
        ->setTargetUri('js/minified/commingsoon.js?var='.$timestampfile)
        ->addFilter($this->jsmin);

        $this->assets->collection('commingsoonnxt')
        ->addJs('js/animation/stats.js')
        ->setTargetPath('js/minified/commingsoonnxt.js')
        ->setTargetUri('js/minified/commingsoonnxt.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        $this->assets->collection('highcharts')
        ->addJs('js/charts/highcharts.js')
        ->join(true)
        ->setTargetPath('js/minified/web-erp-charts.js')
        ->setTargetUri('js/minified/web-erp-charts.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        $this->assets->collection('inputmaskforn')
        ->addJs('js/plugin/input_mask/jquery.inputmask.js')
        ->setTargetPath('js/minified/inputmaskforn.js')
        ->setTargetUri('js/minified/inputmaskforn.js?var='.$timestampfile)
        ->addFilter($this->jsmin);

 
        
/* ----------------- HighLighter All js Start ----------------- */ 
        $this->assets->collection('pdfjs')
        ->addJs('js/shared/pdf.js')
        //->setTargetPath('js/minified/pdfjs.js')
        //->setTargetUri('js/minified/pdfjs.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        $this->assets->collection('pdfviewerjs')
        ->addJs('js/shared/pdf_viewer.js') 
        //->setTargetPath('js/minified/pdfviewerjs.js')
        //->setTargetUri('js/minified/pdfviewerjs.js?var='.$timestampfile)
        ->addFilter($this->jsmin);
        
        $this->assets->collection('indexjs')
        ->addJs('js/index.js') 
        //->setTargetPath('js/minified/indexjs.js')
        //->setTargetUri('js/minified/indexjs.js?var='.$timestampfile)
        ->addFilter($this->jsmin);

/* ----------------- HighLighter All js Start ----------------- */
        
        
    }

}
