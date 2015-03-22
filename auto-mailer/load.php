<?php

$config = parse_ini_file('config.ini.php', TRUE);
$table = $config["username"];

try
{
	$conn = new PDO("mysql:host=localhost;dbname=soze",'root','rajat');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql1 = $conn->prepare("SELECT * FROM ". $table ." WHERE email=:email"); 
	$sql2 = $conn->prepare("INSERT INTO ". $table ." (Author, Email, Paper, status) value (:prof, :email, :paper, :status)"); 
}
catch(Exception $e)
{
	print $e->getMessage();
}

$row = 0;
$total = 0;

if (($handle = fopen("data/".$table ."/scopus.csv", "r")) !== FALSE) 
{
    while (($data = fgetcsv($handle, ",")) !== FALSE) 
	{
		$total++;
		$data2['paper'] = $data[1];
		$data2['prof'] = $data[0];
		
		$temp2 = $data[2];
		if(isset($temp2))
		{
		try
		{
			$data2['email'] = $temp2;
			$is_Indian = explode('.', $data2['email']);
			if($is_Indian[count($is_Indian)-1] == 'india')
			{
				throw new Exception($data2['email'] . ' is as Indian Professor\n');
			}
			
			$data2['status'] = 0;
			
				$data1['email'] = $data2['email'];
				$result = $sql1->execute($data1);
				if(($sql1->rowCount() == 0)&&$data[1]!=""&&$data[0]!="")
				{
					$sql2->execute($data2);
					//var_dump($data2);
					$row++;
				}
				else
				{
					print "\n" . $data1['email'] . 'already present';
				}
			}
			catch(Exception $e)
			{
				print $e->getMessage() . "\n" . $data2['email'] . " was not inserted";
			}
			
		}
    }
    fclose($handle);
	
	echo "\n". $row . " / " . $total . " entries successfully processed";
}

?>
