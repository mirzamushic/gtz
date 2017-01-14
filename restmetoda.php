<?php
header('Content-type: text/javascript');
$query= $_GET['query'];
$json=array();
$baza= new PDO("mysql:dbname=gtz;host=localhost;charset=utf8", "admin", "password");
		$sql = 'SELECT ime,prezime,email FROM korisnici ORDER BY ime';
    foreach ($baza->query($sql) as $row) {
		$podatak1=$row['ime'];
		$podatak2= array($row['prezime']);
		$podatak3 = array($row['email']);

		if($query=='')
		{
			array_push($json,$podatak1,$podatak2,$podatak3);
		}
		elseif(strpos(strtolower($podatak1), strtolower($query))!==false)
		{
			array_push($json,$podatak1,$podatak2,$podatak3);
		}
	}
echo json_encode($json);
?>