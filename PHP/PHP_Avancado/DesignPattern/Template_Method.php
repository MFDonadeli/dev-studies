<?php

abstract class OrderAbstract
{
    public function finalValue($value, $size, $changeValue)
    {
        $value += $this->freight($size);
        $value += $this->changeValue($changeValue);

        return number_format($value, 2, ',', '.');
    }

    protected abstract function changeValue(int $value) :int;

    protected function freight(int $size) :int
    {
        return 10;
    }
}

class DiscountOrder extends OrderAbstract
{
    protected function changeValue(int $value) :int
    {
        return -$value;
    }
}

class IncreaseOrder extends OrderAbstract
{
    protected function changeValue(int $value) :int
    {
        return $value;
    }
}


$value = 190;
$changeValue = 20;

$result = (new DiscountOrder)->finalValue($value, 40, $changeValue);
var_dump($result);

$result = (new IncreaseOrder)->finalValue($value, 40, $changeValue);
var_dump($result);