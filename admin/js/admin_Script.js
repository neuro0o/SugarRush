// DROPDOWN BUTTON CONTENT TOGGLE SCRIPT
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

// loop through all dropdown buttons to toggle show/hide state
for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {

    // toggle the "active" class
    this.classList.toggle("active");

    // get dropdown content
    var dropdownContent = this.nextElementSibling;
    
    // hide dropdown content
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";

      // change icon to right caret
      this.querySelector("i").classList.remove("fa-caret-down");
      this.querySelector("i").classList.add("fa-caret-right");

    }
    // show dropdown content
    else {
      dropdownContent.style.display = "block";

      // change icon to down caret
      this.querySelector("i").classList.remove("fa-caret-right");
      this.querySelector("i").classList.add("fa-caret-down");

    }
  });
}