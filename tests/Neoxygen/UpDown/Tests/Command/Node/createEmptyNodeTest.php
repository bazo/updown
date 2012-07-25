<?php

class createEmptyNodeTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testReturnedEmptyNodeAfterCreate()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\createEmptyNode');

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(array_key_exists('outgoing_relationships', $result));
		$this->assertTrue(empty($result['data']));
	}
}