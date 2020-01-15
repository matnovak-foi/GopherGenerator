<?php


class WordPressDAO implements iDataAccessObject {
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $database = 'wordpress-db';

    public function __construct(){
        $this->connection = new mysqli($this -> host, $this -> user, $this -> pass, $this -> database);
        $this->connection->set_charset("utf8");
    }

    private function query($sql) {
        return $this->connection->query($sql);
    }

    public function getPosts()
    {
        $posts = array();
        $result = $this -> query("SELECT post_content FROM `wp_posts` WHERE `post_status` LIKE 'publish' AND `post_type` LIKE 'post'");
        while ($record = $result->fetch_object()) {
            array_push($posts, $record->post_content);
        }
        return $posts;
    }

    public function getPages()
    {
        $pages = array();
        $result = $this -> query("SELECT * FROM `wp_posts` WHERE `post_status` LIKE 'publish' AND `post_type` LIKE 'page'");
        while ($record = $result->fetch_assoc()) {
            array_push($pages, $record);
        }
        return $pages;
    }
}