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


$sql = "SELECT o.vn, o.hn, o.vstdate, o.vsttime, CONCAT(p.pname,p.fname,' ',p.lname) AS ptname, CONCAT(age_y,'','ปี',' ',age_m,' ','เดือน',' ',age_d,' ','วัน') AS sage, CONCAT(p.addrpart,' ','ม.',' ',p.moopart,' ',t.full_name) AS addrpart ,aid,p.hometel, o.bps FROM opdscreen o
LEFT JOIN patient p on  p.hn = o.hn
LEFT OUTER JOIN vn_stat v ON o.vn=v.vn
LEFT OUTER JOIN thaiaddress t ON v.aid=t.addressid
WHERE o.bps > 159 and o.vstdate = '".$today_date ."' ORDER BY vn DESC " ;

$result = $conn->query($sql);


$sql2 = "INSERT INTO dmht VALUES ('$vn','$hn','$vstdate','$vsttime','$ptname','$age_y', '$age_m', '$age_d','$addrpart','$aid','$tell','$bps1')" ;
$result2 = $conn->query($sql2);

if ($sql2->num_rows > 0) {
    // output data of each row
    
     while($row = $sql2->fetch_assoc()) {
        
    }

}

else {
    echo "0 results";}



//mysqli_close($conn);
$conn->close();
?> 


</body>
</html>