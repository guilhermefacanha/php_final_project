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

    static function getAllFilter($avail, $text) : Array {
        
        $selectAll = "SELECT * FROM vw_book_rent where 1=1 ";

        //append select with filter
        if($avail >= 0 ){

            $selectAll = $selectAll.' and Available = :avail';
        }
        if(strlen($text)>0){
            $text = strtolower($text);
            $selectAll = $selectAll.' 
            and (
                lower(library) like :t1
                or lower(Title) like :t2
                or lower(Author) like :t3
                or lower(Category) like :t4
                )
                ';
        }

        self::$db->query($selectAll);
        
        //bind parameters with filter
        if($avail==0){
            self::$db->bind(":avail", 'NOT AVAILABLE');
        }
        elseif($avail==1){
            self::$db->bind(":avail", 'AVAILABLE');
        }

        if(strlen($text)>0){
            self::$db->bind(":t1", '%'.$text.'%');
            self::$db->bind(":t2", '%'.$text.'%');
            self::$db->bind(":t3", '%'.$text.'%');
            self::$db->bind(":t4", '%'.$text.'%');
        }

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