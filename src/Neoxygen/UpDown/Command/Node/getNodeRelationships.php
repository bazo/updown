<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to find the node Relationships in a database
 *
 * @guzzle nodeUri doc="the all_typed_relationships uri of the node" required="true"
 */
class getNodeRelationships extends AbstractCommand
{
    public function setNode($nodeUri)
    {
        return $this->set('nodeUri', $nodeUri);
    }

    protected function build()
    {
        $uri = $this->get('nodeUri');
        $this->request = $this->client->get(array($uri, $this->data));
        $this->request->setHeader('Accept', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
