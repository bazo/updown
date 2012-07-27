<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;


/**
 * Sends an API call to find a node in the database
 *
 * @guzzle properties doc="an array of key values pairs defining the node properties"
 */
class batchNodeCreate extends AbstractCommand
{

    protected $commands = array();
    
    
	/**
	 * If an empty array is passed, the effect will be the same
	 * as if the createEmptyNode command was called
	 */
	public function setCommand($command)
	{
		$this->commands[] = $command;
	}

	protected function build()
	{
            foreach($this->commands as $command)
            {
                $method = $command->getRequest()->getMethod();
                var_dump($method);
                exit();
            }
            
            
            
		$uri = $this->client->getUriForAction('batch');
		$this->request = $this->client->post(array($uri, $this->data));
		$this->request->setBody(json_encode($this->get('properties')));
		$this->request->setHeader('Accept', 'application/json');
		$this->request->setHeader('Content-Type', 'application/json');
	}

	public function getResult()
	{
		return parent::getResult();
	}
}