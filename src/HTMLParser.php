<?php

class HTMLParser
{

    function getParsedData($text){
        if($this->hasHTML($text)){
            $text = $this->removeAllComments($text);
            $result = $this->parseOutAllHTML($text);
        } else
            return $text;
        return $result;
    }

    public function removeAllComments($text){
        $text = preg_replace('<!--[^<>]*-->','',$text);
        $text = str_replace("<>","",$text);

        return trim($text);
    }

    public function parseOutAllHTML($text)
    {
        $result = "";
        $elements = explode('>', $text);

        foreach ($elements as $k => $v)
            $result .= $this->extractNewHTMLline($v);

        return trim($result);
    }

    private function hasHTML($text){
        $start_pos=$this->getPositionOfFirstHTMLElement($text);

        if(is_int($start_pos))
            return true;
        else
            return false;

    }

    private function parseOutOneHTMLelement($text){
        $startTextPosition=$this->getPositionOfFirstHTMLElement($text)+1;
        $lengthOfText=$this->getLengthOfTextInFirstHTMLElement($text,$startTextPosition);
        return substr($text,$startTextPosition,$lengthOfText);
    }

    private function getLengthOfTextInFirstHTMLElement($text,$start_pos){
        $end_pos=strpos($text,'<',$start_pos);
        $length=$end_pos-$start_pos;
        return $length;
    }

    private function getPositionOfFirstHTMLElement($text){
        return strpos($text,'>');
    }

    public function extractNewHTMLline($element)
    {
        $line = $this->parseOutOneHTMLelement(">" . $element . ">");
        $line = trim($line);
        if($this->isElementEmpty($line))
            return $line . "\n";

    }

    public function isElementEmpty($line)
    {
        return strlen($line) != 0;
    }
}

?>