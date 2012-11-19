<?php
$bas = 'From: google@gmail.com';
//mail('mertnesvat@gmail.com', "deneme", "mesaj",$bas);

for($a=0;$a<20;$a++)
{
    $sub = 'Google SENI SEVIYOR!!!';
    $mes = 'Seni Seviyorum...';
    //$bas = $bas.$a ;
    mail('kursattopcuoglu@gmail.com', $sub, $mes , $bas);
}

?>