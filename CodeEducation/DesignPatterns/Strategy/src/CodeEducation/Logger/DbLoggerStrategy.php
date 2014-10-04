<?php

namespace CodeEducation\Logger;

class DbLoggerStrategy implements Logger
{
	public function success($msg)
	{
		$sql = "INSERT INTO .... 1";
		echo $sql.PHP_EOL;
	}

	public function warning($msg)
	{
		$sql = "INSERT INTO .... 2";
		echo $sql.PHP_EOL;
	}

	public function error($msg)
	{
		$sql = "INSERT INTO ... 3";
		echo $sql.PHP_EOL;
	}
}


