<?php

namespace Neoxygen\UpDown\Command\Cypher;

use Guzzle\Service\Command\AbstractCommand;


/**
 * Sends a Cypher Query to the ReST API
 *
 * @guzzle query doc="The Cypher query to send" required=true
 */
class sendCypherQuery extends AbstractCommand
{
    
	public function setQuery($query)
	{
            $this->set('query', $query);
	}

	protected function build()
	{
            $uri = $this->client->getUriForAction('cypher');
            $this->request = $this->client->post(array($uri, $this->data));
            $this->request->setBody(json_encode($this->get('query')));
            $this->request->setHeader('Accept', 'application/json');
            $this->request->setHeader('Content-Type', 'application/json');
	}

	public function getResult()
	{
            return parent::getResult();
	}
}