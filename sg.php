<?php
/**
 * CREATE : M34L@Ismail Muhammad Zeindy
 * EDITED : IKIGANTENG
 * GANTI TULISAN SEMOGA MATI MENDADAK LO AJG
 * Special Thanks To : Setya Mickala as SHARE AIRDROP
 */

$i = 0;
$j = 0;
    while(true){
        $randomAWB = 'LP190'.rand(000000,999999).'SG'; // atur target sendiri
        $check = sg($randomAWB);
        $json_check = json_decode($check,true);
            if ($json_check['rajaongkir']['status']['code'] == 200) {
                        $status = $json_check['rajaongkir']['result']['delivery_status']['status'];
						$date = $json_check['rajaongkir']['result']['delivery_status']['pod_date'];
                        $awb = $json_check['rajaongkir']['result']['summary']['waybill_number'];
                        $origin = $json_check['rajaongkir']['result']['summary']['origin'];
                        $destination = $json_check['rajaongkir']['result']['summary']['destination'];
                        //$str = "$key : $status : $awb";
    
                        echo " $i. $awb : $status : $date : $origin : $destination \n";
                        
                        file_put_contents('sg.txt',"$awb : $status : $date : $origin : $destination ".PHP_EOL,FILE_APPEND);
                        $i++;
                    
                
            } else {
                echo "$j. $randomAWB : ".$json_check['rajaongkir']['status']['description']."\n";
                $j++;

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

function sg($awb){
    $url = 'https://www.cekpengiriman.com/wp-content/themes/resiongkir/data/awb/singpost.php';
	  $headers = array();
    $headers[] = 'Host: www.cekpengiriman.com';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:87.0) Gecko/20100101 Firefox/87.0';
    $headers[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
    $headers[] = 'Accept-Encoding: gzip, deflate, br';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Cookie: _ga=GA1.2.1254192368.1617760069; _gid=GA1.2.1611132824.1617760069; __gads=ID=591db80335f6032a-22dd111708c700f7:T=1617760134:RT=1617760134:S=ALNI_MZKqzOpdWB_EcI9YYGvAOjA6bSyow; __Host-cekpengiriman_session=0ib998mevl2vhm0pkfo9qohiau; _gat_gtag_UA_151127765_1=1';
    $headers[] = 'Accept: */*';
	  $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
	  $body = 'nomor='.$awb.'&kurir=singpost&type=awb&uuid=d06e0a32a8cec70eb9c59b29273c5c9b';
// kalo error ganti uuid, ambil di webnya
    $post = curl($url,$body,$headers);
			return $post;
}


?>
