<?php
include_once('mobile_redirect.class.php');
$redirect = new mobile_redirect();
$redirect->homepage = 'index.php';
$redirect->mobile_redirect = 'mobile.php';
$redirect->detect();
?>
<h1>INDEX page</h1>
<?php
	print 'device: '.$redirect->device;
	if ($redirect->device != 'normal') {
		print '<br /><a href="mobile.php?mobi=1">View Mobile Site</a>';
	}
?>