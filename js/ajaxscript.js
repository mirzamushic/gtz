
var xhttp = new XMLHttpRequest();
	function getsmjestajContent()
	 {
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("ajaxreplace").innerHTML = this.responseText;
	      var inactivetab1 = document.getElementById("pocetnatab");
	      inactivetab1.className="";
	      var inactivetab2 = document.getElementById("abouttab");
	      inactivetab2.className="";
	      var inactivetab3 = document.getElementById("prijevoztab");
	      inactivetab3.className="";
	      var inactivetab4 = document.getElementById("kontakttab");
	      inactivetab4.className="";
	      var activetab = document.getElementById("smjestajtab");
	      activetab.className ="active";

	    }
	  };
	  xhttp.open("GET", "ajax/smjestajajax.html", true);
	  xhttp.send();
	}

	function getpocetnaContent()
	 {
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("ajaxreplace").innerHTML = this.responseText;
	      var inactivetab1 = document.getElementById("smjestajtab");
	      inactivetab1.className="";
	      var inactivetab2 = document.getElementById("abouttab");
	      inactivetab2.className="";
	      var inactivetab3 = document.getElementById("prijevoztab");
	      inactivetab3.className="";
	      var inactivetab4 = document.getElementById("kontakttab");
	      inactivetab4.className="";
	      var activetab = document.getElementById("pocetnatab");
	      activetab.className ="active";

	    }
	  };
	  xhttp.open("GET", "ajax/pocetnaajax.html", true);
	  xhttp.send();
	}

	function getprijevozContent()
	 {
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("ajaxreplace").innerHTML = this.responseText;
	      var inactivetab1 = document.getElementById("smjestajtab");
	      inactivetab1.className="";
	      var inactivetab2 = document.getElementById("abouttab");
	      inactivetab2.className="";
	      var inactivetab3 = document.getElementById("pocetnatab");
	      inactivetab3.className="";
	      var inactivetab4 = document.getElementById("kontakttab");
	      inactivetab4.className="";
	      var activetab = document.getElementById("prijevoztab");
	      activetab.className ="active";

	    }
	  };
	  xhttp.open("GET", "ajax/prijevozajax.html", true);
	  xhttp.send();
	}

	function getaboutContent()
	 {
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("ajaxreplace").innerHTML = this.responseText;
	      var inactivetab1 = document.getElementById("smjestajtab");
	      inactivetab1.className="";
	      var inactivetab2 = document.getElementById("prijevoztab");
	      inactivetab2.className="";
	      var inactivetab3 = document.getElementById("pocetnatab");
	      inactivetab3.className="";
	      var inactivetab4 = document.getElementById("kontakttab");
	      inactivetab4.className="";
	      var activetab = document.getElementById("abouttab");
	      activetab.className ="active";

	    }
	  };
	  xhttp.open("GET", "ajax/onamaajax.html", true);
	  xhttp.send();
	}

	function getkontaktContent()
	 {
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("ajaxreplace").innerHTML = this.responseText;
	      var inactivetab1 = document.getElementById("smjestajtab");
	      inactivetab1.className="";
	      var inactivetab2 = document.getElementById("prijevoztab");
	      inactivetab2.className="";
	      var inactivetab3 = document.getElementById("pocetnatab");
	      inactivetab3.className="";
	      var inactivetab4 = document.getElementById("abouttab");
	      inactivetab4.className="";
	      var activetab = document.getElementById("kontakttab");
	      activetab.className ="active";

	    }
	  };
	  xhttp.open("GET", "ajax/kontaktajax.html", true);
	  xhttp.send();
	}




