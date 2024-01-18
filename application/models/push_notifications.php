<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Push_notifications extends MY_Model {
	function send_notification_mobile($to, $data)
	{	
		$authorization_key = "AIzaSyBxhMvaZzykt6A-WcyMNqWCqg-ln8lmapc";	    
		$fields = array
			(
				'to'		=> $to,
				'data'	=> $data
			);		
		
		$headers = array
			(
				'Authorization: key=' . $authorization_key,
				'Content-Type: application/json'
			);
		#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		#Echo Result Of FireBase Server
		echo $result;
	}
}