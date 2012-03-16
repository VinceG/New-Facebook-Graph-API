<?php

include 'base.php';
if(!$user) {
	die('You must login first.');
}

if(isset($_POST['POSTTOWALL'])) {
	$wallPost = $facebook->addWallPost(array('message' => $_POST['message'] ? $_POST['message'] : 'blah'));
	if($facebook->isSuccess()) {
		echo '<pre>';
		echo 'post created. ID:' . $facebook->getId();
	} else {
		echo $facebook->getError();
	}
	
}

?>

<form method='post'>
	<textarea name='message'></textarea>
	<input type='submit' name='POSTTOWALL'>
</form>
