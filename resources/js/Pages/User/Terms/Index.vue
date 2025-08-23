<template>
    <Head>
        <title>Syarat & Ketentuan − LetStudy</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="flex-grow-1">
                <div id="home" class="bg-white">
                    <Navbar />
                    <div class="container d-flex flex-column w-100 w-md-700px w-lg-auto">
                        <div class="d-flex flex-column align-items-center text-center py-10 py-md-20">
                            <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                                Syarat & Ketentuan 📃
                            </h1>
                            <p class="text-center text-gray-600 fs-2 fw-semibold mb-0">
                                Biar semua <span class="text-myprimary fw-bold">jelas</span> dari awal, ini panduan <span class="text-myprimary fw-bold">aturan main</span> di LetStudy.
                            </p>
                        </div>
                    </div>
                </div>
                <div id="terms" class="container d-flex flex-column flex-start py-10 py-md-20">
                    <div id="content-editor" class="fs-4" v-html="legal.content"></div>
                </div>
            </div>

            <Footer :sosmed="sosmed" />

            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <i class="fs-1 ri-arrow-up-double-line"></i>
            </div>
        </div>
    </main>
</template>

<script>
    import Navbar from "../../../Components/Navbar/Home.vue";
    import Footer from "../../../Components/Footer/Home.vue";
    import { Head } from '@inertiajs/vue3';

    export default {
        components: {
            Head,
            Navbar,
            Footer,
        },

        props: {
            legal: Object,
            sosmed: Object,
        },
    };
</script>