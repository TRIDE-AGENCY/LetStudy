<template>

    <Head>
        <title>Edit Tryout − {{ product.title }}</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Edit Soal</li>
                        </ol>
                        <div class="page-heading d-flex flex-wrap gap-3 align-items-center">
                            <h1 class="mb-0 text-dark">Edit Soal</h1>
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
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="card-header p-6 d-flex flex-row m-0 border-bottom border-gray-300" style="min-height: unset;">
                                <h3 class="mb-0">Pilihan Jawaban</h3>
                            </div>
                            <div class="card-body p-6">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label fs-6">Pilihan A</label>
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.option_1" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.option_1" class="text-mydanger mt-2">
                                        {{ errors . option_1 }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label class="required form-label fs-6">Pilihan B</label>
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.option_2" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.option_2" class="text-mydanger mt-2">
                                        {{ errors . option_2 }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label class="required form-label fs-6">Pilihan C</label>
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.option_3" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.option_3" class="text-mydanger mt-2">
                                        {{ errors . option_3 }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label class="required form-label fs-6">Pilihan D</label>
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.option_4" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.option_4" class="text-mydanger mt-2">
                                        {{ errors . option_4 }}
                                    </div>
                                </div>
                                <div class="mb-5 fv-row">
                                    <label class="required form-label fs-6">Pilihan E</label>
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.option_5" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.option_5" class="text-mydanger mt-2">
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
                                <div v-if="errors.answer" class="text-mydanger mt-2">
                                    {{ errors . answer }}
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="card-header p-6 d-flex flex-row m-0 border-bottom border-gray-300" style="min-height: unset;">
                                <h3 class="mb-0">Pembahasan</h3>
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
    import { reactive, onMounted, onUnmounted, ref, watch, nextTick } from 'vue';
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
            question: Object,
            TinyMCEApiKey: String,
        },

        setup(props) {
            const form = reactive({
                question: props.question.question,
                option_1: props.question.option_1,
                option_2: props.question.option_2,
                option_3: props.question.option_3,
                option_4: props.question.option_4,
                option_5: props.question.option_5,
                answer: props.question.answer.toString(),
                explanation: props.question.explanation ?? '',
            });

            const editorInit = {
                menubar: false,
                plugins: 'advlist lists emoticons autoresize image',
                toolbar: 'undo redo | bold italic underline | bullist numlist | image emoticons',
                block_formats: 'Paragraf=p',
                min_height: 200,
                max_height: 600,
                paste_data_images: true,
                automatic_uploads: true,
                images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                    try {
                    const mime = blobInfo.blob().type || 'image/png';
                    const dataUrl = `data:${mime};base64,${blobInfo.base64()}`;
                    resolve(dataUrl); 
                    } catch (e) {
                    reject('Gagal mengubah gambar ke base64');
                    }
                }),

                file_picker_types: 'image',
                file_picker_callback: (cb, value, meta) => {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/*';

                    input.onchange = () => {
                        const file = input.files?.[0];
                        if (!file) return;

                        const reader = new FileReader();
                        reader.onload = () => {
                            cb(reader.result, { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
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
                payload.append('option_1', form.option_1);
                payload.append('option_2', form.option_2);
                payload.append('option_3', form.option_3);
                payload.append('option_4', form.option_4);
                payload.append('option_5', form.option_5);
                payload.append('answer', form.answer);
                payload.append('explanation', form.explanation);

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/${props.product.slug}/${props.subProduct.slug}/tryouts/${props.tryout.slug}/questions/${props.question.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Soal Berhasil Diperbarui!',
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
