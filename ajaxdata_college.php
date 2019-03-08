<?php 
include_once './inc/services/db_config.php';
$db=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
$q="SELECT MONTHNAME(DATE(booked_date)) as 'MONTHNAME',count(student_id) as 'cnt' from book_details GROUP BY MONTHNAME";
 $res=mysqli_query($db,$q);
$data = array();
while ( $rww=mysqli_fetch_assoc($res)) {
  $data[] = $rww;
}
 echo json_encode($data);
 ?>