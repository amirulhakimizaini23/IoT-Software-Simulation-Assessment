<?php
	include "connection.php";
    
	// Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
 
    //Get current date and time
    date_default_timezone_set('Asia/Singapore'); 
	$seminggu = array("Minggu","Isnin","Selasa","Rabu","Khamis","Jumaat","Sabtu");
	$hari = date("w");
	$hari_ini = $seminggu[$hari];
    //$d = date("Y-m-d");
	$tarikh_sekarang = date("ymd");
    //echo " Date:".$d."<BR>";
    $jam_sekarang = date("H:i:s");
 
    if(!empty($_POST['status1'])  && !empty($_POST['status2']) && !empty($_POST['kawasan']))
    {
    	$status1 = $_POST['status1'];
		$status2 = $_POST['status2'];
    	$kawasan = $_POST['kawasan'];
 
	    $sql = "INSERT INTO logs (tarikh, hari, waktu, kawasan, suhu, kelembapan)
		
		VALUES ('".$tarikh_sekarang."',  '".$hari_ini."', '".$jam_sekarang."', '".$kawasan."', '".$status1."','".$status2."')";
 
		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
 
 
	$conn->close();
?>