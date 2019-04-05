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

class BookMapper {

    //Place to store the PDO Agent
    private static $db;

    static function initialize()   {
        
        self::$db = new PDOAgent('Book');

    }

    static function create(Book $book) : int   {
        $sqlInsert = "INSERT INTO book (BookId, LibraryId, Title, Author, Category, Available) 
                      VALUES (:BookId, :LibraryId, :Title, :Author, :Category, :Available)";

        self::$db->query($sqlInsert);

        self::$db->bind(':BookId', null);
        self::$db->bind(':LibraryId', $book->getLibraryId());
        self::$db->bind(':Title', $book->getTitle());
        self::$db->bind(':Author', $book->getAuthor());
        self::$db->bind(':Category', $book->getCategory());
        self::$db->bind(':Available', $book->getAvailable());

        self::$db->execute();

        return self::$db->lastInsertId();

    }

    static function update(Book $book){
        //query
        $query = "UPDATE book
                        SET BookId=:BookId, LibraryId=:LibraryId, Title=:Title, 
                            Author=:Author, Category=:Category, Available=:Available
                        WHERE BookId=:BookId;
                        ";
        self::$db->query($query);

        //bind
        self::$db->bind(":BookId", $book->getBookId());
        self::$db->bind(":LibraryId", $book->getLibraryId());
        self::$db->bind(":Title", $book->getTitle());
        self::$db->bind(":Author", $book->getAuthor());
        self::$db->bind(":Category", $book->getCategory());
        self::$db->bind(":Available", $book->getAvailable());        
        
        //execute
        self::$db->execute();
        
        //result
        return true;
    }

    static function getAll() : Array {
        
        $selectAll = "SELECT * FROM book";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getOne($BookId) : Book{
        $sqlSelect = "SELECT * FROM book WHERE BookId = :BookId";
        self::$db->query($sqlSelect);
        //bind
        self::$db->bind(":BookId", $BookId);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function delete(int $BookId) : bool {
        $deleteSQLQuery = "DELETE FROM book WHERE BookId = :BookId;";

        try {

            self::$db->query($deleteSQLQuery);
            self::$db->bind(':BookId', $BookId);
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting book with id $BookId");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            return false;
            
        }

        return true;

    }

}

?>