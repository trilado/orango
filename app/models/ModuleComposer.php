<?php

class ModuleComposer
{
	const POST_ADDS 		= 'POST_ADDS';
	const PAGE_ADDS			= 'PAGE_ADDS';
	const CATEGORY_ADDS		= 'CATEGORY_ADDS';
	const USER_ADDS			= 'USER_ADDS';
	const SIDE_MENU_ADDS	= 'SIDE_MENU_ADDS';
	const NAV_BAR_ADDS		= 'NAV_BAR_ADDS';
	const ADMIN_BODY_ADDS	= 'ADMIN_BODY_ADDS';
	const ADMIN_HEAD_ADDS	= 'ADMIN_HEAD_ADDS';
	const PUBLIC_BODY_ADDS	= 'PUBLIC_BODY_ADDS';
	const PUBLIC_HEAD_ADDS	= 'PUBLIC_HEAD_ADDS';

	// se forem alteracoes na masterpage
	private static $_requireRequestAdds = array(
		self::SIDE_MENU_ADDS,
		self::NAV_BAR_ADDS,
		self::ADMIN_BODY_ADDS,
		self::ADMIN_HEAD_ADDS,
		self::PUBLIC_BODY_ADDS,
		self::PUBLIC_HEAD_ADDS,
	);

	public static function getAdds($addType)
	{
		$modules = Config::get('modules');

		$html = '';

		foreach ($modules as $k => $m)
		{
			$clazz = $k . 'ModuleRegister';
			
			if(class_exists($clazz, false) && isset($clazz::$adds[$addType]))
			{
				if(!array_key_exists('controller', $clazz::$adds[$addType]))
				{
					throw new BadAddSetup('controller');
				}

				if(!array_key_exists('action', $clazz::$adds[$addType]))
				{
					throw new BadAddSetup('action');
				}

				$controller = $clazz::$adds[$addType]['controller'];
				$action = $clazz::$adds[$addType]['action'];

				$params = '';
				if(isset($clazz::$adds['params']))
				{
					$params = implode('/', $clazz::$adds['params']);
				}

				$query = '';
				if(isset($clazz::$adds['query']))
				{
					$query = '?';
					foreach ($clazz::$adds['query'] as $k => $q) 
					{
						$query .= '&' . $k . '=' . $q;
					}
				}

				if(in_array($addType, self::$_requireRequestAdds))
					$html .= Request::create(Request::getSite() . $k . '/' . $controller . '/' . $action . '/' . $params . $query);
				else
					$html .= Module::run('/' . $k . '/' . $controller . '/' . $action . '/' . $params . $query);
			}
		}

		return $html;
	}
}