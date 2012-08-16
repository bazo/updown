<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to find a node in the database
 *
 * @guzzle criteria doc="The criteria for the search in the node index" required="true"
 * @guzzle index_name doc="The Node Index to search from" required="true"
 */
class searchNodeIndex extends AbstractCommand
{

    public function setCriteria(array $criteria)
    {
        $this->set('criteria', $criteria);
    }

    public function setNodeIndex($index)
    {
        $this->set('index_name', urlencode($index));
    }

    protected function build()
    {
        $uri = $this->client->getUriForAction('node_index');
        $this->request = $this->client->get(array($uri.'/'.$this->get('index_name'), $this->data));
        $this->request->setHeader('Accept', 'application/json');
        $this->setQueryString();
    }

    public function getResult()
    {
        return parent::getResult();
    }

    protected function setQueryString()
    {
        $this->request->getQuery()->setEncodeFields(false);
        $this->request->getQuery()->setEncodeValues(false);
        $this->request->getQuery()->setValueSeparator(':');
        $this->request->getQuery()->setPrefix('?query=');
        $this->processQueryCriterias();
    }

    protected function processQueryCriterias()
    {
        foreach ($this->get('criteria') as $field => $value) {
            $this->request->getQuery()->set($field, $value);
        }
    }
}
