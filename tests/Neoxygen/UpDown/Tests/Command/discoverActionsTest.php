<?php

class discoverActionsTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testDiscoveredActions()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$this->assertTrue(array_key_exists('neo4j_version', $client->getDiscoveredActions()));
	}
}