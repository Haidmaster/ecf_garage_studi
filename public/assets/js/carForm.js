window.onload = () => {
  const brand = document.querySelector("#car_brand");
  console.log(brand);

  brand.addEventListener("change", function () {
    const form = this.closest("form");
    const data = this.name + "=" + this.value;

    fetch(form.getAttribute("action"), {
      method: form.getAttribute("method"),
      body: data,
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        charset: "utf-8",
      },
    })
      .then((response) => response.text())
      .then((html) => {
        // console.log(html);
        const content = document.createElement("html");
        content.innerHTML = html;
        const newSelect = content.querySelector("#car_model");
        document.querySelector("#car_model").replaceWith(newSelect);
      })
      .catch((error) => console.logt(error));
  });
};

// function pour ajouter une image à la fois

// const addImage = (e) => {
//   // const listeReponses = document.querySelector('.reponses');
//   const images = e.target.closest("div").previousElementSibling;
//   const image = document.createElement("img");
//   image.innerHTML = images.dataset.prototype.replace(
//     /__name__/g,
//     images.dataset.index++
//   );
//   images.appendChild(image);
// };

// document.querySelectorAll(".add-image").forEach((btn) => {
//   btn.addEventListener("click", addImage);
// });
