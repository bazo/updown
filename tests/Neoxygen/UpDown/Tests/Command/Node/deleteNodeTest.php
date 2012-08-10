<?php

class deleteNodeTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testValidReturnedNode()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$com = $client->getCommand('Node\createEmptyNode');
		$exec = $client->execute($com);
		$node = $com->getResult();
		$splitNode = explode('/', $node['self']);
		$split = array_reverse($splitNode);
		$nodeIds = $split[0];

		$command = $client->getCommand('Node\deleteNode');
		$nodeId = $nodeIds;
		$command->setId($nodeId);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertEquals('204', $command->getResponse()->getStatusCode());
	}

	/**
	 * @expectedException Neoxygen\UpDown\Exception\UpDownException
	 */
	public function testExceptionIfNodeIsNotOrphaned()
	{
		$this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\deleteNode');
		$nodeId = 11;
		$command->setId($nodeId);

		$execute = $client->execute($command);
	}
}