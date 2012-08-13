<?php

namespace Neoxygen\UpDown\Command\Index;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to delete a node index in the database
 *
 * @guzzle name doc="the index name" required="true"
 *
 */
class deleteNodeIndex extends AbstractCommand
{
    public function setIndexName($name)
    {
        $this->set('name', $name);
    }

    protected function build()
    {
        // Note : Currently the index name has to be hardcoded in the uri.
        // A ticket has been opened on the ML
        // https://groups.google.com/forum/?fromgroups#!topic/neo4j/zTPJvjz4L6A
        $uri = $this->client->getUriForAction('node_index');
        $this->request = $this->client->delete(array($uri.'/'.$this->get('name'), $this->data));
        $this->request->setHeader('Accept', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
