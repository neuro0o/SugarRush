/*==============================
  NAVBAR SCRIPT
==============================*/
// get the hamburger icon and navbar
const navbarHamburger = document.getElementById('navbar-hamburger');
const navbar = document.querySelector('.navbar');

// toggle the active class on navbar when hamburger is clicked
navbarHamburger.addEventListener('click', () => {
  navbar.classList.toggle('active');
});

/*==============================
  LOGIN/REGISTER POPUP OVERLAY SCRIPT
==============================*/
function openLoginPopup() {
  document.getElementById("login-popup").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closeLoginPopup() {
  document.getElementById("login-popup").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}

function openRegPopup() {
  document.getElementById("reg-popup").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closeRegPopup() {
  document.getElementById("reg-popup").style.display = "none";
  document.getElementById("login-popup").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}


/*==============================
  BLOG CARD:ACTIVE SCRIPT
==============================*/
document.addEventListener('DOMContentLoaded', function() {
  const blogCards = document.querySelectorAll('.blog-card');

  // apply active class when clicking any card
  blogCards.forEach(function(blogCard) {
    blogCard.addEventListener('click', function(event) {
      event.stopPropagation();
      this.classList.toggle('active');
    });
  });

  // remove all active class when clicking outside card
  document.addEventListener('click', function() {
    blogCards.forEach(function(blogCard) {
      blogCard.classList.remove('active');
    });
  });
});


/*==============================
  REVIEW RATING LABEL SCRIPT
==============================*/
function updateLabel(value) {
  // update rating label based on user input
  document.getElementById('ratingLabel').textContent = '(' + value + ')';
}