<?php
class BookRent
{

/*
+------------+------------+------+-----+---------+----------------+
| Field      | Type       | Null | Key | Default | Extra          |
+------------+------------+------+-----+---------+----------------+
| BookRentId | int(9)     | NO   | PRI | NULL    | auto_increment |
| BookId     | int(9)     | NO   | MUL | NULL    |                |
| UserId     | varchar(9) | NO   |     | NULL    |                |
| RentStart  | date       | NO   |     | NULL    |                |
| RentEnd    | date       | YES  |     | NULL    |                |
+------------+------------+------+-----+---------+----------------+
*/

    private $BookRentId;
    private $BookId;
    private $UserId;
    private $RentStart;
    private $RentEnd;

    //gets
    public function getBookRentId() : int {return $this->BookRentId;}
    public function getBookId() : int {return $this->BookId;}
    public function getUserId() {return $this->UserId;}
    public function getRentStart() {return $this->RentStart;}
    public function getRentEnd()  {return $this->RentEnd;}

    //sets
    public function setBookRentId(int $BookRentId){$this->BookRentId = $BookRentId;}
    public function setBookId(int $id){$this->BookId =$id;}
    public function setUserId($UserId){$this->UserId = $UserId;}
    public function setRentStart($RentStart){$this->RentStart = $RentStart;}
    public function setRentEnd($RentEnd){$this->RentEnd = $RentEnd;}
}

?>