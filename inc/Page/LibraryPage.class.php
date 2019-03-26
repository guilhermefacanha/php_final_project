<?php
class LibraryPage
{
    public static function showLibraryTable($records)
    {
        //Setup the table
        echo '<h2>Customers</h2>';
        echo '<table class="table table-striped table-hover"> <thead>';
        echo '<th>Name</th>';
        echo '<th>City</th>';
        echo '<th>Address</th>';
        echo '<th>Controls</th>';
        echo '</thead> <tbody>';

        //Iterate
        foreach ($records as $rec) {
            echo '<tr>
            <td>' . $rec->getName() . '</td>
            <td>' . $rec->getCity() . '</td>
            <td>' . $rec->getAddress() . '</td>
            <td>
                <a href="?upd='.$rec->getId().'" class="badge badge-primary">Update</a>
                <a href="?del='.$rec->getId().'" onclick="if( confirm(\'Confirm delete Customer '.$rec->getName().' ?\') == false ) return false;" class="badge badge-danger">Delete</a>
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

    public static function libraryForm($customer)
    {
        echo '
            <div class="container">
            <h3>'.($customer->getId() > 0 ? ('Edit Customer - '.$customer->getId() ) : 'Add Customer').'</h3>
            <form method="post">
                <input type="hidden" name="id" id="id" value="'.$customer->getId().'">
                <div class="form-group row">
                    <div class="col-6">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Customer Name..." value="'.$customer->getName().'">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>City:</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="Customer City..." value="'.$customer->getCity().'">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label>Address:</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Customer Address..." value="'.$customer->getAddress().'">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">' . ($customer->getId() > 0 ? ('Edit Customer') : 'Add Customer') . '</button>
                        '.($customer->getId() > 0 ? '<a class="btn btn-danger" href="?new">Cancel</a>' : '').'
                    </div>
                </div>
            </form>
        </div>';
    }
}

?>