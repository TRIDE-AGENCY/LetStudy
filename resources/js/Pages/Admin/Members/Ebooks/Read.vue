<template>

    <Head>
        <title>Detail E-Book − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/dashboard" class="btn-link-myprimary fw-bold pe-3">Dashboard</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks`" class="btn-link-myprimary fw-bold pe-3">Member Area</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Baca E-Book</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">{{ ebook.title }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <iframe
                        :src="`https://drive.google.com/file/d/${ebook.id_ebook}/preview`"
                        width="100%"
                        style="height: 75vh;"
                        frameborder="0"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../Layouts/Admin.vue';
    import { Head, Link, router } from '@inertiajs/vue3';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            product: Object,
            subProduct: Object,
            ebook: Object,
        },
    }
</script>

<style>

</style>
