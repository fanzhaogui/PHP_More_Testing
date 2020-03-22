<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 16:17
 */

class EmailSender implements SplObserver
{
	public function update(SplSubject $subject)
	{
		$args = func_num_args();
		if ($args === 2) {
			$user = func_get_arg(1);
			echo "向 {$user['email']} 发送邮件成功。内容是： 你好 {$user['username']}" .
			"您的新密码是 {$user['password']}，请妥善保管", PHP_EOL;
		}
	}
}