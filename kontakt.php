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

  if(isset($_POST['Poaljipitanje']))
{
  $xml = new DomDocument("1.0", "UTF-8");
  $xml->load ('postavljenapitanja.xml');

  $ime = xss_clean($_POST['Ime']);
  $prezime =xss_clean($_POST['Prezime']);
  $email = xss_clean($_POST['Email']);
  $pitanje = xss_clean($_POST['Pitanje']);


  $rootTag = $xml->getElementsByTagName("root")->item(0);

  $infoTag = $xml->createElement("info");
    $imeTag = $xml->createElement("ime",$ime);
    $prezimeTag = $xml->createElement("prezime",$prezime);
    $emailTag = $xml->createElement("email", $email);
    $pitanjeTag= $xml->createElement("pitanje",$pitanje);

  $infoTag->appendChild($imeTag);
  $infoTag->appendChild($prezimeTag);
  $infoTag->appendChild($emailTag);
  $infoTag->appendChild($pitanjeTag);



  //validacija unesenih podataka
  $imeTacno = false;
  $prezimeTacno = false;
  $emailTacan = false;
  $pitanjeTacno = false;
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
  if (empty($pitanje))
  {
    $errors['pitanje1'] = "Polje za unos pitanja ne smije biti prazno!";
  }
  else{
      $pitanjeTacno = true;
      $infoTag->appendChild($pitanjeTag);
  }

  if($imeTacno == true and $prezimeTacno == true and $emailTacan == true and $pitanjeTacno == true){
  $rootTag->appendChild($infoTag);
  $xml->save('postavljenapitanja.xml');
}
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Gradska turistička zajednica</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/contact.css" type="text/css" />

</head>
<body id="top">
<div class="wrapper">
  <div id="header">
    <div id="logo">
      <!--<h1><a href="index.html">Dobro došli!</a></h1>
      <p>Turistička zajednica općine Živinice</p>-->
      <img src="images/grbzivinice.jpg" id="grbheader" alt="" />
    </div>
    <div id="headerpozdrav">
      <h1> Dobro došli</h1>
      <h2> Turistička zajednica Općine Živinice</h2>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper">
  <div id="navbar-menu">
    <ul id="menu-bar">
 <li><a href="index.html">Početna</a></li>
 <li><a href="smjestaj.html">Smještaj</a>
  <!--<ul>
   <li><a href="#">Hoteli</a></li>
   <li><a href="#">Moteli</a></li>
   <li><a href="#">Apartmani</a></li>
  </ul>-->
 </li>
 <li><a href="prijevoz.html">Prijevoz</a>
  <!--<ul>
   <li><a href="#">Rent a car</a></li>
   <li><a href="#">Rent a bike</a></li>
   <li><a href="#">Autobusi</a></li>
  </ul>-->
 </li>
 <li><a href="about.html">O nama</a></li>
 <li  class="active"><a href="#">Kontakt</a></li>
</ul>
  </div>
</div>
<div class="wrapper">
  <div class="question">
    <div id="kontakt">
    <h3> <br>
      <b>Kontakt informacije:<br>
      <br>
      Maršala Tita 1, Živinice<br><br>
      75270 <br><br>
      Tel +387 35 777 777<br>
      <br>
      info@gtz.ba<br>
      <br>
      </h3>
    </div>

    








  <form action="kontakt.php" method="POST" class="iform" id="first">
<ul>
<li class="iheader">Unesite Vaše pitanje</li>
<li>
  <label for="Ime">* Ime</label>
  <input class="itext" type="text" name="Ime" id="Ime" onchange="validacijaIme()"/>
  <img id="checkmark" onload="resizeImg(this, 20, 20);"></img>
</li> 
<p align="center" style="color:red;">
  <?php if(isset($errors['ime1']))echo $errors['ime1'];?></p>
<li>
  <label for="Prezime">* Prezime</label>
  <input class="itext" type="text" name="Prezime" id="Prezime" onchange="validacijaPrezime()" />
  <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
</li>
<p align="center" style="color:red;"><?php if(isset($errors['prezime1']))echo $errors['prezime1'];?></p>
<li><label for="Email">* Email</label><input class="itext" type="text" name="Email" id="Email" onchange="validacijaEmaila()" />
<img id="checkmarkemail" onload="resizeImg(this, 20,20);"></img>
</li>
<p align="center" style="color:red;"><?php if(isset($errors['email1']))echo $errors['email1'];?></p>
<li><label for="Pitanje">* Pitanje</label><textarea class="itextarea" name="Pitanje" id="Pitanje"></textarea></li>
<p align="center" style="color:red;"><?php if(isset($errors['pitanje1']))echo $errors['pitanje1'];?></p>

<li class="iseparator">&nbsp;</li>
<li><label>&nbsp;</label><input type="submit" class="ibutton" name="Poaljipitanje" id="Posaljipitanje" value="Pošalji" /></li>
</ul></form>
</div>
</div>














<div class="wrapper">
  <form action="" class="iform">
<ul>
  <li>
  <label for="Prezime">* Prezime</label>
  <input class="itext" type="text" name="Prezime" id="Prezime" onchange="validacijaPrezime()" />
  <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
</li>
<li>
  <label for="Prezime">* Prezime</label>
  <input class="itext" type="text" name="Prezime" id="Prezime" onchange="validacijaPrezime()" />
  <img id="checkmarkprezime" onload="resizeImg(this, 20,20);"></img>
</li>
<li class="iheader">Pošaljite Vaš prijedlog</li>
<li><label for="Pitanje">* Prijedlog</label><textarea class="itextarea" name="Pitanje2" id="Pitanje"></textarea></li>
<li class="iseparator">&nbsp;</li>
<li><label>&nbsp;</label><input type="button" class="ibutton" name="Poaljipitanje2" id="Posaljipitanje" value="Pošalji" /></li>
</ul></form>

<form action="" class="iform">
<ul>
<li class="iheader">Prijavite nepravilnosti u radu turističke zajednice</li>
<li><label for="Email">*Email</label><input class="itext" type="text" name="Email3" id="Email" /></li>
<li><label for="Pitanje">*Opišite uočene nepravilnosti:></label><textarea class="itextarea" name="Pitanje3" id="Pitanje"></textarea></li>
<li class="iseparator">&nbsp;</li>
<li><label>&nbsp;</label><input type="button" class="ibutton" name="Posaljipitanje3" id="Posaljipitanje" value="Pošalji pitanje" /></li>
</ul></form>
</div>

<div class="wrapper">
  <div id="footer">
    <div id="newsletter">
      <h2>Pretplatite se</h2>
      <p>Unesite Vaš email da biste se pretplatili na sedmični izvještaj turističke zajednice</p>
      <form action="#" method="post">
        <fieldset>
          <legend>Pretplata</legend>
          <input type="text" value="Unesite email&hellip;"  onfocus="this.value=(this.value=='Unesite email&hellip;')? '' : this.value ;" />
          <input type="submit" name="news_go" id="news_go" value="Ok" />
        </fieldset>
      </form>
    </div>
    <div class="footbox">
      <h2>Kontakt</h2>
      <ul>
        <li><a href="#">Turistički ured</a></li>
        <li><a href="#">Turistički informativni centri</a></li>
        <li><a href="#">B2B</a></li>
        <li><a href="#">Pišite nam</a></li>
        <li class="last"><a href="#">Impresije</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Informacije</h2>
      <ul>
        <li><a href="#">Korisne informacije</a></li>
        <li><a href="#">Putničke agencije</a></li>
        <li><a href="#">Avionski prijevoznici</a></li>
        <li class="last"><a href="#">Turistički vodiči</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Linkovi</h2>
      <ul>
        <li><a href="#">Živinice portal</a></li>
        <li><a href="#">Wizzair</a></li>
        <li><a href="#">Love Živinice</a></li>
        <li class="last"><a href="#">Hotel President</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2016 - Sva prava zadržana - <a href="#">Gradska turistička zajednica Živinice</a></p>
    <br class="clear" />
  </div>
</div>
<script src="js/validacija.js" type="text/javascript"></script>
</body>
</html>