<?php

include 'base.php';
if(!$user) {
	die('You must login first.');
}

echo '<pre>';
print_r($facebook->getAdAccounts());

?>
