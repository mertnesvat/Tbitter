<html>
<head>
<title>
cron Jobs
</title>

</head>
<body>
<?php 
include 'cronjobs.php';

	$a = new Crontab();
	$m = $a->getJobs();
	
	echo 'jobs = '.$m;
	echo '<br>SON!';
	print_r($m);
	echo '<br>====<br>';
	$g = $a->doesJobExist($job='* * * */1 * /usr/bin/wget http://twitter.mertnesvat.com/tweet/robot');
	echo 'does='.$g;

?>

</body>
</html>

