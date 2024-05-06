// window.onload = () => {
//   // On récupère le form
//   const FiltersForm = document.querySelector("#filters");

//   // On récupère tout les input et on les boucles
//   document.querySelectorAll("#filters input").forEach((input) => {
//     // On place un écouteur d'évenement
//     input.addEventListener("change", () => {
//       // On intercepte les clics
//       // On récupère les données du formulaire
//       const Form = new FormData(FiltersForm);

//       // On fabrique la querystring
//       const Params = new URLSearchParams();

//       Form.forEach((value, key) => {
//         Params.append(key, value);
//       });

//       // On récupère l'url active
//       const Url = new URL(window.location.href);

//       // On lance la requête ajax
//       fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
//         headers: {
//           "X-Requested-with": "XMLHttpRequest",
//         },
//       }) // Si la reponse est récupérée
//         .then((response) => {
//           console.log(response);
//         })
//         .catch((e) => alert(e));
//     });
//   });
// };

window.addEventListener("DOMContentLoaded", () => {
  const FiltersForm = document.querySelector("#filters");
  document.querySelectorAll("#filters option").forEach((option) => {
    FiltersForm.addEventListener("change", () => {
      const Form = new FormData(FiltersForm);

      // On fabrique la querystring
      const Params = new URLSearchParams();

      Form.forEach((value, key) => {
        Params.append(key, value);
      });

      // On récupère l'url active
      const Url = new URL(window.location.href);

      // On lance la requête ajax
      fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
        headers: {
          "X-Requested-with": "XMLHttpRequest",
        },
      }) // Si la reponse est récupérée
        .then((response) => {
          console.log(response);
        })
        .catch((e) => alert(e));
    });
  });
});
