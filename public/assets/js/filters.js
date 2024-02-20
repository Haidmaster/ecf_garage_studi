window.onload = () => {
  const GearboxFiltersForm = document.querySelector("#gearbox-filters");
  console.log(GearboxFiltersForm);
  // On boucle sur les input
  document.querySelectorAll("#gearbox-filters input").forEach((input) => {
    input.addEventListener("change", () => {
      // On recupère les données du formulaire
      const GearboxForm = new FormData(GearboxFiltersForm);

      // // On fabrique la "queryString"
      // const Params = new URLSearchParams();

      // GearboxForm.forEach((car, gearbox) => {
      //   Params.append(gearbox, car);
      // });

      // // On récupere l'url active
      // const Url = new URL(window.location.href);

      // On lance la requete ajax
      fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
        headers: {
          "X-Requested-With": "XMLHttpRequest",
        },
      })
        .then((response) => {
          console.log(response);
        })
        .catch((e) => alert(e));
    });
  });

  const EnergyFiltersForm = document.querySelector("#energy-filters");
  console.log(EnergyFiltersForm);
  // On boucle sur les input
  document.querySelectorAll("#energy-filters input").forEach((input) => {
    input.addEventListener("change", () => {
      const EnergyForm = new FormData(EnergyFiltersForm);
      EnergyForm.forEach((car, energy) => {
        console.log(energy, car);
      });
    });
  });

  //   const BrandFiltersForm = document.querySelector("#brand-filters");
  //   console.log(BrandFiltersForm);
  //   // On boucle sur les input
  //   document.querySelectorAll("#brand-filters input").forEach((input) => {
  //     input.addEventListener("change", () => {
  //       const brandForm = new FormData(BrandFiltersForm);
  //       brandForm.forEach((car, brand) => {
  //         console.log(brand, car);
  //       });
  //     });
  //   });
};
