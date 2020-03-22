<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 15:48
 */

class User implements SplSubject
{

	private $email;

	private $username;

	private $mobile;

	private $password;

	/**
	 * @var \SplObjectStorage
	 */
	private $observers;

	public function __construct($email, $username, $mobile, $password)
	{
		$this->email    = $email;
		$this->username = $username;
		$this->mobile   = $mobile;
		$this->password = $password;

		$this->observers = new SplObjectStorage();
	}

	public function attach(SplObserver $observer)
	{
		$this->observers->attach($observer);
	}

	public function detach(SplObserver $observer)
	{
		$this->observers->detach($observer);
	}

	public function notify()
	{
		$user = [
			'email'    => $this->email,
			'username' => $this->username,
			'mobile'   => $this->mobile,
			'password' => $this->password,
		];
		foreach ($this->observers as $observer) {
			$observer->update($this, $user);
		}
	}

	public function create()
	{
		echo __METHOD__, PHP_EOL;
		$this->notify();
	}

	public function changePassword($newPassword)
	{
		echo __METHOD__, PHP_EOL;
		$this->password = $newPassword;
		$this->notify();
	}

	public function resetPassword()
	{
		echo __METHOD__, PHP_EOL;
		$this->password = mt_rand(100000, 999999);
		$this->notify();
	}
}