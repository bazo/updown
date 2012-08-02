<?php

namespace Neoxygen\UpDown\Command\Cypher;

use Guzzle\Service\Command\AbstractCommand;


/**
 * Sends a Cypher Query to the ReST API
 *
 * @guzzle query doc="The Cypher query to send" required=true
 * @guzzle params doc="The parameters for the Cypher Query"
 */
class sendCypherQuery extends AbstractCommand
{
    protected $cypherQuery;
    
    protected $cypherParams;
    
	public function setQuery($query)
	{
            $this->cypherQuery = $query;
	}
        
        public function setParameters(array $parameters)
        {
            $this->cypherParams = $parameters;
        }

	protected function build()
	{
            $body = array('query' => $this->cypherQuery);
            if(!empty($this->cypherParams)) {
                $body['params'] = $this->cypherParams;
            }
            
            $uri = $this->client->getUriForAction('cypher');
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