<?php
    
    //config file
    require_once("inc/config.inc.php");

    //page html related files
    require_once("inc/Page/Page.class.php");
    require_once("inc/Page/BookPage.class.php");
    require_once("inc/Page/Validation.class.php");
    
    //entity file
    require_once("inc/Entity/Book.class.php");
    require_once("inc/Entity/Library.class.php");
    
    //util file
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/BookMapper.class.php");
    require_once("inc/Utility/LibraryMapper.class.php");

    Page::$title = 'Books';
    Page::$subtitle = 'List of Books';
    Page::header();


    //Get ID, Name of all libraries to user choose from
    LibraryMapper::initialize();
    $allLibraries = LibraryMapper::getAllAsAssociativeArray(); 

    BookMapper::initialize();
    $book = new Book();

    //POST METHOD USED TO PERSIST INSERT OR UPDATE
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $book->setBookId($_POST['id']);        
        $book->setLibraryId($_POST['library']);        
        $book->setTitle($_POST['title']);
        $book->setAuthor($_POST['author']);
        $book->setCategory($_POST['category']);            
        $errors = Validation::isBookValid($_POST, $allLibraries);
        if(count($errors)==0){//When 0, validation is ok
            if($book->getBookId()>0){
                BookMapper::update($book);
                Page::success('Book updated!');
            }
            else{
                $newBookId = BookMapper::create($book);
                Page::success('New Book added with id '.$newBookId);
            }
            $book = new Book();
        }
        else{
            Page::showErrors($errors);
        }
    }

    //GET METHOD USED FOR UPDATE LOAD OR DELETE
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['upd'])){
            $id = $_GET['upd'];
            $book = BookMapper::getOne($id);
        }
        else if(isset($_GET['del'])){
            $id = $_GET['del'];
            $result = BookMapper::delete($id);
            if(is_bool($result) && $result == true){
                Page::success('Book deleted!');
            }
            else{
                Page::error($result);
            }
        }
    }

    $books  = BookMapper::getAll();
    BookPage::showTable($books, $allLibraries);

    BookPage::showForm($book, $allLibraries);

    Page::footer();
?>