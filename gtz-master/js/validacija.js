
var posaljipitanjebtn = document.getElementById("posaljipitanjebtn");
var validacijaPitanja = false;
var imetacno = false;
var prezimetacno = false;
var emailtacan = false;
var emailtacan2 = false;
var pitanjetacno = false;
var prijavanepravilnosti = false;
var prijedlogpopunjen = false;

function enablePosaljiPitanje(){
        if (imetacno  && prezimetacno  && emailtacan && pitanjetacno)
            document.getElementById("posaljipitanjebtn").disabled = false;
        else 
            document.getElementById("posaljipitanjebtn").disabled = true;
}

function enablePosaljiNepravilnosti(){
        if (emailtacan2 && prijavanepravilnosti)
            document.getElementById("Posaljinepravilnost").disabled = false;
        else 
            document.getElementById("Posaljinepravilnost").disabled = true;
}


function enablePosaljiPrijedlog(){
        if (prijedlogpopunjen == true)
            document.getElementById("posaljiprijedlogbtn").disabled = false;
        else
            document.getElementById("posaljiprijedlogbtn").disabled = true;
}

function validacijapoljaPrijedlog(){
    var x;
    x = document.getElementById("Prijedlog").value;
    prijedlogpopunjen = false;
    if (/^$|\s/.test(x) == true) 
    {
    // ukoliko je input prazan ili ne zadovoljava regex za ime, postavlja wrongmark
            prijedlogpopunjen = false;   
    }
    else{
        
        prijedlogpopunjen = true;
    }
        enablePosaljiPrijedlog();

}
function validacijapoljaPitanje(){
    var x;
    x = document.getElementById("Pitanje").value;
    pitanjetacno = false;

    if (/^$|\s/.test(x) == true) 
    {
    // ukoliko je input prazan ili ne zadovoljava regex za ime, postavlja wrongmark
          
        pitanjetacno = false;   
    }
    else{
        
        pitanjetacno = true;
    }
        enablePosaljiPitanje();

}
function validacijapoljaNepravilnost(){
    var x;
    x = document.getElementById("Nepravilnost").value;
     prijavanepravilnosti = false;

    if (/^$|\s/.test(x) == true) 
    {
    // ukoliko je input prazan ili ne zadovoljava regex za ime, postavlja wrongmark
          
        prijavanepravilnosti = false;   
    }
    else{
        
        prijavanepravilnosti = true;
    }
        enablePosaljiNepravilnosti();

}

function validacijaIme() {
    var x;
    x = document.getElementById("Ime").value;
    var checkmark = document.getElementById("checkmark");
    checkmark.src = "images/checkmarksmall.png"; 
    imetacno = false;

    if (/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u.test(x) == false) 
    {
    // ukoliko je input prazan ili ne zadovoljava regex za ime, postavlja wrongmark
        checkmark.src="images/wrongmarksmall.png";  
        imetacno = false;   
    }
    else{
        checkmark.src="images/checkmarksmall.png";
        imetacno = true;
    }
        enablePosaljiPitanje();
}
function validacijaPrezime() {
    var x;
    x = document.getElementById("Prezime").value;
    var checkmark = document.getElementById("checkmarkprezime");
    checkmark.src = "images/checkmarksmall.png";
    prezimetacno = false;
    if (/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u.test(x) == false) 
    {
    // ukoliko je input prazan ili ne zadovoljava regex za ime, postavlja wrongmark
        checkmark.src="images/wrongmarksmall.png";  
        prezimetacno = false;      
    }
    else{
        checkmark.src="images/checkmarksmall.png";  
        prezimetacno = true;  
    }
    enablePosaljiPitanje();
}

function resizeImg(img, height, width){
    img.height = height;
    img.width = width;
}

function testEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validacijaEmaila(){
    var x;
    x = document.getElementById("Email").value;
    var checkmark = document.getElementById("checkmarkemail");
    checkmark.src = "images/checkmarksmall.png";
    if(testEmail(x)){
                checkmark.src="images/checkmarksmall.png";    
                emailtacan = true;
            }
    else {
                checkmark.src="images/wrongmarksmall.png"; 
                emailtacan = false;
                }
    enablePosaljiPitanje();       
}
function validacijaEmaila2(){
    var x;
    x = document.getElementById("Email2").value;
    var checkmark = document.getElementById("checkmarkemail2");
    checkmark.src = "images/checkmarksmall.png";
    if(testEmail(x)){
                checkmark.src="images/checkmarksmall.png";    
                emailtacan2 = true;
            }
    else {
                checkmark.src="images/wrongmarksmall.png"; 
                emailtacan2 = false;
                }
    enablePosaljiNepravilnosti();       
}
