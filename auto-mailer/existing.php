<?php

$config = parse_ini_file('config.ini.php', TRUE);

//$temp = "ra@ilsb.tuwien.ac.at,sakaguch@ohsu.edu,hzhou38@asu.edu,xavier.aubard@herakles.com,jon.molina@imdea.org,j.mckelvie@strath.ac.uk,MYClam@ntu.edu.sg,pettermann@ilsb.tuwien.ac.at,ra@ilsb.tuwien.ac.at,moulinec@lma.cnrs-mrs.fr,biwa@kuaero.kyoto-u.ac.jp,quyegao@gmail.com,herak@virginia.edu,hjb@ilsb.tuwien.ac.at,felix.fritzen@kit.edu,aymerich@iris.unica.it,dhodges@gatech.edu,ramakrishna.r.valisetty.civ@mail.mil,mhmiguel@ing.uc3m.es,elebordi@nus.edu.sg,william.parnell@manchester.ac.uk,Marc.Hellmuth@bioinf.uni-sb.de,mdsilva@fc.up.pt,M.I.Okereke@greenwich.ac.uk,voltita@sc.usp.br,itirtom@gmail.com,john.carroll@dcu.ie,giulio.scocchi@icimsi.ch,zhengqs@tsinghua.edu.cn,bvkreddy680@gmail.com,brian.falzon@monash.edu,b.falzon@qub.ac.uk,ver.Barbero@mail.wvu.edu,grus@ugr.es,Stepan.Lomov@mtm.kuleuven.be,ronald.krueger-1@nasa.gov,Abbas.Milani@ubc.ca,pappu.l.murthy@nasa.gov,gspringer@stanford.edu,adrian.orifici@rmit.edu.au,prd@cumtb.edu.cn,LYou@bournemouth.ac.uk,Manfred.Kaltenbacher@uni-klu.ac.at,bahendr@sandia.gov,zhang@bauwesen.uni-siegen.de,qqa747z9k@carrot.ocn.ne.jp,jeff.weiss@utah.edu,mfcabral@gmail.com,wire@tu-braunschweig.de,David.Nicholson@ucf.edu,pa.kelly@auckland.ac.nz,mg0c@andrew.cmu.edu,siegfried.schmauder@imwf.uni-stuttgart.de,abronson@utep.edu,krishna@umich.edu,sigmund@mek.dtu.dk,a.simone@tudelft.nl,matthias.heil@manchester.ac.uk,DENG@cec.sc.edu,rohan@kme.zcu.cz,mkt4@case.edu,hr.ornskoldsvik@baesystems.se,fiala@itam.cas.cz,David.Mollenhauer@wpafb.af.mil,jotapina@gmail.com";
$handle = fopen("list.csv", "r");

try
{
	$conn = new PDO("mysql:host=localhost;dbname=soze",'root','');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql1 = $conn->prepare("SELECT * FROM " . $config['username'] ." WHERE email=:email"); 
	$sql2 = $conn->prepare("INSERT INTO " . $config['username'] ." (prof, email, paper, status) value (:prof, :email, :paper, :status)"); 
	
	$count = 0;
	while (($data = fgetcsv($handle, ",")) !== FALSE) 
	{
		$email = $data[0];
		
		$data1 = array('email' => $email);
		$sql1->execute($data1);
		if($sql1->rowCount() == 0)
		{
			$count++;
			$data2 = array('prof' => 'Already mailed', 'paper'=>'none', 'status'=>1, 'email'=>$email);
			$sql2->execute($data2);
		}
	}
}
catch(Exception $e)
{
	print $e->getMessage();
}

print $count . " entries added";

fclose($handle);

?>
