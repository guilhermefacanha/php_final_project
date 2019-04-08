<?php
    //config file
    require_once("inc/config.inc.php");

    //Page html related file
    require_once("inc/Page/Page.class.php");
    require_once("inc/Page/StatsPage.class.php");

    //entity file
    require_once("inc/Entity/ViewBookRent.class.php");

    //utility file
    require_once("inc/Utility/RestClient.class.php");
    //require_once("inc/dao/CustomerMapper.class.php");

    Page::$title = 'Admin Statistics';
    Page::$subtitle = 'Books by Availability';
    Page::header();

    $resGAvail = RestClient::call("GET",array('gavail' => 'true'));
    StatsPage::showGroupChart($resGAvail ,'Books by Availabilty');
    
    Page::footer();
    ?>