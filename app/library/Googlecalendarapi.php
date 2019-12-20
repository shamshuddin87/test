<?php
use Phalcon\Mvc\User\Component;

class Googlecalendarapi extends Component
{
	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
		$url = 'https://accounts.google.com/o/oauth2/token';			
		
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve access token Note : You can not refresh page after getting google authentication Please go to back page');
			
		return $data;
	}

	public function GetUserCalendarTimezone($access_token) {

		
		$url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';

		
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_settings);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true); //echo '<pre>';print_r($data);echo '</pre>';

		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get timezone');

		return $data['value'];
	}

	public function GetCalendarsList($access_token) {
		$url_parameters = array();

		$url_parameters['fields'] = 'items(id,summary,timeZone)';
		$url_parameters['minAccessRole'] = 'owner';

		$url_calendars = 'https://www.googleapis.com/calendar/v3/users/me/calendarList?'. http_build_query($url_parameters);
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_calendars);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true); //echo '<pre>';print_r($data);echo '</pre>';
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get calendars list');

		return $data['items'];
	}



	public function CreateCalendarEvent($calendar_id, $summary, $all_day, $event_time, $invit_list, $event_timezone, $emailtextde, $location_get, $access_token) {

		
		$url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';         

		 $curlPost = array('summary' => $summary,'location' => $location_get,'description' => $emailtextde);        
     
       $curlPost['reminders'] = array('overrides' => array('method' => 'email', 'minutes' => 24 * 60));
      $curlPost['reminders'] = array('method' => 'popup', 'minutes' => 1);
 	   
 	   if(!empty($invit_list)){

        foreach($invit_list as $inv_key=>$inv_val){        	

		$attendees[] = array('email' => $inv_val);	

	  }

	  $curlPost['attendees'] = $attendees;

	  //print_r($curlPost['attendees']);exit;
	}
     
	 $datetime = $all_day.'T'.$event_time.':00';
	 $timestamp = strtotime($event_time) + 60*60;
	 $f_time = strftime('%H:%M', $timestamp);
	 $edatetime = $all_day.'T'.$f_time.':00';
      //print_r($edatetime);exit;
      // echo "<br>".'2018-03-30T18:44:00';
      // exit;
	
		if($all_day == 1) {
			
			$curlPost['start'] = array('date' => $all_day);
			$curlPost['end'] = array('date' => $all_day);
			//$curlPost['end'] = array('date' => $event_time['event_date']);
		}
		else {

			// $curlPost['start'] = array('date' => $all_day);
			// $curlPost['end'] = array('date' => $all_day);
			$curlPost['start'] = array('dateTime' => $datetime, 'timeZone' => $event_timezone);
			$curlPost['end'] = array('dateTime' => $edatetime, 'timeZone' => $event_timezone);				
          
		}
		
		 $final_arr = $curlPost;
		 $final_arr['sendNotifications'] = true;
		//print_r($final_arr);exit;
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_events);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));
        //print_r(json_encode($final_arr));exit;
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($final_arr));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		//print_r($http_code);exit;		
		if($http_code != 200) 
			throw new Exception('Error : Failed to create event');
		return $data['id'];
	}

	
}

?>