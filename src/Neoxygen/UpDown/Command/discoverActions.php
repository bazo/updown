<?php

namespace Neoxygen\UpDown\Command;

use Guzzle\Service\Command\AbstractCommand;


/**
 * Discover all the links for the different actions
 * This means the REST API can change their uri template without
 * affecting the Client
 * 
 */
class discoverActions extends AbstractCommand
{
	public function setId($id)
	{
		return $this->set('id', $id);
	}

	protected function build()
	{
		$this->request = $this->client->get(array('/db/data', $this->data));
		$this->request->setHeader('Accept', 'application/json');
	}

	public function getResult()
	{
		return parent::getResult();
	}
}