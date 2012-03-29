<?php
/**
 * Facebook API Wrapper
 * @package Facebook API Wrapper
 * @since March 16th 2012
 * @uses Facebook
 * @author Vincent Gabriel <http://vadimg.com> < vadimg88@gmail.com >
 */

/**
 * Require the facebook PHP SDK base class
 */
require_once('src/facebook.php');

/**
 * Facebook API Wrapper
 * @author Vincent Gabriel
 * @since March 16th 2012
 * @version 2.0
 */
class FB extends Facebook {
	/**
	 * @var mixed - inner result from request
	 */
	protected $innerResult = null;
	
	/**
	 * Facebook wrapper constructor
	 * You must pass in the appId and secret for this to work properly
	 * The configuration:
	 * - appId: the application ID
	 * - secret: the application secret
	 * - fileUpload: (optional) boolean indicating if file uploads are enabled
	 * @param array $config array of settings required to initiate the class successfully  
	 * @return void
	 * @throws FBException
	 */
	public function __construct($config) {
		if(!isset($config['appId']) || !isset($config['secret'])) {
			throw new FBException('Sorry, You must specify the appId and secret when initializing the class.', 500);
		}
		parent::__construct($config);
	}
	
	/**
	 * Return an object info, can be a user profile, page, group etc.. 
	 * All objects in Facebook can be accessed in the same way:
	 *
	 *	Users: https://graph.facebook.com/btaylor (Bret Taylor)
	 *	Pages: https://graph.facebook.com/cocacola (Coca-Cola page)
	 *	Events: https://graph.facebook.com/251906384206 (Facebook Developer Garage Austin)
	 *	Groups: https://graph.facebook.com/195466193802264 (Facebook Developers group)
	 *	Applications: https://graph.facebook.com/2439131959 (the Graffiti app)
	 *	Status messages: https://graph.facebook.com/367501354973 (A status message from Bret)
	 *	Photos: https://graph.facebook.com/98423808305 (A photo from the Coca-Cola page)
	 *	Photo albums: https://graph.facebook.com/99394368305 (Coca-Cola's wall photos)
	 *	Profile pictures: https://graph.facebook.com/vincent.v.gabriel/picture (your profile picture)
	 *	Videos: https://graph.facebook.com/817129783203 (A Facebook tech talk on Graph API)
	 *	Notes: https://graph.facebook.com/122788341354 (Note announcing Facebook for iPhone 3.0)
	 *	Checkins: https://graph.facebook.com/414866888308 (Check-in at a pizzeria)
	 *
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array returns an array with public information
	 * @permission none
	 */
	public function getObjectInfo($objectId) {
		return $this->_apiGet(null, $objectId);
	}
	
	/**
	 * Return the user info 
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array returns an array with public information
	 * @permission none
	 */
	public function getUserInfo($objectId=null) {
		return $this->_apiGet(null, $objectId);
	}
	
	/**
	 * Return the object profile picture 
	 * @param string|int $objectId the object id can be the id or the name
	 * @return string public image location
	 * @permission none
	 */
	public function getObjectPicture($objectId=null) {
		return sprintf("https://graph.facebook.com/%s/picture", $this->getObjectId($objectId));
	}
	
	/**
	 * Return array of friends
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission none
	 */
	public function getFriends($objectId=null) {
		return $this->_apiGet('friends', $objectId);
	}
	
	/**
	 * Return array of news feed items
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission read_stream
	 */
	public function getFeed($objectId=null) {
		return $this->_apiGet('feed', $objectId);
	}
	
	/**
	 * Return array of likes that the user liked
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_likes
	 */
	public function getLikes($objectId=null) {
		return $this->_apiGet('likes', $objectId);
	}
	
	/**
	 * Return array of movies
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission none
	 */
	public function getMovies($objectId=null) {
		return $this->_apiGet('movies', $objectId);
	}
	
	/**
	 * Return array of music
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission none
	 */
	public function getMusic($objectId=null) {
		return $this->_apiGet('music', $objectId);
	}
	
	/**
	 * Return array of books
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission none
	 */
	public function getBooks($objectId=null) {
		return $this->_apiGet('books', $objectId);
	}
	
