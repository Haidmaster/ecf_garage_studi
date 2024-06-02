function onClickBtnFilter(event) {
  event.preventDefault();
  const Url = this.href;

  fetch(Url + "?" + "&ajax=1", {
    headers: {
      "X-Requested-With": "XMLHttpRequest",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      const content = document.querySelector("#js-car-content");
      content.innerHTML = data.content;
    })
    .catch((e) => alert(e));
}

document.querySelectorAll("#js-filter").forEach(function (link) {
  link.addEventListener("click", onClickBtnFilter);
});
