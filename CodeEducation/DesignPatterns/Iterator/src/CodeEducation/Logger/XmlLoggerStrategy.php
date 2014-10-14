<?php

namespace CodeEducation\Logger;

class XmlLoggerStrategy implements Logger
{
	public function success($msg)
	{
		echo "Inserido no XML SUCESSO";
	}

	public function warning($msg)
	{
		echo "Inserido no XML WARNING";
	}

	public function error($msg)
	{
		echo "Inserido no XML ERROR";
	}
}

