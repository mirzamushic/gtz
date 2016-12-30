function preuzmiKorisnika(){
	if(window.localStorage.length != 0){
	var ime = localStorage.getItem("ime");
	var prezime = localStorage.getItem("prezime");
	var email = localStorage.getItem("email");
	alert("Posljednji unos u localstorage: \n Ime: "+ ime +"\n Prezime: " + prezime + "\n Email: " + email  );
	}
	else{
	}
}
function spasiKorisnika(){
	 if(typeof(Storage) !== "undefined") {
        if (localStorage.ime && localStorage.prezime) {
            localStorage.ime = document.getElementById("Ime").value;
            localStorage.prezime = document.getElementById("Prezime").value;
            localStorage.email = document.getElementById("Email").value;
        } else {
            localStorage.ime="";
            localStorage.prezime="";
            localStorage.email ="";
        }
        
        document.getElementById("poljeime").innerHTML = "Ime: "  + localStorage.ime;
        document.getElementById("poljeprezime").innerHTML="Prezime: "+ localStorage.prezime; 
        document.getElementById("poljeemail").innerHTML="Email: "+ localStorage.email; 
        document.getElementById("result").style.visibility ="visible";
        document.getElementById("poljeime").style.visibility ="visible";
        document.getElementById("poljeprezime").style.visibility ="visible";
        document.getElementById("poljeemail").style.visibility ="visible";

    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support web storage...";
    }
}
