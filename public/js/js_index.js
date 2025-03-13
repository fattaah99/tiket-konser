let index = 0;
const carouselInnerManual = document.querySelector(".carousel-inner-manual");

if (carouselInnerManual) {
    const manualSlides = carouselInnerManual.querySelectorAll("img");
    const totalManualSlides = manualSlides.length;

    function nextSlideManual() {
        index = (index + 1) % totalManualSlides;
        carouselInnerManual.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(nextSlideManual, 3000);
} else {
    console.error("Element .carousel-inner-manual tidak ditemukan.");
}

document.querySelectorAll(".gallery img").forEach((img) => {
    img.addEventListener("click", function () {
        document
            .querySelectorAll(".gallery img")
            .forEach((img) => img.classList.remove("active"));
        this.classList.add("active");
        this.scrollIntoView({
            behavior: "smooth",
            block: "center",
            inline: "center",
        });
    });
});
