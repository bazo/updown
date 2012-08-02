<?php

class sendCypherQueryTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testCypherCreateOneNode()
	{
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Cypher\sendCypherQuery');
		$node = array('name' => 'Angus Young', '_uid' => uniqid());
                $query = 'create n={node} return n';
                $params = array('node' => $node);
                $command->setQuery($query);
                $command->setParameters($params);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$this->assertTrue(array_key_exists('columns', $result));
                $this->assertTrue(array_key_exists('data', $result));
		$this->assertEquals('Angus Young', $result['data'][0][0]['data']['name']);
	}
}