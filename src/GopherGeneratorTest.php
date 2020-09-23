<?php
declare(strict_types=1);
include_once("GopherGenerator.php");
include_once("DAO/MockDAO.php");
include_once("HTMLParserMocks.php");

use PHPUnit\Framework\TestCase;

class GopherGeneratorTest extends TestCase
{
    private $main;
    private $wordpressDAO;
    private $htmlParser;

    public function setUp(): void
    {
        $this->wordpressDAO = new MockDAO();
        $this->main = new GopherGenerator($this->wordpressDAO, "testFiles/");
        $this->htmlParser = new HTMLParserDummy();
    }

    public function testHasInstance(): void {
        $this->assertInstanceOf(
            GopherGenerator::class, $this->main);
    }

    public function testMainCreatesInstanceOfHTMLParser(): void {
        $this->assertInstanceOf(
            HTMLParser::class, $this->main->getHTMLParser());
    }

    public function testMainCreatesInstanceOfWordPressDAO(): void {
        $this->assertInstanceOf(
            iDataAccessObject::class, $this->main->getWordPressDAO());
        $this->assertInstanceOf(
            iDataAccessObject::class, $this->main->getWordPressDAO());
    }

    public function testMainGetsDataAndPassesOnToHTMLParserForOnePostAndCreatesFile(): void {
        $this->main->setHTMLParser($this->htmlParser);
        $this->wordpressDAO->posts = array("postTitle1" => "post1");
        $this->main->generateGopherPagesForPosts();

        $fileFullPath="testFiles/postTitle1";
        $file = fopen($fileFullPath,"r");
        $textFromFile = fread($file,filesize($fileFullPath));
        fclose($file);

        $this->assertEquals("post1",$textFromFile);
        unlink($fileFullPath);
    }

    public function testMainGetsDataAndPassesOnToHTMLParserForMultiplePostAndCreatesFiles(): void {
        $this->main->setHTMLParser($this->htmlParser);
        $this->main->generateGopherPagesForPosts();
        $this->assertEquals(sizeof($this->wordpressDAO->getPosts()),$this->htmlParser->callCount);
        $i=0;
        foreach ($this->wordpressDAO->getPosts() as $postTitle => $post) {
            $fileFullPath = "testFiles/" . $postTitle;
            $file = fopen($fileFullPath, "r");
            $textFromFile = fread($file, filesize($fileFullPath));
            fclose($file);

            $this->assertEquals($post, $this->htmlParser->inputText[$i]);
            $i++;
            $this->assertEquals($post, $textFromFile);
            unlink($fileFullPath);
        }
    }

    public function testMainGetsDataAndPassesOnToHTMLParserForMultiplePagesAndCreatesFiles(): void {
        $this->main->setHTMLParser($this->htmlParser);
        $this->main->generateGopherPagesForWPPages();
        $this->assertEquals(sizeof($this->wordpressDAO->getPages()),$this->htmlParser->callCount);
        $i=0;
        foreach ($this->wordpressDAO->getPages() as $pageTitle => $pageText) {
            $fileFullPath = "testFiles/" . $pageTitle;
            $file = fopen($fileFullPath, "r");
            $textFromFile = fread($file, filesize($fileFullPath));
            fclose($file);

            $this->assertEquals($pageText, $this->htmlParser->inputText[$i]);
            $i++;
            $this->assertEquals($pageText, $textFromFile);
            unlink($fileFullPath);
        }
    }
}
?>