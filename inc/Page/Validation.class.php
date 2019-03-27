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
    }
    
?>