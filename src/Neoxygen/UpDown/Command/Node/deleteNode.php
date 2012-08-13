<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to find a node in the database
 *
 * @guzzle id doc="the ID of the node to be deleted" required="true"
 */
class deleteNode extends AbstractCommand
{

    /**
     * If an empty array is passed, the effect will be the same
     * as if the createEmptyNode command was called
     */
    public function setId($id)
    {
        $this->set('id', $id);
    }

    protected function build()
    {
        $uri = $this->client->getUriForAction('node');
        $this->request = $this->client->delete(array($uri.'/{id}', $this->data));
        $this->request->setHeader('Accept', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
