const bellClick = document.querySelector(".notify-header");
const container = document.querySelector(".notify-inner-container");
const closeBtn = document.querySelector(".button-close");


const handleToggle = () => {
  $('ion-icon').removeClass( "bell-icon");
  if (container?.classList.value.split(" ").includes("show")) {
    container.classList.add("notShow");
    container.classList.remove("show");
  } else {
    container.classList.remove("notShow");

    container.classList.add("show");
  }
};

bellClick?.addEventListener("click", (e) => {
  handleToggle();
});

closeBtn?.addEventListener("click", () => {
  handleToggle();
});


