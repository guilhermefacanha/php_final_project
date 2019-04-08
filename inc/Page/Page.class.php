<?php

//This Class is to construct our html page.

class Page
{

    public static $title = "Please set the title";
    public static $subtitle = "Please set the subtitle";

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
            
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
            <link rel="stylesheet" href="css/style.css">

            
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://rawgit.com/RobinHerbots/Inputmask/4.x/dist/jquery.inputmask.bundle.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

        </head>

        <body>
            <div class="jumbotron text-center">
                <h1>
                    <?php echo self::$title ?>
                </h1>
                <p><?php echo self::$subtitle ?></p>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Library System :: </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="library.php">Libraries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="book.php">Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bookRent.php">Book Rent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stats.php">Statistics</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container">
        <?php

    }

    //This function displays the html footer
    public static function footer()
    {?>
        </div>
        </body>
        <br/>
        <br/>
        <br/>
        <br/>
        <footer>
            <ul>
                <li>Guilherme Lima Facanha # 300294067</li>
                <li>David Silva de Araujo # 300291953</li>
                <li>Gessica Matos # 300284935</li>
            </ul>
        </footer>

        </html>
        <?php

    }

    public static function success($msg)
    {
    ?>
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success: </strong><?php echo $msg ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
	    </div>
    <?php
    }

    public static function error($msg)
    {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error: </strong><?php echo $msg ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
	    </div>
    <?php
    }

    public static function showErrors($errors)
    {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong>
        <?php
            foreach ($errors as $msg) {
                echo "</br>" . $msg;                
            }            
        ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
    }
}

?>