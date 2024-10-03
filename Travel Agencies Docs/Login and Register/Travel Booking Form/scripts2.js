// Get the modal
var popup = document.getElementById("popup");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Show the modal automatically when the page loads
window.onload = function() {
    popup.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    popup.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
