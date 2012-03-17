<?php

include 'base.php';
if(!$user) {
	die('You must login first.');
}

if(isset($_POST['POSTTOWALL'])) {
	print_r($_FILES);
	$wallPost = $facebook->addPhoto(array('message' => $_POST['message'] ? $_POST['message'] : 'blah', 'image' => '@' . $_FILES['source']['tmp_name']), $_POST['albumid']);
	if($facebook->isSuccess()) {
		echo '<pre>';
		echo 'photo created. ID:';
		if($facebook->getId()) {
			echo $facebook->getId();
		} else {
			print_r($wallPost);
		}
	} else {
		print_r($facebook->getErrorMessage());
	}
	
}

?>

<form method='post' enctype="multipart/form-data">
	<textarea name='message'></textarea>
	<input type='text' value='10150665078202310' name='albumid' />
	<input name="source" type="file">
	<input type='submit' name='POSTTOWALL'>
	
</form>
