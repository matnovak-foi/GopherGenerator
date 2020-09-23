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

    private function removeAllComments($text){
        $text = preg_replace('<!--[^<>]*-->','',$text);
        $text = str_replace("<>","",$text);

        return trim($text);
    }

    private function parseOutAllHTML($text)
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

    private function getPositionOfFirstHTMLElement($text){
        return strpos($text,'>');
    }

    private function extractNewHTMLline($element)
    {
        $line = $this->parseOutOneHTMLelement(">" . $element . ">");
        $line = trim($line);
        if($this->isElementEmpty($line))
            return $line . "\n";
    }

    private function parseOutOneHTMLelement($text){
        $startTextPosition=$this->getPositionOfFirstHTMLElement($text)+1;
        $lengthOfText=$this->getLengthOfTextInFirstHTMLElement($text,$startTextPosition);
        $finalText = substr($text,$startTextPosition,$lengthOfText);
        if(strpos($text,"</li>"))
            $finalText="- ".$finalText;
        return $finalText;
    }

    private function getLengthOfTextInFirstHTMLElement($text,$start_pos){
        $end_pos=strpos($text,'<',$start_pos);
        $length=$end_pos-$start_pos;
        return $length;
    }

    private function isElementEmpty($line)
    {
        return strlen($line) != 0;
    }
}

?>