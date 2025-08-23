<template>

    <Head>
        <title>Edit Playlist − {{ product.title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Edit Playlist</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Edit Playlist</h1>
                            <span class="badge px-3 py-2 fs-5">{{ subProduct.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="row g-6">
                            <div class="col-md-4">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-0">Data Playlist</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Nama</label>
                                            <textarea class="form-control fs-5" data-kt-autosize="true" rows="5"
                                                placeholder="Masukkan nama playlist disini..." v-model="form.title"
                                                :class="{ 'is-invalid': errors.title }" required>
                                            </textarea>
                                            <div v-if="errors.title" class="text-mydanger mt-2">
                                                {{ errors . title }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">ID Playlist</label>
                                            <input type="text" class="form-control fs-5" v-model="form.id_playlist"
                                                required placeholder="Masukkan ID playlist youtube disini..."
                                                :class="{ 'is-invalid': errors.id_playlist }" />
                                            <div v-if="errors.id_playlist" class="text-mydanger mt-2">
                                                {{ errors . id_playlist }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="required mb-0">Thumbnail Playlist</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div id="playlist-dropzone" class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                            <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                <div>
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini / klik untuk mengunggah.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Maksimal 10 MB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="errors.thumbnail" class="text-mydanger mt-2">
                                            {{ errors . thumbnail }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4 border border-gray-300 mt-6">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-0">Deskripsi Playlist</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="fv-row">
                                            <Editor 
                                                :api-key="TinyMCEApiKey" 
                                                v-model="form.description" 
                                                :init="editorInit"
                                            />
                                            <div v-if="errors.description" class="text-mydanger mt-2">
                                                {{ errors . description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <button @click.prevent="destroy(playlist.id_playlist)"
                                class="btn btn-sm btn-mydanger fs-5 me-3">
                                Hapus Playlist
                            </button>
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Edit Playlist
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutAdmin from '../../../../Layouts/Admin.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, onMounted, watch } from 'vue';
    import Dropzone from 'dropzone';
    import Swal from 'sweetalert2';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
            Editor
        },

        props: {
            errors: Object,
            product: Object,
            subProduct: Object,
            playlist: Object,
            TinyMCEApiKey: String,
        },

        setup(props) {
            const form = reactive({
                title: props.playlist.title,
                id_playlist: props.playlist.id_playlist,
                thumbnaill: null,
                description: props.playlist.description ?? '',
            });

            const editorInit = {
                menubar: false,
                plugins: 'advlist lists link emoticons autoresize',
                toolbar:
                    'undo redo | bold italic underline | bullist numlist | link emoticons',
                block_formats: 'Paragraf=p',
                min_height: 300,
                max_height: 600,
                content_style: `
                    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
                    body {
                        font-family: 'Inter', sans-serif;
                    }
                `
            };

            onMounted(() => {
                const dz = new Dropzone('#playlist-dropzone', {
                    url: '/', 
                    paramName: 'thumbnail',
                    maxFiles: 1,
                    maxFilesize: 10,
                    acceptedFiles: 'image/jpeg,image/png',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Hapus',
                    init: function () {
                        this.on('addedfile', function (file) {
                            form.thumbnail = file;
                        });
                        this.on('removedfile', function () {
                            form.thumbnail = null;
                        });

                        if (props.playlist.thumbnail) {
                            const mockFile = {
                                name: props.playlist.thumbnail_name ?? 'Thumbnail Playlist',
                                size: props.playlist.thumbnail_size ?? 12345
                            };
                            this.emit('addedfile', mockFile);
                            this.emit('thumbnail', mockFile, `/storage/${props.playlist.thumbnail}`);
                            this.emit('complete', mockFile);
                            mockFile.previewElement.classList.add('dz-success', 'dz-complete');
                        }
                    },
                });
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('title', form.title);
                payload.append('id_playlist', form.id_playlist);
                payload.append('description', form.description);
                if (form.thumbnail && (form.thumbnail instanceof File || form.thumbnail instanceof Blob)) {
                    payload.append('thumbnail', form.thumbnail);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/${props.product.slug}/${props.subProduct.slug}/playlists/${props.playlist.id_playlist}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Playlist Berhasil Diperbarui!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            }
                        });
                    },
                    onFinish: cleanup
                });
            }

            const destroy = (id) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    showCancelButton: true,
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    customClass: {
                        popup: 'swal-custom-icon',
                        confirmButton: "btn btn-sm btn-myprimary",
                        cancelButton: "btn btn-sm btn-mydanger"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        router.delete(`/admin/${props.product.slug}/${props.subProduct.slug}/playlists/${props.playlist.id_playlist}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data Playlist Berhasil Dihapus!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            }
                        });
                    }
                })
            };

            return {
                form,
                editorInit,
                submit,
                destroy
            };
        }
    }
</script>

<style>

</style>
