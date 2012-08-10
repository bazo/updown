<?php

class sendCypherQueryTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testCypherCreateOneNode()
	{
		$this->markTestIncomplete(
          'This test pass in local but not on Travis. Why ?.'
        );
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Cypher\sendCypherQuery');
		$node = array('name' => 'Angus Young', '_uid' => uniqid());
                $query = 'CREATE n={node} return n';
                $params = array('node' => $node);
                $command->setQuery($query);
                $command->setParameters($params);

		$execute = $client->execute($command);
		$result = $command->getResult();

		// You can get the raw http request with the following code :
		// $rbody = $command->getRequest();
		// print_r($rbody->__toString());

		$this->assertTrue(array_key_exists('columns', $result));
                $this->assertTrue(array_key_exists('data', $result));
		$this->assertEquals('Angus Young', $result['data'][0][0]['data']['name']);
	}
}