function onClickBtnFilter(event) {
  event.preventDefault();
  const url = this.href;

  axios.get(url).then((response) => {
    const content = document.querySelector("#js-car-content");
    content.innerHTML = "";
    content.innerHTML = response.data;
  });
}

document.querySelectorAll("#js-filter").forEach(function (link) {
  link.addEventListener("click", onClickBtnFilter);
});
