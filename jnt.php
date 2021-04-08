<?php
/**
 * CREATE : M34L@Ismail Muhammad Zeindy
 * EDITED : IKIGANTENG
 * GANTI TULISAN SEMOGA MATI MENDADAK LO AJG
 * Special Thanks To : Setya Mickala as SHARE AIRDROP
 */

$i = 0;
$j = 0;
$resi = 4041526025; //edit sesuai target

   while(true){
		$randomAWB = 'JP'.$resi++;
        //$randomAWB = 'JP4'.rand(00000000,99999999);
        $check = jnt($randomAWB);
        $json_check = json_decode($check,true);
            if (strpos($check, 'Invalid waybill. Resi yang Anda masukkan salah atau belum terdaftar.')) {
                echo "$j. $randomAWB : Invalid waybill. Resi yang Anda masukkan salah atau belum terdaftar. \n";
                $j++;       
            } elseif ($json_check['rajaongkir']['status']['code'] == 200) {
                        $status = $json_check['rajaongkir']['result']['delivery_status']['status'];
						            $date = $json_check['rajaongkir']['result']['delivery_status']['pod_date'];
                        $awb = $json_check['rajaongkir']['result']['summary']['waybill_number'];
                        $origin = $json_check['rajaongkir']['result']['summary']['origin'];
                        $destination = $json_check['rajaongkir']['result']['summary']['destination'];
                        //$str = "$key : $status : $awb";
    
                        echo " $i. $awb : $status : $date : $origin : $destination \n";
                        
                        file_put_contents('jnt.txt',"$awb : $status : $date : $origin : $destination ".PHP_EOL,FILE_APPEND);
                        $i++;
			}
	}
	

function curl($url, $data = 0, $header = 0, $cookie = 0) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    // curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    if($header) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    }
    if($data) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    if($cookie) {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    }
    $x = curl_exec($ch);
    curl_close($ch);
    return $x;
}

function jnt($awb){
    $url = 'https://api2.melisa.id/raja-ongkir/waybill';
	  $headers = array();
    $headers[] = 'Host:  api2.melisa.id';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:87.0) Gecko/20100101 Firefox/87.0';
    $headers[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
    $headers[] = 'Accept-Encoding: gzip, deflate, br';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE1MTk4Nzg1MzgsImp0aSI6NCwiaXNzIjoiaHR0cDpcL1wvYXBpLmxvY2FsaG9zdCIsImF1ZCI6Imh0dHA6XC9cL2FwaS5sb2NhbGhvc3QiLCJuYmYiOjE1MTk4Nzg1MzgsImV4cCI6MjI5NzQ3ODUzOH0.SpAi9gIqU_J2jBwKWpSBx1kpARj5mNoyScKNgAdwXA_lLaW8bsyEs2DSDeDUF_VMBDyKWC0FizKL6wvLYBHCrw';
    $headers[] = 'Accept: application/json, text/plain, */*';
	  $headers[] = 'Content-Type: application/json;charset=utf-8';
	  $body = '{"courier":"jnt","waybill":"'.$awb.'"}';
    $post = curl($url,$body,$headers);
			return $post;
}
 //$check = kr('JP40452186800');
//$json_check = json_decode($check,true);
//ikiganteng
?>
