<template>

    <Head>
        <title>Dashboard − LetStudy</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0 mb-2">
                            Dashboard Admin
                        </h1>
                        <p class="fs-4 text-gray-600 m-0">Selamat Datang {{ $page . props . auth . user . name }}</p>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../Layouts/Admin.vue';
    import {
        Head,
    } from '@inertiajs/vue3';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
        },
    };
</script>
