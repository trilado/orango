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
	public $Slug;
	
	/**
	 * @Column(Type="Int")
	 */
	public $CreatedDate;
	
		/**
	 * @Column(Type="Int")
	 */
	public $PublicatedDate;
	
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
		$this->PublicatedDate = date($dateFormat, $this->PublicatedDate);
		$this->UpdatedDate = date($dateFormat, $this->UpdatedDate);
	}
	
	public function setCategories($categories)
	{
		$db = Database::factory();
		$postCategories = $db->PostCategory;
		foreach ($categories as $c)
		{
			$postCategories->insert(new PostCategory($this->Id, $c));
		}
		$db->save();
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
}