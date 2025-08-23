<template>

    <Head>
        <title>Tambah FAQs − LetStudy</title>
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
                                <Link href="/admin/pages/letstudy/faqs" class="btn-link-myprimary fw-bold pe-3">FAQs</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Tambah FAQs</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0">Tambah Pertanyaan Umum</h1>
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
                                        <h3 class="mb-0">Informasi Umum</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Kategori</label>
                                            <select class="form-select fs-5" required v-model="form.category"
                                                :class="{ 'is-invalid': errors.category }">
                                                <option value="General">General</option>
                                                <option value="Seputar LetStudy">Seputar LetStudy</option>
                                                <option value="Cara Penggunaan">Cara Penggunaan</option>
                                                <option v-for="(product, index) in products" :key="index"
                                                    :value="product.title">{{ product . title }}</option>
                                            </select>
                                            <div v-if="errors.category" class="text-mydanger mt-2">
                                                {{ errors . category }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Status</label>
                                            <div class="btn-group w-100" data-kt-buttons="true"
                                                data-kt-buttons-target="[data-kt-button]">
                                                <label
                                                    class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                    data-kt-button="true"
                                                    :class="{ active: form.status === 'published' }">
                                                    <input class="btn-check" type="radio" v-model="form.status"
                                                        value="published" />
                                                    Terbit
                                                </label>
                                                <label
                                                    class="btn btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                    data-kt-button="true"
                                                    :class="{ active: form.status === 'archived' }">
                                                    <input class="btn-check" type="radio" v-model="form.status"
                                                        value="archived" />
                                                    Arsip
                                                </label>
                                            </div>
                                            <div v-if="errors.status" class="text-mydanger mt-2">
                                                {{ errors . status }}
                                            </div>
                                        </div>
                                        <hr class="mb-5" style="border-color: var(--bs-gray-500);">
                                        <div class="fv-row">
                                            <div class="form-check form-switch form-check-custom form-check-solid gap-4 justify-content-between">
                                                <label class="form-label fs-6 mb-0">Tampilkan sebagai Unggulan</label>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchDefault"
                                                    v-model="form.is_featured" :true-value="true" :false-value="false"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                        <h3 class="mb-0">Konten FAQs</h3>
                                    </div>
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Pertanyaan</label>
                                            <textarea class="form-control fs-5" data-kt-autosize="true" rows="3"
                                                required placeholder="Masukkan pertanyaan disini..."
                                                v-model="form.question" :class="{ 'is-invalid': errors.question }">
                                            </textarea>
                                            <div v-if="errors.question" class="text-mydanger mt-2">
                                                {{ errors . question }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Jawaban</label>
                                            <Editor 
                                                :api-key="TinyMCEApiKey" 
                                                v-model="form.answer" 
                                                :init="editorInit"
                                            />
                                            <div v-if="errors.answer" class="text-mydanger mt-2">
                                                {{ errors . answer }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-7">
                            <Link href="/admin/pages/letstudy/faqs" type="button" class="btn btn-sm btn-mylighten fs-5 me-3">Batal</Link>
                            <button type="submit" id="submit_button"
                                class="btn btn-sm btn-myprimary fs-5">
                                <span class="indicator-label">
                                    Tambah FAQs
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
    import { reactive } from 'vue';
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
            TinyMCEApiKey: String,
            products: Array,
        },

        setup() {
            const form = reactive({
                question: '',
                answer: '',
                category: '',
                status: '',
                is_featured: false
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

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('question', form.question);
                payload.append('answer', form.answer);
                payload.append('category', form.category);
                payload.append('status', form.status);
                payload.append('is_featured', form.is_featured ? '1' : '0'); 

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                router.post('/admin/pages/letstudy/faqs', payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data FAQs Berhasil Disimpan!',
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
