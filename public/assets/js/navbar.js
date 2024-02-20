const links = document.querySelectorAll("nav li");

const icons = document.querySelector("#icons");
icons.addEventListener("click", () => {
  document.querySelector("#nav").classList.toggle("active");
});

links.forEach((links) => {
  links.addEventListener("click", () => {
    navigator.classList.remove("active");
  });
});
