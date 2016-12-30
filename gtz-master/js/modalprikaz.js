// Get the modal
var modal4 = document.getElementById('modalPrikaz');

// Get the button that opens the modal
var btn4 = document.getElementById("prikaziPodatke");
// Get the <span> element that closes the modal
var span4 = document.getElementsByClassName("close4")[0];

// When the user clicks on the button, open the modal 
btn4.onclick = function() {
    modal4.style.display = "block";
}


// When the user clicks on <span> (x), close the modal
span4.onclick = function() {
    modal4.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal4) {
        modal4.style.display = "none";
    }
}
