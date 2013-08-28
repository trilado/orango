<?php

class ModuleController extends AppController
{
	public function __construct()
	{
		$this->_set('active', '');
	}
	
	/**
	 * @Master("admin")
	 */
	public function __contruct()
	{
		parent::__contruct();
	}
}