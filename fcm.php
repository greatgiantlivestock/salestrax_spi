<?php 
$conn = mysqli_connect("localhost","homt3248_ms","moha11mmad","homt3248_salestrax");
$sql = "Select Token From fcm";
$query = mysqli_query($conn,$sql);

if(mysqli_num_rows($query) > 0 ){

    while ($row = mysqli_fetch_assoc($query)) {
        // $to='caaC3v0I4z4:APA91bHGuX7oJnklErOWulbzF0C6ZlKad9JwdT4LGTadcxo8e0BFb5xwsR7U-GR_ltkZrdp8vZCDCgJKClLVlS5hLAHuCPlm7MXMZNSvAT8BsXYf8kqPOW-cwRAibmEaBnZaomOmSqtP';
        $to=$row["Token"];
        $data=array('body'=> 'New Message');

        function sendPushNotification($to='', $data=array()){
            $json_data = array('to'=> $to,'notification'=>$data);
            $data = json_encode($json_data);
            $server_key = 'AIzaSyB9mF-RbtkLxeIEQKk3gLeDxZ3y8sU4F1c';
            $headers = array('Authorization:key='.$server_key,'Content-Type:application/json');
            
            $url = 'https://fcm.googleapis.com/fcm/send';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Oops! FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);

            return json_decode($result, true);
        }

        print_r(sendPushNotification($to,$data)); 
    }
}

?>