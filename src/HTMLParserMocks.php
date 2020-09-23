<?php
class HTMLParserDummy extends HTMLParser
{
    public $inputText = array();
    public $callCount = 0;

    function getParsedData($text){
        $this->inputText[$this->callCount] = $text;
        $this->callCount++;
        return $text;
    }
}
?>