
<?php

 function send_notification ($tokens, $message)
 {
 	$url = 'https:fcm.googleapis.com/fcm/send';
 	$fields = array(
 	'registration_ids'=> $tokens,
 	'data' => $message 
 	);

 	$headers = array(
    	'Authorization:key = AAAAGUMwwno:APA91bHD7ODtwiUG10PJmnm9FJuAhXKnxjGv2qQ1VQjZ8c-DjNV9Og4xtQrkJ3bHtvEBzDSTl7wlmVbvxo2kuUNhBJVVuHPjUwNMy_gLI-bEm-K8dLFXDD-E_N7tuvEsKaY_cazaOe3m',
    	'Content-Type: application/json'
 	);

 	$ch = curl_init();
 	curl_setopt($ch, CURLOPT_URL, $url);
 	curl_setopt($ch, CURLOPT_POST, true);
 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 	$result = curl_exec($ch);
 	if($result=== FALSE){
 		die('Curl failed:' .curl_error($ch));
 	}
 	curl_close($ch);
 	return $result;
 }


 	$conn = mysqli_connect("localhost","root","","fcm");

 	$sql = "Select Token From users";

 	$result = mysqli_query($conn,$sql);
 	$tokens = array();

 	if(mysqli_num_rows($result) > 0 ){
 		
 		while($row = mysqli_fetch_assoc($result)){
 			$tokens[] = $row["Token"];
 		}
 	}

 	mysqli_close($conn);

 	$message = array("message" => "magang PUSH NOTIFICATION TEST MESSAGE");
 	$message_status = send_notification($tokens, $message);
 	echo $message_status ;


 	?>