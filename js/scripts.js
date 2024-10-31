let body = document.body;
let profile = document.querySelector(".header .flex .profile");
let sideBar = document.querySelector(".side-bar");

function ProfileClick() {
  profile.classList.toggle("active");
}

function MenuClick() {
  sideBar.classList.toggle("active");
  body.classList.toggle("active");
}

function CloseClick() {
  sideBar.classList.remove("active");
  body.classList.remove("active");
}

window.onscroll = () => {
  profile.classList.remove("active");
  search.classList.remove("active");

  if (window.innerWidth < 1200) {
    sideBar.classList.remove("active");
    body.classList.remove("active");
  }
};

// norgor slideshow

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}