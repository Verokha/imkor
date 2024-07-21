import lightGallery from "lightgallery";
import lgThumbnail from "lightgallery/plugins/thumbnail";
import lgZoom from "lightgallery/plugins/zoom";
//import lgVideo from "lightgallery/plugins/video";
import "lightgallery/css/lightgallery-bundle.css";
// import videojs from "video.js";
// window["videojs"] = videojs;
// import "video.js/dist/video-js.css";

const modalHandlerCard = (modalName) => {
    document.querySelectorAll(".small-photo > img").forEach((item) => {
        item.addEventListener("click", (e) => {
            document
                .querySelector(".big-photo > a > img.active")
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
    });
    document.querySelector(".to_contact").addEventListener("click", () => {
        document.getElementById('message').value = document.getElementById(modalName).querySelector('.car_info > .title').innerText
        MicroModal.close(modalName);
        document.getElementById("contacts").scrollIntoView({
            behavior: "smooth",
        });
    });
};

export { modalHandlerCard };
