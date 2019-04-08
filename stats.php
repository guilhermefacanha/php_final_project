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
    Page::$subtitle = 'Book Rentals';
    Page::header();

    //$result = RestClient::call("GET",array('isbn' => $_GET["isbn"]));
    $result = RestClient::call("GET",array());
    $jrecords = json_decode($result);
    $rents = array();
    foreach ($jrecords as $jrecord) {
        $r = new ViewBookRent();
        $r->setLibraryId($jrecord->LibraryId);
        $r->setLibrary($jrecord->library);
        $r->setBookId($jrecord->BookId);
        $r->setTitle($jrecord->Title);
        $r->setAuthor($jrecord->Author);
        $r->setCategory($jrecord->Category);
        $r->setAvailable($jrecord->Available);
        $r->setRentedBy($jrecord->RentedBy);
        $r->setRentStart($jrecord->RentStart);
        $r->setRentEnd($jrecord->RentEnd);
        
        $rents[] = $r;
    }
    
    StatsPage::showTable($rents);
    
    $resGAvail = RestClient::call("GET",array('gavail' => 'true'));
    $groupsAvail = json_decode($resGAvail);

    StatsPage::showGroupAvailableChart();

    $resGLib = RestClient::call("GET",array('glib' => 'true'));
    $groupsLib = json_decode($resGLib);    
    
    Page::footer();
    ?>