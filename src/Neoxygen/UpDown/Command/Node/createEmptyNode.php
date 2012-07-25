<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;


/**
 * Sends an API call to find a node in the database
 * 
 */
class createEmptyNode extends AbstractCommand
{
	protected function build()
	{
		$uri = $this->client->getUriForAction('node');
		$this->request = $this->client->post(array($uri, $this->data));
		$this->request->setHeader('Accept', 'application/json');
	}

	public function getResult()
	{
		return parent::getResult();
	}
}