<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to find the node Relationships in a database
 *
 * @guzzle nodeUri doc="the full node uri" required="true"
 */
class getNodeRelationships extends AbstractCommand
{
    public function setNode($nodeUri)
    {
        return $this->set('nodeUri', $nodeUri);
    }

    protected function build()
    {
        $cl = $this->getClient();
        $command = $cl->getCommand('Common\sendSimpleGet');
        $command->setUri($this->get('nodeUri'));
        $exec = $cl->execute($command);
        $rslt = $command->getResult();
        $reluri = $rslt['all_typed_relationships'];

        $uri = $reluri;
        $this->request = $this->client->get(array($uri, $this->data));
        $this->request->setHeader('Accept', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
