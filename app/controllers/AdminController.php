<?php

class AdminController extends Controller
{
	/**
	 * @Auth("Admin","Manager","Author")
	 */
	public function __construct()
	{
		$this->_set('active', 'post');
	}
}