<?php

class addNodeToIndexTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testNodeIsAddedToIndex()
	{
		//first create a node
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\createNode');
		$properties = array(
			'username' => 'christophe',
			'lastname' => 'willemsen',
			);
		$command->setProperties($properties);

		$execute = $client->execute($command);
		$result = $command->getResult();
		$nodeUri = $result['self'];

		// add the node to the index
		$indexName = 'usernames';
		$key = 'username';
		$value = $result['data']['username'];

		$cmd = $client->getCommand('Node\addNodeToIndex');
		$cmd->setIndex($indexName);
		$cmd->setUri($nodeUri);
		$cmd->setKey($key);
		$cmd->setValue($value);
		$exec = $client->execute($cmd);
		$rslt = $cmd->getResult();

		$this->assertTrue(201 === $cmd->getResponse()->getStatusCode());
		$this->assertTrue($nodeUri === $rslt['self']);
	}

	/**
	 * @expectedException Guzzle\Service\Exception\ValidationException
	 */
	public function testExceptionisThrownIfNoIndexNameIsPassed()
	{
		//first create a node
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\createNode');
		$properties = array(
			'username' => uniqid(),
			'lastname' => uniqid(),
			);
		$command->setProperties($properties);

		$execute = $client->execute($command);
		$result = $command->getResult();
		$nodeUri = $result['self'];

		// add the node to the index
		$indexName = 'usernames';
		$key = 'username';
		$value = $result['data']['username'];

		$cmd = $client->getCommand('Node\addNodeToIndex');
		//$cmd->setIndex($indexName);
		$cmd->setUri($nodeUri);
		$cmd->setKey($key);
		$cmd->setValue($value);
		$exec = $client->execute($cmd);
		$rslt = $cmd->getResult();
	}


}