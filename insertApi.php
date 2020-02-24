<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/* 
“Access-Control-Allow-Origin: *” – it indicates the request is accepted from any where

“Content-Type: application/json; charset=UTF-8” – it indicates that request is a json data

“Access-Control-Allow-Methods: POST” – it indicates that only POST request is allowed
*/


// include database file
include_once 'conn.php';

$dbname = 'vending';
$collection = 'customers';

//DB connection
$db = new DbManager();
$conn = $db->getConnection();

//record to add
$data = json_decode(file_get_contents("php://input", true));

// insert record
$insert = new MongoDB\Driver\BulkWrite();
$insert->insert($data);

$result = $conn->executeBulkWrite("$dbname.$collection", $insert);

// verify
if ($result->getInsertedCount() == 1) {
    echo json_encode(
		array("message" => "Record successfully created")
	);
} else {
    echo json_encode(
            array("message" => "Error while saving record")
    );
}

/*
API POST

{
"first_name":"bambang",
"last_name":"nurjaman",
"tags":[
		"writer",
		"user"
		]

}


*/
?>