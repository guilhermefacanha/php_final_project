<?php
class LibraryPage
{
    public static function showLibraryTable($records)
    {
        //Setup the table
        echo '<h2>Libraries</h2>';
        echo '<table class="table table-striped table-hover"> <thead>';
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
    }

    public static function libraryForm(Library $entity)
    {
        echo '
            <div class="container">
            <h3>'.($entity->getId() > 0 ? ('Edit Library - '.$entity->getId() ) : 'Add Library').'</h3>
            <form method="post">
                <input type="hidden" name="id" id="id" value="'.$entity->getId().'">
                <div class="form-group row">
                    <div class="col-6">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Library Name..." value="'.$entity->getName().'">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Address:</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Library Address..." value="'.$entity->getAddress().'">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">' . ($entity->getId() > 0 ? ('Edit Library') : 'Add Library') . '</button>
                        '.($entity->getId() > 0 ? '<a class="btn btn-danger" href="?new">Cancel</a>' : '').'
                    </div>
                </div>
            </form>
        </div>';
    }
}

?>