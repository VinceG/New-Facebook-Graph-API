<?php

include 'base.php';
if(!$user) {
	die('You must login first.');
}

if(isset($_POST['POSTTOWALL'])) {
	$wallPost = $facebook->addAlbum(array('name' => $_POST['message'] ? $_POST['message'] : 'blah'));
	if($facebook->isSuccess()) {
		echo '<pre>';
		echo 'album created. ID:' . $facebook->getId();
	} else {
		echo $facebook->getErrorMessage();
	}
	
}

?>

<form method='post'>
	<textarea name='message'></textarea>
	<input type='submit' name='POSTTOWALL'>
</form>
