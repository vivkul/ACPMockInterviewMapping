<?php
  session_start();
  $user_id = $_SESSION["user_id"];
  $db_connection = new mysqli("localhost", "root", "passwd", "Mapping");
  if ($db_connection->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
?>