<template>

    <Head>
        <title>Edit E-Book − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks`" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/ebooks/${ebook.slug}`" class="btn-link-myprimary fw-bold pe-3">Detail E-Book</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Edit E-Book</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Edit E-Book</h1>
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
                                        <h3 class="mb-0">Data E-Book</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Judul</label>
                                            <input type="text" class="form-control fs-5" v-model="form.title"
                                                required placeholder="Masukkan judul disini..."
                                                :class="{ 'is-invalid': errors.title }" />
                                            <div v-if="errors.title" class="text-mydanger mt-2">
                                                {{ errors . title }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">ID E-Book</label>
                                            <input type="text" class="form-control fs-5" v-model="form.id_ebook"
                                                required placeholder="Masukkan ID google drive disini..."
                                                :class="{ 'is-invalid': errors.id_ebook }" />
                                            <div v-if="errors.id_ebook" class="text-mydanger mt-2">
                                                {{ errors . id_ebook }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Link Unduh E-Book</label>
                                            <input type="text" class="form-control fs-5" v-model="form.id_form"
                                                required placeholder="Masukkan link unduh e-book disini..."
                                                :class="{ 'is-invalid': errors.id_form }" />
                                            <div v-if="errors.id_form" class="text-mydanger mt-2">
                                                {{ errors . id_form }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Tanggal Rilis</label>
                                            <input class="form-control fs-5" v-model="form.launch_date" required
                                                placeholder="Pilih tanggal rilis disini..." id="kt_datepicker_1"
                                                :class="{ 'is-invalid': errors.launch_date }" />
                                            <div v-if="errors.launch_date" class="text-mydanger mt-2">
                                                {{ errors . launch_date }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Jumlah Halaman</label>
                                            <div class="input-group fs-5">
                                                <input type="number" class="form-control" v-model="form.total_pages" aria-describedby="basic-addon2"
                                                    required placeholder="Masukkan jumlah hal disini..." :class="{ 'is-invalid': errors.total_pages }"/>
                                                <span class="input-group-text" id="basic-addon2">Halaman</span>
                                            </div>
                                            <div v-if="errors.total_pages" class="text-danger mt-2">
                                                {{ errors . total_pages }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4 border border-gray-300 mt-6">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="required mb-0">Sampul E-Book</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div id="ebook-dropzone" class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                            <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                <div>
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini / klik untuk mengunggah.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Maksimal 10 MB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="errors.image" class="text-mydanger mt-2">
                                            {{ errors . image }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="required mb-0">Deskripsi E-Book</h3>
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
                                <div class="card rounded-4 border border-gray-300 mt-6">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="required mb-0">Benefit E-Book</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="fv-row">
                                            <Editor 
                                                :api-key="TinyMCEApiKey" 
                                                v-model="form.benefit" 
                                                :init="editorInit"
                                            />
                                            <div v-if="errors.benefit" class="text-mydanger mt-2">
                                                {{ errors . benefit }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <button @click.prevent="destroy(ebook.slug)"
                                class="btn btn-sm btn-mydanger fs-5 me-3">
                                Hapus E-Book
                            </button>
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Edit E-Book
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
            ebook: Object,
            TinyMCEApiKey: String,
        },

        setup(props) {
            const form = reactive({
                title: props.ebook.title,
                id_ebook: props.ebook.id_ebook,
                id_form: props.ebook.id_form,
                launch_date: props.ebook.launch_date,
                total_pages: props.ebook.total_pages,
                image: null,
                description: props.ebook.description,
                benefit: props.ebook.benefit,
            });

            const editorInit = {
                menubar: false,
                plugins: 'advlist lists link emoticons autoresize',
                toolbar:
                    'undo redo | bold italic underline | bullist numlist | link emoticons',
                block_formats: 'Paragraf=p',
                min_height: 320,
                max_height: 600,
                content_style: `
                    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
                    body {
                        font-family: 'Inter', sans-serif;
                    }
                `
            };

            onMounted(() => {
                flatpickr("#kt_datepicker_1", {
                    enableTime: false,
                    dateFormat: "Y-m-d",
                });

                const dz = new Dropzone('#ebook-dropzone', {
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

                        if (props.ebook.image) {
                            const mockFile = {
                                name: props.ebook.image_name ?? 'Sampul E-Book',
                                size: props.ebook.image_size ?? 12345
                            };
                            this.emit('addedfile', mockFile);
                            this.emit('thumbnail', mockFile, `/storage/${props.ebook.image}`);
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
                payload.append('id_ebook', form.id_ebook);
                payload.append('id_form', form.id_form);
                payload.append('launch_date', form.launch_date);
                payload.append('total_pages', form.total_pages);
                payload.append('description', form.description);
                payload.append('benefit', form.benefit);
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
                router.post(`/admin/${props.product.slug}/${props.subProduct.slug}/ebooks/${props.ebook.slug}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data E-Book Berhasil Diperbarui!',
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

            const destroy = (slug) => {
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
                        router.delete(`/admin/${props.product.slug}/${props.subProduct.slug}/ebooks/${props.ebook.slug}`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Data E-Book Berhasil Dihapus!',
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
