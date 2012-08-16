<?php

namespace Neoxygen\UpDown\Tests;

use Neoxygen\UpDown\ClientService;
use Guzzle\Service\Client;

class ClientServiceTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testSimpleServiceReturnClient()
    {
    	$dbParams = array(
    		'host' => 'localhost',
    		'port' => 7474
    		);

    	$service = new ClientService($dbParams);
    	$client = $service->getClient();
    	$this->assertTrue($client instanceof Client);
    }
}
