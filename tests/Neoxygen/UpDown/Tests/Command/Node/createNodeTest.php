<?php

class createNodeTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testReturnedCreatedNodeAfterCreate()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\createNode');
		$properties = array(
			'username' => 'christophe',
			'lastname' => 'willemsen',
			);
		$command->setProperties($properties);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(array_key_exists('outgoing_relationships', $result));
		$this->assertEquals('christophe', $result['data']['username']);
	}

	public function testEmptyNodeIsCreatedIfEmptyArrayIsPassed()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\createNode');
		$properties = array();
		$command->setProperties($properties);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(array_key_exists('outgoing_relationships', $result));
		$this->assertTrue(empty($result['data']));
	}
}