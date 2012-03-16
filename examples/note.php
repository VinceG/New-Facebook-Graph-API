<?php

include 'base.php';
if(!$user) {
	die('You must login first.');
}

if(isset($_POST['POSTTOWALL'])) {
	$wallPost = $facebook->addNote(array('subject' => $_POST['subject'] ? $_POST['subject'] : 'subject', 'message' => $_POST['message'] ? $_POST['message'] : 'message'));
	if($facebook->isSuccess()) {
		echo '<pre>';
		echo 'note created. ID:' . $facebook->getId();
	} else {
		echo $facebook->getError();
	}
	
}

?>

<form method='post'>
	<textarea name='subject'>subject</textarea>
	<textarea name='message'>message</textarea>
	<input type='submit' name='POSTTOWALL'>
</form>
