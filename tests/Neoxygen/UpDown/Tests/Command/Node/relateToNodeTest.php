<?php

class relateToNodeTest extends Guzzle\Tests\GuzzleTestCase
{
	public function testRelationshipIsCreated()
	{
		//first create two nodes
		$client = $this->getServiceBuilder()->get('test.updown');
		$command = $client->getCommand('Node\createNode');
		$command2 = $client->getCommand('Node\createNode');
		$properties = array(
			'username' => 'christophe-1-'.uniqid(),
			'lastname' => 'willemsen',
			);
		$properties2 = array(
			'username' => 'christophe-2-'.uniqid(),
			'lastname' => 'willemsen',
			);
		$command->setProperties($properties);
		$command2->setProperties($properties2);

		$execute = $client->execute($command);
		$result = $command->getResult();

		$exec = $client->execute($command2);
		$rslt = $command2->getResult();


		//create the relationship between the two nodes
		$start = $result['create_relationship'];
		$end = $rslt['self'];
		$type = 'KNOWS';

		$relcmd = $client->getCommand('Node\relateToNode');
		$relcmd->setStartNode($start);
		$relcmd->setEndNode($end);
		$relcmd->setType($type);

		$relxc = $client->execute($relcmd);
		$relrslt = $relcmd->getResult();

		$this->assertTrue(201 === $relcmd->getResponse()->getStatusCode());
		$this->assertEquals($result['self'], $relrslt['start']);
		$this->assertEquals($end, $relrslt['end']);
		$this->assertEquals($type, $relrslt['type']);
		
		$cm = $client->getCommand('Node\getNodeRelationships');
		$cm->setNode($result['self']);
		$xc = $client->execute($cm);

		$relationFound = false;
		foreach ($cm->getResult() as $relation){
			if ($relation['start'] == $result['self']){
				$relationFound = true;
			}
		}
		$this->assertTrue($relationFound);
	}
}