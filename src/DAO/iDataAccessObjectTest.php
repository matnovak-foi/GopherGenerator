<?php

declare(strict_types=1);
include_once("iDataAccessObject.php");
include_once("WordPressDAO.php");
include_once("MockDAO.php");

use PHPUnit\Framework\TestCase;

class iDataAccessObjectTest extends TestCase
{
    private $dao;

    public function setUp(): void{
        $this->dao = new MockDAO();
    }

    public function testHasInstance(): void {
        $this->assertInstanceOf(iDataAccessObject::class, $this->dao);
    }

    public function testGivenNoneWhenGetPostsThenReturnNotNull(): void {
        $this->assertNotNull($this->dao->getPosts());
    }

    public function testGivenNoneWhenGetPostsThenReturnPostArray(): void {
        $this->assertIsArray($this->dao->getPosts());
    }

    public function testGivenNoneWhenGetPagesThenReturnNotNull(): void {
        $this->assertNotNull($this->dao->getPages());
    }

    public function testGivenNoneWhenGetPostsThenReturnPagesArray(): void {
        $this->assertIsArray($this->dao->getPages());
    }
}