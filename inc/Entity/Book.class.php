<?php
// mysql> DESC book;
// +-----------+--------------+------+-----+---------+----------------+
// | Field     | Type         | Null | Key | Default | Extra          |
// +-----------+--------------+------+-----+---------+----------------+
// | BookId    | int(9)       | NO   | PRI | NULL    | auto_increment |
// | LibraryId | int(9)       | NO   | MUL | NULL    |                |
// | Title     | varchar(100) | NO   |     | NULL    |                |
// | Author    | varchar(100) | NO   |     | NULL    |                |
// | Category  | varchar(100) | NO   |     | NULL    |                |
// | Available | tinyint(1)   | YES  |     | 0       |                |
// +-----------+--------------+------+-----+---------+----------------+
class Book
{
    private $BookId; // table identificator
    private $LibraryId; //id for the library that contains the book (FK)
    private $Title; //title of the book
    private $Author; //author of the book
    private $Category; //category of the book
    private $Available = 1; //a new book is set is available by default    

    public function __construct($bookId = null){
        if($bookId != null)
            $this->$BookId = $bookId;
    }
    
    //gets
    public function getBookId(){return $this->BookId;}
    public function getLibraryId(){return $this->LibraryId;}
    public function getTitle(){return $this->Title;}
    public function getAuthor(){return $this->Author;}
    public function getCategory(){return $this->Category;}
    public function getAvailable(){return $this->Available;}

    //sets
    public function setBookId($BookId){$this->BookId = $BookId;}
    public function setLibraryId($LibraryId){$this->LibraryId = $LibraryId;}
    public function setTitle($Title){$this->Title = $Title;}
    public function setAuthor($Author){$this->Author = $Author;}
    public function setCategory($Category){$this->Category = $Category;}
    public function setAvailable($Available){$this->Available = $Available;}

    
}

?>