<template>

    <Head>
        <title>Member Area − {{ product.title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Member Area</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">{{ product.title }}</h1>
                            <span class="badge px-3 py-2 bg-mysecondary text-myprimary fs-5">{{ subProduct.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <ul class="nav nav-tabs nav-line-tabs mb-8 fs-4">
                        <li class="nav-item">
                            <Link class="nav-link" :href="`/admin/${product.slug}/${subProduct.slug}/ebooks`">E-Book</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="`/admin/${product.slug}/${subProduct.slug}/tryouts`">Tryout</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link active" href="#">Playlist</Link>
                        </li>
                    </ul>
                    <div class="d-flex flex-grow gap-4 flex-column flex-sm-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3x fs-md-2x mb-1">Belajar Lewat Video ✨</h1>
                            <p class="text-gray-600 fs-4 mb-0">
                                Tingkatkan pemahamanmu lewat video pilihan terbaik.
                            </p>
                        </div>
                        <Link :href="`/admin/${product.slug}/${subProduct.slug}/playlists/create`"
                            class="w-100 w-sm-auto btn btn-sm btn-myprimary fs-5 align-self-end white-space-nowrap">
                            Tambah Playlist
                        </Link>
                    </div>
                    <div class="row g-6">
                        <div class="text-center py-10" v-if="playlists.data.length === 0">
                            <img src="/assets/media/illustrations/empty.png"
                                alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                            <h2 class="text-dark mb-4">Belum Ada Playlist</h2>
                            <p class="text-gray-600 fs-4 mb-0">Silakan tambahkan playlist baru untuk akses belajar.</p>
                        </div>
                        <div v-else v-for="playlist in playlists.data" :key="playlist.id" class="col-12 col-md-6 col-xxl-4">
                            <div class="card card-hover rounded-4 border border-gray-300 h-100">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/playlists/${playlist.id_playlist}`" class="h-100" type="button">
                                    <div class="card-body d-flex flex-column justify-content-between h-100 p-7 gap-2">
                                        <div class="d-flex flex-column">
                                            <div class="overflow-hidden position-relative rounded ratio ratio-16x9 mb-6">
                                                <img class="object-fit-cover"
                                                    :src="`/storage/${playlist.thumbnail}`" :alt="`Thumbnail ${playlist.title}`">
                                            </div>
                                            <p class="text-dark fs-1 fs-lg-2 fw-bold mb-0 text-truncate-3">{{ playlist.title }}</p>
                                        </div>
                                        <p class="fs-5 text-gray-600 m-0">10 Video</p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
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
            playlists: Object,
        },
    }
</script>

<style>

</style>
