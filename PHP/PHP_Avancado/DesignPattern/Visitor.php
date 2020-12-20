<?php

interface VisitorInterface
{
    public function convert(ElementAbstract $element);
}

abstract class ElementAbstract
{
    protected $value;

    public abstract function validate($value) :bool;

    public function setValue($value)
    {
        if (!$this->validate($value)) {
            throw new Exception("Invalid value");
        }
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function accept(VisitorInterface $visitor)
    {
        $visitor->convert($this);
    }
}

class LowerCaseVisitor implements VisitorInterface
{
    public function convert(ElementAbstract $element)
    {
        $value = $element->getValue();
        $element->setValue(strtolower($value));
    }
}

class UpperCaseVisitor implements VisitorInterface
{
    public function convert(ElementAbstract $element)
    {
        $value = $element->getValue();
        $element->setValue(strtoupper($value));
    }
}

class StringElement extends ElementAbstract
{
    public function validate($value) :bool
    {
        return is_string($value);
    }
}


$element = new StringElement;
$element->setValue('Erik Figueiredo');
$element->accept(new LowerCaseVisitor);
var_dump($element->getValue());