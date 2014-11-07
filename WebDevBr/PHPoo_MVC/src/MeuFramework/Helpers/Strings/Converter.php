<?php

namespace MeuFramework\Helpers;

trait Strings_Converter
{
	public $string;

	public function toLower()
	{
		$this->string=strtolower($this->string);
		return $this;
	}

	public function toUpper()
	{
		$this->string = ucfirst($this->string);
		return $this;
	}

	public function toUrl($separator='-')
	{
		$string=str_replace(' ', $separator, trim($this->toLower()));
		return $this;
	}

}