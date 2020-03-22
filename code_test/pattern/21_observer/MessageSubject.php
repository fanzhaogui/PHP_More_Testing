<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 14:27
 */

class MessageSubject implements SplSubject
{
	private $_message;
	private $_obversers;

	public function __construct()
	{
		$this->_obversers = new SplObjectStorage();
	}

	public function attach(SplObserver $observer)
	{
		$this->_obversers->attach($observer);
	}

	public function detach(SplObserver $observer)
	{
		$this->_obversers->detach($observer);
	}

	public function notify()
	{
		foreach ($this->_obversers as $observer) {
			$observer->update($this);
		}
	}

	public function setMessage($message)
	{
		$this->_message = $message;
		// todo 是直接调用，还是单独使用
		// $this->notify();
	}

	public function getMessage()
	{
		return $this->_message;
	}
}