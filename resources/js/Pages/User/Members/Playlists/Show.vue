<template>

    <Head>
        <title>Detail Playlist − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/member-area/" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/member-area/${product.slug}/${subProduct.slug}/playlists`" class="btn-link-myprimary fw-bold pe-3">Produk</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Detail Playlist</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Detail Playlist</h1>
                            <span class="badge px-3 py-2 fs-5">{{ subProduct.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="d-flex flex-grow gap-6 flex-column flex-md-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3qx fs-md-2qx mb-3">{{ playlist.title }}</h1>
                            <p class="fs-4 text-gray-600 m-0">Terdapat {{ playlist.playlist_videos.length }} video dalam playlist ini</p>
                        </div>
                    </div>
                    <div class="row g-8">
                        <div class="col-md-4">
                            <div class="ratio ratio-16x9 rounded-4 mb-6 border border-gray-300 overflow-hidden">
                                <img class="w-100 object-fit-cover"
                                    :src="`/storage/${playlist.thumbnail}`"
                                    :alt="`Thumbnail ${playlist.title}`">
                            </div>
                            <a :href="`https://www.youtube.com/playlist?list=${playlist.id_playlist}`"
                                target="_blank"
                                class="w-100 btn btn-sm btn-mydanger-solid fs-5 mb-6">
                                Lihat di Youtube
                            </a>
                            <p class="text-dark mb-0 fs-5" id="content-editor"
                                v-html="playlist.description">
                            </p>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex flex-column gap-4">
                                <div v-if="playlist.playlist_videos.length === 0"
                                    class="bg-white rounded-4 border border-gray-300 text-center py-10 px-6">
                                    <img src="/assets/media/illustrations/empty.png"
                                        alt="Tidak ada data" class="mh-225px img-fluid mb-10">
                                    <h2 class="text-dark mb-4">Video Belum Tersedia</h2>
                                    <p class="text-gray-600 fs-4 mb-0">Belum ada video dari playlist yang tersedia.</p>
                                </div>
                                <Link v-else v-for="(playlist_video, index) in playlist.playlist_videos" :key="index"
                                    :href="`/member-area/${product.slug}/${subProduct.slug}/playlists/${playlist.id_playlist}/videos/${playlist_video.id_video}`"  
                                    class="card card-hover rounded-4 border border-gray-300">
                                    <div class="card-body d-flex flex-row p-7 gap-7 align-items-center">
                                        <div class="w-25px text-dark fw-bold mb-0 fs-3 text-end flex-shrink-0">{{ index + 1 }}</div>
                                        <div class="ratio ratio-16x9 w-150px w-md-175px rounded overflow-hidden flex-shrink-0">
                                            <img class="object-fit-cover w-100 h-100"
                                                :src="`/storage/${playlist_video.thumbnail}`"
                                                :alt="`Thumbnail ${playlist_video.title}`">
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <h2 class="text-dark lh-base fs-2 mb-0 text-truncate-1">{{ playlist_video.title }}</h2>
                                            <p class="text-gray-600 fs-5 mb-0 mt-3 text-truncate-2">
                                                {{ stripTags(playlist_video.description) || 'Tidak ada deskripsi video' }}
                                            </p>
                                        </div>
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
    import LayoutUser from '../../../../Layouts/User.vue';
    import { Head, Link, router } from '@inertiajs/vue3';

    export default {
        layout: LayoutUser,

        components: {
            Head,
            Link,
        },

        props: {
            product: Object,
            subProduct: Object,
            playlist: Object,
        },

        setup() {
            const stripTags = (html) => {
                const div = document.createElement("div");
                div.innerHTML = html;
                return div.textContent || div.innerText || "";
            };

            return {
                stripTags,
            }
        }
    }
</script>

<style>

</style>
