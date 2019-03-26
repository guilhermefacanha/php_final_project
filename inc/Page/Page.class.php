<?php

//This Class is to construct our html page.

class Page
{

    public static $title = "Please set the title";

    //Constructor - Set the title when it is passed in __construct($newTitle)  {

    //This function displays the html header
    public static function header()
    {?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?php echo self::$title ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="jumbotron text-center">
        <h1>
            <?php echo self::$title ?>
        </h1>
        <p>Customer List from Database</p>
    </div>
    <div class="container">
        <?php

    }

    //This function displays the html footer
    public static function footer()
    {?>
    </div>
</body>
<footer>

</footer>

</html>
<?php

    }

    public static function success($msg)
    {
        ?>
<div class="alert alert-success" role="alert">
    <strong>Success! </strong>
    <?php echo $msg ?>
</div>
<?php

    }

    public static function error($msg)
    {
        ?>
<div class="alert alert-danger" role="alert">
    <strong>Error! </strong>
    <?php echo $msg ?>
</div>
<?php
}

    public static function showErrors($errors)
    {
        ?>
<div class="alert alert-danger" role="alert">
    <strong>Error! </strong>
    <?php
foreach ($errors as $msg) {
            echo "</br>" . $msg;
        }
        ?>
</div>
<?php

    }

    public static function showTable($records)
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

    public static function form($customer)
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