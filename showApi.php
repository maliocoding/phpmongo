<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database file
include_once 'conn.php';

$dbname = 'vending';
$collection = 'customers';


//DB connection
$db = new DbManager();
$conn = $db->getConnection();


/*
Notice in this file we have filter[] and option[] array which are used to restrict the query to select the records based on filter and option values.

We use here executeQuery() method to read the data from MongoDB.

We display the as json format and as query returns multiple rows, so we are using here iterator_to_array() method to iterate the json array.
*/
// read all records
$filter = [];
$option = [];
$read = new MongoDB\Driver\Query($filter, $option);

//fetch records
$records = $conn->executeQuery("$dbname.$collection", $read);

echo json_encode(iterator_to_array($records));

?>