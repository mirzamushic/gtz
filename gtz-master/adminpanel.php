<?php
function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}


  function validEmail($email){
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }

    return true;
}

  if(isset($_POST['unesikorisnika']))
{
  $xml = new DomDocument("1.0", "UTF-8");
  $xml->load ('korisnici.xml');

  $ime = xss_clean($_POST['Ime']);
  $prezime =xss_clean($_POST['Prezime']);
  $email = xss_clean($_POST['Email']);

  $rootTag = $xml->getElementsByTagName("root")->item(0);

  $infoTag = $xml->createElement("info");
    $imeTag = $xml->createElement("ime",$ime);
    $prezimeTag = $xml->createElement("prezime",$prezime);
    $emailTag = $xml->createElement("email", $email);

  $infoTag->appendChild($imeTag);
  $infoTag->appendChild($prezimeTag);
  $infoTag->appendChild($emailTag);
  

  //validacija unesenih podataka
  $imeTacno = false;
  $prezimeTacno = false;
  $emailTacan = false;
 
  if (empty($ime) or !preg_match("/^[a-zA-Z'-]+$/",$ime))
  {
    $errors['ime1'] = "Ime nije nikako uneseno ili sadrži brojeve!";
  }
  else{
      $imeTacno = true;
      $infoTag->appendChild($imeTag);
  }
  if (empty($prezime) or !preg_match("/^[a-zA-Z'-]+$/",$prezime))
  {
    $errors['prezime1'] = "Prezime nije nikako uneseno ili sadrži brojeve!";
  }
  else{
      $prezimeTacno = true;
      $infoTag->appendChild($prezimeTag);
  }
  if (empty($email) or !validEmail($email))
  {
    $errors['email1'] = "Polje za unos emaila ne smije biti prazno ili ste unijeli nepravilan email!";
  }
  else{
      $emailTacan = true;
      $infoTag->appendChild($emailTag);
  }


  if($imeTacno == true and $prezimeTacno == true and $emailTacan == true){
  $rootTag->appendChild($infoTag);
  $xml->save('korisnici.xml');
}
}


  if(isset($_POST['brisikorisnika']))
{
  $xml = new DomDocument("1.0", "UTF-8");
  $xml->load ('korisnici.xml');

  $ime2 = $_POST["Ime2"];
  $prezime2 =$_POST['Prezime2'];

  $xpath = new DOMXPATH($xml);
  $korisnik = $xpath -> query("/root/info[ime = '$ime2'][prezime = '$prezime2']");
  $postoji = $xpath->evaluate("/root/info[ime = '$ime2'][prezime = '$prezime2']");
  if($postoji == false)
  {
  	    $errors['nepostojanjekorisnika'] = "Korisnik kojeg ste zeljeli izbrisati nije ni postojao kao registrovan korisnik.";

  }
  else{
  foreach(($xpath -> query("/root/info[ime = '$ime2'][prezime = '$prezime2']"))  as $node){
  			$node -> parentNode->removeChild($node);
  }
}

  
  $xml->formatoutput = true;
  $xml->save('korisnici.xml');

}



if(isset($_POST['promijenikorisnika']))
{
$xml = new DomDocument("1.0", "UTF-8");
$xml->load ('korisnici.xml');
$xpath = new DOMXPATH($xml);
$ime3 = $_POST["Novoime"];
$prezime3 = $_POST["Novoprezime"];
$email3 = $_POST["Noviemail"];
$staroime = $_POST["Ime3"];
$staroprezime = $_POST["Prezime3"];
$stariemail = $_POST["Email3"];
//$novoime3 = $_POST["Novoime"];
//$novoprezime3 = $_POST["Novoprezime"];
//$noviemail3 = $_POST["Noviemail"];
    $rootTag = $xml->getElementsByTagName("root")->item(0);
    $infoTag = $xml->createElement("info");
    $imeTag = $xml->createElement("ime",$ime3);
    $prezimeTag = $xml->createElement("prezime",$prezime3);
    $emailTag = $xml->createElement("email", $email3);

  $infoTag->appendChild($imeTag);
  $infoTag->appendChild($prezimeTag);
  $infoTag->appendChild($emailTag);

  $korisnik = $xpath -> query("/root/info[ime = '$staroime'][prezime = '$staroprezime']");
  
  foreach(($xpath -> query("/root/info[ime = '$staroime'][prezime = '$staroprezime']"))  as $node){
        $node -> parentNode->removeChild($node);
  }

  $rootTag->appendChild($infoTag);
  $xml->formatoutput = true;
  $xml->save('korisnici.xml');

}


