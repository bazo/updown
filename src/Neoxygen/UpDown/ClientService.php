<?php

namespace Neoxygen\UpDown;

use Guzzle\Service\Builder\ServiceBuilder;

class ClientService
{
    private $host;

    private $port;

    public function __construct(array $dbParams)
    {
        if (!isset($dbParams['host']) || !isset($dbParams['port'])) {
            throw new \Exception('You must specify a host and port name/number');
        }
        $this->host = $dbParams['host'];
        $this->port = $dbParams['port'];
    }

    public function getClient()
    {
		$config = array(
			'updown' => array(
				'class' => 'Neoxygen\UpDown\UpDownClient',
				'params' => array(
					'host' => $this->host, 
					'port' => $this->port
				)
			)
		);
		
		// Source service definitions from a JSON file
		$builder = ServiceBuilder::factory($config);

		$client = $builder['updown'];

		return $client;
    }
}
