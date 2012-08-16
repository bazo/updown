<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call add a node to an index
 *
 * @guzzle indexName doc="The index name to add a node to" required="true"
 * @guzzle nodeUri doc="The node uri" required="true"
 * @guzzle key doc="The key of the node to index" required="true"
 * @guzzle value doc="The key value of the node to index" required="true"
 */
class addNodeToIndex extends AbstractCommand
{

    public function setIndex($indexName)
    {
        $this->set('indexName', $indexName);
    }

    public function setUri($nodeUri)
    {
        $this->set('nodeUri', $nodeUri);
    }

    public function setKey($key)
    {
        $this->set('key', $key);
    }

    public function setValue($value)
    {
        $this->set('value', $value);
    }

    protected function build()
    {
        $index = urlencode($this->get('indexName'));

        $body = array(
            'uri' => $this->get('nodeUri'),
            'key' => $this->get('key'),
            'value' => $this->get('value')
            );

        $uri = $this->client->getUriForAction('node_index');
        $this->request = $this->client->post(array($uri.'/'.$index, $this->data));
        $this->request->setBody(json_encode($body));
        $this->request->setHeader('Accept', 'application/json');
        $this->request->setHeader('Content-Type', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
