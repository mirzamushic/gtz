# Gradska turistička zajednica

Mirza Mušić (16841)

Informativni website sa korisnim sadržajem za turiste


/****************************************SPIRALA_1***************************************************************/

1) Urađeno je:

   * 5 podstranica sa izgledom za desktop i mobilnu verziju i njihov detaljan izgled
   * Website je responzivan za mobilnu verziju - korišten media query
   * 3 HTML forme su na 'Kontakt' podstranici (kontakt.html)
   * Meni web stranice je implementiran i nalazi se na svakoj podstranici te je omogućeno prebacivanje
     sa jedne podstranice na drugu uz obilježavanje aktivne podstranice
   * Elementi stranice su poravnati
   * CSS fajlovi su odvojeni u eksterni styles folder, svaka podstranica ima zaseban .css
   * Skice
   
2) Šta nije urađeno: 
    - 
    
3) Potrebno doraditi (bugovi/nepravilnosti):

    * Potrebno je poraditi na responzivnosti stranice za uređaje koji nisu ni mobile a ni desktop 
      (Treba doraditi media query za svaku html komponentu, kako ne bi dolazilo do 'overflow-a' 
      između komponenti npr. img holder i menu-bar u index.html )
      
    * Potrebno je poraditi na izgledu stranice kao što su padding i margine određenih elemenata kao što su
      form inputi (potrebno izmijeniti css navedenih komponenti)
   
4)   -

5)  Lista fajlova:

     *********************HTML************************************
     
     * gtz/index.html - HTML fajl podstranice 'Pocetna'
     * gtz/about.html - HTML fajl podstranice 'O nama'
     * gtz/kontakt.html - HTML fajl podstranice 'Kontakt'
     * gtz/smjestaj.html - HTML fajl podstranice 'Smjestaj'
     * gtz/prijevoz.html - HTML fajl podstranice 'Prijevoz'
     
     **********************Images**********************************
     
     * gtz/images - slike koje su koristene na svim podstranicama
     
     ************************CSS***********************************
     
     * gtz/layout/styles/layout.css - CSS fajl podstranice 'Pocetna'
     * gtz/layout/styles/about.css  - CSS fajl podstranice 'O nama'
     * gtz/layout/styles/contact.css - CSS fajl podstranice 'Kontakt'
     * gtz/layout/styles/prijevoz.css - CSS fajl podstranice 'Prijevoz'
     * gtz/layout/styles/smjestaj.css - CSS fajl podstranice 'Smjestaj'
     
     ************************HTML Skice*****************************
     
     * gtz/skice/SkiceHTML/pocetna - Skica podstranice 'Pocetna'
     * gtz/skice/SkiceHTML/onama - Skica podstranice 'O nama'
     * gtz/skice/SkiceHTML/kontakt - Skica podstranice 'Kontakt'
     * gtz/skice/SkiceHTML/prijevoz - Skica podstranice 'Prijevoz'
     * gtz/skice/SkiceHTML/smjestaj - Skica podstranice 'Smjestaj'
     
     ************************Mobile View Skice***********************
     
     * gtz/skice/SkiceMobile/PocetnaMobile - Skica podstranice 'Pocetna'
     * gtz/skice/SkiceMobile/OnamaMobile - Skica podstranice 'O nama' 
     * gtz/skice/SkiceMobile/KontaktMobile - Skica podstranice 'Kontakt'
     * gtz/skice/SkiceMobile/PrijevozMobile - Skica podstranice 'Prijevoz'
     * gtz/skice/SkiceMobile/SmjestajMobile - Skica podstranice 'Smjestaj'
         

/****************************************SPIRALA_2***************************************************************/


