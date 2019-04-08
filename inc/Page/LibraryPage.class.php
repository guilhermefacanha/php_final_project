<?php
class LibraryPage
{
    public static function showTable($records)
    {
        //Setup the table
        echo '<h2>Libraries</h2>
        <!-- Trigger the modal with a button -->
            <button style="margin-bottom:10px;" id="btnModal" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square" aria-hidden="true"></i> New Library</button>
            <br/>';
        echo '<table id="tb_records" name="tb_records" class="display table table-striped table-hover"> <thead>';
        echo '<th>Name</th>';
        echo '<th>Address</th>';
        echo '<th>Controls</th>';
        echo '</thead> <tbody>';

        //Iterate
        foreach ($records as $rec) {
            echo '<tr>
            <td>' . $rec->getName() . '</td>
            <td>' . $rec->getAddress() . '</td>
            <td>
                <a href="?upd='.$rec->getId().'" class="badge badge-primary">Update</a>
                <a href="?del='.$rec->getId().'" onclick="if( confirm(\'Confirm delete Library '.$rec->getName().' ?\') == false ) return false;" class="badge badge-danger">Delete</a>
            </td>
            </tr>';
        }

        //close the table
        echo '</tbody>';
        //Display the total count of list -->
        echo '<tfoot>
        <tr class="alert-info">
            <td colspan="10" style="font-weight:bold;">Total Count: ' . count($records) . '</td>
        </tr>
      </tfoot>';
        echo '</table> <hr style="border-top:1px solid darkgray !important">';
        echo 
            '<script type="text/javascript">
                $(document).ready(function(){
                    $(\'#tb_records\').DataTable({
                        responsive : true,
                        paging : true,
                        "pagingType" : "full_numbers"
                    });
                });
            </script>';
    }

    public static function showForm(Library $entity)
    {
        echo '
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

          <form method="post">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title">'.($entity->getId() > 0 ? ('Edit Library - '.$entity->getId() ) : 'Add Library').'</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <input type="hidden" name="id" id="id" value="'.$entity->getId().'">
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Library Name..." value="'.$entity->getName().'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Address:</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Library Address..." value="'.$entity->getAddress().'">
                        </div>
                    </div>
                </div>
              </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">' . ($entity->getId() > 0 ? ('Update Library') : 'Add Library') . '</button>
                            '.($entity->getId() > 0 ? '<a class="btn btn-danger" href="?new">Cancel</a>' : '').'
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