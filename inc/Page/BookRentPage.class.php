<?php
class BookRentPage
{
    public static function showTable($records)
    {

        echo '

        ';

        //Setup the table
        echo '
            <h2>Book Rentals</h2>
            <!-- Trigger the modal with a button -->
            <button style="margin-bottom:10px;" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square" aria-hidden="true"></i> Register Book Rent</button>
            <br/>';
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
            <td>' . date('m-d-Y', strtotime($rec['rent']->getRentStart())) . '</td>
            <td>' . ($rec['rent']->getRentEnd() == null ? "" : date('m-d-Y', strtotime($rec['rent']->getRentEnd()))) . '</td>
            <td width="120">';
            //if rent date is null then allows user to "Return book"
            if ($rec['rent']->getRentEnd() == null) {
                echo '<a href="?upd=' . $rec['rent']->getBookRentId() . '" onclick="if( confirm(\'Confirm Book return?\') == false ) return false;" class="badge badge-primary">Return</a> ';
            } else {
                echo '<a class="badge badge-secondary">Return</a> ';
            }
            //send the rent id to delete
            echo '<a href="?del=' . $rec['rent']->getBookRentId() . '" onclick="if( confirm(\'Confirm delete Book Rental?\') == false ) return false;" class="badge badge-danger">Delete</a>
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
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

          <form method="post">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title">Register Book Rent</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
              <div class="container">
                  <div class="form-group row">
                      <div class="col-12">
                          <label>Book:</label>
                          <select name="bookId" id="bookId" class="form-control selectpicker" data-live-search="true">';
                            //Populate select component with the id and Library name and Book Name
                            foreach ($items as $item) {
                                $select = "";
                                echo "            <option value='" . $item['bookId'] . "'>" . $item['library'] . " - " . $item['title'] . "</option>";
                            }
                            echo '
                           </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-12">
                          <label>User ID:</label>
                          <input type="text" class="form-control" name="userId" id="userId" placeholder="User ID..."/>
                      </div>
                  </div>
                  </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Add Rental</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                  </div>
            </form>

          </div>
        </div>
        ';
    }

}
