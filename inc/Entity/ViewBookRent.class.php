<?php 
class ViewBookRent
{
    private $LibraryId;
    private $library;
    private $BookId;
    private $Title;
    private $Author;
    private $Category;
    private $Available;
    private $RentedBy;
    private $RentStart;
    private $RentEnd;

    //function to return visible attributes in an object
    function getVisisbleBook()  {
        $obj = new StdClass;
        
        $obj->LibraryId = $this->getLibraryId();
        $obj->library = $this->getLibrary();
        $obj->BookId = $this->getBookId();
        $obj->Title = $this->getTitle();
        $obj->Author = $this->getAuthor();
        $obj->Category = $this->getCategory();
        $obj->Available = $this->getAvailable();
        $obj->RentedBy = $this->getRentedBy();
        $obj->RentStart = $this->getRentStart();
        $obj->RentEnd = $this->getRentEnd();

        return $obj;

    }

    public function getLibraryId(){return $this->LibraryId;}
    public function getLibrary(){return $this->library;}
    public function getBookId(){return $this->BookId;}
    public function getTitle(){return $this->Title;}
    public function getAuthor(){return $this->Author;}
    public function getCategory(){return $this->Category;}
    public function getAvailable(){return $this->Available;}
    public function getRentedBy(){return $this->RentedBy;}
    public function getRentStart(){return $this->RentStart;}
    public function getRentEnd(){return $this->RentEnd;}

    public function setLibraryId($LibraryId){$this->LibraryId = $LibraryId;}
    public function setLibrary($library){$this->library = $library;}
    public function setBookId($BookId){$this->BookId = $BookId;}
    public function setTitle($Title){$this->Title = $Title;}
    public function setAuthor($Author){$this->Author = $Author;}
    public function setCategory($Category){$this->Category = $Category;}
    public function setAvailable($Available){$this->Available = $Available;}
    public function setRentedBy($RentedBy){$this->RentedBy = $RentedBy;}
    public function setRentStart($RentStart){$this->RentStart = $RentStart;}
    public function setRentEnd($RentEnd){$this->RentEnd = $RentEnd;}

}


?>