if(isset($_POST['prikaziPodatke']))
{

$xml=simplexml_load_file("korisnici.xml") or die("Error: Cannot create object");
echo $xml->ime . "<br>";
echo $xml->prezime . "<br>";
echo $xml->email . "<br>";



}


if(isset($_POST["preuzmicsv"])){

/*$filexml='korisnici.xml';

    if (file_exists($filexml)) 
           {
       $xml = simplexml_load_file($filexml);
       $f = fopen('ispiskorisnika.csv', 'w');
       createCsv($xml, $f);
       fclose($f);
    }

    function createCsv($xml,$f)
    {

        foreach ($xml->children() as $item) 
        {

           $hasChild = (count($item->children()) > 0)?true:false;

        if( ! $hasChild)
        {
           $put_arr = array($item->getName(),$item); 
           fputcsv($f, $put_arr ,',','"');

        }
        else
        {
         createCsv($item, $f);
        }
     }*/
     $filexml='korisnici.xml';
if (file_exists($filexml))  {

   $xml = simplexml_load_file($filexml);
   $i = 1;           // Position counter
   $values = [];     // PHP array

   // Writing column headers
   $columns = array('ime', 'prezime', 'email');

   $fs = fopen('izvjestajkorisnici.csv', 'w');

   fputcsv($fs, $columns);      
   fclose($fs);

   // Iterate through each <item> node
   $node = $xml->xpath('//info');

   foreach ($node as $n) {           

       // Iterate through each child of <item> node
       $child = $xml->xpath('//info['.$i.']/*');      

       foreach ($child as $value) {
          $values[] = $value;         
       }

       // Write to CSV files (appending to column headers)
       $fs = fopen('izvjestajkorisnici.csv', 'a');
       fputcsv($fs, $values);      
       fclose($fs);  

       $values = [];    // Clean out array for next <item> (i.e., row)
       $i++;            // Move to next <item> (i.e., node position)
   }

    $file_url = 'izvjestajkorisnici.csv';
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
    readfile($file_url); // do the double-download-dance (dirty but worky)
    exit();
}
    
    }










?>








<!DOCTYPE html>
<html>
<head>
<title>Admin panel</title>
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/login.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/adminpanel.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/contact.css" type="text/css" />
</head>
<body>
	<h1 id="header1">Admin panel</h1>
<p align="center" style="color:red;">
<?php if(isset($errors['nepostojanjekorisnika']))echo $errors['nepostojanjekorisnika'];?></p>


	<p align="center" style="color:red;">
<?php if(isset($errors['ime1']))echo $errors['ime1'];?></p>

<p align="center" style="color:red;">
<?php if(isset($errors['prezime1']))echo $errors['prezime1'];?></p>

<p align="center" style="color:red;">
<?php if(isset($errors['email1']))echo $errors['email1'];?></p>
<div id="adminkontrole">
	<div id="adminbtns">
		<ul id="redbutton">
    <li class="newbutton"><a id="unosKorisnika" href="#">Unesi korisnika</a></li>
    <li class="newbutton"><a id="izmijeniPodatke" href="#">Izmijeni podatke</a></li>
    <li class="newbutton"><a id="prikaziPodatke"href="/prikazkorisnika.php">Prikaži podatke</a></li>
    <li class="newbutton"><a id="brisiPodatke"href="#">Brisanje podataka</a></li>
</ul>
	</div>
</div>
<form action="adminpanel.php" method="POST">
    <input type="submit" id="preuzmicsv" name="preuzmicsv" value="Preuzmi CSV" />
</form>

<!--  Modal Unos -->
<div id="modalUnos" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h4 id="modalh4">Unesite podatke o novom korisniku: </h4>
     <form action="adminpanel.php" method="POST" class="iform" id="first">
	<ul>
		<li>
		<label for="Ime">* Ime</label>
		<input class="itext" type="text" name="Ime" id="Ime" onchange="validacijaIme()"/>
		<img id="checkmark" onload="resizeImg(this, 20, 20);"></img>
		</li> 

		<li>
		  <label for="Prezime">* Prezime</label>
		  <input class="itext" type="text" name="Prezime" id="Prezime" onchange="validacijaPrezime()" />
		  <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
		</li>

		<li>
			<label for="Email">* Email</label><input class="itext" type="text" name="Email" id="Email" onchange="validacijaEmaila()" />
			<img id="checkmarkemail" onload="resizeImg(this, 20,20);"></img>
		</li>
  
		<li><label>&nbsp;</label><input type="submit" class="ibutton" name="unesikorisnika" id="unesiBtn" value="Unesi" /></li>
	</ul>
	</form>
  </div>

