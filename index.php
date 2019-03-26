<?php
    //config file
    //require_once("inc/util/config.inc.php");
    require_once("inc/Page/Page.class.php");
    //require_once("inc/page/Validation.class.php");

    //entity file
    //require_once("inc/entity/Customer.class.php");

    //utility file
    //require_once("inc/util/PDOAgent.class.php");
    //require_once("inc/dao/CustomerMapper.class.php");

    Page::$title = 'Index Page';
    Page::$subtitle = 'Some subtitle for the index page';
    Page::header();

    Page::error('Example of an error!');
    Page::success('Example of an success.');

    Page::footer();
?>