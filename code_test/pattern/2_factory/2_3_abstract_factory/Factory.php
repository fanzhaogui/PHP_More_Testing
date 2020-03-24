<?php
/**
 * User: Andy
 * Date: 2020/3/24
 * Time: 0:00
 */

interface Factory
{

	/**
	 * @return mixed
	 */
	public function createUser();

	/**
	 * @return mixed
	 */
	public function createArticle();

}