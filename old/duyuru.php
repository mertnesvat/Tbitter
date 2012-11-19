
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="tr-TR">
<html>
<head>
<title>duyurular</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
</head>

<body>

<?php
function utf_to_tr($text) {
    echo '<br> gelen = '.$text;   
    $text = trim($text);    
    $search = array('Ãœ','Å','&#286;','Ã‡','Ä°','Ã–','Ã¼','ÅŸ','ÄŸ','Ã§','Ä±','Ã¶');
    $replace = array('Ü','Ş','Ğ','Ç','İ','Ö','ü','ş','ğ','ç','ı','ö'); 
    $new_text = str_replace($search,$replace,$text);    
    echo '<br> giden = '.$new_text;
    return $new_text;  
}
$url = "http://bilgisayar.kocaeli.edu.tr/";
$icerik = file_get_contents("http://bilgisayar.kocaeli.edu.tr/");

//echo '======================<br>'.$icerik.'<br>==================';

//basliklar seciliyor.
 preg_match_all("/class=\"popup\">(.*?)<font/",$icerik,$secilen_baslik);
 preg_match_all("/Yayınlayan <\/th><td>\s*(.*?)<\/td>/",$icerik,$secilen_yayinlayan);
 preg_match_all("/Konu <\/th><td>\s*(.*?)<\/td>/",$icerik,$secilen_konu);
 preg_match_all("/Tarih <\/th><td>\s*(.*?)<\/td>/",$icerik,$secilen_tarih);
 preg_match("/Açıklama <\/th><td>\s*(.*?)<\/td>/smU",$icerik,$secilen_aciklama);
 echo '<br>secilen = '.$secilen_aciklama;
 /*
 for($x=0;$x<10;$x++)
 {
     $yazdir = utf_to_tr($secilen_baslik[1][$x]) ; 
     echo $yazdir.'<br>=====';
     //echo $secilen_icerik[1][$x].'<br>=======MMMMMMMM=======';
 }*/
echo '==============XXXXXXXXXXXXXXXXXXXX==============';
print_r($secilen_aciklama);
?>

</body>
</html>