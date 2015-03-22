<?php

// LOAD CONFIG
$config = parse_ini_file('config.ini.php', TRUE);



// INITIALIZE EMAILING DEFAULTS
$_FROM_NAME = $config["name"];
$_FROM_EMAIL = $config["username"]."@iitk.ac.in";
$_FROM_USERNAME =$config["username"] ;
$_FROM_PASSWORD =$config["password"];
$_BCC = $config["bcc"];



// EMAIL OBJECT AND ITS SETTINGS
require_once('phpmailer/class.phpmailer.php');
// START DATABASE CONNECTION
$table = $config["username"];
try
{
	$conn = new PDO("mysql:host=localhost;dbname=soze",'root','rajat');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql1 = $conn->prepare("SELECT * FROM ". $table ." WHERE status=:status");
	$sql2 = $conn->prepare("UPDATE " . $table . " SET status=1 WHERE email=:email");
}
catch(Exception $e)
{
	print $e->getMessage();
}


// CHECK FOR THE DATA WITH PENDING STATUS
$data1 = array('status' => 0);
$sql1 -> setFetchMode(PDO::FETCH_ASSOC);
$sql1->execute($data1);

$count = 0;

if($sql1->rowCount() >=1)
{
	foreach($sql1 as $result)
	{
		if($count < 2500) // no. of mails sent CHANGE ACCORDINGLY
		{
			require_once('phpmailer/class.phpmailer.php');
			$prof_ = $result['Author'];
			$email = $result['Email'];
			$paper = $result['Paper'];
			$arr = (explode(",",$prof_));
			$prof=$arr[0];	
			$data2 = array('email'=>$email);
			
			try
			{
				$sql2->execute($data2); //UPDATE THE STATUS OF THE DATA
				
				include('data/' . $config["username"] . '/letter.php');
				
				$_TO_EMAIL = $email;
				$_TO_NAME = $prof;
				$mail             = new PHPMailer();
				$body             = $letter;
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->Host       = "smtp.cc.iitk.ac.in"; // SMTP server
				$mail->SMTPAuth   = true;                // enable SMTP authentication
				$mail->Host       = "smtp.cc.iitk.ac.in"; // sets the SMTP server
				$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
				$mail->Username   = $_FROM_USERNAME; // SMTP account username
				$mail->Password   = $_FROM_PASSWORD;        // SMTP account password

				$mail->SetFrom($_FROM_EMAIL, $_FROM_NAME);
				$mail->AddReplyTo($_FROM_EMAIL, $_FROM_NAME);
				
				$mail->Subject= "Opportunity for a Summer Research Internship";
				$mail->Body = $body;
				$mail->AddAddress($_TO_EMAIL, $_TO_NAME);
				
				$mail->AddBCC($_BCC, $_FROM_NAME);   
				//$mail->AddAttachment('data/' . $config["username"] . '/' . $config['cv']);

				if(!$mail->Send())
				{
				  print $email . " ERROR in send()\n ";
				  //echo "\n";
				}
				else
				{
				  print $email . "\nyipee\n";
				//	echo "\n";
				  $count++;
				}
			}
			catch(Exception $e)
			{
				print $result['Email'] . " FAILED \n";
			}
		}
	}
}

print "<hr><h2>" . $count . " mails sent.</h2>";
?>
