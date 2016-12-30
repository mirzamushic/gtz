var hoteli = document.getElementById("sidenavhoteli");
function expandHoteli(){
	hoteli.style.visibility ="visible";
	hoteli.style.height = "100px";
	hoteli.style.width =  "120px";
	hoteli.style.top = "50";
	hoteli.style.left ="100";
	hoteli.style.float = "right";
}

function shrinkHoteli(){
	hoteli.style.visibility ="hidden";
	hoteli.style.height = "0";
	hoteli.style.width =  "0";
	
}

var moteli = document.getElementById("sidenavmoteli");
function expandMoteli(){
	moteli.style.visibility ="visible";
	moteli.style.height = "100px";
	moteli.style.width =  "120px";
	moteli.style.top = "50";
	moteli.style.left ="100";
	moteli.style.float = "right";
}

function shrinkMoteli(){
	moteli.style.visibility ="hidden";
	moteli.style.height = "0";
	moteli.style.width =  "0";
	
}

var prijevoz = document.getElementById("prijevozlist");

function expandPrijevozmenu(){
	prijevoz.style.visibility = "visible";

}