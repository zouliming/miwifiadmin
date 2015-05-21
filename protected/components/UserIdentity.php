<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate(){
                if(!empty($this->password)){
                        $this->_id=1;
			$this->username=  $this->username;
			$this->errorCode=self::ERROR_NONE;
                }else{
                        $this->errorCode=self::ERROR_PASSWORD_INVALID;
                }
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}