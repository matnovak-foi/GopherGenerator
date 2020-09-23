<?php
include_once("HTMLParser.php");
include_once("DAO/iDataAccessObject.php");
include_once("DAO/WordPressDAO.php");
include_once("GopherPageCreator.php");

class GopherGenerator
{
    private $htmlParser;
    private $wordpressDAO;
    private $gopherPageCreator;

    public function __construct(iDataAccessObject $wordpressDAO, $gopherPagesPath){
        $this->htmlParser = new HTMLParser();
        $this->gopherPageCreator = new GopherPageCreator($gopherPagesPath);
        $this->wordpressDAO = $wordpressDAO;
    }

    public function getHTMLParser()
    {
        return $this->htmlParser;
    }

    public function setHTMLParser(HTMLParser $htmlParser)
    {
        $this->htmlParser = $htmlParser;
    }

    public function getWordPressDAO()
    {
        return $this->wordpressDAO;
    }

    public function clearGopherMap(){
        $this->gopherPageCreator->deleteOldGopherMap();
    }

    public function generateGopherPagesForPosts()
    {
        $posts = $this->wordpressDAO->getPosts();
        $this->generateGopherPages($posts,"POSTS");
        $this->gopherPageCreator->createGopherMap($posts,"POSTS");
    }

    public function generateGopherPagesForWPPages(){
        $pages = $this->wordpressDAO->getPages();
        $this->generateGopherPages($pages,"PAGES");
        $this->gopherPageCreator->createGopherMap($pages,"PAGES");
    }

    private function generateGopherPages($posts,$type){
        foreach ($posts as $postTitle => $post)
        {
            $parsedPostText = $this->htmlParser->getParsedData($post);
            $this->gopherPageCreator->createPage($parsedPostText,$postTitle,$type);
        }
    }
}

?>