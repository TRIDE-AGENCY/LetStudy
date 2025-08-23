<template>

    <Head>
        <title>Section Sosial Media − LetStudy</title>
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
                                <Link href="/admin/pages/letstudy" class="btn-link-myprimary fw-bold pe-3">LetStudy</Link>
                            </li>
                            <li class="breadcrumb-item pe-3 text-muted">Sosial Media</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Section Sosial Media</h1>
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
                                        <h3 class="mb-0">Informasi Sosial Media</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola informasi sosial media pada halaman LetStudy
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-instagram-line fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link instagram disini..."
                                                v-model="form.instagram" :class="{ 'is-invalid': errors.instagram }" />
                                        </div>
                                        <div v-if="errors.instagram" class="text-mydanger mt-2">
                                            {{ errors . instagram }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">YouTube</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-youtube-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link youtube disini..."
                                                v-model="form.youtube" :class="{ 'is-invalid': errors.youtube }" />
                                        </div>
                                        <div v-if="errors.youtube" class="text-mydanger mt-2">
                                            {{ errors . youtube }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">TikTok</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-tiktok-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link tiktok disini..."
                                                v-model="form.tiktok" :class="{ 'is-invalid': errors.tiktok }" />
                                        </div>
                                        <div v-if="errors.tiktok" class="text-mydanger mt-2">
                                            {{ errors . tiktok }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">LinkedIn</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-linkedin-box-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link linkedin disini..."
                                                v-model="form.linkedin" :class="{ 'is-invalid': errors.linkedin }" />
                                        </div>
                                        <div v-if="errors.linkedin" class="text-mydanger mt-2">
                                            {{ errors . linkedin }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="form-label fs-6">Twitter / X</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-twitter-x-fill fs-3"></i>
                                            </span>
                                            <input type="text" class="form-control fs-5" placeholder="Masukkan link twitter / x disini..."
                                                v-model="form.x" :class="{ 'is-invalid': errors.x }" />
                                        </div>
                                        <div v-if="errors.x" class="text-mydanger mt-2">
                                            {{ errors . x }}
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
    import { reactive } from 'vue';
    import Swal from 'sweetalert2';

    export default {
        layout: LayoutAdmin,

        components: {
            Head,
            Link,
        },

        props: {
            errors: Object,
            sosmed: Object,
        },

        setup(props) {
            const form = reactive({
                instagram: props.sosmed.instagram ?? '',
                youtube: props.sosmed.youtube ?? '',
                tiktok: props.sosmed.tiktok ?? '',
                linkedin: props.sosmed.linkedin ?? '',
                x: props.sosmed.x ?? '',
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('instagram', form.instagram);
                payload.append('youtube', form.youtube);
                payload.append('tiktok', form.tiktok);
                payload.append('linkedin', form.linkedin);
                payload.append('x', form.x);

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                payload.append('_method', 'PUT');
                router.post(`/admin/pages/letstudy/social-media/${props.sosmed.id}`, payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Sosial Media Berhasil Diperbarui!',
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
