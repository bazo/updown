<?php

class findNoteByIdTest extends Guzzle\Tests\GuzzleTestCase
{

	private $id;

	public function setUp()
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
		$self = $result['self'];
		$splitted = explode('/', $self);
		$this->id = array_pop($splitted);
	}

	public function testValidReturnedNode()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\findNodeById');
		$nodeId = $this->id;
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