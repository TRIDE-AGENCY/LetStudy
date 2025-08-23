<template>

    <Head>
        <title>Edit Tutor − LetStudy</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/pages/letstudy" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link href="/admin/pages/letstudy/tutors" class="btn-link-myprimary fw-bold pe-3">Tutor</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Edit Tutor</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0">Edit Tutor</h1>
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
                                        <h3 class="mb-0">Data Tutor</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Foto Profil</label>
                                            <div id="tutor-dropzone"
                                                class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                                <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                                    <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                                    <div>
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini /
                                                            klik untuk mengunggah.</h3>
                                                        <span class="fs-7 fw-semibold text-gray-400">Maks. 10 MB • Rasio 3:4</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="errors.photo" class="text-mydanger mt-2">
                                                {{ errors . photo }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Nama</label>
                                            <input type="text" class="form-control fs-5" v-model="form.name" required
                                                placeholder="Masukkan nama disini..."
                                                :class="{ 'is-invalid': errors.name }" />
                                            <div v-if="errors.name" class="text-mydanger mt-2">
                                                {{ errors . name }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Pendidikan</label>
                                            <input type="text" class="form-control fs-5" v-model="form.education" required
                                                placeholder="Masukkan pendidikan disini..."
                                                :class="{ 'is-invalid': errors.education }" />
                                            <div v-if="errors.education" class="text-mydanger mt-2">
                                                {{ errors . education }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-0">Detail Tutor</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">E-Book</label>
                                            <select class="form-select fs-5" required v-model="form.ebook_id"
                                                :class="{ 'is-invalid': errors.ebook_id }">
                                                <option v-for="(ebook, index) in ebooks" :key="index"
                                                    :value="ebook.id">{{ ebook . title }}</option>
                                            </select>
                                            <div v-if="errors.ebook_id" class="text-mydanger mt-2">
                                                {{ errors . ebook_id }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Topik / Subtopik / Subtes</label>
                                            <input type="text" class="form-control fs-5" v-model="form.title" required
                                                placeholder="Masukkan topik disini..."
                                                :class="{ 'is-invalid': errors.title }" />
                                            <div v-if="errors.title" class="text-mydanger mt-2">
                                                {{ errors . title }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Pencapaian Tutor</label>
                                            <Editor 
                                                :api-key="TinyMCEApiKey" 
                                                v-model="form.achievement" 
                                                :init="editorInit"
                                            />
                                            <div v-if="errors.achievement" class="text-mydanger mt-2">
                                                {{ errors . achievement }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <Link href="/admin/pages/letstudy/tutors" type="button" class="btn btn-sm btn-mylighten fs-5 me-3">Batal</Link>
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Edit Tutor
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
            tutor: Object,
            TinyMCEApiKey: String,
            ebooks: Array,
        },

        setup(props) {
            const form = reactive({
                ebook_id: props.tutor.ebook_id,
                name: props.tutor.name,
                title: props.tutor.title,
                education: props.tutor.education,
                photo: null,
                achievement: props.tutor.achievement
            });

            const editorInit = {
                menubar: false,
                plugins: 'advlist lists link emoticons autoresize',
                toolbar:
                    'undo redo | bold italic | bullist numlist | link emoticons',
                style_formats: [
                    { title: 'Paragraf', block: 'p' },
                ],
                min_height: 300,
                max_height: 400,
                content_style: `
                    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
                    body {
                        font-family: 'Inter', sans-serif;
                    }
                `
            };

            onMounted(() => {
                const dz = new Dropzone('#tutor-dropzone', {
                    url: '/', 
                    paramName: 'photo',
                    maxFiles: 1,
                    maxFilesize: 10,
                    acceptedFiles: 'image/jpeg,image/png',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Hapus',
                    init: function () {
                        this.on('addedfile', function (file) {
                            form.photo = file;
                        });
                        this.on('removedfile', function () {
                            form.photo = null;
                        });

                        if (props.tutor.photo) {
                            const mockFile = {
                                name: props.tutor.photo_name ?? 'Foto Profil',
                                size: props.tutor.photo_size ?? 12345
                            };
                            this.emit('addedfile', mockFile);
                            this.emit('thumbnail', mockFile, `/storage/${props.tutor.photo}`);
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
                payload.append('ebook_id', form.ebook_id);
                payload.append('name', form.name);
                payload.append('title', form.title);
                payload.append('education', form.education);
                payload.append('achievement', form.achievement);
                if (form.photo && (form.photo instanceof File || form.photo instanceof Blob)) {
                    payload.append('photo', form.photo);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/pages/letstudy/tutors/${props.tutor.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Tutor Berhasil Diperbarui!',
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
                editorInit,
                submit,
            };
        }
    }
</script>

<style>

</style>
