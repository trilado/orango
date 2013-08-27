<?php

/**
 * Exceção para má efetuação do registro de uma ADD
 */
class BadAddSetupException extends PageNotFoundException
{
	/**
	 * Contrutor da classe
	 * @param	string	$action		nome da action
	 */
	public function __construct($key)
	{
		parent::__construct('O array de registro de uma ADD deve conter a chave '. $key .'.');
	}
	
	/**
	 * Se o debug estiver habilitado, informa ao usuário detalhes sobre a action
	 * @see		PageNotFoundException::getDetails()
	 * @return	string		retorna os detalhes da action
	 */
	public function getDetails()
	{
		return 'public static $adds = array(' . nl .
			'ModuleComposer::POST_ADDS => array(' . nl .
				"'controller' 	=> 'ExampleController'," . nl .
				"'action'		=> 'index'". nl .
			');' . nl .
		');';
	}
}