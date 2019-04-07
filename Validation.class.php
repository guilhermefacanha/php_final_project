<?php
    class Validation
    {
        public static function isLibraryValid(& $POST){
            if(strlen($POST['name']) == 0)
            {
                return "Required Field: Name";
            }
            if(strlen($POST['address']) == 0)
            {
                return "Required Field: Address";
            }

            return true;
        }
        
        public static function isRentValid(& $POST){
            $errors=array();

            if(strlen($POST['userId']) != 9){
                $errors[] = "User ID must be 9 digits";
            }
            if(!is_numeric($POST['bookId']) && $POST['bookId'] < 0){
                $errors[] = "The book select doen't exist in our database! ID" . $POST['bookId'];
            }

            return $errors;
        }

        public static function isBookValid(& $POST, $libraries){
            $errors=array();
            $quantityAvailable = $POST['available'];
            if(strlen($POST['library']) == 0)
            {
                $errors[]= "Required Field: Library";
            }
            if(!array_key_exists($POST['library'],$libraries))
            {
                $errors[]="This library doesn't exist in our database! ID:".$POST['library'];
            }
            if(strlen($POST['title']) == 0)
            {
                $errors[]="Required Field: Title";
            }
            if(strlen($POST['author']) == 0)
            {
                $errors[]="Required Field: Author";
            }
            if(strlen($POST['category']) == 0)
            {
                $errors[]="Required Field: Category";
            }
            if(strlen($quantityAvailable) == 0)
            {
                $errors[]="Required Field: Quantity Available";
            }elseif (filter_var($quantityAvailable, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0))) === false)
            {
                $errors[]="Quantity Available: requires an integer number equal or greater than 0!";
            }
            
            return $errors;
        }
    }    
    
?>