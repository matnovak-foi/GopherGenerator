<?php

declare(strict_types=1);
include_once("HTMLParser.php");

use PHPUnit\Framework\TestCase;

class HTMLParserTest extends TestCase
{
    private $htmlParser;

    public function setUp(): void{
        $this->htmlParser = new HTMLParser();
    }

    public function testHasInstance(): void {
        $this->assertInstanceOf(
            HTMLParser::class, $this->htmlParser);
    }

    public function testGivenPureTextWhenGetParsedDataThenReturnSameText(): void {
        $this->assertEquals('PureTextWithNoHTML',$this->htmlParser->getParsedData("PureTextWithNoHTML"));
    }

    public function testGivenOnlyHTMLCodeWhenGetParsedDataThenReturnEmptyText():void {
        $this->assertEquals('',$this->htmlParser->getParsedData("<p></p>"));
    }

    public function testGivenNoTextWhenGetParsedDataThenReturnEmptyText():void {
        $this->assertEquals('',$this->htmlParser->getParsedData(""));
    }

    public function testGivenHTMLCodeParagraphWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals('TextInParagraph',$this->htmlParser->getParsedData("<p>TextInParagraph</p>"));
    }

    public function testGivenHTMLCodeH1WithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals('TextInH1',$this->htmlParser->getParsedData("<h1>TextInH1</h1>"));
    }

    public function testGivenHTMLCodeSPANWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals('TextInSPAN',$this->htmlParser->getParsedData("<span>TextInSPAN</span>"));
    }
}

?>