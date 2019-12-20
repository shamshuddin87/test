<?php
use Phalcon\Mvc\User\Component;
class Imagecommon extends Component
{
 
   private $image;
   private $image_type;
   
   
   public function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   public function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   public function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   public function getWidth() {
 
      return imagesx($this->image);
   }
   public function getHeight() {
 
      return imagesy($this->image);
   }
   public function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   public function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   public function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   public function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }
    
    
    public function getimgdir($userid,$username,$session_uniqueid,$directorytype) {
 
        $getuser_session_id = $userid;
		$getuser_session_uniqueid = $session_uniqueid;
		$dirtype = $directorytype;
		$getuser_session_username = str_replace( ' ', '_', (trim(strtolower($username))));
		$getrandomchar = $this->validationcommon->randomcodegen_alpha('10') ;
		$createpostdirname = $getuser_session_id."_".$getuser_session_username."_outergenerated"; 
		if(!empty($getrandomchar))
		{$getrandomchar = $getrandomchar;$createpostdirname = $getuser_session_id."_".$getuser_session_username."_".$getrandomchar;}
		else{$getrandomchar = 'notgeneratedcode';
			$createpostdirname = $getuser_session_id."_".$getuser_session_username."_".$getrandomchar;
		}
		//$this->session->set($directorytype, array('createdirname' => $createpostdirname));
		
	 return $createpostdirname;	
   }
    
    
 
}
?>