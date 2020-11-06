
<?

 function send_notification ($tokens, $message)
 {
 	$url = 'https:magang.googleapis.com/apimagang/send';
 	$fields = array(
 	'registration_ids'=> $tokens,
 	'data' => $message 
 	);

 	$headers = array(
    	'Authorization:key = AAAARWb13-0:APA91bFmMOqXs7tnL7hQlkrpWI0B2QSPcLgkpbsbEJcZ9a5poAOe5topalWJh61WX82vNuHNE-nCu2WTDrR-Hsfivw_zGmrzYhxmV-DtxwbgT0h1Og_jPVI2unK5e7wB54spvJUjv_ga',
    	'content-Type:application/json'
 	);

 	$ch = curl_init();
 	curl_setopt($ch, CURLOPT_URL, $url);
 	curl_setopt($ch, CURLOPT_POST, true);
 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 	$result = curl_exec(ch);
 	if($result=== FALSE){
 		die('Curl failed:' .curl_error($ch));
 	}
 	curl_close($ch);
 	return $result;
 }


 	$conn = mysqli_connect("localhost","root","","magang");

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