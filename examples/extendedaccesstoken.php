<?php

include 'base.php';
if(!$user) {
	die('You must login first.');
}

if(isset($_POST['POSTTOWALL'])) {
	
	$result = $facebook->extenedAccessToken();
	if($facebook->isSuccess()) {
		echo "Access token extended:\n<br />";
		echo $facebook->getAccessToken();
		echo "<Br /><br />";
		var_dump($result);
	} else {
		echo "There was an error extending the access token:\n<br />";
		echo $facebook->getErrorMessage();
	}
} else {
	echo "Current access token:\n<br />";
	print_r($facebook->getAccessToken());
}

print_r($facebook->getPermissions());

?>

<form method='post'>
	<input type='submit' name='POSTTOWALL' value='EXTEND ACCESS TOKEN'>
</form>
