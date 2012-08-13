<?php

namespace Neoxygen\UpDown\Command\Index;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to list the Node Indexes
 *
 */
class listNodeIndexes extends AbstractCommand
{
    protected function build()
    {
        $uri = $this->client->getUriForAction('node_index');
        $this->request = $this->client->get(array($uri, $this->data));
        $this->request->setHeader('Accept', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
