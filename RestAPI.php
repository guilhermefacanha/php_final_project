<?php

//Include the config file
require_once "inc/config.inc.php";

//Entities
require_once "inc/Entity/ViewBookRent.class.php";

//Utility Classes
require_once "inc/Utility/PDOAgent.class.php";
require_once "inc/Utility/ViewBookRentMapper.class.php";

ViewBookRentMapper::initialize();

parse_str(file_get_contents('php://input'), $requestData);

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":

        if (isset($requestData['gavail'])) {

            //Get Records Group By Available
            $record = ViewBookRentMapper::getGroupByAvailable();
            if ($record) {
                //Set content type
                header('Content-type: application/json');
                //return the json for all the records
                echo json_encode($record);
            }

        }
        elseif (isset($requestData['glib'])) {
             //Get Records Group By Library
             $record = ViewBookRentMapper::getGroupByLibrary();
             if ($record) {
                 //Set content type
                 header('Content-type: application/json');
                 //return the json for all the records
                 echo json_encode($record);
             }
        } 
        else {
            //Get all the records
            $records = ViewBookRentMapper::getAll();

            //Change them to type StdClass
            $jrecords = array();

            foreach ($records as $record) {
                $jrecords[] = $record->getVisisbleBook();
            }

            //Set content type
            header('Content-type: application/json');
            //return the json for all the records
            echo json_encode($jrecords);
        }

        break;

    case "POST":

        //Insert a book
        $nb = new Book();
        $nb->setISBN($requestData['isbn']);
        $nb->setTitle($requestData['title']);
        $nb->setAuthor($requestData['author']);
        $nb->setPrice($requestData['price']);

        //Insert the book
        $result = recordsMapper::createBook($nb);

        //set the header
        header('Content-Type: application/json');
        echo json_encode($result);

        break;

    case "PUT":

        //Update a book
        $nb = new Book();
        $nb->setISBN($requestData['isbn']);
        $nb->setTitle($requestData['title']);
        $nb->setAuthor($requestData['author']);
        $nb->setPrice($requestData['price']);

        $isbn = $requestData['edit'];
        //Insert the book
        $result = recordsMapper::updateBook($nb, $isbn);

        //set the header
        header('Content-Type: application/json');
        echo json_encode($result);

        break;

    case "DELETE":
        var_dump($requestData);
        $result = recordsMapper::deleteBook($requestData['isbn']);

        //set the header
        header('Content-Type: application/json');
        echo json_encode($result);

        break;

    default:

        echo json_encode(array("message" => "Voce fala HTTP?"));

        break;
}
