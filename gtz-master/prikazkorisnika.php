<?php
$xml=simplexml_load_file("korisnici.xml") or die("Error: Cannot create object");

echo "<h2> Lista korisnika GTZ </h2>"."<br>";
foreach($xml->children() as $korisnik){
echo "<h3>"."Ime: ".$korisnik->ime ."</h3>" ."<br>";
echo "<h3>"."Prezime: ".$korisnik->prezime ."</h3>". "<br>";
echo "<h3>"."Email: ".$korisnik->email ."</h3>". "<br>";
echo "<br>";
echo "<br>";
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
h3 {
text-align: center;
}
h2{
margin-left:37%;
margin-right:35%;
}
</style>
<title>Prikaz korisnika GTZ</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/contact.css" type="text/css" />
</head>
<body>


</body>
</html>