import { modalHandlerCard } from "./helper";
import { modal } from "./modal";

const scrollStickiHeader = (elem) => {
    elem.addEventListener("click", async (e) => {
        /** MOBILE */
        document.querySelector(
            ".sticky-header .border .select-tagline-mobile"
        ).innerText = e.currentTarget.innerText;
        /** MOBILE */

        /** MOBILE */
        document
            .querySelector(".section.sticky-header")
            .classList.remove("active");
        /** MOBILE */

        document.querySelector(".products-block").scrollIntoView({
            behavior: "smooth",
        });
    });
};

const createQueryRequest = (filterType, page) => {
    const url = new URL(window.location.href);
    if (page) {
        url.searchParams.set("page", page);
    } else {
        url.searchParams.delete("page");
    }

    if (filterType) {
        url.searchParams.set("filterType", filterType);
    }
    history.replaceState({}, document.title, url.toString());
    return url.search;
};

const buttonMoreListener = (elem) => {
    elem.addEventListener("click", async (e) => {
        const response = await fetch(
            `/api/cars/${e.currentTarget.getAttribute("data-id")}`
        );
        if (response.ok) {
            const content = await response.text();
            const modalName = "modal-1";
            modal(
                modalName,
                content,
                () => {
                    modalHandlerCard(modalName);
                },
                () => {}
            );
        }
    });
};

const removeOldListeners = () => {
    document.querySelectorAll(".card").forEach((item) => item.remove());
    document.querySelectorAll(".paginator  a").forEach((item) => item.remove());
};

const addNewListeners = () => {
    document
        .querySelectorAll(".paginator  a")
        .forEach((item) => handlePaginateItem(item));
    document.querySelectorAll(".card").forEach((elem) => {
        buttonMoreListener(elem);
    });
};

const handleFilterItem = (elem) => {
    elem.addEventListener("click", async (e) => {
        const traget = e.target;
        const type = traget.getAttribute("type");
        const lastCategory = document.querySelector(".categories > .current");
        const newCategory = document.querySelector(
            `.category-item[type="${type}"]`
        );

        lastCategory.classList.toggle("current");
        newCategory.classList.toggle("current");

        const queryRequest = createQueryRequest(type);

        /** MOBILE */
        document.querySelector(".select-tagline__m").innerText =
            traget.innerText;
        document.querySelector(".select-tagline-mobile").innerText =
            traget.innerText;
        /** MOBILE */
        /** MOBILE */
        if (
            document
                .querySelector(".products-block")
                .classList.contains("active")
        ) {
            document
                .querySelector(".select-tagline__m")
                .dispatchEvent(new Event("click"));
        }
        /** MOBILE */

        const response = await fetch(`/api/cars${queryRequest}`);
        if (response.ok) {
            const data = await response.text();
            removeOldListeners();
            document.getElementById("carItems").innerHTML = data;
            addNewListeners();
        }
    });
};

const handlePaginateItem = (elem) => {
    elem.addEventListener("click", async (e) => {
        e.preventDefault();
        const target = e.currentTarget;

        const hrefURL = new URL(target.getAttribute("href"));
        const queryRequest = createQueryRequest(
            hrefURL.searchParams.get("filterType"),
            hrefURL.searchParams.get("page")
        );

        const response = await fetch(`/api/cars${queryRequest}`);
        if (response.ok) {
            const data = await response.text();
            removeOldListeners();
            document.getElementById("carItems").innerHTML = data;
            addNewListeners();
        }
    });
};

const filterItems = () => {
    document
        .querySelectorAll(".category-items > .category-item-th")
        .forEach((item) => handleFilterItem(item));
    document
        .querySelectorAll(".category-items > .category-item-sticky")
        .forEach((item) => {
            scrollStickiHeader(item);
            handleFilterItem(item);
        });
    addNewListeners();
};

filterItems();
