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

	public function testNodeIsCreatedWithConfig()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Index\createNodeIndex');
		$indexName = 'fulltextindex';
		$config = array('type' => 'fulltext', 'provider' => 'lucene');
		$command->setName($indexName);
		$command->setConfig($config);

		$execute = $client->execute($command);
		$result = $command->getResult();

		/**
		 * @TODO: Add a check to retrieve the node index when getIndexList Command is created
		 */
		$this->assertTrue(201 === $command->getResponse()->getStatusCode());

	}
}