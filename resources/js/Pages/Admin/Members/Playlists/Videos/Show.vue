<template>

    <Head>
        <title>Detail Video − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/playlists`" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/playlists/${playlist.id_playlist}`" class="btn-link-myprimary fw-bold pe-3">Detail Playlist</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Detail Video</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Detail Video</h1>
                            <span class="badge px-3 py-2 fs-5">{{ playlist.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <div class="d-flex flex-grow gap-6 flex-column flex-md-row mb-8">
                        <div class="flex-grow-1">
                            <h1 class="text-dark lh-base fs-3qx fs-md-2qx mb-3">{{ playlistVideo.title }}</h1>
                            <p class="fs-4 text-gray-600 m-0">{{ index + 1 }} dari {{ playlist.playlist_videos.length }} video di playlist {{ playlist.title }}</p>
                        </div>
                        <div class="d-flex gap-4">
                            <Link :href="`/admin/${product.slug}/${subProduct.slug}/playlists/${playlist.id_playlist}/videos/${playlistVideo.id_video}/edit`"
                                class="w-100 w-md-auto btn btn-sm btn-mysecondary fs-5 align-self-end white-space-nowrap">
                                Edit Video
                            </Link>
                            <a :href="`https://www.youtube.com/watch?v=${playlistVideo.id_video}&list=${playlist.id_playlist}&index={{ index + 1 }}`"
                                target="_blank"
                                class="w-100 w-md-auto btn btn-sm btn-mydanger-solid fs-5 align-self-end white-space-nowrap">
                                Lihat di Youtube
                            </a>
                        </div>
                    </div>
                    <div class="rounded-4 overflow-hidden">
                        <div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0;">
                            <iframe
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                :src="`https://www.youtube.com/embed/${playlistVideo.id_video}`"
                                :title="`YouTube ${playlistVideo.title}`"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    <p class="text-dark mb-0 mt-8 fs-5" id="content-editor"
                        v-html="playlistVideo.description">
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../../Layouts/Admin.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { computed } from 'vue';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            product: Object,
            subProduct: Object,
            playlist: Object,
            playlistVideo: Object,
        },

        setup(props) {
            const index = computed(() => {
                return props.playlist.playlist_videos.findIndex(
                    video => video.id_video === props.playlistVideo.id_video
                );
            });

            return { index };
        }
    }

    
</script>

<style>

</style>
