<?php
    class Validation
    {
        public static function isCustomerValid(& $POST){
            if(strlen($POST['name']) == 0)
            {
                return "Required Field: Name";
            }
            if(strlen($POST['city']) == 0)
            {
                return "Required Field: City";
            }
            if(strlen($POST['address']) == 0)
            {
                return "Required Field: Address";
            }

            return true;
        }    
    }
    
?>