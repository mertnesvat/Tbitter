<?php
echp "okey?";
mail("mertnesvat@gmail.com", 'Baslik : BLM104 Elektrik Devre Temelleri ve Uygulamaları Dersi Öğrencilerine &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&empty;Yayinlayan : Prof.Dr.Hasan Dinçer &empty;Konu : BLM104 Elektrik Devre Temelleri ve Uygulamaları Dersi Öğrencilerine Tarih : 28 Şubat 2012 Aciklama : Duyuru No: EDT 1112/02 BLM104 Elektrik Devre Temelleri ve Uygulamaları Dersi 2011- 2012BY Öğrencilerine Haftalık Ders programında 29.02.2012 Çarşamba günü saat: 20.40- 23.20 saatleri arasında gözüken BLM104 Elektrik Devre Temelleri ve Uygulamaları A-2.Ö dersi hava muhalefeti nedeniyle bu haftaya özgün olmak üzere 29.02.2012 Çarşamba günü 11.00- 13.50 saatleri arasında BM 303 dersliğinde yapılacaktır. 
Prof. Dr. Hasan Dinçer', '');

/*
echo 'X'.getenv('HTTP_REFERER').'X';
$ip = getenv('REMOTE_ADDR');
$ip = file_get_contents("http://www.ipgp.net/api.xml/".$ip);
echo $ip;
$cevap = new SimpleXMLElement($ip);
echo '<br>================================================================================<br>';
$ulke = $cevap->County;
$sehir = $cevap->City;
$bayrak = $cevap->Flag;

echo "Ulke : $ulke <br>";
echo "Bayrak : $bayrak <br>";
echo "Sehir : $sehir <br>"
 

echo <<<TAMAM
<form action="vur.php" method="post">
  Select your favorite color: <input type="text" name="favcolor" /><br />
  <input type="submit" />
</form>
TAMAM;
echo 'X'.getenv('CONTENT_LENGTH').'X';
*/
/* sonradan yorum satiri olan kisim
function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
            else return FALSE;
    }
echo 'selam';
$url = 'http://www.google.com';
$url_cont=curl_get_file_contents('http://www.letscoding.com/');
echo $url_cont;
*/


/*$dizi = 'ezel';
$dizi_2 = '/>{1}('.$dizi.')<{1}/';
preg_match_all($dizi_2,$url_cont,$match);
print_r($match);*/
?>