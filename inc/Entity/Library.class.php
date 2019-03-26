<?php
class Library
{
    private $LibraryId;
    private $Name;
    private $Address;

    //gets
    public function getId(){return $this->LibraryId;}
    public function getLibraryId(){return $this->LibraryId;}
    public function getName(){return $this->Name;}
    public function getAddress(){return $this->Address;}

    //sets
    public function setLibraryId($LibraryId){$this->LibraryId = $LibraryId;}
    public function setName($Name){$this->Name = $Name;}
    public function setAddress($Address){$this->Address = $Address;}
}

?>