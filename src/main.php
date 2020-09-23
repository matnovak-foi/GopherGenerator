<?php
include_once "GopherGenerator.php";
include_once "DAO/WordPressDAO.php";

$wordpressDAO = new WordPressDAO();
$gopherGenerator = new GopherGenerator($wordpressDAO,"/var/gopher/watss");
$gopherGenerator->clearGopherMap();
$gopherGenerator->generateGopherPagesForWPPages();
$gopherGenerator->generateGopherPagesForPosts();
?>
