<?php
use Phalcon\Mvc\User\Component;
use Phalcon\Filter;
class Timecommon extends Component
{
	
	public function time_stamp($session_time) 
	{ 
		$time_difference = time() - $session_time ; 
		$seconds = $time_difference ; 
		$minutes = round($time_difference / 60 );
		$hours = round($time_difference / 3600 ); 
		$days = round($time_difference / 86400 ); 
		$weeks = round($time_difference / 604800 ); 
		$months = round($time_difference / 2419200 ); 
		$years = round($time_difference / 29030400 ); 
	
		if($seconds <= 60)
		{
		echo"$seconds seconds ago"; 
		}
		else if($minutes <=60)
		{
		   if($minutes==1)
		   {
			 echo"1 minute ago"; 
			}
		   else
		   {
		   echo"$minutes minutes ago"; 
		   }
		}
		else if($hours <=24)
		{
		   if($hours==1)
		   {
		   echo"1 hour ago";
		   }
		  else
		  {
		  echo"$hours hours ago";
		  }
		}
		else if($days <=7)
		{
		  if($days==1)
		   {
		   echo"1 day ago";
		   }
		  else
		  {
		  echo"$days days ago";
		  }
		
		
		  
		}
		else if($weeks <=4)
		{
		  if($weeks==1)
		   {
		   echo"1 week ago";
		   }
		  else
		  {
		  echo"$weeks weeks ago";
		  }
		 }
		else if($months <=12)
		{
		   if($months==1)
		   {
		   echo"1 month ago";
		   }
		  else
		  {
		  echo"$months months ago";
		  }
		 
		   
		}
	
	else
	{
		if($years==1)
		   {
			   echo"1 year ago";
		   }
		else
		   {
			   echo"$years years ago";
			  }
		   }
	}     
    
	public function timeAgo($time_ago){
		$cur_time 	= time();        
		$time_elapsed 	= $cur_time - $time_ago;        
		$seconds 	= $time_elapsed ;
		$minutes 	= round($time_elapsed / 60 );        
		$hours 		= round($time_elapsed / 3600);
		$days 		= round($time_elapsed / 86400 );
		$weeks 		= round($time_elapsed / 604800);
		$months 	= round($time_elapsed / 2600640 );
		$years 		= round($time_elapsed / 31207680 );
		// Seconds
		if($seconds <= 2){
			$getresult = "Just now";
		}
		else if($seconds <= 60){
			$getresult = "$seconds seconds ago";
		}
		//Minutes
		else if($minutes <=60){
			if($minutes==1){
				$getresult = "1 minute ago";
			}
			else{
				$getresult = "$minutes minutes ago";
			}
		}
		//Hours
		else if($hours <=24){
			if($hours==1){
				$getresult = "an hour ago";
			}else{
				$getresult = "$hours hours ago";
			}
		}
		//Days
		else if($days <= 7){
			if($days==1){
				$getresult = "yesterday";
			}else{
				$getresult = "$days days ago";
			}
		}
		//Weeks
		else if($weeks <= 4.3){
			if($weeks==1){
				$getresult = "a week ago";
			}else{
				$getresult = "$weeks weeks ago";
			}
		}
		//Months
		else if($months <=12){
			if($months==1){
				$getresult = "a month ago";
			}else{
				$getresult = "$months months ago";
			}
		}
		//Years
		else{
			if($years==1){
				$getresult = "1 year ago";
			}else{
				$getresult = "$years years ago";
			}
		}
		return $getresult;
	}
	
	public function convertime($ptime) {
			$etime = time() - $ptime;
		
			if ($etime < 60) {
				return 'less than minute ag';
			}
		
			$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
					30 * 24 * 60 * 60       =>  'month',
					24 * 60 * 60            =>  'day',
					60 * 60                 =>  'hour',
					60                      =>  'minute'
				  //  1                       =>  'second'
					);
		
		foreach ($a as $secs => $str) {
			$d = $etime / $secs;
			if ($d >= 1) {
				$r = round($d);
				return $r . ' ' . $str . ($r > 1 ? 's' : '');
			}
		}
	}
	public  function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["PHP_SELF"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];
	 }
	 return $pageURL;
	}
	public function getformdate($date){
		 $phpdate = strtotime($date);
         $mysqldate = date( 'D\,\ jS \of F Y', $phpdate );
         return $mysqldate;
	}
}
