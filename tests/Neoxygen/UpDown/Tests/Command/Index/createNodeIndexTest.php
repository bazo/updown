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

		$list = $this->getIndexesList();
		$this->assertTrue(201 === $command->getResponse()->getStatusCode());
		$this->assertTrue(array_key_exists($indexName, $list));
	}

	public function testNodeIndexIsCreatedWithConfig()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Index\createNodeIndex');
		$indexName = 'fulltextindex';
		$config = array('type' => 'fulltext', 'provider' => 'lucene');
		$command->setName($indexName);
		$command->setConfig($config);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$list = $this->getIndexesList();
		$this->assertTrue(201 === $command->getResponse()->getStatusCode());
		$this->assertTrue(array_key_exists($indexName, $list));
		$this->assertEquals($config['type'], $list[$indexName]['type']);

	}

	public function testNodeIndexIsNotCreatedIfConfigIsInvalid()
	{
		// @TODO
	}

	private function getIndexesList()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Index\listNodeIndexes');
		$execute = $client->execute($command);
		$result = $command->getResult();
		return $result;
	}
}