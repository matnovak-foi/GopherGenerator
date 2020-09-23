<?php

class MockDAO implements iDataAccessObject{

    public $posts = array("PostTitle1" => "post 1", "PostTitle2" => "post 2", "PostTitle3" => "post 3");
    public $pages = array("PostPage1" => "page 1", "PostPage2" => "page 2", "PostPage3" => "page 3");


    function getPosts()
    {
        return $this->posts;
    }

    function getPages()
    {
        return $this->pages;
    }
}
