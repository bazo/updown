<?php

namespace Neoxygen\UpDown;

class ClientService
{
    private $host;
    
    private $port;
    
    
    public function __construct(array $config = array())
    {
        if(!isset($config['host']) || !isset($config['port']))
        {
            throw new \Exception('You must specify a host and port name/number');
        }
        $this->host = $config['host'];
        $this->port = $config['port'];
    }
    
    public function getClient()
    {
    
    $config = array('updown' => array(
	'class' => 'Neoxygen\UpDown\UpDownClient',
	'params' => array('host' => $this->host, 'port' => $this->port)));
    // Source service definitions from a JSON file
    $builder = ServiceBuilder::factory($config);

    $client = $builder['updown'];
    
    return $client;
    }
}
