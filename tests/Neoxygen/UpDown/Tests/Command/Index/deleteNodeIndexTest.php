<?php

class deleteNodeIndexTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testNodeIndexIsDeleted()
	{
		// First create a node index
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Index\createNodeIndex');
		$indexName = 'favorites';
		$command->setName($indexName);
		$execute = $client->execute($command);

		// Check that index is well created
		$list = $this->getIndexesList();
		$this->assertTrue(201 === $command->getResponse()->getStatusCode());
		$this->assertTrue(array_key_exists($indexName, $list));

		// Delete the node
		$command2 = $client->getCommand('Index\deleteNodeIndex');
		$command2->setIndexName($indexName);
		$exec = $client->execute($command2);
		$result = $command2->getResult();

		// Check that node is deleted
		$list = $this->getIndexesList();
		$this->assertTrue(204 === $command2->getResponse()->getStatusCode());
		$this->assertFalse(array_key_exists($indexName, $list));
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