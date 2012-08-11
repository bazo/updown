<?php

class discoverActionsTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testDiscoveredActions()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		

		print_r($client->getDiscoveredActions());
	}
}