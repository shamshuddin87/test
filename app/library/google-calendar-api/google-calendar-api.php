<?php

class GoogleCalendarApi
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
		   // header('Location: http://localhost/volody/boardapp/event?moc=eventlist');
			throw new Exception('Error : Failed to receieve access token');
			
		return $data;
	}

	public function GetUserCalendarTimezone($access_token) {
		$url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';			
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url_settings);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	
		$data = json_decode(curl_exec($ch), true); 
		
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

	public function CreateCalendarEvent($calendar_id, $summary, $all_day, $event_time,$emailiddir,  $event_timezone, $emailtextde, $locationget, $access_token) {
		 

		$url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';
         
         
		 $curlPost = array('summary' => $summary,'location' => $locationget,'description' => $emailtextde);

		 //print_r($curlPost);exit;	

			//$curlPost = array('sendNotifications'=>true);	

     
       $curlPost['reminders'] = array('overrides' => array('method' => 'email', 'minutes' => 24 * 60));
       $curlPost['reminders'] = array('method' => 'popup', 'minutes' => 1);
 	  
        foreach($emailiddir as $inv_key => $inv_val){

        	$attendees[] = array('email' => $inv_val);
        }
        
				
		$curlPost['attendees'] = $attendees;
		if($all_day == 1) {
			$curlPost['start'] = array('date' => $event_time['event_date']);
			$curlPost['end'] = array('date' => $event_time['event_date']);
		}
		else {
			$curlPost['start'] = array('dateTime' => $event_time['start_time'], 'timeZone' => $event_timezone);
			$curlPost['end'] = array('dateTime' => $event_time['end_time'], 'timeZone' => $event_timezone);			
          
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
        //print_r(json_encode($curlPost));exit;
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($final_arr));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		print_r($http_code);exit;		
		if($http_code != 200) 
			throw new Exception('Error : Failed to create event');

		return $data['id'];
	}
}

?>