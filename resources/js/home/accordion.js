const accordion = () => {
    const acc = document.getElementsByClassName("accordion");
    let i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function (e) {
            const panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
            panel.classList.toggle('active');
            e.currentTarget.classList.toggle('active')
        });
    }
};
accordion();
