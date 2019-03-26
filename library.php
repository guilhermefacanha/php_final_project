<?php
    require_once("inc/config.inc.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Page/Page.class.php");
    require_once("inc/Entities/Library.class.php");
    require_once("inc/Page/LibraryPage.class.php");
    require_once("inc/Utility/LibraryMapper.class.php");

    Page::$title = 'Libraries';
    Page::$subtitle = 'List of Available Libraries';
    Page::header();

    LibraryMapper::initialize();
    $libraries  = LibraryMapper::getAll();
    LibraryPage::showLibraryTable($libraries);

    Page::footer();
?>