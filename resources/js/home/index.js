// // import Swiper JS
// import Swiper from "swiper";
// // import Swiper styles
// import "swiper/css";
import lightGallery from "lightgallery";
import lgVideo from "lightgallery/plugins/video";
import "lightgallery/css/lightgallery-bundle.css";
import videojs from "video.js";
window["videojs"] = videojs;
import "video.js/dist/video-js.css";
import { modal } from "./modal";

const initVideoPlugin = () => {
    const videoPlugin = lightGallery(
        document.getElementById("gallery-videos-demo"),
        {
            plugins: [lgVideo],
            videojs: true,
            closable: true,
            videojsOptions: {
                muted: true,
            },
            mobileSettings: {
                controls: true,
                showCloseIcon: true,
            },
            showCloseIcon: true,
        }
    );
    const videoPlugin__m = lightGallery(
        document.getElementById("gallery-videos-demo__m"),
        {
            plugins: [lgVideo],
            videojs: true,
            videojsOptions: {
                muted: true,
            },
            controls: true,
            toggleThumb: true,
            allowMediaOverlap: true,
            mobileSettings: {
                controls: true,
                showCloseIcon: true,
            },
            showCloseIcon: true,
        }
    );
    document.querySelector(".icon-play").addEventListener("click", (e) => {
        e.preventDefault();
        console.log("play");
        videoPlugin.openGallery();
    });
    document.querySelector(".icon-play__m").addEventListener("click", (e) => {
        e.preventDefault();
        console.log("play");
        videoPlugin__m.openGallery();
    });
};

document
    .getElementById("contact-form")
    .addEventListener("submit", async (e) => {
        e.preventDefault();
        var formData = new FormData(e.currentTarget);
        if (!formData.get("phone")) {
            console.log(" empty phone");
            document.getElementById("phoneError").style.display = "block";
        } else {
            document.getElementById("phoneError").style.display = "none";
            document
                .querySelectorAll("#contact-form > input, textarea")
                .forEach((item) => {
                    item.setAttribute("disabled", "disabled");
                });
            document.querySelector(
                "#contact-form > button"
            ).style.backgroundColor = "rgba(239, 239, 239, 1)";
            document
                .querySelector("#contact-form > button")
                .setAttribute("disabled", "disabled");
            const response = await fetch("/api/sendForm", {
                method: "POST",
                body: formData,
            });
            if (response.ok) {
                document.getElementById("contact-form").reset();
                const content = await response.text();
                const modalName = "modal-2";

                document
                    .querySelectorAll("#contact-form > input, textarea")
                    .forEach((item) => {
                        item.removeAttribute("disabled");
                    });
                document.querySelector(
                    "#contact-form > button"
                ).style.backgroundColor = "white";
                document
                    .querySelector("#contact-form > button")
                    .removeAttribute("disabled", "disabled");

                modal(modalName, content);
            }
        }
    });

document.querySelector(".button-contact").addEventListener("click", () => {
    document.getElementById("contacts").scrollIntoView({
        behavior: "smooth",
    });
});

const toggleMobileMenuClass = () => {
    document.querySelector(".header").classList.toggle("active");
    document.querySelector("body").classList.toggle("o_h");
    document.querySelector(".menu__m").classList.toggle("hidden-menu-ticker");
};
const mobileMenu = () => {
    document.querySelector(".ico").addEventListener("click", (e) => {
        toggleMobileMenuClass();
    });
    document.querySelectorAll(".menu__m li").forEach((item) => {
        item.addEventListener("click", (e) => {
            console.log(e.currentTarget.firstChild);
            const toHref = e.currentTarget.firstChild
                .getAttribute("data-href")
                .replace("#", "");
            if (document.getElementById(toHref)) {
                document.getElementById(toHref).scrollIntoView({
                    behavior: "smooth",
                });
                toggleMobileMenuClass();
            }
        });
    });
};

const selectMobileCategory = () => {
    const checkTitleHeader = (elem) => {
        if (
            document
                .querySelector(".sticky-header")
                .classList.contains("active")
        ) {
            elem.innerText = "Выберете категорию автомобиля";
        } else {
            elem.innerText = "Категории авто";
        }
    };
    const checkTitleOrderHeader = (elem) => {
        if (
            document
                .querySelector(".products-block")
                .classList.contains("active")
        ) {
            elem.innerText = "Выберете категорию автомобиля";
        }
    };
    document
        .querySelector(".select-tagline-mobile")
        .addEventListener("click", (e) => {
            document.querySelector(".sticky-header").classList.toggle("active");
            checkTitleHeader(e.currentTarget);
        });
    document.querySelector(".filter-icon").addEventListener("click", (e) => {
        document.querySelector(".sticky-header").classList.toggle("active");
        checkTitleHeader(document.querySelector(".select-tagline-mobile"));
    });
    document
        .querySelector(".select-tagline__m")
        .addEventListener("click", (e) => {
            document
                .querySelector(".products-block")
                .classList.toggle("active");
            checkTitleOrderHeader(e.currentTarget);
        });
    document.querySelector(".filter-icon__m").addEventListener("click", (e) => {
        document.querySelector(".products-block").classList.toggle("active");
        checkTitleOrderHeader(document.querySelector(".select-tagline__m"));
    });
};

const arrowDown = () => {
    document.querySelector(".main-arrow-down").addEventListener("click", () => {
        document.getElementById("about").scrollIntoView({
            behavior: "smooth",
        });
    });
};

const toggleMobileArrowUp = () => {
    const btnUp = document.querySelector(".scroll_arrow_up__m");
    const isElementInViewport = (el) => {
        return el.getBoundingClientRect().top >= 0;
    };
    const onScroll = () => {
        const headerBlock = document.getElementById("about");
        if (!isElementInViewport(headerBlock)) {
            btnUp.style.display = "block";
        } else {
            btnUp.style.display = "none";
        }
    };
    window.addEventListener("scroll", onScroll);
    btnUp.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
};

const policyModal = () => {
    document.getElementById("policy").addEventListener("click", async (e) => {
        const response = await fetch(`/api/policy`);
        if (response.ok) {
            const content = await response.text();
            const modalName = "modal-policy";
            modal(modalName, content);
        }
    });
};

initVideoPlugin();
mobileMenu();
selectMobileCategory();
arrowDown();
toggleMobileArrowUp();
policyModal();
