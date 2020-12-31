<?php
class FCM {
    function __construct() {
    }
   /**
    * Sending Push Notification
   */
  public function send_notification($registatoin_ids, $notification,$device_type) {
      $url = 'https://fcm.googleapis.com/fcm/send';
      if($device_type == "Android"){
            $fields = array(
                'to' => $registatoin_ids,
                'notification' => array (
					"body" => $notification["body"],
					"title" => $notification["title"],
					"icon" => "myicon"
        )
            );
      } else {
            $fields = array(
                'to' => $registatoin_ids,
                'notification' => $notification
            );
      }
      // Firebase API Key
      $headers = array('Authorization:key=AAAApHc2VvM:APA91bFm_8wRNI1r0pHAkLiVEeH-rT71d8nqU9AXx30djisBkoze34UIlnyG_EKT5Ju4xvUOy5imxsA8cPNAlNrF0ecSQperUGyo6F24n6srNiUlxZDYK2oM2pra6xm0jsMa7QEjBSQP','Content-Type:application/json');
     // Open connection
      $ch = curl_init();
      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Disabling SSL Certificate support temporarly
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);

      if ($result === FALSE) {
          die('Curl failed: ' . curl_error($ch));
      }
	  echo $result;
      curl_close($ch);
  }
}   
?>