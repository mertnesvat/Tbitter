<?php
function duyuru_oku($kacinci) {
    $url = "http://bilgisayar.kocaeli.edu.tr/";
    $icerik = file_get_contents("http://bilgisayar.kocaeli.edu.tr/");

    //echo '======================<br>'.$icerik.'<br>==================';

    //basliklar seciliyor.
    $icerik = str_replace('<a href="files/', '<a href="http://bilgisayar.kocaeli.edu.tr/files/', $icerik);
    //echo $icerik;
    preg_match_all("/class=\"popup\">(.*?)<font/", $icerik, $secilen_baslik);
    preg_match_all("/Yayınlayan <\/th><td>\s*(.*?)<\/td>/", $icerik, $secilen_yayinlayan);
    preg_match_all("/Konu <\/th><td>\s*(.*?)<\/td>/", $icerik, $secilen_konu);
    preg_match_all("/Tarih <\/th><td>\s*(.*?)<\/td>/", $icerik, $secilen_tarih);
    preg_match_all("/Açıklama <\/th><td>\s*(.*?)<\/table>/s", $icerik, $secilen_aciklama);
    trim($secilen_aciklama[1][$kacinci]);// aciklama icin sondan td tr yi kesmek lazim
    $secilen_aciklama[1][$kacinci] = str_replace('</td></tr>','', $secilen_aciklama[1][$kacinci]);
    //$gonderilecek = array('baslik' => $secilen_baslik[1][$kacinci], 'yayinlayan' => $secilen_yayinlayan[1][$kacinci], 'konu' => $secilen_konu[1][$kacinci], 'tarih' => $secilen_tarih[1][$kacinci], 'aciklama' => $secilen_aciklama[1][$kacinci], );
  
    $gonderilecek = array($secilen_baslik[1][$kacinci],
    $secilen_yayinlayan[1][$kacinci],
    $secilen_konu[1][$kacinci],
    $secilen_tarih[1][$kacinci],
    $secilen_aciklama[1][$kacinci], );

    return $gonderilecek;
}

function duyuru_yaz($duyuru) {
    $damgam2 = rand(5, 10000);
    $tarih = $duyuru[3];
    $tarih = str_replace(' ', '', $tarih);
    $tarih = str_replace('Ş','S', $tarih);
    
    echo 'tarihimiz dosya icin = '.$tarih;
    
    $simdiki = fopen('./duyurular/' .$tarih.'M+'.$damgam2. '.txt', "w");
    $yazilacak = implode(':MN:', $duyuru);
    $yazilacak = str_replace("&nbsp;", '', $yazilacak);
    $yazilacak = str_replace("&nbsp", '', $yazilacak);
    fwrite($simdiki, $yazilacak);
    fclose($simdiki);
}
function duyuru_yaz_isimle($duyuru,$dosya_ismi) {
    
    $simdiki = fopen('./duyurular/'.$dosya_ismi, "w+");
    $yazilacak = implode(':MN:', $duyuru);
    fwrite($simdiki, $yazilacak);
    fclose($simdiki);
}
function dosyadan_oku($dosya_ismi){

    $simdiki = fopen('./duyurular/'.$dosya_ismi, "r");
    $icerik = fread($simdiki, 1024);
    $gonderilecek = explode(":MN:", $icerik);
    //print_r($gonderilecek);
return $gonderilecek;
}

?>