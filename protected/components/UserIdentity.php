<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
	private $_id;
	/**
	 * 加密的干扰码
	 * @var string
	 */
	private $key = "a2ffa5c9be07488bbb04a3a47d3c5f6a";
	/**
	 * 前台随机生成的种子
	 * @var
	 */
	public $nonce;
	/**
	 * 登录类型：
	 * 1代表是普通用户登录
	 * 2代表是超级管理员登录
	 * @var
	 */
	public $loginType;

	public function __construct($username,$password,$loginType,$nonce){
		$this->username=$username;
		$this->password=$password;
		$this->loginType = $loginType;
		$this->nonce = $nonce;
	}
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		if($this->validatePassword($this->username,$this->password,$this->loginType,$this->nonce)) {
			$this->_id = 1;
			$this->username = $this->username;
			$this->errorCode = self::ERROR_NONE;
		} else {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * 加密算法介绍：
	 * 用户输入的密码，和系统的干扰码合并成一个字符串，然后通过SHA1算法，生成新的字符串。（数据库也会记录这样一个加密过的字符串密码）
	 * 然后前台会生成一个随机种子，然后随机种子和之前生成的加密字符串合并后，再SHA1一次，然后传输到后台进行验证。
	 * @param $username 用户名
	 * @param $password 加密过后，从前台传输过来的密码串
	 * @param $loginType 登录类型
	 * @param $nonce 随机种子
	 * @return boolean 验证匹配
	 */
	public function validatePassword($username,$password,$loginType,$nonce){
		//数据库里面存的是sha1(pwd+key)
		if($loginType==1){
			$user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
			//判断逻辑暂时省略，还没有想好
		}elseif($loginType==2){
			//密码是"无坚不摧"
			$sha1Password = "ef336ca3d6488f1be0057aaf2d6a9661edf309a6";
			if(sha1($nonce.$sha1Password)===$password){
				return true;
			}
		}
		return false;
	}
}