<?php

/**
 * @Entity("post")
 */
class Post extends Model
{
	/**
	 * @AutoGenerated()
	 * @Column(Type="Int",Key="Primary")
	 */
	public $Id;
	
	/**
	 * @Column(Type="String")
	 */
	public $Title;
	
	/**
	 * @Column(Type="String")
	 */
	public $Img;
	
	/**
	 * @Column(Type="String")
	 */
	public $Slug;
	
	/**
	 * @Column(Type="Int")
	 */
	public $CreatedDate;
	
		/**
	 * @Column(Type="Int")
	 */
	public $PublicationDate;
	
	/**
	 * @Column(Type="Int")
	 */
	public $UpdatedDate;
	
	/**
	 * @Column(Type="Int")
	 */
	public $UserId;
	
	/**
	 * @Column(Type="String")
	 */
	public $Content;
	
	/**
	 * @Column(Type="Int")
	 */
	public $Status;
	
	/**
	 * @Column(Type="String")
	 */
	public $Type;
	
	/**
	 * @Column(Type="Int")
	 */
	public $ParentId;
	
	/**
	 * @Column(Type="Int")
	 */
	public $Order;

	public function saveImage($path)
	{
		$content = file_get_contents($path);

		$config = Config::get('image');
		extract($config);
		$this->Img = $path . md5(uniqid()) . '.png';

		file_put_contents(WWWROOT . $this->Img, $content);
	}
	
	/**
	 * Retorna as categorias de um post.
	 * @param int		$p	Pagina de resultados
	 * @param int		$m	Quantidade máxima de resultados retornados
	 * @param string	$o	Coluna para ordenação
	 * @param string	$t	Tipo da ordenação
	 * @return array		Array contendo as categorias desejadas
	 */
	public function getCategories($p = 1, $m = 10, $o = 'Id', $t = 'DESC')
	{
		return ViewCategory::allByPost($this->Id, $p, $m, $o, $t);
	}
	
	public function getCategoriesIds()
	{
		$db = Database::factory();
		$pcs = $db->PostCategory->all('PostId = ?', $this->Id);
		$postCategories = array();
		
		foreach ($pcs as $pc)
		{
			$postCategories[] = $pc->CategoryId;
		}
		
		return $postCategories;
	}
	
	/**
	 * Retorna um post pelo slug.
	 * @param	string	$slug	Slug do post retornado.
	 * @return	mixed			resultado encontrado.
	 */
	public static function getBySlug($slug)
	{
		$db = Database::factory();
		return $db->Post->single('Slug = ?', $slug);
	}
	
	public function humanize()
	{
		$dateFormat = Config::get('date_format');
		$this->CreatedDate = date($dateFormat, $this->CreatedDate);
		$this->PublicationDate = $this->PublicationDate ? date($dateFormat, $this->PublicationDate) : '-';
		$this->UpdatedDate = date($dateFormat, $this->UpdatedDate);
		$this->Summary = substr(strip_tags($this->Content), 0, 255);
	}
	
	public function setCategories($categories)
	{
		$db = Database::factory();
		$postCategories = $db->PostCategory;
		if($categories)
		{
			foreach ($categories as $c)
			{
				$postCategories->insert(new PostCategory($this->Id, $c));
			}
			$db->save();
		}
	}
	
	public function unsetCategories()
	{
		$db = Database::factory();
		$db->PostCategory->where('PostId = ?', $this->Id)->deleteAll();
		$db->save();
	}
	
	public static function deleteAll($ids)
	{	
		$list = '(';
		foreach ($ids as $k => $i)
		{
			$list .= '?,';
			$ids[$k] = (int)$i;
		}
		$list = substr($list, 0, strlen($list) - 1) . ')';
	
		$db = Database::factory();
		$db->Post->whereArray('Id IN ' . $list, $ids)->deleteAll();
		$db->save();
	}
	
	public static function publishAll($ids)
	{	
		$list = '(';
		foreach ($ids as $k => $i)
		{
			$list .= '?,';
			$ids[$k] = (int)$i;
		}
		$list = substr($list, 0, strlen($list) - 1) . ')';
	
		$db = Database::factory();
		$posts = $db->Post->whereArray('Id IN ' . $list, $ids)->all();
		
		foreach ($posts as $p)
		{
			$p->PublicationDate = time();
			$p->Status = 1;
			$db->Post->update($p);
		}
		
		$db->save();
	}
	
	public function isAuthorizedManager($userId)
	{
		return $this->UserId == $userId || Auth::is('Manager', 'Admin');
	}
	
	public static function allByType($type, $p = 1, $m = 10, $o = 'Id', $t = 'DESC')
	{
		$p = ($p < 1 ? 1 : $p) - 1;
		$db = Database::factory();
		return $db->Post->where('Type = ?', $type)->orderBy($o, $t)->paginate($p, $m);
	}
	
	public static function allPages($onlyParent = false, $o = 'Order', $t = 'ASC')
	{
		$db = Database::factory();
		if($onlyParent)
			return $db->Post->where('Type = ? AND (ParentId IS NULL OR ParentId = 0)', 'page')->orderBy('`'. $o .'`', $t)->all();
		return $db->Post->where('Type = ?', 'page')->orderBy('`'. $o .'`', $t)->all();
	}
	
	public static function all($p = 1, $m = 10, $o = 'Id', $t = 'asc')
	{
		$p = ($p < 1 ? 1 : $p) - 1;
		$db = Database::factory();
		return $db->Post->where('Type = ?', 'post')->orderBy($o, $t)->paginate($p, $m);
	}
	
	public static function allByParent($id, $o = 'Order', $t = 'asc')
	{
		$db = Database::factory();
		return $db->Post->where('Type = ? AND ParentId = ?', 'page', $id)->orderBy('`'. $o .'`', $t)->all();
	}
}