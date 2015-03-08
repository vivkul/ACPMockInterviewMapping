<?php
  include 'startSession.php';

  $name = $_POST['name'];
  $rollno = $_POST['rollno'];
  $username = $_POST['username'];
  $phoneno = $_POST['phoneno'];
  $ITP1 = $_POST['studentPref1'];
  $ITP2 = $_POST['studentPref2'];
  $ITP3 = $_POST['studentPref3'];
  $SP1 = $_POST['studentSlotPref1'];
  $SP2 = $_POST['studentSlotPref2'];
  $department = $_POST['department'];
  $degree = $_POST['degree'];

  $sql="SELECT * 
        FROM StudentsAdded 
        WHERE username='".$username."';";

  $res=$db_connection->query($sql);
  if(!mysqli_num_rows($res)){      //To avoid same student getting more than one interview
    $sql="INSERT INTO Students (username, rollno, name, phoneno, ITP1, ITP2, ITP3, SP1, SP2, degree, department) 
                        VALUES('".$username."', ".$rollno.", '".$name."', '".$phoneno."', ".$ITP1.", ".$ITP2.", ".$ITP3.", ".$SP1.", ".$SP2.", '".$degree."', '".$department."') 
      ON DUPLICATE KEY UPDATE    
      username='".$username."', rollno=".$rollno.", name='".$name."', phoneno='".$phoneno."', ITP1=".$ITP1.", ITP2=".$ITP2.", ITP3=".$ITP3.", SP1=".$SP1.", SP2=".$SP2.", degree='".$degree."', department='".$department."';";
    $db_connection->query($sql);
  }
  else{
      echo "You aren't allowed to appear again as you were given slots reviously";
  }
?>