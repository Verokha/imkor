import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/scss/base.scss",
                "resources/js/base.js",
                "resources/js/home/index.js",
                "resources/js/home/accordion.js",
                "resources/js/home/car-item.js",
                "resources/js/home/swipper.js",
                "resources/scss/modal.scss",
                "resources/scss/swiper-bundle.min.css",
                "resources/scss/сongratulation.scss",
                "resources/scss/policy.scss",
            ],
            refresh: true,
        }),
    ],
    // resolve: {
    //     alias: {
    //         $static: resolve("./public/static"),
    //     },
    // },
});
