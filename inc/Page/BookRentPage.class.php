<?php
class BookRentPage
{
    public static function showTable($records)
    {
    
        //Setup the table
        echo '<h2>Book Rentals</h2>';
        echo '<table id="tb_records" name="tb_records" class="display table table-striped table-hover"> <thead>';
        echo '<th>Library</th>';
        echo '<th>Book</th>';
        echo '<th>User</th>';
        echo '<th>Start Date</th>';
        echo '<th>End Date</th>';
        echo '<th>Controls</th>';
        echo '</thead> <tbody>';

        //Iterate through the array of objects
        foreach ($records as $rec) {                        
            echo '<tr>
            <td>'; 
            echo $rec['library'];
            echo '</td>
            <td>' . $rec['book'] . '</td>
            <td>' . $rec['rent']->getUserId() . '</td>
            <td>' . date('m-d-Y', strtotime($rec['rent']->getRentStart()) ). '</td>
            <td>' . ($rec['rent']->getRentEnd() == null ? "" : date('m-d-Y', strtotime( $rec['rent']->getRentEnd()) )) . '</td>                                    
            <td width="120">';
            //if rent date is null then allows user to "Return book"
            if($rec['rent']->getRentEnd() == null){
                echo '<a href="?upd='.$rec['rent']->getBookRentId().'" onclick="if( confirm(\'Confirm Book return?\') == false ) return false;" class="badge badge-primary">Return</a> ';
            }else{
                echo '<a class="badge badge-secondary">Return</a> ';
            }
            //send the rent id to delete
            echo '<a href="?del='.$rec['rent']->getBookRentId().'" onclick="if( confirm(\'Confirm delete Book Rental?\') == false ) return false;" class="badge badge-danger">Delete</a>
            </td>
            </tr>';
        }

        //close the table
        echo '</tbody>';
        //Display the total count of list -->
        echo '<tfoot>
        <tr class="alert-info">
            <td colspan="6" style="font-weight:bold;">Total Count: ' . count($records) . '</td>
        </tr>
      </tfoot>';
        echo '</table> <hr style="border-top:1px solid darkgray !important">';
        echo 
            '<script type="text/javascript">
                $(document).ready(function(){
                    $(\'#tb_records\').DataTable();
                });
            </script>';
    }


    public static function showForm($items)
    {

        echo '
            <div class="container">
            <h3>Add Book Rental</h3>
            <form method="post">                
                <div class="form-group row">
                    <div class="col-6">
                        <label>Book:</label>
                        <select name="bookId">';
                        //Populate select component with the id and Library name and Book Name
                        foreach($items as $item){                       
                            $select="" ;                             
        echo "            <option value='".$item['bookId']."'>". $item['library']." - ". $item['title']."</option>";
        }       
        echo '          </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <label>User ID:</label>
                        <input type="text" class="form-control" name="userId" id="userId" placeholder="User ID..."/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Add Rental</button>                        
                    </div>
                </div>                                
            </form>
        </div>';
    }

    
}

?>