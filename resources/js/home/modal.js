import MicroModal from "micromodal";

const insertmodal = (content, modalName) => {
    const footerElem = document.querySelector("footer");
    if (footerElem) {
        footerElem.insertAdjacentHTML(
            "afterend",
            `<div id="${modalName}_wrapper">${content}</div>`
        );
    }
};

const onCloseModal = (modal) => {
    const modalId = modal.getAttribute("id");
    document.getElementById(`${modalId}_wrapper`)?.remove();
};

const modal = (modalName, content, funcOnShow, funcOnClose) => {
    insertmodal(content, modalName);
    MicroModal.show(modalName, {
        disableScroll: true,
        disableFocus: true,
        onClose: (modal) => {
            onCloseModal(modal);
            if (funcOnClose) {
                funcOnClose();
            }
        },
        onShow: (modal) => {
            if (funcOnShow) {
                funcOnShow();
            }
        },
    });
};

export { modal };
