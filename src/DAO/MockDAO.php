<?php

class MockDAO implements iDataAccessObject{

    function getPosts()
    {
        $posts = array();
        array_push($posts, "post 1", "post 2", "post 3");
        return $posts;
    }

    function getPages()
    {
        $pages = array();
        array_push($pages, "page 1", "page 2", "page 3");
        return $pages;
    }
}
