<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
require 'utils.php';
require 'router.php';



// function consulta(string $query, array $config) {
//     $conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname'], $config['port']);

//     if ($conn -> connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     // $rows = mysqli_fetch_all($conn->query($query));
//     // return $rows;
//     return $conn->query($query);
// }
?>
