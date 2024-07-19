import { handleModal } from "./modal";

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

        const url = new URL(window.location.href);
        url.searchParams.delete("page");
        url.searchParams.set("filterType", type);
        history.replaceState({}, document.title, url.toString());

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

const filterItems = () => {
    document
        .querySelectorAll(".category-item")
        .forEach((item) => handleFilterItem(item));
    document
        .querySelectorAll(".category-items > .category-item-sticky")
        .forEach((item) => {
            scrollStickiHeader(item);
            handleFilterItem(item);
        });
    document
        .querySelectorAll(".paginator  a")
        .forEach((item) => handlePaginateItem(item));
};

filterItems();
