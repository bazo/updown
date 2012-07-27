<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;


/**
 * Sends an API call to find a node in the database
 *
 */
class batchNodeCreate extends AbstractCommand
{

    protected $batch = array();
    
    protected $method = 'POST';
    
    public function addNode(array $properties)
    {
        $this->batch[] = array('method' => 'POST', 'to' => '/node', 'body' => $properties);
    }

	protected function build()
	{
            
            
            
		$uri = $this->client->getUriForAction('batch');
		$this->request = $this->client->post(array($uri, $this->data));
		$this->request->setBody(json_encode($this->batch));
		$this->request->setHeader('Accept', 'application/json');
		$this->request->setHeader('Content-Type', 'application/json');
	}

	public function getResult()
	{
		return parent::getResult();
	}
        
        public function getBatch()
        {
            return $this->batch;
        }
}