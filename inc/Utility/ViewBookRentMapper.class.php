<?php

class ViewBookRentMapper {

    //Place to store the PDO Agent
    private static $db;

    static function initialize()   {
        self::$db = new PDOAgent('ViewBookRent');
    }

    static function getAll() : Array {
        
        $selectAll = "SELECT * FROM vw_book_rent";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getOne($id) : Library{
        $sqlSelect = "SELECT * FROM vw_book_rent WHERE BookId = :id";
        self::$db->query($sqlSelect);
        //bind
        self::$db->bind(":id", $id);
        self::$db->execute();
        return self::$db->singleResult();
    }
    
    static function getGroupByAvailable() : Array{
        $sqlSelect = 'select Available, COUNT(BookId) as qty from librarydb.vw_book_rent group by Available';
        self::$db->query($sqlSelect);
        self::$db->execute();
        return self::$db->resultSetArray();
    }

    
    static function getGroupByLibrary() : Array{
        $sqlSelect = 'select library, COUNT(BookId) as qty from librarydb.vw_book_rent group by library';
        self::$db->query($sqlSelect);
        self::$db->execute();
        return self::$db->resultSetArray();
    }

    static function getAllAsAssociativeArray() : Array {
        
        $selectAll = "SELECT * FROM vw_book_rent";

        self::$db->query($selectAll);
        self::$db->execute();
        $records = self::$db->resultSet();
        $associativeArray=array();
        foreach($records as $record){
            $associativeArray[$record->getBookId()]=$record->getTitle();
        }
        
        return $associativeArray;
    }

}

?>