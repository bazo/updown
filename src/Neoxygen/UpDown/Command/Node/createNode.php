<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to find a node in the database
 *
 * @guzzle properties doc="an array of key values pairs defining the node properties"
 */
class createNode extends AbstractCommand
{

    /**
     * If an empty array is passed, the effect will be the same
     * as if the createEmptyNode command was called
     */
    public function setProperties(array $properties)
    {
        if (!empty($properties)) {
        $this->set('properties', $properties);
        }
    }

    protected function build()
    {
        $uri = $this->client->getUriForAction('node');
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
