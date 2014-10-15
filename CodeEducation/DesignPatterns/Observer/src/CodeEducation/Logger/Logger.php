<?php

namespace CodeEducation\Logger;

interface Logger
{
	public function success($msg);
	public function warning($msg);
	public function error($msg);
}
