<?php

namespace Neoxygen\UpDown\Command\Index;

use Guzzle\Service\Command\AbstractCommand;


/**
 * Sends an API call to find a node in the database
 *
 * @guzzle name doc="the index name"
 */
class createNodeIndex extends AbstractCommand
{

	public function setName($name)
	{
		$this->set('name', $name);
	}

	protected function build()
	{
		$body = array('name' => $this->get('name'));
		$uri = $this->client->getUriForAction('node_index');
		$this->request = $this->client->post(array($uri, $this->data));
		$this->request->setBody(json_encode($body));
		$this->request->setHeader('Accept', 'application/json');
		$this->request->setHeader('Content-Type', 'application/json');
	}

	public function getResult()
	{
		return parent::getResult();
	}
}