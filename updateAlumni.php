<?php
  include 'startSession.php';

  $name = $_POST['name'];
  $company = $_POST['company'];
  $emailid = $_POST['emailid'];
  $phoneno = $_POST['phoneno'];
  $ITP1 = $_POST['alumniPref1'];
  $ITP2 = $_POST['alumniPref2'];
  $SLOT = $_POST['alumniSlotPref1'];   //TODO its array
  $department = $_POST['department'];
  $degree = $_POST['degree'];
  $currentposition = $_POST['currentposition'];
  $YOP = $_POST['YOP'];

  $sql="INSERT INTO AlumniAdded (emailid, phoneno, name, degree, department, currentposition, company, YOP) 
                        VALUES('".$emailid."', '".$phoneno."', '".$name."', '".$degree."', '".$department."','".$currentposition."', '".$company."', ".$YOP.") 
    ON DUPLICATE KEY UPDATE    
    emailid='".$emailid."', phoneno='".$phoneno."', name='".$name."', degree='".$degree."', department='".$department."', currentposition='".$currentposition."', company='".$company."', YOP=".$YOP.";";
  $db_connection->query($sql);

  $sql="Select AAID FROM AlumniAdded where emailid='".$emailid."';";
  // echo $sql;
  $res=$db_connection->query($sql);

  if($row=mysqli_fetch_array($res)){
    $AAID=$row["AAID"];
    $N = count($SLOT);
    for($i=0; $i < $N; $i++)
    {
      $sql="INSERT INTO Alumni (AAID, ITP1, ITP2, SLOT) 
                        VALUES(".$AAID.", ".$ITP1.", ".$ITP2.", ".$SLOT[$i].")";
      $db_connection->query($sql);
    }
  }
?>