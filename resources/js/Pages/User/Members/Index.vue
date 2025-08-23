<template>

    <Head>
        <title>Member Area − LetStudy</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0 mb-2">
                            Member Area
                        </h1>
                        <p class="fs-4 text-gray-600 m-0">Selamat Datang {{ $page . props . auth . user . name }}</p>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid pb-12">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="bg-gradient-myprimary rounded-4 p-8 p-md-14 position-relative mb-7">
                        <p class="text-white fw-semibold fs-4 mb-2" style="letter-spacing: 0.04em;">
                            #YOURSTUDYPARTNER
                        </p>
                        <h2 class="text-white lh-sm fs-3x fw-bold mb-4 mb-md-6">
                            LetStudy Teman Belajar Tanpa Batas
                        </h2> 
                        <p class="text-white fs-4 mb-0 opacity-75">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                        </p>
                    </div>

                    <div class="row g-6">
                        <div class="col-12 col-md-4">
                            <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                                <div class="d-flex rounded bg-mysecondary mb-7">
                                    <i class="p-6 fs-2tx text-mysecondary ri-book-open-fill"></i>
                                </div>
                                <h2 class="text-dark lh-sm fs-2tx mb-5">E-Book</h2>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mysecondary ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                                <div class="d-flex rounded bg-mywarning-light mb-7">
                                    <i class="p-6 fs-2tx text-mywarning ri-survey-fill"></i>
                                </div>
                                <h2 class="text-dark lh-sm fs-2tx mb-5">Tryout</h2>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mywarning ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card card-hover h-100 p-8 align-items-start rounded-4 border border-gray-300">
                                <div class="d-flex rounded bg-mydanger-light mb-7">
                                    <i class="p-6 fs-2tx text-mydanger ri-folder-video-fill"></i>
                                </div>
                                <h2 class="text-dark lh-sm fs-2tx mb-5">Playlist</h2>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mydanger ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mydanger ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="fs-4 mt-1 text-mydanger ri-checkbox-circle-fill"></i>
                                        <p class="text-gray-600 fs-4 mb-0">
                                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutUser from '../../../Layouts/User.vue';
    import {
        Head,
        Link
    } from '@inertiajs/vue3';

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link
        },
    };
</script>
