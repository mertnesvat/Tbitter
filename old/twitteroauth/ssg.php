<?php
$url = 'view-source:http://www.eksisozluk.com/show.asp?t=s%C3%B6zl%C3%BCk%C3%A7%C3%BClerin+en+iyi+10+dizi+listesi&kw=&a=&all=&v=&fd=&td=&au=&g=&p=1';
$url_cont     = 'view-source:http://www.eksisozluk.com/show.asp?t=s%C3%B*asp<>asp';//file_get_contents($url);
$dizi = 'asp';
$dizi_2 = '/('.$dizi.')/imx';
preg_match($dizi_2,$url_cont,$match);
print_r($match);
?>