</div>




<!-- Modal Mijenjanje -->
<div id="modalPromjena" class="modal3">

  <!-- Modal content -->
  <div class="modal-content3">
    <span class="close3">&times;</span>
    <h4 id="modalh4">Unesite podatke o korisniku kojeg želite promijeniti: </h4>
     <form action="adminpanel.php" method="POST" class="iform" id="second">
	<ul>
		<li>
		<label for="Ime3">* Ime</label>
		<input class="itext" type="text" name="Ime3" id="Ime3" onchange="validacijaIme()"/>
		<img id="checkmark" onload="resizeImg(this, 20, 20);"></img>
		</li> 

		<li>
		  <label for="Prezime3">* Prezime</label>
		  <input class="itext" type="text" name="Prezime3" id="Prezime3" onchange="validacijaPrezime()" />
		  <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
		</li>
    
    <li>
      <label for="Email3">* Email</label><input class="itext" type="text" name="Email3" id="Email3" onchange="validacijaEmaila()" />
      <img id="checkmarkemail" onload="resizeImg(this, 20,20);"></img>
    </li>

    <h4 id="modalh4">Unesite nove podatke:  </h4>

  <li>
    <label for="Novoime">* Ime</label>
    <input class="itext" type="text" name="Novoime" id="Novoime" onchange="validacijaIme()"/>
    <img id="checkmark" onload="resizeImg(this, 20, 20);"></img>
    </li> 

    <li>
      <label for="Novoprezime">* Prezime</label>
      <input class="itext" type="text" name="Novoprezime" id="Novoprezime" onchange="validacijaPrezime()" />
      <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
    </li>
    
    <li>
      <label for="Noviemail">* Email</label><input class="itext" type="text" name="Noviemail" id="Noviemail" onchange="validacijaEmaila()" />
      <img id="checkmarkemail" onload="resizeImg(this, 20,20);"></img>
    </li>






		<li><label>&nbsp;</label><input type="submit" class="ibutton" name="promijenikorisnika" id="izmjenaBtn" value="Promijeni" /></li>
	</ul>
	</form>
  </div>

</div>



<!-- Modal Prikaz -->
<!--<div id="modalPrikaz" class="modal4">-->

  <!-- Modal content -->
 <!-- <div class="modal-content4">
    <span class="close4">&times;</span>
    <h4 id="modalh4">Unesite podatke o korisniku kojeg želite izbrisati: </h4>
     <form action="adminpanel.php" method="POST" class="iform" id="fourth">
  <ul>
    <li>
    <label for="Ime4">* Ime</label>
    <input class="itext" type="text" name="Ime4" id="Ime4" onchange="validacijaIme()"/>
    <img id="checkmark" onload="resizeImg(this, 20, 20);"></img>
    </li> 

    <li>
      <label for="Prezime4">* Prezime</label>
      <input class="itext" type="text" name="Prezime4" id="Prezime4" onchange="validacijaPrezime()" />
      <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
    </li>
  
    <li><label>&nbsp;</label><input type="submit" class="ibutton" name="prikazikorisnike" id="prikaziBtn" value="Prikaži sve" /></li>
  </ul>
  </form>
  </div>

</div>-->




















<!-- Modal Brisanje -->
<div id="modalBrisanje" class="modal2">

  <!-- Modal content -->
  <div class="modal-content2">
    <span class="close2">&times;</span>
    <h4 id="modalh4">Unesite podatke o korisniku kojeg želite izbrisati: </h4>
     <form action="adminpanel.php" method="POST" class="iform" id="second">
	<ul>
		<li>
		<label for="Ime2">* Ime</label>
		<input class="itext" type="text" name="Ime2" id="Ime2" onchange="validacijaIme()"/>
		<img id="checkmark" onload="resizeImg(this, 20, 20);"></img>
		</li> 

		<li>
		  <label for="Prezime2">* Prezime</label>
		  <input class="itext" type="text" name="Prezime2" id="Prezime2" onchange="validacijaPrezime()" />
		  <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
		</li>
  
		<li><label>&nbsp;</label><input type="submit" class="ibutton" name="brisikorisnika" id="brisiBtn" value="Izbriši" /></li>
	</ul>
	</form>
  </div>

</div>

<script src="js/modalizmjena.js" type="text/javascript"></script>
<script src="js/modalpopup.js" type="text/javascript"></script>
<script src="js/validacija.js" type="text/javascript"></script>
<script src="js/modalbrisanjekorisnika.js" type="text/javascript"></script>

</body>
</html>