	/**
	 * Return array of notes
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_notes
	 */
	public function getNotes($objectId=null) {
		return $this->_apiGet('notes', $objectId);
	}
	
	/**
	 * Return array of permissions
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission none
	 */
	public function getPermissions($objectId=null) {
		return $this->_apiGet('permissions', $objectId);
	}
	
	/**
	 * Return array of photos
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_photos
	 */
	public function getPhotos($objectId=null) {
		return $this->_apiGet('photos', $objectId);
	}
	
	/**
	 * Return array of albums
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_photos
	 */
	public function getAlbums($objectId=null) {
		return $this->_apiGet('albums', $objectId);
	}
	
	/**
	 * Return array of videos
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_videos
	 */
	public function getVideos($objectId=null) {
		return $this->_apiGet('videos', $objectId);
	}
	
	/**
	 * Return array of events
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_events
	 */
	public function getEvents($objectId=null) {
		return $this->_apiGet('events', $objectId);
	}
	
	/**
	 * Return array of groups
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_groups
	 */
	public function getGroups($objectId=null) {
		return $this->_apiGet('groups', $objectId);
	}
	
	/**
	 * Return array of checkins
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_checkins
	 */
	public function getCheckins($objectId=null) {
		return $this->_apiGet('checkins', $objectId);
	}
	
	/**
	 * Return array of locations
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_locations
	 */
	public function getLocations($objectId=null) {
		return $this->_apiGet('locations', $objectId);
	}
	
	/**
	 * Return array of accounts
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission 
	 */
	public function getAccounts($objectId=null) {
		return $this->_apiGet('accounts', $objectId);
	}
	
	/**
	 * Return array of activities
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission 
	 */
	public function getActivities($objectId=null) {
		return $this->_apiGet('activities', $objectId);
	}
	
	/**
	 * Return array of ad accounts
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission ads_management
	 */
	public function getAdAccounts($objectId=null) {
		return $this->_apiGet('adaccounts', $objectId);
	}
	
	/**
	 * Return array of app requests
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission 
	 */
	public function getAppRequests($objectId=null) {
		return $this->_apiGet('apprequests', $objectId);
	}
	
	/**
	 * Return array of family members
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission 
	 */
	public function getFamily($objectId=null) {
		return $this->_apiGet('family', $objectId);
	}
	
	/**
	 * Return array of friend lists
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission 
	 */
	public function getFriendLists($objectId=null) {
		return $this->_apiGet('friendlists', $objectId);
	}
	
	/**
	 * Return array of friend requests
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission read_requests
	 */
	public function getFriendRequests($objectId=null) {
		return $this->_apiGet('friendrequests', $objectId);
	}
	
	/**
	 * Return array of games
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission 
	 */
	public function getGames($objectId=null) {
		return $this->_apiGet('games', $objectId);
	}
	
	/**
	 * Return array of the home news feed
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission 
	 */
	public function getHomeFeed($objectId=null) {
		return $this->_apiGet('home', $objectId);
	}
	
	/**
	 * Return array of inbox messages
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission read_mailbox
	 */
	public function getInbox($objectId=null) {
		return $this->_apiGet('inbox', $objectId);
	}
	
	/**
	 * Return array of outbox messages
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission read_mailbox
	 */
	public function getOutbox($objectId=null) {
		return $this->_apiGet('outbox', $objectId);
	}
	
	/**
	 * Return array of notifications
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission manage_notifications
	 */
	public function getNotifications($objectId=null) {
		return $this->_apiGet('notifications', $objectId);
	}
	
	/**
	 * Return array of statuses
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_status
	 */
	public function getStatuses($objectId=null) {
		return $this->_apiGet('statuses', $objectId);
	}
	
	/**
	 * Return array of tagged objects
	 * @param string|int $objectId the object id can be the id or the name
	 * @return array
	 * @permission user_status
	 */
	public function getTagged($objectId=null) {
		return $this->_apiGet('tagged', $objectId);
	}
	
