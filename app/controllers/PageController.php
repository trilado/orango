<?php
class PageController extends AppController
{
	/**
	 * @Auth("Admin","Manager") 
	 */
	public function __construct()
	{
		$this->_set('active', 'page');
	}
	
	public function admin_index($p = 1, $m = 20, $o = 'Id', $t = 'DESC')
	{
		$pages = Post::allByType('page', $p, $m, $o, $t);
		return $this->_view($pages);
	}
	
	public function admin_add()
	{
		$page = new Post();
		if(Request::isPost())
		{
			try
			{
				$page = $this->_data($page);
				$page->Slug = Inflector::slugify(Request::post('Title'));
				$page->Status = Request::post('Draft') ? 0 : 1;
				$page->Content = strip_tags(Request::post('Content'), Config::get('html_safe_list'));
				$page->UserId = Session::get('user')->Id;
				$page->CreatedDate = time();
				$page->Type = 'page';

				$file = Request::file('Image');
				if($file['name'])
				{
					$page->saveImage($file['tmp_name']);
				}
				
				if($page->Status)
					$page->PublicationDate = time();
				
				$page->save();
				$this->_flash('alert alert-success', 'Página salva com sucesso.');
				$this->_redirect('~/admin/page/edit/' . $page->Id);
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert alert-error', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a página.');
			}
		}
		$pages = Post::allByType('page', 1, 100, 'Title');
		$this->_set('pages', $pages);
		$this->_set('label', 'Criar');
		
		return $this->_view($page);
	}
	
	public function admin_edit($id)
	{
		$page = Post::get($id);
		if(!$page)
		{
			$this->_flash('alert alert-error', 'Página não encontrada.');
			$this->_redirect('~/admin/page');
		}
		if(Request::isPost())
		{
			try
			{
				$page = $this->_data($page);
				$page->Content = strip_tags(Request::post('Content'), Config::get('html_safe_list'));
				$page->Status = Request::post('Draft') ? 0 : 1;

				$file = Request::file('Image');
				if($file['name'])
				{
					$page->saveImage($file['tmp_name']);
				}
				
				$page->save();
				$this->_flash('alert alert-success', 'Página salva com sucesso.');
			} 
			catch (ValidationException $e)
			{
				$this->_flash('alert alert-error', $e->getMessage());
			}
			catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível salvar a página.');
			}
		}
		
		$pages = Post::allByType('page', 1, 100, 'Title');
		$this->_set('pages', $pages);
		$this->_set('label', 'Editar');
		
		return $this->_view('admin_add', $page);
	}
	
	public function admin_remove()
	{
		if (Request::isPost())
		{
			try
			{
				$ids = Request::post('items', array());
				Post::deleteAll($ids);
				$this->_flash('alert alert-success', 'Páginas excluídos com sucesso.');
			} catch (Exception $e)
			{
				$this->_flash('alert alert-error', 'Ocorreu um erro e não foi possível excluir as páginas.');
			}
		}
		$this->_redirect('~/admin/page');
	}
}