<?php
    require_once("inc/Page/Page.class.php");

    PAGE::$title = 'Index Page';
    PAGE::$subtitle = 'Some subtitle for the index page';
    PAGE::header();

    PAGE::footer();
?>