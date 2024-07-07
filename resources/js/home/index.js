// // import Swiper JS
// import Swiper from "swiper";
// // import Swiper styles
// import "swiper/css";
import MicroModal from "micromodal";
import lightGallery from "lightgallery";
import lgThumbnail from "lightgallery/plugins/thumbnail";
import lgZoom from "lightgallery/plugins/zoom";
import lgVideo from "lightgallery/plugins/video";
import "lightgallery/css/lightgallery-bundle.css";
import videojs from "video.js";
window["videojs"] = videojs;
import "video.js/dist/video-js.css";

const accordion = () => {
    const acc = document.getElementsByClassName("accordion");
    let i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            const panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
            panel.classList.toggle("active");
        });
    }
};

const handleFilterItem = (elem) => {
    elem.addEventListener("click", async (e) => {
        const traget = e.target;
        const type = traget.getAttribute("type");
        document
            .querySelector(".categories > .current")
            .classList.toggle("current");
        document
            .querySelector(`.category-item[type="${type}"]`)
            .classList.toggle("current");

        const url = new URL(window.location.href);
        url.searchParams.delete("page");

        // if (document.querySelector(".current.page")) {
        //     const page = document
        //         .querySelector(".current.page")
        //         .getAttribute("page");
        //     url.searchParams.set("page", page);
        // }
        url.searchParams.set("filterType", type);
        history.replaceState({}, document.title, url.toString());
        document.querySelector(".select-tagline__m").innerText =
            traget.innerText;
        document.querySelector(".select-tagline").innerText =
        traget.innerText;
        if (
            document
                .querySelector(".products-block")
                .classList.contains("active")
        ) {
            document
                .querySelector(".select-tagline__m")
                .dispatchEvent(new Event("click"));
        }

        //document.querySelector(".products-block").classList.toggle('active');

        const response = await fetch(`/api/cars${url.search}`);
        if (response.ok) {
            const data = await response.text();
            document
                .querySelectorAll(".button-more")
                .forEach((item) => item.remove());
            document
                .querySelectorAll(".paginator  a")
                .forEach((item) => item.remove());
            document.getElementById("carItems").innerHTML = data;
            document
                .querySelectorAll(".paginator  a")
                .forEach((item) => handlePaginateItem(item));
            document.querySelectorAll(".button-more").forEach((elem) => {
                handleModal(elem);
            });
        }
    });
};

const handlePaginateItem = (elem) => {
    elem.addEventListener("click", async (e) => {
        e.preventDefault();
        let target = e.currentTarget;
        const href = target.getAttribute("href");
        const hrefUr = new URL(href);

        const url = new URL(window.location.href);
        url.searchParams.set("page", hrefUr.searchParams.get("page"));
        if (hrefUr.searchParams.get("filterType")) {
            url.searchParams.set(
                "filterType",
                hrefUr.searchParams.get("filterType")
            );
        }
        history.replaceState({}, document.title, url.toString());

        const response = await fetch(`/api/cars${url.search}`);
        if (response.ok) {
            const data = await response.text();
            document
                .querySelectorAll(".button-more")
                .forEach((item) => item.remove());
            document
                .querySelectorAll(".paginator  a")
                .forEach((item) => item.remove());
            document.getElementById("carItems").innerHTML = data;
            document
                .querySelectorAll(".paginator  a")
                .forEach((item) => handlePaginateItem(item));
            document.querySelectorAll(".button-more").forEach((elem) => {
                handleModal(elem);
            });
        }
    });
};
const scrollStickiHeader = (elem) => {
    elem.addEventListener("click", async (e) => {
        document.querySelector(
            ".sticky-header .border .select-tagline"
        ).innerText = e.currentTarget.innerText;
        document
            .querySelector(".section.sticky-header")
            .classList.remove("active");
        document.querySelector(".products-block").scrollIntoView({
            behavior: "smooth",
        });
    });
};

const filterItems = () => {
    document
        .querySelectorAll(".category-item")
        .forEach((item) => handleFilterItem(item));
    document.querySelectorAll(".category-items > p").forEach((item) => {
        scrollStickiHeader(item);
        handleFilterItem(item);
    });
    document
        .querySelectorAll(".paginator  a")
        .forEach((item) => handlePaginateItem(item));
};



const vwToPixels = (vw) => {
    const screenWidth = window.innerWidth;
    const pixels = (vw * screenWidth) / 100;

    return pixels;
};

const insertmodal = (content, modal) => {
    document
        .querySelector("footer")
        .insertAdjacentHTML(
            "afterend",
            `<div id="${modal}_wrapper">${content}</div>`
        );
};
const onCloseModal = (modal) => {
    const modalId = modal.getAttribute("id");
    document.getElementById(`${modalId}_wrapper`).remove();
};

const handleModal = (elem) => {
    elem.addEventListener("click", async (e) => {
        const response = await fetch(
            `/api/cars/${e.currentTarget.getAttribute("data-id")}`
        );
        if (response.ok) {
            const gameModal = "modal-1";
            const content = await response.text();
            insertmodal(content, gameModal);
            MicroModal.show(gameModal, {
                disableScroll: true,
                disableFocus: true,
                onClose: (modal) => {
                    onCloseModal(modal);
                },
                onShow: (modal) => {
                    document
                        .querySelectorAll(".small-photo > img")
                        .forEach((item) => {
                            item.addEventListener("click", (e) => {
                                document
                                    .querySelector(
                                        ".big-photo > a > img.active"
                                    )
                                    .classList.toggle("active");
                                document
                                    .querySelector(
                                        `.big-photo > a > img[data-key="${e.currentTarget.getAttribute(
                                            "data-key"
                                        )}"]`
                                    )
                                    .classList.toggle("active");
                            });
                        });
                    lightGallery(document.getElementById("lightgallery"), {
                        speed: 500,
                        plugins: [lgZoom, lgThumbnail],
                        closable: true,
                        mobileSettings: {
                            controls: true,
                            showCloseIcon: true,
                        },
                        showCloseIcon: true,
                        //licenseKey: "0000-0000-000-0000",
                        // ... other settings
                    });
                    document
                        .querySelector(".to_contact")
                        .addEventListener("click", () => {
                            MicroModal.close(gameModal);
                            document.getElementById("contacts").scrollIntoView({
                                behavior: "smooth",
                            });
                        });
                },
            });
        }
    });
};

const modalCard = () => {
    document.querySelectorAll(".button-more").forEach((elem) => {
        handleModal(elem);
    });
};

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

                insertmodal(content, modalName);
                MicroModal.show(modalName, {
                    disableScroll: true,
                    onShow: (modal) => {},
                    onClose: (modal) => {
                        onCloseModal(modal);
                    },
                });
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
        } else {
            //elem.innerText = "Категории авто";
        }
    };
    document.querySelector(".select-tagline").addEventListener("click", (e) => {
        document.querySelector(".sticky-header").classList.toggle("active");
        checkTitleHeader(e.currentTarget);
    });
    document.querySelector(".filter-icon").addEventListener("click", (e) => {
        document.querySelector(".sticky-header").classList.toggle("active");
        checkTitleHeader(document.querySelector(".select-tagline"));
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

const toggleArrow = () => {
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
            insertmodal(content, modalName);
            MicroModal.show(modalName, {
                disableScroll: true,
                onClose: (modal) => {
                    onCloseModal(modal);
                },
            });
        }
    });
}

accordion();
filterItems();
modalCard();
initVideoPlugin();
mobileMenu();
selectMobileCategory();
arrowDown();
toggleArrow();
policyModal();