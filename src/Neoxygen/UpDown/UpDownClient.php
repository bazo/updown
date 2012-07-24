<?php

namespace Neoxygen\UpDown;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Service\Description\ServiceDescription;

class UpDownClient extends Client
{
    /**
     * @var string Host address
     */
    protected $host;

    /**
     * @var integer Http Port number
     */
    protected $port;

    /**
     * @var string Username
     */
    protected $username;

    /**
     * @var string Password
     */
    protected $password;

    /**
     * @var string EntryPoint
     */
    protected $entryPoint;

    /**
     * @var array discoveredActions
     */
    protected $discoveredActions = array();

    /**
     * Factory method to create a new UpDownClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *
     * @return UpDownClient
     *
     * @TODO update factory method and docblock for parameters
     */
    public static function factory($config = array())
    {
        $default = array();
        $required = array('host', 'port');
        $config = Inspector::prepareConfig($config, $default, $required);

        $base_url = 'http://'.$config->get('host').':'.$config->get('port');

        $client = new self(
            $base_url,
            $config->get('host'),
            $config->get('port')
            );
        $client->setConfig($config);

        // Uncomment the following two lines to use an XML service description
        // $client->setDescription(ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'client.xml'));

        return $client;
    }

    public function __construct($baseUrl, $host, $port)
    {
        parent::__construct($baseUrl);
        $this->host = $host;
        $this->port = $port;
        $this->entryPoint = $baseUrl;
        $this->discoverActions();
    }

    /**
     * This function calls the entry point and fetch
     * the links to the possible actions of Neo4j
     * It wraps sub arrays with the "." character
     */
    public function discoverActions()
    {
        if(empty($this->discoveredActions)) {
            $cmd = $this->getCommand('discoverActions');
            $exec = $this->execute($cmd);
            foreach($exec as $key => $value) {
                if(!is_array($value)) {
                    $this->discoveredActions[$key] = $value;
                } else {
                    $subName = $key;
                    foreach($value as $sk => $sv) {
                        $ssname = $subName.'.'.$sk;
                        if(!is_array($sv)) {
                            $this->discoveredActions[$ssname] = $sv;
                        } else {
                            foreach($sv as $ssk => $ssv) {
                                $sssname = $ssname.'.'.$ssk;
                                $this->discoveredActions[$sssname] = $ssv;
                            }
                        }
                    }
                }
            }
        }
    }

    public function getDiscoveredActions()
    {
        return $this->discoveredActions;
    }

    public function getUriForAction($action)
    {
        if(!array_key_exists($action, $this->discoveredActions)) {
            throw new \Exception('The requested action does not exist');
        }
        return $this->discoveredActions[$action];
    }
}
