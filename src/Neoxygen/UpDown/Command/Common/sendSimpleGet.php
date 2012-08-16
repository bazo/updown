<?php

namespace Neoxygen\UpDown\Command\Common;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Sends a simple GET request to the API
 *
 * @guzzle uri doc="the full uri" required="true"
 */
class sendSimpleGet extends AbstractCommand
{
    public function setUri($uri)
    {
        return $this->set('uri', $uri);
    }

    protected function build()
    {
        $uri = $this->get('uri');
        $this->request = $this->client->get(array($uri, $this->data));
        $this->request->setHeader('Accept', 'application/json');
    }

    public function getResult()
    {
        return parent::getResult();
    }
}
