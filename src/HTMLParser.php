<?php

class HTMLParser
{

    function getParsedData($text){
        if($this->hasHTML($text)){
            $text=$this->parseOutHTML($text);
        }
        return $text;
    }

    private function hasHTML($text){
        $start_pos=$this->getPositionOfFirstHTMLElement($text);

        if(is_int($start_pos))
            return true;
        else
            return false;

    }

    private function parseOutHTML($text){
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
}

?>