<?php
    
    //config file
    require_once("inc/config.inc.php");
    require_once("inc/Page/Page.class.php");
    require_once("inc/Page/BookRentPage.class.php");
    require_once("inc/Page/Validation.class.php");
    
    //entity file
    require_once("inc/Entity/Book.class.php");
    require_once("inc/Entity/Library.class.php");
    require_once("inc/Entity/BookRent.class.php");
    
    //util file
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/BookMapper.class.php");
    require_once("inc/Utility/LibraryMapper.class.php");
    require_once("inc/Utility/BookRentMapper.class.php");

    Page::$title = 'Book Rentals';
    Page::$subtitle = 'List of Book Rentals';
    Page::header();


    //initialize classes mappers used in the page
    LibraryMapper::initialize();
    BookMapper::initialize();    
    BookRentMapper::initialize();
    $bookRent = new BookRent();


    //POST METHOD USED TO PERSIST INSERT
    if ($_SERVER["REQUEST_METHOD"] == "POST") {               
        $bookRent->setBookId($_POST['bookId']);        
        $bookRent->setUserId($_POST['userId']);
        $bookRent->setRentStart(date('Y-m-d', time())); 
        
        //check if the post data are in the correct format
        $errors = Validation::isRentValid($_POST);
        
        //if there's no erro create the new rental
        if(count($errors)==0){
            $newRentId = BookRentMapper::create($bookRent);           
            Page::success('Book rental with id '.$newRentId);    
        }else{
            Page::showErrors($errors);
        }   
    }

    //GET METHOD USED FOR UPDATE RENTAL (RETURN) OR DELETE
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['upd'])){
            $id = $_GET['upd'];
            $bookRent = new BookRent();
            $bookRent->setBookRentId($id);
            //parse the time now to the correct format
            $bookRent->setRentEnd(date('Y-m-d', time()));
            //update the rental
            $result = BookRentMapper::update($bookRent);
            
            //check if updated without problem
            if(is_bool($result) && $result == true){                
                Page::success('Book returned!');
            }else{
                Page::error($result);
            }

        }
        else if(isset($_GET['del'])){
            $id = $_GET['del'];
            //remove rental from database
            $result = BookRentMapper::delete($id);
            if(is_bool($result) && $result == true){                
                Page::success('Rental deleted!');
            }
            else{
                Page::error($result);
            }
        }
    }

    //array to be send to BookRentPage
    $records = array();
    $booksRent  = BookRentMapper::getAll();

    foreach($booksRent as $rent){
        //get the book and library attributes
        $book =  BookMapper::getOne($rent->getBookId());
        $library = LibraryMapper::getOne(($book->getLibraryId()));
        //add the rent, book and library to an array
        $r = array('rent' => $rent, 'book' => $book->getTitle(), 'library' => $library->getName());
        $records[] = $r;
    }
    //call the function to load all rentals 
    BookRentPage::showTable($records);
    

    //array to populate the select tag on BookRentPage
    $libbooks = array();
    //select all books
    foreach(BookMapper::getAll() as $book){
        //add the book to the array if it is available
        if($book->getAvailable() != "0"){
            $lb = array('bookId'=>$book->getBookId(), 
            'library'=>LibraryMapper::getOne($book->getLibraryId())->getName(),
            'title'=>$book->getTitle());
            $libbooks[] = $lb;
        }        
    }
    //show form to create a new rental
    BookRentPage::showForm($libbooks);
    Page::footer();
?>