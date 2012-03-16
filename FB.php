<?php

require_once('src/facebook.php');


class FB extends Facebook {
	protected $innerResult = null;
	public function __construct($config) {
		if(!isset($config['appId']) || !isset($config['secret'])) {
			throw new FBException('Sorry, You must specify the appId and secret when initializing the class.', 500);
		}
		parent::__construct($config);
	}
	
	public function addWallPost(array $params, $objectId=null) {
		return $this->_apiCall('feed', $params, $objectId);
	}
	
	public function addLink(array $params, $objectId=null) {
		return $this->_apiCall('links', $params, $objectId);
	}
	
	public function addEvent(array $params, $objectId=null) {
		return $this->_apiCall('events', $params, $objectId);
	}
	
	public function addAlbum(array $params, $objectId=null) {
		return $this->_apiCall('albums', $params, $objectId);
	}
	
	public function addPhoto(array $params, $objectId) {
		return $this->_apiCall('photos', $params, $objectId);
	}
	
	public function addNote(array $params, $objectId=null) {
		return $this->_apiCall('notes', $params, $objectId);
	}
	
	public function addComment(array $params, $objectId) {
		return $this->_apiCall('comments', $params, $objectId);
	}
	
	public function like($objectId) {
		return $this->_apiCall('likes', array(), $objectId);
	}
	
	protected function _apiCall($apiKey, array $params, $objectId=null) {
		try {
			$this->innerResult = $this->api('/' . $this->getObjectId($objectId) . '/' . $apiKey, 'post', $params);
		} catch (FacebookApiException $e) {
          return $e;
        }

		return $this->innerResult;
	}
	
	protected function getUserId($objectId=null) {
		return $objectId!== null ? $objectId : $this->getUser();
	}
	
	public function isError() {
		return (is_object($this->innerResult) && get_class($this->innerResult) == 'FacebookApiException') ? true : false;
	}
	
	public function getError() {
		return $this->innerResult['error']['message'];
	}
	
	public function isSuccess() {
		return !$this->isError ? true : false;
	}
	
	public function getResult() {
		return $this->innerResult;
	}
	
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
	
	public function clear() {
		$this->clearAllPersistentData();
	}
	
}

class FBException extends Exception {
	
}