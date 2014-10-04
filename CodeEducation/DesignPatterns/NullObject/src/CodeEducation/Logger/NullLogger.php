<?php

namespace CodeEducation\Logger;

class NullLogger implements Logger
{
	public function success($msg) { }

	public function warning($msg) { }

	public function error($msg) { }
}
