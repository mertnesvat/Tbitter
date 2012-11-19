<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="tr-TR">
	<html>
		<head>
			<title>duyurular</title>
			<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
		</head>
		<body>
			<?php
			echo "==================================<br>&nbsp;&nbsp;Mert Neşvat 2012 =====================<br>==================================<br>";
			require_once("fonksiyonlar.php");
			$last_attention = dosyadan_oku("son_duyuru.txt");
            $gonderilecek = array_fill(0, 10, "banana");
            $from = "kayhantolga@letscoding.com";
            $headers = "From:" . $from;
            //asthma982loafer@m.facebook.com
            /*mail('kocaeliduyuru@gmail.com','Baslik : '.$last_attention[0].'Yayinlayan : '.$last_attention[1].'Konu : '.$last_attention[2].'Tarih : '.$last_attention[3].'Aciklama : '.$last_attention[4]
            ,':)');*/
            echo '<br> Son Duyuru = '.$last_attention[0];
			for($i = 0 ; $i < 10 ; $i++)
            {
                $attention = duyuru_oku($i);
                echo '<br> Okunan Duyuru = '.$attention[0];
                //duzeltmeler
                for($n = 0 ;$n<5;$n++)
                {
                    $attention[$n] = strip_tags($attention[$n]);
                    $attention[$n] = str_replace("&nbsp;", '', $attention[$n]);                
                    $attention[$n] = str_replace("&nbsp", '', $attention[$n]);                
                    $attention[$n] = str_replace("nbsp", '', $attention[$n]);                
                }
                
                if( !strcmp($last_attention[0], $attention[0]) && !strcmp($last_attention[1], $attention[1]) )
                {
                    break;
                }
                
                
                
                $gonderilecek[$i] = $attention ;
                
                
                
                mail('kocaeliduyuru@gmail.com','Baslik : '.$attention[0].'Yayinlayan : '.$attention[1].'Konu : '.$attention[2].'Tarih : '.$attention[3].'Aciklama : '.$attention[4]
                ,':)');
                
            }
            echo 'i = '.$i;
            if($i == 0)die("<br><b> Simdilik Yeni Duyuru Yok!</b>");
            for($m = $i ; $m >=0 ; $m--)
            {
                duyuru_yaz($gonderilecek[$m]);
                
                
            }
            duyuru_yaz_isimle($gonderilecek[0],"son_duyuru.txt");
			unset($last_attention);
            unset($attention);
echo "<br><br><br><br><br><br>all faq goes to info[at]mertnesvat.com";
			?>
		</body>
	</html>
