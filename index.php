<?php
    require_once("inc/Page/Page.class.php");

    Page::$title = 'Index Page';
    Page::$subtitle = 'Some subtitle for the index page';
    Page::header();

    Page::error('Example of an error!');
    Page::success('Example of an success.');

    Page::footer();
?>