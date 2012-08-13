<?php

class listNodeIndexesTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testIndexesAreListed()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Index\listNodeIndexes');

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(200 === $command->getResponse()->getStatusCode());
	}
}