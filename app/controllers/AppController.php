<?php

class AppController extends Controller
{
	public function beforeRender()
	{
		if(isset($this->args['prefix']) && $this->args['prefix'] == 'admin')
		{
			if($this->args['action'] != 'admin_login')
				Auth::allow('Admin', 'Manager', 'Author');
			
			$this->Template->setMaster('admin');
		}
		else
		{
			$this->Template->setDirectory(App::$root . 'app/views/theme/' . Config::get('theme') . '/');
			$this->_set('categories', Category::findAll());
			$this->_set('pages', Post::allPages(true));
		}
	}
}