<?php

class searchNodeIndexTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testValidReturnedNode()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('searchNodeIndex');
		$command->setNodeIndex('Acme\\DemoBundle\\Entity\\User');
		$command->setCriteria(array(
			'fullName' => 'Roger*'
			));

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(is_array($result));
		$this->assertEquals('Roger Lefrancq', $result[0]['data']['fullName']);
	}
}