<?php

namespace Neoxygen\UpDown\Tests;

use Neoxygen\UpDown\UpDownClient;

class UpDownClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testBuilderCreatesClient()
    {
    	$client = $this->getServiceBuilder()->get('test.updown');

    	$this->assertTrue(array_key_exists('node', $client->getDiscoveredActions()));
    	//$this->assertTrue(array_key_exists('extensions.GremlinPlugin.execute_script', $client->getDiscoveredActions()));
    }
}
