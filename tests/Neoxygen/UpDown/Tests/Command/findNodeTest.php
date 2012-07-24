<?php

class findNoteTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testValidReturnedNode()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('findNode');
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
		$command = $client->getCommand('findNode');

		$execute = $client->execute($command);
	}
}