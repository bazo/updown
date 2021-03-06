<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to find a node in the database
 *
 * @guzzle id doc="The ID of the node to find" required="true"
 */
class findNodeById extends AbstractCommand
{
    public function setId($id)
    {
        return $this->set('id', $id);
    }

    protected function build()
    {
        $uri = $this->client->getUriForAction('node');
        $this->request = $this->client->get(array($uri.'/{id}', $this->data));
        $this->request->setHeader('Accept', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
