<?php

//This Class is to construct our html page.

class Page
{

    public static $title = "Please set the title";

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
}

?>