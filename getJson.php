<?php 
ini_set("allow_url_fopen", 1);

try {
	$host="localhost";
	$dbname="vendingmachine";
	$user="root";
	$pass="";
    $conn = new PDO("mysql:host=".$host.";dbname=".$dbname."",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $file = file_get_contents("php://input");
	$json = json_decode($file,true);
	$vmcode=$json['vmCode'];
	$trxid=$json['trxId'];
	$gambar=$json['base64_img'];
	$nama_gambar=$trxid.".jpg";
	$filename_path="customer_photo/2019/".$vmcode."/".$nama_gambar;
	$decoded=base64_decode($gambar); 
	if (!is_dir('customer_photo/2019/'.$vmcode)) {
	    mkdir('customer_photo/2019/'.$vmcode, 0777, true);
	}
	file_put_contents($filename_path,$decoded);
	$sql= "INSERT INTO customer(vmcode,trxid,gambar) VALUES('".$vmcode."','".$trxid."','".$nama_gambar."')";
	$conn->exec($sql);

	$conn = null;

  
   
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }




?>