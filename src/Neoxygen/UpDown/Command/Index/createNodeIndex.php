<?php

namespace Neoxygen\UpDown\Command\Index;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to find a node in the database
 *
 * @guzzle name doc="the index name" required="true"
 * @guzzle config doc="configuration options for custom index"
 *
 * @TODO: DO NOT CREATE INDEX IF CONFIG IS INVALID / USE EXCEPTIONS
 */
class createNodeIndex extends AbstractCommand
{

    public function setConfig(array $config)
    {
        foreach ($config as $key => $value) {
            if (empty($value)) {
                return false;
            }
        }
        $this->set('config', $config);
    }

    public function setName($name)
    {
        $this->set('name', $name);
    }

    protected function build()
    {
        $uri = $this->client->getUriForAction('node_index');
        $this->request = $this->client->post(array($uri, $this->data));
        $this->request->setBody(json_encode($this->getCreateBody()));
        $this->request->setHeader('Accept', 'application/json');
        $this->request->setHeader('Content-Type', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }

    private function getCreateBody()
    {
        $body = array();
        $body['name'] = $this->get('name');
        if (null !== $this->get('config', null)) {
            $body['config'] = $this->get('config');
        }

        return $body;
    }
}
