<template>

    <Head>
        <title>Section Banner − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/dashboard" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/pages/products/${product.slug}`" class="btn-link-myprimary fw-bold pe-3">{{ product.title }}</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Banner</li>
                        </ol>
                        <div class="page-name">
                            <h1 class="mb-0 text-dark">Section Banner</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="card rounded-4 border border-gray-300">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-0" style="min-height: unset;">
                                        <h3 class="mb-0">Banner Produk</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola banner yang tampil di awal halaman produk 
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Gambar Banner</label>
                                        <div id="banner-dropzone"
                                            class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                            <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                <div>
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini /
                                                        klik untuk mengunggah.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Maks. 10 MB • Rasio 1:1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="errors.image" class="text-mydanger mt-2">
                                            {{ errors . image }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Heading</label>
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="3" required
                                            placeholder="Masukkan heading disini..." v-model="form.heading"
                                            :class="{ 'is-invalid': errors.heading }">
                                        </textarea>
                                        <div v-if="errors.heading" class="text-mydanger mt-2">
                                            {{ errors . heading }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label fs-6">Sub Heading</label>
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                            placeholder="Masukkan sub heading disini..." v-model="form.sub_heading"
                                            :class="{ 'is-invalid': errors.sub_heading }">
                                        </textarea>
                                        <div v-if="errors.sub_heading" class="text-mydanger mt-2">
                                            {{ errors . sub_heading }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Simpan Perubahan
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
    import LayoutAdmin from '../../../../../Layouts/Admin.vue';
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, onMounted } from 'vue';
    import Dropzone from 'dropzone';
    import Swal from 'sweetalert2';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            errors: Object,
            banner: Object,
            product: Object
        },

        setup(props) {
            const form = reactive({
                heading: props.banner.heading,
                sub_heading: props.banner.sub_heading,
                image: null,
            });

            onMounted(() => {
                const dz = new Dropzone('#banner-dropzone', {
                    url: '/', 
                    paramName: 'image',
                    maxFiles: 1,
                    maxFilesize: 10,
                    acceptedFiles: 'image/jpeg,image/png',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Hapus',
                    init: function () {
                        this.on('addedfile', function (file) {
                            form.image = file;
                        });
                        this.on('removedfile', function () {
                            form.image = null;
                        });

                        if (props.banner.image) {
                            const mockFile = {
                                name: props.banner.image_name ?? 'Gambar Banner',
                                size: props.banner.image_size ?? 12345
                            };
                            this.emit('addedfile', mockFile);
                            this.emit('thumbnail', mockFile, `/storage/${props.banner.image}`);
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
                payload.append('heading', form.heading);
                payload.append('sub_heading', form.sub_heading);
                if (form.image && (form.image instanceof File || form.image instanceof Blob)) {
                    payload.append('image', form.image);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/pages/products/${props.product.slug}/banner/${props.banner.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Banner Berhasil Diperbarui!',
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

            return {
                form,
                submit,
            };
        }
    }
</script>

<style>

</style>
