<?php

class deleteNodeTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testValidReturnedNode()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\deleteNode');
		$nodeId = 11;
		$command->setId($nodeId);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertEquals('204', $command->getResponse()->getStatusCode());
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