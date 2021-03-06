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
        echo '<h2>Books</h2>
            <!-- Trigger the modal with a button -->
            <button style="margin-bottom:10px;" id="btnModal" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus-square" aria-hidden="true"></i> New Book
            </button>
            <br/>
        ';
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
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

          <form method="post">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">'.($entity->getBookId() > 0 ? ('Edit Book - '.$entity->getBookId() ) : 'Add Book').'</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="container">
                <input type="hidden" name="id" id="id" value="'.$entity->getBookId().'">
                <div class="form-group row">
                    <div class="col-12">
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
                        echo '          
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label>Title:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Book Title..." value="'.$entity->getTitle().'">
                    </div>
                </div>                
                <div class="form-group row">
                    <div class="col-12">
                        <label>Author:</label>
                        <input type="text" class="form-control" name="author" id="author" placeholder="Author name" value="'.$entity->getAuthor().'">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label>Category:</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Book category" value="'.$entity->getCategory().'">
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">' . ($entity->getBookId() > 0 ? ('Update Book') : 'Add Book') . '</button>
                    '.($entity->getBookId() > 0 ? '<a class="btn btn-danger" href="?new">Cancel</a>' : '').'
                  </div>
              </div>

            </form>

          </div>
        </div>
        ';
    }

    public static function openModal(){
        ?>
        <script>
            document.getElementById("btnModal").click();
        </script>
        <?php
    }
}

?>