<?php

include 'base.php';
if(!$user) {
	die('You must login first.');
}

$types = array(
	'friends',
	'feed',
	'likes',
	'movies',
	'music',
	'books',
	'notes',
	'permissions',
	'photos',
	'albums',
	'videos',
	'events',
	'groups',
	'checkins',
	'locations',
	);

foreach($types as $type) {
	$name = 'get' . ucfirst($type);
	echo '<h1>'.$name.'</h1>';
	echo '<pre>';
	echo print_r($facebook->$name(), true);
	echo '</pre>';
}

?>
