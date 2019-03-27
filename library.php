<?php
    
    //config file
    require_once("inc/config.inc.php");
    require_once("inc/Page/Page.class.php");
    require_once("inc/Page/LibraryPage.class.php");
    require_once("inc/Page/Validation.class.php");
    
    //entity file
    require_once("inc/Entity/Library.class.php");
    
    //util file
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/LibraryMapper.class.php");

    Page::$title = 'Libraries';
    Page::$subtitle = 'List of Available Libraries';
    Page::header();

    LibraryMapper::initialize();
    $library = new Library();

    //POST METHOD USED TO PERSIST INSERT OR UPDATE
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $library->setLibraryId($_POST['id']);
        $library->setName($_POST['name']);
        $library->setAddress($_POST['address']);
        $valid = Validation::isLibraryValid($_POST);
        if(is_bool($valid) && $valid == true){
            if($library->getId()>0){
                LibraryMapper::update($library);
                Page::success('Library updated!');
            }
            else{
                $newid = LibraryMapper::create($library);
                Page::success('New Library added with id '.$newid);
            }
            $library = new Library();
        }
        else{
            Page::error($valid);
        }
    }

    //GET METHOD USED FOR UPDATE LOAD OR DELETE
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['upd'])){
            $id = $_GET['upd'];
            $library = LibraryMapper::getOne($id);
        }
        else if(isset($_GET['del'])){
            $id = $_GET['del'];
            $result = LibraryMapper::delete($id);
            if(is_bool($result) && $result == true){
                Page::success('Library deleted!');
            }
            else{
                Page::error($result);
            }
        }
    }

    $libraries  = LibraryMapper::getAll();
    LibraryPage::showTable($libraries);

    LibraryPage::showForm($library);

    Page::footer();
?>