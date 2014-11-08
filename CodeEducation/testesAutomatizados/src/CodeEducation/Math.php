<?php

namespace CodeEducation;

class Math
{
    public function soma($x, $y)
    {
        if(!is_numeric($x) || !is_numeric($y))
            throw new \InvalidArgumentException("Os valores nao sao numericos.");

        return $x + $y;
    }
}