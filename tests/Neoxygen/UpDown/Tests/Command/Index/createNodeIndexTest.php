<?php

class createNodeIndexTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testNodeIndexIsCreated()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Index\createNodeIndex');
		$indexName = 'favorites';
		$command->setName($indexName);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(201 === $command->getResponse()->getStatusCode());
	}
}