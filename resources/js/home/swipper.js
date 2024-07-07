const swipperItems = () => {
    console.log("start");
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 200,
            modifier: 1,
            slideShadows: false,
        },

        // Navigation arrows
        navigation: {
            nextEl: ".to-nex",
            prevEl: ".to-prev",
        },
        on: {
            init: (swiper) => {
                const activeSlide = swiper.slides[swiper.activeIndex];
                const key = activeSlide.getAttribute("data-key");
                document.querySelector(
                    `.case-about[data-key="${key}"]`
                ).style.display = "block";
            },
            slideChangeTransitionEnd: function (swiper) {
                const activeSlide = swiper.slides[swiper.activeIndex];
                const key = activeSlide.getAttribute("data-key");
                document
                    .querySelectorAll(`.case-about`)
                    .forEach((item) => (item.style.display = "none"));
                document.querySelector(
                    `.case-about[data-key="${key}"]`
                ).style.display = "block";
            },
        },
    });
    // const swiperContainer = document.querySelector(".mySwiper");
    // swiperContainer.style.height = `${window.innerHeight}px`;
    //swiperContainer.style.height = "auto";
};
swipperItems();