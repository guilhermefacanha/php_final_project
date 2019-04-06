<?php

class BookRentMapper {

/*
+------------+------------+------+-----+---------+----------------+
| Field      | Type       | Null | Key | Default | Extra          |
+------------+------------+------+-----+---------+----------------+
| BookRentId | int(9)     | NO   | PRI | NULL    | auto_increment |
| BookId     | int(9)     | NO   | MUL | NULL    |                |
| UserId     | varchar(9) | NO   |     | NULL    |                |
| RentStart  | date       | NO   |     | NULL    |                |
| RentEnd    | date       | NO   |     | NULL    |                |
+------------+------------+------+-----+---------+----------------+
*/
    //Place to store the PDO Agent
    private static $db;

    static function initialize()   {        
        self::$db = new PDOAgent('BookRent');
    }

    static function create(BookRent $bookRent) : int   {
        $sqlInsert = "INSERT INTO book_rent (BookId, UserId, RentStart) VALUES (:BookId, :UserId, :RentStart)";

        self::$db->query($sqlInsert);

        self::$db->bind(':BookId', $bookRent->getBookId());
        self::$db->bind(':UserId', $bookRent->getUserId());
        self::$db->bind(':RentStart', $bookRent->getRentStart());

        self::$db->execute();
        $id = self::$db->lastInsertId();

        //change the availability of book
        BookMapper::changeAvailability(self::getOne($id)->getBookId(), 0);
        
        return $id;
    }

    static function update(BookRent $bookRent){
        //query
        $query = "UPDATE book_rent
                        SET RentEnd=:RentEnd
                        WHERE BookRentId=:id;
                        ";
        self::$db->query($query);

        //bind
        self::$db->bind(":RentEnd", $bookRent->getRentEnd());        
        self::$db->bind(":id", $bookRent->getBookRentId());
        
        //execute
        self::$db->execute();

        //change the availability of book
        BookMapper::changeAvailability(self::getOne($bookRent->getBookRentId())->getBookId(), 1);

        //result
        return true;
    }

    static function getAll() : Array {
        
        $selectAll = "SELECT * FROM book_rent";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getOne(int $id) : BookRent{
        $sqlSelect = "SELECT * FROM book_rent WHERE BookRentId = :id";
        self::$db->query($sqlSelect);
        //bind
        self::$db->bind(":id", $id);
        self::$db->execute();       

        return self::$db->singleResult();
    }

    static function delete(int $id) : bool {
        $deleteSQLQuery = "DELETE FROM book_rent WHERE BookRentId = :id;";

        try {
            //change availability of the book
            BookMapper::changeAvailability(self::getOne($id)->getBookId(), 1);
            
            self::$db->query($deleteSQLQuery);
            self::$db->bind(':id', $id);
            self::$db->execute();
            
            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting book rent with id $id");
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