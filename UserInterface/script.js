 // Modal functionality
 document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("profile-modal");
    var profileLink = document.querySelector(".profile-link");
    var closeBtn = document.querySelector(".close");

    profileLink.addEventListener("click", function () {
        modal.style.display = "block";
    });

    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});


