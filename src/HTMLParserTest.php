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

    public function testGivenHTMLCodeSPANWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals('TextInSPAN',$this->htmlParser->getParsedData("<span>TextInSPAN</span>"));
    }

    public function testGivenHTMLCodeParagraphWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals('TextInParagraph',$this->htmlParser->getParsedData("<p>TextInParagraph</p>"));
    }

    public function testGivenHTMLCodeH1WithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals('TextInH1',$this->htmlParser->getParsedData("<h1>TextInH1</h1>"));
    }

    public function testGivenMultipleHTMLelementsWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals("TextInH1\nTextInP\nTextInSPAN",$this->htmlParser->getParsedData("<h1>TextInH1</h1><p>TextInP</p><span>TextInSPAN</span>"));
    }


    public function testGivenNestedHTMLelementWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals("TextInH1\nTextInP\nTextInSPAN",$this->htmlParser->getParsedData("<h1>TextInH1<p>TextInP<span>TextInSPAN</span></p></h1>"));
    }

    public function testGivenNestedHTMLelementInARowWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals("TextInH1-TextInP-TextInSPAN",$this->htmlParser->getParsedData("<h1><p><span>TextInH1-TextInP-TextInSPAN</span></p></h1>"));
    }

    public function testGivenNestedAndMultipleHTMLelementWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals("TextInH1-TextInP-TextInSPAN\nTextInH1-TextInP-TextInSPAN",$this->htmlParser->getParsedData("<h1><p><span>TextInH1-TextInP-TextInSPAN</span></p></h1><h1><p><span>TextInH1-TextInP-TextInSPAN</span></p></h1>"));
    }

    public function testGivenNestedAndMultipleHTMLelementAndMixedWithTextWhenGetParsedDataThenReturnOnlyText():void {
        $this->assertEquals("TextInH1-TextInP\nTextInH1-TextInP-TextInSPAN\nTextInH1-TextInP-TextInSPAN",$this->htmlParser->getParsedData("<h1><p>TextInH1-TextInP<span>TextInH1-TextInP-TextInSPAN</span></p></h1><h1><p><span>TextInH1-TextInP-TextInSPAN</span></p></h1>"));
    }

    public function testGivenHTMLCommentWithTextWhenGetParsedDataThenReturnEmptyText():void {
        $this->assertEquals("",$this->htmlParser->getParsedData('<!-- wp:heading {\"level\":1,\"align\":\"center\"} -->'));
    }

    public function testGivenMultipleHTMLCommentWithTextWhenGetParsedDataThenReturnEmptyText():void {
        $this->assertEquals("",$this->htmlParser->getParsedData("<!-- /wp:heading -->\n\n<!-- wp:paragraph {\\\"align\\\":\\\"left\\\",\\\"fontSize\\\":\\\"regular\\\"} -->"));
}
}

?>