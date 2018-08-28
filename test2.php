<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$servername = "192.168.0.50";
$username = "sa";
$password = "sa";
$dbname = "hos";
$id =0;

error_reporting(~E_NOTICE); //ปิด massage แจ้งเตือน Undefined index
error_reporting(error_reporting() & ~E_NOTICE);

date_default_timezone_set('Asia/Bangkok');

$line_api = 'https://notify-api.line.me/api/notify';
$access_token = '6FFdl5BJVisbs34eVAgyCwpw259i1P0hSu2MBDJepYf';


$today_date = date("Y-m-d");
$yy = explode("-",$today_date);
$year = $yy[0];
$dateTime = date("Y-m-d h:i:sa");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT o.vn, o.hn, o.vstdate, o.vsttime, p.pname, p.fname, p.lname, p.addrpart ,p.road,  p.moopart, p.tmbpart, p.amppart, p.chwpart, p.hometel, o.bps FROM opdscreen o
LEFT JOIN patient p on  p.hn = o.hn
WHERE o.bps > 159 and vstdate = '".$today_date ."' ORDER BY vn DESC  " ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    
     while($row = $result->fetch_assoc()) {
    	$id++;
    	echo "|ID: $id ";
        echo "| vn: ".$row["vn"]. 
        	 " |hn: ".$row["hn"].  
        	 " |Date: ".$row["vstdate"]. 
        	 " |Time: ".$row["vsttime"].
        	 " |Name: ".$row["pname"].$row["fname"]."  ".$row["lname"] . 
        	 " |Addrees: ".$row["addrpart"]."  ".$row["road"]."  ".$row["moopart"]."  ".$row["tmbpart"]."  ".$row["amppart"]."  ".$row["chwpart"] . 
        	 " |Tel: ". $row["hometel"]. 
			 " |bps: ". $row["bps"] . 

        	 "|<br>";
    }
} 

else {
    echo "0 results";}

$conn->close();
?> 


</body>
</html>