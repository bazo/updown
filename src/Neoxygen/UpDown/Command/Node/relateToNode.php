<?php

namespace Neoxygen\UpDown\Command\Node;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends an API call to create a relationship between two nodes
 *
 * @guzzle startNode doc="the ``create_relationship`` uri of the starting node" required="true"
 * @guzzle type doc="the relationship type" required="true"
 * @guzzle endNode doc="the end node uri" required="true"
 * @guzzle properties doc="an array of key values pairs defining the relationship properties"
 */
class relateToNode extends AbstractCommand
{

    public function setStartNode($startNode)
    {
        $this->set('startNode', $startNode);
    }

    public function setEndNode($endNode)
    {
        $this->set('endNode', $endNode);
    }

    public function setType($type)
    {
        $this->set('type', $type);
    }

    public function setProperties(array $properties)
    {
        if ($prop = $this->sanitizeProperties($properties)){
            $this->set('properties', $prop);
        }
    }

    protected function build()
    {
        $uri = $this->get('startNode');
        $body = array(
            'to' => $this->get('endNode'),
            'type' => $this->get('type')
            );
        if ($this->get('properties', false)){
            $body['data'] = $this->get('properties');
        }
        $this->request = $this->client->post(array($uri, $this->data));
        $this->request->setBody(json_encode($body));
        $this->request->setHeader('Accept', 'application/json');
        $this->request->setHeader('Content-Type', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }

    private function sanitizeProperties(array $prop)
    {
        if (empty($prop)){
            return false;
        }

        foreach($prop as $key => $val)
        {
            if (empty($val)){
                unset($prop[$key]);
            }
        }
        return $prop;
    }
}
