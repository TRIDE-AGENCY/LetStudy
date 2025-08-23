<template>

    <Head>
        <title>Tambah Tryout − {{ product.title }}</title>
    </Head>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-7 py-lg-8">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ol class="breadcrumb text-muted fs-6 fw-semibold mb-3">
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts`" class="btn-link-myprimary fw-bold pe-3">...</Link>
                            </li>
                            <li class="breadcrumb-item pe-3">
                                <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}`" class="btn-link-myprimary fw-bold pe-3">Detail Tryout</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Tambah Soal</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Tambah Soal</h1>
                            <span class="badge px-3 py-2 fs-5">{{ tryout.title }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="card rounded-4 border border-gray-300">
                            <div class="card-header p-6 d-flex flex-row m-0 border-bottom border-gray-300" style="min-height: unset;">
                                <h3 class="required mb-0">Pertanyaan</h3>
                                <div class="collapsible toggle collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#question-collapse">
                                    <button type="button" class="toggle-off btn btn-link btn-link-myprimary fs-5 fw-bold mb-0 p-0">
                                        Tambah Gambar
                                    </button>
                                    <button type="button" class="toggle-on btn btn-link btn-link-mydanger fs-5 fw-bold mb-0 p-0">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-6">
                                <div class="fv-row">
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.question" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.question" class="text-mydanger mt-2">
                                        {{ errors . question }}
                                    </div>
                                </div>
                                <div id="question-collapse" class="mt-5 fv-row collapse">
                                    <div id="question-dropzone" class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                        <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                            <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                            <div>
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini / klik untuk mengunggah.</h3>
                                                <span class="fs-7 fw-semibold text-gray-400">Maksimal 10 MB</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="errors.question_image" class="text-mydanger mt-2">
                                        {{ errors . question_image }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="card-header p-6 d-flex flex-row m-0 border-bottom border-gray-300" style="min-height: unset;">
                                <h3 class="required mb-0">Pilihan Jawaban</h3>
                            </div>
                            <div class="card-body p-6">
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <span class="input-group-text w-45px d-flex justify-content-center"
                                            id="basic-addon1">A</span>
                                        <input type="text" class="form-control fs-5" v-model="form.option_1"
                                            aria-describedby="basic-addon1" required
                                            placeholder="Masukkan pilihan A disini..."
                                            :class="{ 'is-invalid': errors.option_1 }" />
                                    </div>
                                    <div v-if="errors.option_1" class="text-danger mt-2">
                                        {{ errors . option_1 }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <span class="input-group-text w-45px d-flex justify-content-center"
                                            id="basic-addon1">B</span>
                                        <input type="text" class="form-control fs-5" v-model="form.option_2"
                                            aria-describedby="basic-addon1" required
                                            placeholder="Masukkan pilihan B disini..."
                                            :class="{ 'is-invalid': errors.option_2 }" />
                                    </div>
                                    <div v-if="errors.option_2" class="text-danger mt-2">
                                        {{ errors . option_2 }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <span class="input-group-text w-45px d-flex justify-content-center"
                                            id="basic-addon1">C</span>
                                        <input type="text" class="form-control fs-5" v-model="form.option_3"
                                            aria-describedby="basic-addon1" required
                                            placeholder="Masukkan pilihan C disini..."
                                            :class="{ 'is-invalid': errors.option_3 }" />
                                    </div>
                                    <div v-if="errors.option_3" class="text-danger mt-2">
                                        {{ errors . option_3 }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <span class="input-group-text w-45px d-flex justify-content-center"
                                            id="basic-addon1">D</span>
                                        <input type="text" class="form-control fs-5" v-model="form.option_4"
                                            aria-describedby="basic-addon1" required
                                            placeholder="Masukkan pilihan D disini..."
                                            :class="{ 'is-invalid': errors.option_4 }" />
                                    </div>
                                    <div v-if="errors.option_4" class="text-danger mt-2">
                                        {{ errors . option_4 }}
                                    </div>
                                </div>
                                <div class="fv-row">
                                    <div class="input-group">
                                        <span class="input-group-text w-45px d-flex justify-content-center"
                                            id="basic-addon1">E</span>
                                        <input type="text" class="form-control fs-5" v-model="form.option_5"
                                            aria-describedby="basic-addon1" required
                                            placeholder="Masukkan pilihan E disini..."
                                            :class="{ 'is-invalid': errors.option_5 }" />
                                    </div>
                                    <div v-if="errors.option_5" class="text-danger mt-2">
                                        {{ errors . option_5 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="card-header p-6 d-flex flex-row m-0 border-bottom border-gray-300" style="min-height: unset;">
                                <h3 class="required mb-0">Kunci Jawaban</h3>
                            </div>
                            <div class="card-body p-6">
                                <div class="btn-group w-100" data-kt-buttons="true"
                                    data-kt-buttons-target="[data-kt-button]">
                                    <label
                                        class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                        data-kt-button="true"
                                        :class="{ active: form.answer === '1' }">
                                        <input class="btn-check" type="radio" v-model="form.answer"
                                            value="1" />
                                        A
                                    </label>
                                    <label
                                        class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                        data-kt-button="true"
                                        :class="{ active: form.answer === '2' }">
                                        <input class="btn-check" type="radio" v-model="form.answer"
                                            value="2" />
                                        B
                                    </label>
                                    <label
                                        class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                        data-kt-button="true"
                                        :class="{ active: form.answer === '3' }">
                                        <input class="btn-check" type="radio" v-model="form.answer"
                                            value="3" />
                                        C
                                    </label>
                                    <label
                                        class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                        data-kt-button="true"
                                        :class="{ active: form.answer === '4' }">
                                        <input class="btn-check" type="radio" v-model="form.answer"
                                            value="4" />
                                        D
                                    </label>
                                    <label
                                        class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                        data-kt-button="true"
                                        :class="{ active: form.answer === '5' }">
                                        <input class="btn-check" type="radio" v-model="form.answer"
                                            value="5" />
                                        E
                                    </label>
                                </div>
                                <div v-if="errors.answer" class="text-danger mt-2">
                                    {{ errors . answer }}
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="card-header p-6 d-flex flex-row m-0 border-bottom border-gray-300" style="min-height: unset;">
                                <h3 class="mb-0">Pembahasan</h3>
                                <div class="collapsible toggle collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#explanation-collapse">
                                    <button type="button" class="toggle-off btn btn-link btn-link-myprimary fs-5 fw-bold mb-0 p-0">
                                        Tambah Gambar
                                    </button>
                                    <button type="button" class="toggle-on btn btn-link btn-link-mydanger fs-5 fw-bold mb-0 p-0">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-6">
                                <div class="fv-row">
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.explanation" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.explanation" class="text-mydanger mt-2">
                                        {{ errors . explanation }}
                                    </div>
                                </div>
                                <div id="explanation-collapse" class="mt-5 fv-row collapse">
                                    <div id="explanation-dropzone" class="dropzone border-dashed border-myprimary rounded p-5 text-center">
                                        <div class="dz-message needsclick flex-column text-center gap-5 p-5">
                                            <i class="ri-image-add-line text-myprimary fs-3x"></i>
                                            <div>
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-2">Jatuhkan file di sini / klik untuk mengunggah.</h3>
                                                <span class="fs-7 fw-semibold text-gray-400">Maksimal 10 MB</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="errors.explanation_image" class="text-mydanger mt-2">
                                        {{ errors . explanation_image }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <Link :href="`/admin/${product.slug}/${subProduct.slug}/tryouts/${tryout.slug}`"
                                type="button" class="btn btn-sm btn-mylighten fs-5 me-3">Batal</Link>
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Tambah Soal
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
    import { reactive, onMounted, onUnmounted } from 'vue';
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
            tryout: Object,
            TinyMCEApiKey: String,
        },

        setup(props) {
            const form = reactive({
                question: '',
                question_image: null,
                option_1: '',
                option_2: '',
                option_3: '',
                option_4: '',
                option_5: '',
                answer: '',
                explanation: '',
                explanation_image: null,
            });

            const editorInit = {
                menubar: false,
                plugins: 'advlist lists emoticons autoresize',
                toolbar:
                    'undo redo | bold italic underline | bullist numlist | emoticons',
                block_formats: 'Paragraf=p',
                min_height: 200,
                max_height: 300,
                content_style: `
                    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
                    body {
                        font-family: 'Inter', sans-serif;
                    }
                `
            };

            const createDropzone = (selector, { paramName, onSet, maxSizeMB = 10 }) => {
                return new Dropzone(selector, {
                    url: '/',              
                    paramName,
                    maxFiles: 1,
                    maxFilesize: maxSizeMB,
                    acceptedFiles: 'image/jpeg,image/png,image/jpg,image/webp',
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Hapus',
                    init: function () {
                    this.on('addedfile', (file) => {
                        if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                        }
                        onSet(file);
                    });
                    this.on('removedfile', () => onSet(null));
                    },
                });
            };

            let dzQuestion = null;
            let dzExplanation = null;

            onMounted(() => {
                Dropzone.autoDiscover = false;

                dzQuestion = createDropzone('#question-dropzone', {
                    paramName: 'question_image',
                    onSet: (file) => { form.question_image = file; },
                });

                dzExplanation = createDropzone('#explanation-dropzone', {
                    paramName: 'explanation_image',
                    onSet: (file) => { form.explanation_image = file; },
                });
            });

            onUnmounted(() => {
                if (dzQuestion) { dzQuestion.destroy(); dzQuestion = null; }
                if (dzExplanation) { dzExplanation.destroy(); dzExplanation = null; }
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('question', form.question);
                payload.append('option_1', form.option_1);
                payload.append('option_2', form.option_2);
                payload.append('option_3', form.option_3);
                payload.append('option_4', form.option_4);
                payload.append('option_5', form.option_5);
                payload.append('answer', form.answer);
                payload.append('explanation', form.explanation);
                if (form.question_image && (form.question_image instanceof File || form.question_image instanceof Blob)) {
                    payload.append('question_image', form.question_image);
                }
                if (form.explanation_image && (form.explanation_image instanceof File || form.explanation_image instanceof Blob)) {
                    payload.append('explanation_image', form.explanation_image);
                }

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                router.post(`/admin/${props.product.slug}/${props.subProduct.slug}/tryouts/${props.tryout.slug}/questions`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Soal Berhasil Disimpan!',
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
