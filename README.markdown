## *UpDown* - A simple PHP client library for the [Neo4j](http://neo4j.org) ReST API

`UpDown` is momently a WIP ! Beta will be lauched soon...

*UpDown* is a simple PHP client that wraps the Neo4j ReST API. UpDown is based upon [Guzzle](https://github.com/guzzle/guzzle).

## CI

[![Build Status](https://secure.travis-ci.org/neoxygen/updown.png?branch=master)](http://travis-ci.org/neoxygen/updown)

## Goal

*UpDown*'s goal is to provide a flexible way to make calls to your Neo4j ReST API. 

*UpDown* is aimed to make your requests and responses to the API easier and only that.

## Installation

Installation is now a piece of cake thanks to Composer

### Add the UpDown package to your dependencies

````
#composer.json

"require": {
    .... ,
    "neoxygen/updown": "dev-master"
}
````

## Usage

*UpDown* provides you a main ClientService and uses the Command pattern.

### Instantiate the Client

First you need to instantiate the Service Factory with and to provide some basic configuration.

_Note: This step will be made easier in the future_

````

<?php

require 'vendor/autoload.php';

use Neoxygen\UpDown\ClientService;

$dbParams = array('host' => 'localhost', 'port' => 7474);
$service = new ClientService($dbParams);
$client = $service->getClient();

````

### Creating your first request with the help of the commands

To make the requests to the Neo4j API, you need to call a Command that will make the request.

For example, if you want to *GET* the available API action links, you can do this by calling the *discoverActions* command.

In the backend, this command make a request to the endpoint of the API and return you the response with all the available links.

_The API is discoverable, and *UpDown* is built with this discoverability in mind, so at the bootstrap it will first fetch the 
available links at the endpoint, this way if the API URI scheme change, this library will not break_ :


````
$command = $client->getCommand('discoverActions');
try {
    $client->execute($command)
} catch ( UpDownException $e ) {
 var_dump($e);
}

var_dump($client->getResult());

````


This call will return you in case of success something like this :


````
array
  'extensions' => 
    array
      'CypherPlugin' => 
        array
          'execute_query' => string 'http://192.168.43.149:7474/db/data/ext/CypherPlugin/graphdb/execute_query' (length=73)
      'GremlinPlugin' => 
        array
          'execute_script' => string 'http://192.168.43.149:7474/db/data/ext/GremlinPlugin/graphdb/execute_script' (length=75)
  'node' => string 'http://192.168.43.149:7474/db/data/node' (length=39)
  'reference_node' => string 'http://192.168.43.149:7474/db/data/node/0' (length=41)
  'node_index' => string 'http://192.168.43.149:7474/db/data/index/node' (length=45)
  'relationship_index' => string 'http://192.168.43.149:7474/db/data/index/relationship' (length=53)
  'extensions_info' => string 'http://192.168.43.149:7474/db/data/ext' (length=38)
  'relationship_types' => string 'http://192.168.43.149:7474/db/data/relationship/types' (length=53)
  'batch' => string 'http://192.168.43.149:7474/db/data/batch' (length=40)
  'cypher' => string 'http://192.168.43.149:7474/db/data/cypher' (length=41)
  'neo4j_version' => string '1.8.M06-1-g87a127a' (length=18)

````

By default, the response will be returned to you in a php array. Other options will come later.

### Available commands

Here you find a list of the currently available commands :

* discoverActions (should change to discoverApi in the future)
* Node\createNodee
* Node\createEmptyNode
* Node\findNodeById
* Node\deleteNode
* Node\batchNodeCreate (should be removed in the future in favor of a generic batch command)
* searchNodeIndex (should move to Index\searchNodeIndex)
* Index\listNodeIndexes
* Index\createNodeIndex
* Index\deleteNodeIndex

