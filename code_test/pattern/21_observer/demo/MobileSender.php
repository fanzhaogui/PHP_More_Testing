<?php
/**
 * User: Andy
 * Date: 2020/3/22
 * Time: 16:17
 */

class MobileSender implements SplObserver
{
	public function update(SplSubject $subject)
	{
	    // 推荐方式
        // $user = $subject->getUserInfo(); // 一个方法获取用户的信息


	    // 不推荐此方式
		$args = func_num_args();
		if ($args === 2) {
			$user = func_get_arg(1);
			echo "向 {$user['mobile']} 发送短信成功。内容是： 你好 {$user['username']}" .
			"您的新密码是 {$user['password']}，请妥善保管", PHP_EOL;
		}
	}
}