1) Urađeno je:

   * Sve forme na podstranici "Kontakt" imaju implementiranu javascript validaciju
     Poruke o pravilnom/nepravilnom unosu su predstavljene vizuelno, checkmark i wrongmark ikonama pri čemu je dugme za 
     slanje pitanja/prijedloga/nepravilnosti onemogućeno ukoliko podaci nisu zadovoljili proces validacije
   * Dropdown meni je urađen na tabovima "Smještaj" i "Prijevoz" pri čemu je meni u vidu stabla urađen na tabu "Smještaj"
   * Carousel je urađen na podstranici "Početna" u donjem dijelu
   * Galerija slika je implementirana u carousel i klikom na bilo koju od slika, slika se zumira i na Esc se vrati u početno stanje
   * Local storage je korišten na prvoj formi na podstranici "Kontakt" gdje se snimaju podaci (ime, prezime, email) i prilikom ponovnog
   klika na podstranicu "Kontakt" u alert prozoru se zadnje upisani podaci ispisuju
   * AJAX je iskorišten kako bi se učitavale podstranice bez reloada cijele stranice
   
   
2) Šta nije urađeno: 
    - 
    
3) Potrebno doraditi (bugovi/nepravilnosti):

    - Prilikom početnog loada stranice ili reloada podstranice "Početna" carousel radi, ali prilikom prebacivanja na neku drugu 
    
    podstranicu pa ponovnog vraćanja na Početnu, carousel ne radi
   
4)   -

5)  Lista dodatnih foldera/fajlova:

    * gtz/ajax - folder u kojima su .html dokumenti podstranica koje se učitavaju koristeći AJAX
    
    * gtz/js/ajaxscript.js - javascript fajl sa funkcijama koje omogućavaju funkcionalnost AJAX-a na web stranici
    
    * gtz/js/carousel.js - javascript za carousel sa slikama
    
    * gtz/js/imagezoom.js - javascript za uvećavanje i umanjivanje slika unutar carousel-a 
    
    * gtz/js/localstorage.js - javascript za local storage funkcionalnost
    
    * gtz/js/treedropdown.js - javascript za tree dropdown implementiran na tabu 'Smještaj'
    
    * gtz/js/validacija.js - javascript za validiranje svih formi unutar podstranice "Kontakt"
    

/****************************************SPIRALA_3***************************************************************/


1) Urađeno je:

  * login
  * admin panel
  * admin mogućnosti
  * download csv
   
2) Šta nije urađeno: 
    * download pdf
    * search
    
3) Potrebno doraditi (bugovi/nepravilnosti):

   
4)   -

5)  Lista dodatnih foldera/fajlova:
  * adminpanel.php - funkcionalnost admin panela
  * adminpanel.css - izgled admin panela
  * login.php - login izgled i funkcionalnosti
  * postavljenapitanja.xml - moguce je unijeti pitanje u prvoj formi na Kontakt tabu i registruju se u ovaj xml
  * prikazkorisnika.php - nakon klika u admin panelu na Prikaz korisnika, koristi se ovaj fajl
  
  
  
  /*************************************SPIRALA_4************************************************************/
  
  1) Napravljena je baza 'gtz' sa tri tabele: pitanja, prijedlozi, nepravilnosti koje su povezane preko polja 'email'
  2) Svi korisnici koji su sačuvani u korisnici.xml prilikom dodavanja preko admin panela su prebačeni u bazu u tabelu 'korisnici'
  3) Sve metode u adminpanel.php koje su upisivale/brisale/modifikovale .xml fajlove, su izmijenjene kako bi se manipulisalo bazom    podataka
  4) Openshift link na website: http://gtz-php-gradska-turisticka-zajednica.44fs.preview.openshiftapps.com/
     Openshift phpmyadmin: http://mysql-gradska-turisticka-zajednica.44fs.preview.openshiftapps.com/phpmyadmin
  5) REST metoda se nalazi u fajlu restmetoda.php
  6) SS-ovi korištenja POSTMAN-a za testiranje GET requesta se nalaze u folderu postmanprimjeri
  
  * Login za admina -> Korisničko ime: admin      Lozinka: password
  
  
  
   
  
