<?php
declare(strict_types=1);
include_once("GopherPageCreator.php");

use PHPUnit\Framework\TestCase;

class GopherPageCreatorTest extends TestCase
{
    private $pageCreator;
    private $fileFullPath="testFiles/gophermap";

    public function setUp(): void
    {
        $this->pageCreator = new GopherPageCreator("testFiles/");
    }

    public function testHasInstance(): void
    {
        $this->assertInstanceOf(
            GopherPageCreator::class, $this->pageCreator);
    }

    public function testCreateEmptyGopherMap(): void
    {
        $posts=array();
        $pages=array();
        $this->pageCreator->createGopherMap($posts,"POSTS");

        $this->assertTrue(file_exists($this->fileFullPath));
        unlink($this->fileFullPath);
    }

    public function testCreateGopherWithOnePostMap(): void
    {
        $posts=array("PostTitle 1"=>"Post","PostTitle 2"=>"Post 2");
        $pages=array("PageTitle 1"=>"Post","PageTitle 2"=>"Post 2");
        $this->pageCreator->deleteOldGopherMap();
        $this->pageCreator->createGopherMap($posts,"POSTS");
        $this->pageCreator->createGopherMap($pages,"PAGES");
        $gopherMapContent="\nPOSTS\n0PostTitle 1\tPOSTS/PostTitle 1\twatss.foi.hr\t70\n".
            "0PostTitle 2\tPOSTS/PostTitle 2\twatss.foi.hr\t70\n".
            "\nPAGES\n".
            "0PageTitle 1\tPAGES/PageTitle 1\twatss.foi.hr\t70\n".
            "0PageTitle 2\tPAGES/PageTitle 2\twatss.foi.hr\t70\n";
        $this->assertFileContentIs($gopherMapContent);
    }


    public function assertFileContentIs($fileContent){
        $file = fopen($this->fileFullPath,"r");
        $textFromFile = fread($file,filesize($this->fileFullPath));
        fclose($file);
        $this->assertEquals($fileContent,$textFromFile);
        unlink($this->fileFullPath);
    }
}
?>