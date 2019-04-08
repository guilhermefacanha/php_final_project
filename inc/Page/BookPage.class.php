<?php
class BookPage
{
    public static function showTable($records, $allLibraries)
    {

        //  $BookId;
        //  $LibraryId;
        //  $Title;
        //  $Author;
        //  $Category;
        //  $Available;
    
        //Setup the table
        echo '<h2>Books</h2>';
        echo '<table id="tb_records" name="tb_records" class="display table table-striped table-hover"> <thead>';
        echo '<th>Library</th>';
        echo '<th>Title</th>';
        echo '<th>Author</th>';
        echo '<th>Category</th>';
        echo '<th>Available</th>';
        echo '<th>Controls</th>';
        echo '</thead> <tbody>';

        //Iterate
        foreach ($records as $rec) {
            $available = ($rec->getAvailable() == "0" ) ? "No" : "Yes";
            echo '<tr>
            <td>'; 
            //Show the name of the library instead of the ID
            //see if ID is present inside libraries array
            if(array_key_exists($rec->getLibraryId(), $allLibraries)){
                echo $allLibraries[$rec->getLibraryId()] ;
            }
            else{
                echo $rec->getLibraryId();
            } 
           echo '</td>
            <td>' . $rec->getTitle() . '</td>
            <td>' . $rec->getAuthor() . '</td>
            <td>' . $rec->getCategory() . '</td>
            <td>' . $available . '</td>                        
            <td width="120">
                <a href="?upd='.$rec->getBookId().'" class="badge badge-primary">Update</a>
                <a href="?del='.$rec->getBookId().'" onclick="if( confirm(\'Confirm delete Book '.$rec->getTitle().' ?\') == false ) return false;" class="badge badge-danger">Delete</a>
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

    public static function showForm(Book $entity, $libraries)
    {
        echo '
            <div class="container">
            <h3>'.($entity->getBookId() > 0 ? ('Edit Book - '.$entity->getBookId() ) : 'Add Book').'</h3>
            <form method="post">
                <input type="hidden" name="id" id="id" value="'.$entity->getBookId().'">
                <div class="form-group row">
                    <div class="col-6">
                        <label>Library:</label>
                        <select name="library">';
                        //Populate select component with the libraries id and Name
        foreach($libraries as $id => $library){                       
            $select="" ;
            //select the right library if it is in edit mode
            if($id==$entity->getLibraryId()){
                $select= "selected='selected'" ;
            }
            echo "            <option value=$id $select> $library</option>";
        }       
        echo '          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Title:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Book Title..." value="'.$entity->getTitle().'">
                    </div>
                </div>                
                <div class="form-group row">
                    <div class="col-6">
                        <label>Author:</label>
                        <input type="text" class="form-control" name="author" id="author" placeholder="Author name" value="'.$entity->getAuthor().'">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Category:</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Book category" value="'.$entity->getCategory().'">
                    </div>
                </div>
                
               
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">' . ($entity->getBookId() > 0 ? ('Update Book') : 'Add Book') . '</button>
                        '.($entity->getBookId() > 0 ? '<a class="btn btn-danger" href="?new">Cancel</a>' : '').'
                    </div>
                </div>
            </form>
        </div>';
    }
}

?>