	/**
	 * Return array of search results
	 * @param string $query the search term you are searching for
	 * @param string $type the type of object you are looking for for example: user, application, post, page, event, group etc...
	 * @return array
	 * @link https://developers.facebook.com/docs/reference/api/ - see searching section
	 * @permission none
	 */
	public function search($query, $type=null) {
		$query = '?q=' . $query;
		if($type) {
			$query .= '&type=' . $type;
		}
		return $this->_apiGet('search' . $query, false);
	}

	/**
	 * Add a new wall post to the objectId's wall
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      message, picture, link, name, caption, description, source, place, tags
	 * @param int $objectId user profile id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new wall post id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/post/
	 * @permission publish_stream
	 */
	public function addWallPost(array $params, $objectId=null) {
		return $this->_apiCall('feed', $params, $objectId);
	}
	
	/**
	 * Add a new link to the user profile
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      link, message, picture, name, caption, description
	 * @param int $objectId user profile id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new link id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/link/
	 * @permission publish_stream
	 */
	public function addLink(array $params, $objectId=null) {
		return $this->_apiCall('links', $params, $objectId);
	}
	
	/**
	 * Add a new event
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      name, start_time, end_time
	 * @param int $objectId user profile id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new event id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/event/
	 * @permission create_event
	 */
	public function addEvent(array $params, $objectId=null) {
		return $this->_apiCall('events', $params, $objectId);
	}
	
	/**
	 * Add a new photo album to the user profile
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      name, message
	 * @param int $objectId user profile id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new album id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/album/
	 * @permission publish_stream
	 */
	public function addAlbum(array $params, $objectId=null) {
		return $this->_apiCall('albums', $params, $objectId);
	}
	
	/**
	 * Add a new photo to an album
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      message, source, place (multipart/form-data)
	 * @param int $objectId album id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new photo id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/photo/
	 * @permission publish_stream
	 */
	public function addPhoto(array $params, $objectId) {
		// Set support file uploads
		$this->setFileUploadSupport(true);
		return $this->_apiCall('photos', $params, $objectId);
	}
	
	/**
	 * Add a new note
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      message, subject
	 * @param int $objectId user profile id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new note id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/note/
	 * @permission publish_stream
	 */
	public function addNote(array $params, $objectId=null) {
		return $this->_apiCall('notes', $params, $objectId);
	}
	
	/**
	 * Add a new comment to an object
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      message
	 * @param int $objectId user profile id or object id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new comment post id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/ - each object has a comments section that you can see if it allows comments
	 * @permission publish_stream
	 */
	public function addComment(array $params, $objectId) {
		return $this->_apiCall('comments', $params, $objectId);
	}
	
	/**
	 * Add a new checking to an object
	 * @param array $params list of key=>value pairs that represent the post data:
	 *                      coordinates, place, message, tags
	 * @param int $objectId user profile id or object id that this operation will work on
	 * @return array|object on success it will return an array with an 'id' element with the new checkin id on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/checkin/ - each object has a comments section that you can see if it allows comments
	 * @permission publish_stream, user_checkins
	 */
	public function addCheckin(array $params, $objectId=null) {
		return $this->_apiCall('checkins', $params, $objectId);
	}
	
	/**
	 * Like an object
	 * @param int $objectId object id that you want to like
	 * @return array|object on success it will return boolean value on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/ - each object has a likes section that you can see if it allows likes
	 * @permission publish_stream
	 */
	public function like($objectId) {
		return $this->_apiCall('likes', array(), $objectId);
	}
	
	/**
	 * attend an event
	 * @param int $objectId object id that you want to like
	 * @return array|object on success it will return boolean value on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/event
	 * @permission publish_stream, user_events
	 */
	public function eventAttending($objectId) {
		return $this->_apiCall('attending', array(), $objectId);
	}
	
	/**
	 * maybe attend an event
	 * @param int $objectId object id that you want to like
	 * @return array|object on success it will return boolean value on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/event
	 * @permission publish_stream, user_events
	 */
	public function eventMaybe($objectId) {
		return $this->_apiCall('maybe', array(), $objectId);
	}
	
