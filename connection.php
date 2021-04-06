<?php
$serverName = "МИЛЕНКОБИЋ-PC"; //ime servera


$connectionInfo = array( "Database"=>"WinFormsDB"); //ime baze podataka
$conn = sqlsrv_connect( $serverName, $connectionInfo);//konekcija sa serverom i bazom podataka

if( $conn ) {
     
}else{
     echo "Konekcija nije uspostavljena.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>