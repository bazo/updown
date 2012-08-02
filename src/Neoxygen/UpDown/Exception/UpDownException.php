<?php

namespace Neoxygen\UpDown\Exception;

class UpDownException extends \Exception
{

	protected $message;

	protected $errorInfo = array();

	protected $fullStackTrace;

	public function __construct(\Exception $exception)
	{
		$this->formatException($exception);
		parent::__construct('An error occured with the Command request - '.$this->errorInfo['message'], $exception->getCode());
	}

	public function formatException($exception)
	{
		$this->errorInfo['statusCode'] = $exception->getResponse()->getStatusCode();
		$body = $exception->getResponse()->getBody(true);
		$this->errorInfo['message'] = $body;
		//$this->fullStackTrace = $body;
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function getExceptionInfo()
	{
		return $this->errorInfo;
	}

	public function getFullStackTrace()
	{
		return $this->fullStackTrace;
	}
}