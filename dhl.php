<?php
/**
 * CREATE : M34L@Ismail Muhammad Zeindy
 * GANTI TULISAN SEMOGA MATI MENDADAK LO AJG
 * Special Thanks To : Setya Mickala as SHARE AIRDROP
 */
awal:
echo "Berapa Banyak? ";
$count = trim(fgets(STDIN));

$i = 0;
$j = 0;
$resi = 1468456275;

if (!empty($count)) {

    while(true){
		$randomAWB = $resi++;
        //$randomAWB = '112'.rand(0000000,9999999);
        $check = dhl($randomAWB);
        $json_check = json_decode($check,true);
        //print_r($json_check);

        foreach ($json_check as $key => $code){
            if ($key =="results") {
                foreach ($code as $kode){
                    if ($i >= $count) {
                        die("Done!");
                    } else {
                        $status = $kode['delivery']['status'];
                        $awb = $kode['id'];
                        $desc = $kode['description'];
                        $origin = $kode['origin']['value'];
                        $destination = $kode['destination']['value'];
                        //$str = "$key : $status : $awb";
    
                        echo " $i. $key: $status : $awb : $destination : $desc \n";
                        
                        file_put_contents('dhl.txt',"$key : $status : $awb : $origin - $destination : $desc".PHP_EOL,FILE_APPEND);
                        $i++;

                    }
                }
            } else {
                echo "$j. $randomAWB : INVALID AWB \n";
                $j++;

            }
        }

        
    }

} else {
    echo "\033[31m KETIK JUMLAHNYA GOBLOK \033[0m\n";
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

function dhl($awb){
    $url = 'https://www.dhl.com/shipmentTracking?AWB='.$awb.'&countryCode=g0&languageCode=en&_=1617645656661';
    $headers = array();
    $headers[] = 'Host: www.dhl.com';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:87.0) Gecko/20100101 Firefox/87.0';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
    $headers[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
    $headers[] = 'Accept-Encoding: gzip, deflate, br';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Cookie: _abck=CFA15E13F2CECCADE492C8B560F0EEF1~-1~YAAQrJ5hdi2ifqV4AQAAGj8VqwVKkOYwKL2CFJ8xwgORamHlLbSoPm035A4PxJ/tT30dPWvr3WIKfj/nnEi1jsJCuA2FaDOYahdIuZ/HowUgRMQNYupGUS3+Bvb9bVxS6XE5BlbsYLPx7nUoCM5uQcmNHJI98QIByodqkkvLjEhNcISN8bDHjRwiSyZKn4XV/fNQM2+4hTZVqt2m0j46HwyiSULaxHXSue+fxvwQ4GRTmWKwQAJge+N+yylwJnAEIUBE4R82sj2jqg9LoWAmmg/QJQAxkx88shyeHGiyeebnvbQE7mPJU3D4dhZ63DXadBcT4toGI/dcsR5ZP9WFcuVtk3yBd2vXFj7+h7i7AD3A6RnccCjkS8l22hBG/62yUfEZQBy+8lEm5ogQqHOGJUb1Be08v00TL3U6lPGR4w==~-1~-1~-1; dhl_cookie_consent=accepted; RT…&sl=2&tt=8lo&rl=1&obo=1&ld=88eq&r=1381lhfg&ul=88et&hd=89tn"; TS016f3c0b=01914b743d3288f5e1f31cbb799518ef9a1abcc6584ce1bf5e6ce7a2173af4503a05e233ca1e3d5b5d125ae0498a20e360b0b26f3a; bm_sz=AD35D5920B6A42BCF1C1CB9635421F63~YAAQrJ5hdiyifqV4AQAAGj8Vqwsg3qSwPMCDUyU8YTHGsc0Oh0X99qTiYIEEhblJeEws/e/bCrTNRT8noNEJ+x3ZNr1ZvGc6xBVywIOgpLv03pGwT9PBluEEU1n+tMe+aFE0w+HehQFVqivmDSTnm/KzlpRAXbgGU47EFixDZ5EQGKDQVOOQ97/qryHRde7yOV5ysvyZOyVjsTl8UOMZ6WIHZntToAV8SwLmWGFNrdauv2E+9RiB+LM02cw8T0CWO4aBJ+myxx8GwNa9ysL7a1zuM/SHaOn2jw==';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $post = curl($url,0,$headers);
			return $post;
}


?>
