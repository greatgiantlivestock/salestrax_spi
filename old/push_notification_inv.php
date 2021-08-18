<?php 

function send_notification($tokens, $message, $title){
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' => $tokens,
        'data' => $message,
        'notification' => $title
    );

    $headers = array(
        'Authorization:key = AIzaSyB9mF-RbtkLxeIEQKk3gLeDxZ3y8sU4F1c',
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);           
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

$conn = mysqli_connect("localhost","gred3696_ms","moha11mmad","gred3696_do_gantung");
$sql = "SELECT Token FROM master_perangkat";
$result = mysqli_query($conn,$sql);
$tokens=array();
if(mysqli_num_rows($result) > 0 ){

    while ($row = mysqli_fetch_assoc($result)) {
        $tokens[] = $row["Token"];
    }
}

mysqli_close($conn);
	$message = array("message" => "Data Invoice Pending di server telah diperbarui, silahkan tekan tombol refresh untuk melakukan update.");
	// $title = array("title" => "Data Invoice Pending di Server Telah Diperbarui");
	$message_status = send_notification($tokens, $message, $title);
	echo $message_status;

?>