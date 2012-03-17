<?php
require '../FB.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new FB(array(
  'appId'  => '340730982629661',
  'secret' => 'dd9c20718654c9c6e7ada4f98057d58f',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}


// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  	$loginUrl   = $facebook->getLoginUrl(
	            array(
	                'scope'         => 'read_stream,user_website,user_videos,user_status,user_religion_politics,user_relationship_details,user_relationships,user_questions,user_photos,user_notes,user_location,user_likes,user_interests,user_groups,user_events,user_education_history,user_checkins,user_activities,email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
	            )
	    );
}