<?php
include_once('mobile_redirect.class.php');
$redirect = new mobile_redirect();
$redirect->homepage = 'index.php';
$redirect->mobile_redirect = 'mobile.php';
$redirect->detect();
?>
<h1>MOBILE page</h1>
<?php
	print 'device: '.$redirect->device;
	print '<br /><a href="mobile.php?nomobi=1">Disable Mobile Site</a>';
?>