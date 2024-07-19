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

export { handleModal };
