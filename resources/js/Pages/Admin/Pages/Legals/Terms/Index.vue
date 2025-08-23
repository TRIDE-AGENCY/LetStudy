<template>

    <Head>
        <title>Halaman Syarat & Ketentuan − LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Syarat & Ketentuan</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Halaman Syarat & Ketentuan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl px-0">
                    <form @submit.prevent="submit">
                        <div class="card rounded-4 border border-gray-300">
                            <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                <h3 class="required mb-0">Konten Syarat & Ketentuan</h3>
                            </div>
                            <div class="card-body p-6">
                                <div class="fv-row">
                                    <Editor 
                                        :api-key="TinyMCEApiKey" 
                                        v-model="form.content" 
                                        :init="editorInit"
                                    />
                                    <div v-if="errors.content" class="text-mydanger mt-2">
                                        {{ errors . content }}
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
            legal: Object,
            TinyMCEApiKey: String,
        },

        setup(props) {
            const form = reactive({
                content: props.legal.content,
            });

            const editorInit = {
                menubar: false,
                plugins: 'advlist lists link emoticons autoresize',
                toolbar:
                    'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link emoticons',
                style_formats: [
                    { title: 'Paragraf', block: 'p' },
                    { title: 'Judul Besar', block: 'h2' },
                    { title: 'Judul Sedang', block: 'h3' },
                    { title: 'Judul Kecil', block: 'h4' },
                ],
                min_height: 500,
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

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                router.put(`/admin/pages/legal/terms-and-condition/${props.legal.id}`, {
                    content: form.content
                }, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Syarat & Ketentuan Berhasil Diperbarui!',
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
