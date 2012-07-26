<?php

class findNoteByIdTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testValidReturnedNode()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\findNodeById');
		$nodeId = 11;
		$command->setId($nodeId);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(array_key_exists('outgoing_relationships', $result));
	}

	/**
	 * @expectedException Guzzle\Service\Exception\ValidationException
	 */
	public function testValidationExceptionWhenNoIdIsProvided()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\findNodeById');
		$execute = $client->execute($command);
	}
}