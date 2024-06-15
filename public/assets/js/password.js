const togglePassword = () => {
  const passwordInput = document.querySelector("#inputPassword");
  passwordInput.type = passwordInput.type === "text" ? "password" : "text";
  const eyeIcon = document.querySelector("#eye-js");
  eyeIcon.style.display = eyeIcon.style.display === "none" ? "block" : "none";
  const eyeSlashIcon = document.querySelector("#eye-slash-js");
  eyeSlashIcon.classList.contains("d-none")
    ? eyeSlashIcon.classList.remove("d-none")
    : eyeSlashIcon.classList.add("d-none");
};
