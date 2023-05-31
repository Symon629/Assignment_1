<?php
$db['db_host'] = "awseb-e-hnxnyk4sgd-stack-awsebrdsdatabase-lwpjzhdmosya.cr2tau4ucenq.us-east-1.rds.amazonaws.com";
$db['db_user'] = "uts";
$db['db_pass'] = "test1uts1234";
$db['db_name'] = "uts_assignment1";

foreach($db as $key => $value){
    define(strtoupper($key),$value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}

?>


