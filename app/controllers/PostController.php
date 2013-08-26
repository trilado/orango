<?php
class PostController extends AppController
{
	public function __construct()
	{
		$this->_set('active', 'post');
	}
	
	/**
	 * @Auth("*")
	 */
	public function view($slug)
	{
		$post = ViewPost::getBySlug($slug);
		if($post == null)
			throw new PageNotFoundException('Página não encontrada.');
		
		$children = Post::allByParent($post->Id);
		$this->_set('children', $children);
		
		return $this->_view($post->Type, 'view', $post);
	}
	
	/**
	 * @Auth("*")
	 */
	public function index($p = 1, $o = 'Id', $t = 'DESC')
	{
		$m = 20;
		$this->_set('m', $m);
		
		$posts = Post::all($p, $m, $o, $t);
		
		$post = null;
		if($posts->Data)
		{
			$post = $posts->Data[0];
			$post->humanize();
			unset($posts->Data[0]);
		}
		
		$this->_set('post', $post);
		
		return $this->_view($posts);
	}
	
	/**
	 * @Auth("*")
	 */
	public function search($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$q = Request::get('q');
		$filters = array();
		if($q)
		{
			$filters['Title'] = "%$q%";
		}
		
		$this->_set('categories', Category::findAll());
		$this->_set('q', $q);
		$posts = Post::search($p, $m, $o, $t, $filters);
		return $this->_view($posts);
	}
	
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$filters = array();
		
		if(Auth::is('Author'))
		{
			$filters['UserId'] = Session::get('user')->Id;
		}
		
		$q = Request::get('q');
		if($q)
		{
			$filters['Title'] = "%$q%";
			$filters['Author'] = "%$q%";
		}
		
		$posts = ViewPost::search($p, $m, $o, $t, $filters);
		return $this->_view($posts);
	}
	
	public function admin_add()
	{
		$post = new Post();
		if(Request::isPost())
		{
			try
			{
				$post = $this->_data($post);
				$post->Content = strip_tags(Request::post('Content'), Config::get('html_safe_list'));
				$post->UserId = Session::get('user')->Id;
				$post->CreatedDate = time();
				$post->Type = 'post';
				$post->Slug = Inflector::slugify(Request::post('Title'));

				$file = Request::file('Image');
				if($file['name'])
				{
					$post->saveImage($file['tmp_name']);
				}
				
				if(Request::post('Draft'))
				{
					$post->Status = 0;
				}
				else
				{
					$post->PublicationDate = time();
					$post->Status = 1;
				}
				
				$post->save();
				
				$categories = Request::post('categories');
				if($categories) $post->setCategories($categories);
				
				$this->_flash('alert alert-success', 'Post salvo com sucesso.');
				$this->_redirect('~/admin/post/edit/' . $post->Id);
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar o post.');
			}
		}
		
		$this->_set('label', 'Criar');
		$this->_set('categories', Category::findAll());
		$this->_set('selectedCategories', $post->getCategoriesIds());
		return $this->_view($post);
	}
	
	public function admin_edit($id)
	{
		$post = Post::get($id);
		
		if(!$post->isAuthorizedManager(Session::get('user')->Id))
		{
			$this->_flash('alert', 'Você não pode editar este post.');
			return $this->_redirect('~/admin/post');
		}
		
		if(Request::isPost())
		{
			try
			{
				$post = $this->_data($post);
				$post->Content = strip_tags(Request::post('Content'), Config::get('html_safe_list'));
				$post->UserId = Session::get('user')->Id;
				$post->UpdatedDate = time();
				
				if(Request::post('Draft'))
				{
					$post->Status = 0;
				}
				else
				{
					$post->PublicationDate = time();
					$post->Status = 1;
				}

				$file = Request::file('Image');
				if($file['name'])
				{
					$post->saveImage($file['tmp_name']);
				}
				
				$post->save();
				$post->unsetCategories();
				$post->setCategories(Request::post('categories'));
				$this->_flash('alert alert-success', 'Post salvo com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar o post.');
			}
		}
		
		$this->_set('label', 'Editar');
		$this->_set('categories', Category::findAll());
		$this->_set('selectedCategories', $post->getCategoriesIds());
		return $this->_view('admin_add', $post);
	}
	
	public function admin_remove()
	{
		if (Request::isPost())
		{
			try
			{
				$ids = Request::post('items', array());
				Post::deleteAll($ids);
				$this->_flash('alert alert-success', 'Posts excluídos com sucesso.');
			} 
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir os posts.');
			}
		}
		$this->_redirect('~/admin/post');
	}
	
	public function admin_publish()
	{
		if (Request::isPost())
		{
			try
			{
				$ids = Request::post('items', array());
				Post::publishAll($ids);
				$this->_flash('alert alert-success', 'Posts publicados com sucesso.');
			} 
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível publicar os posts.');
			}
		}
		$this->_redirect('~/admin/post');
	}
}