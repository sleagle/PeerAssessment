$(document).ready(function () {
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
    var dropdown1 = document.getElementsByClassName("dropdown-btn1");
    var j;

    for (j = 0; j < dropdown1.length; j++) {
        dropdown1[j].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent1 = this.nextElementSibling;
            if (dropdownContent1.style.display === "block") {
                dropdownContent1.style.display = "none";
            } else {
                dropdownContent1.style.display = "block";
            }
        });
    }
});