	/**
	 * decline attending an event
	 * @param int $objectId object id that you want to like
	 * @return array|object on success it will return boolean value on failure 
	 * it will return an FacebookApiException object with the error message in it
	 * @link https://developers.facebook.com/docs/reference/api/event
	 * @permission publish_stream, user_events
	 */
	public function eventDeclin($objectId) {
		return $this->_apiCall('declined', array(), $objectId);
	}
	
	/**
	 * Check to see if there was an error in the last operation
	 * @return boolean
	 */
	public function isError() {
		return (is_object($this->innerResult) && get_class($this->innerResult) == 'FacebookApiException') ? true : false;
	}
	
	/**
	 * Return the error array with the error message, code, type etc..
	 * @return array
	 */
	public function getError() {
		return $this->innerResult->getResult();
	}
	
	/**
	 * Return the error code from the last operation
	 * @return int|string
	 */
	public function getErrorCode() {
		$error = $this->getError();
		return $error['error']['code'];
	}
	
	/**
	 * Return the error message from the last operation
	 * @return string
	 */
	public function getErrorMessage() {
		$error = $this->getError();
		return $error['error']['message'];
	}
	
	/**
	 * Check to see if the last operation was successful
	 * @return boolean
	 */
	public function isSuccess() {
		return !$this->isError() ? true : false;
	}
	
	/**
	 * Return the result from the last operation
	 * @return array
	 */
	public function getResult() {
		return $this->innerResult;
	}
	
	/**
	 * Return the id of the last operation
	 * when a push operation is performed and is successful the id will be returned
	 * @return mixed|array|string
	 */
	public function getId() {
		// Make sure it was successesful
		if($this->isSuccess()) {
			// Get the data and see if we have id in it
			$data = $this->getResult();
			if(is_array($data) && count($data)) {
				// Do we have id in it
				if(isset($data['id'])) {
					return $data['id'];
				} else {
					// first element
					return current($data);
				}
			} else {
				return $data;
			}
		}
		
		// bad call
		return null;
	}
	
	/**
	 * Clear a certain state from the persistent storage
	 * @param string $key the key we would like to clear
	 * @return void
	 */
	public function clearState($key) {
		$this->clearPersistentData($key);
	}
	
	/**
	 * Clear all states from the persistent storage
	 * @return void
	 */
	public function clear() {
		$this->clearAllPersistentData();
	}
	
	public function extenedAccessToken($token=null) {
		$params = array(    
							'client_id' => $this->getAppId(),
                            'client_secret' => $this->getAppSecret(),
                            'grant_type'=>'fb_exchange_token',
                            'fb_exchange_token'=>$token !== null ? $token : $this->getAccessToken(),
                      );
		return $this->_apiCall('access_token', $params, 'oauth', 'get');
	}
	
	/**
	 * Perform a push api call
	 * @param string $apiKey the actual api key
	 * @param array $params array of data to send to the api
	 * @param string|int $objectId optional the object id to perform the operation on
	 * @param string $methodType optional the type of the method you want to perform post/get
	 * @return object|array
	 */
	protected function _apiCall($apiKey, array $params, $objectId=null, $methodType='post') {
		try {
			$this->innerResult = $this->api('/' . $this->getObjectId($objectId) . '/' . $apiKey, $methodType, $params);
		} catch (FacebookApiException $e) {
		  $this->innerResult = $e;
          return $e;
        }

		return $this->innerResult;
	}
	
	/**
	 * Perform a get api call
	 * @param string $key the actual api key
	 * @param string|int $objectId optional the object id to perform the operation on
	 * @return object|array
	 */
	protected function _apiGet($key=null, $objectId=null) {
		try {
			$apiKey = $key !== null ?   ('/' . $key) : '';
			$_objectId = $objectId !== false ? ('/' . $this->getObjectId($objectId)) : '';
			$this->innerResult = $this->api($_objectId . $apiKey);
		} catch (FacebookApiException $e) {
		  $this->innerResult = $e;
          return $e;
        }

		return $this->innerResult;
	}
	
	/**
	 * Return the objectid if the parameter is not null, if it is return the current logged in user
	 * @param string|int $objectId optional the object id to perform the operation on
	 * @return string|int
	 */
	protected function getObjectId($objectId=null) {
		return $objectId!== null ? $objectId : $this->getUser();
	}
}

class FBException extends Exception {
	
}