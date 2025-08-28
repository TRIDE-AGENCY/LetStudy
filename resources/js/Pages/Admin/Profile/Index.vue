<template>

    <Head>
        <title>Profil LetStudy</title>
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
                            <li class="breadcrumb-item pe-3 text-muted">Profil LetStudy</li>
                        </ol>
                        <div class="page-heading">
                            <h1 class="mb-0 text-dark">Profil LetStudy</h1>
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
                                        <h3 class="mb-0">Tentang LetStudy</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola narasi yang tampil di halaman Tentang 
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="fv-row">
                                        <label class="required form-label fs-6">Tentang</label>
                                        <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                            placeholder="Masukkan tentang letstudy disini..." v-model="form.about"
                                            :class="{ 'is-invalid': errors.about }">
                                        </textarea>
                                        <div v-if="errors.about" class="text-mydanger mt-2">
                                            {{ errors . about }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-4 border border-gray-300 mt-6">
                            <div class="row align-items-start m-0">
                                <div class="col-12 col-md-4 col-xl-3 p-0">
                                    <div class="card-header p-6 d-flex flex-column m-0 border-0" style="min-height: unset;">
                                        <h3 class="mb-0">Informasi Kontak</h3>
                                        <p class="fs-5 d-none d-md-block text-gray-600 mt-2 mb-0 fw-normal">
                                            Mengelola informasi kontak pada halaman LetStudy
                                        </p>
                                    </div>
                                </div>
                                <div class="d-md-none border-bottom border-gray-300"></div>
                                <div class="col-12 col-md-8 col-xl-9 card-body p-6">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Nomor Telepon</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-phone-fill fs-3"></i>
                                            </span>
                                            <input type="text" required class="form-control fs-5" placeholder="Masukkan nomor telepon disini..."
                                                v-model="form.phone" :class="{ 'is-invalid': errors.phone }" />
                                        </div>
                                        <div v-if="errors.phone" class="text-mydanger mt-2">
                                            {{ errors . phone }}
                                        </div>
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="form-label fs-6">Alamat Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-mail-fill fs-3"></i>
                                            </span>
                                            <input type="text" required class="form-control fs-5" placeholder="Masukkan alamat email disini..."
                                                v-model="form.email" :class="{ 'is-invalid': errors.email }" />
                                        </div>
                                        <div v-if="errors.email" class="text-mydanger mt-2">
                                            {{ errors . email }}
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="form-label fs-6">Link Komunitas</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-whatsapp-line fs-3"></i>
                                            </span>
                                            <input type="text" required class="form-control fs-5" placeholder="Masukkan link whatsapp group disini..."
                                                v-model="form.whatsapp_community" :class="{ 'is-invalid': errors.whatsapp_community }" />
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="ri-telegram-2-fill fs-3"></i>
                                            </span>
                                            <input type="text" required class="form-control fs-5" placeholder="Masukkan link telegram group disini..."
                                                v-model="form.telegram_community" :class="{ 'is-invalid': errors.telegram_community }" />
                                        </div>
                                        <div v-if="errors.whatsapp_community" class="text-mydanger mt-2">
                                            {{ errors . whatsapp_community }}
                                        </div>
                                        <div v-if="errors.telegram_community" class="text-mydanger mt-2">
                                            {{ errors . telegram_community }}
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
    import LayoutAdmin from '../../../Layouts/Admin.vue';
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
            profile: Object,
        },

        setup(props) {
            const form = reactive({
                about: props.profile.about,
                phone: props.profile.phone,
                email: props.profile.email,
                whatsapp_community: props.profile.whatsapp_community,
                telegram_community: props.profile.telegram_community,
            });

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

                router.put(`/admin/profile/${props.profile.id}`, {
                    about: form.about,
                    phone: form.phone,
                    email: form.email,
                    whatsapp_community: form.whatsapp_community,
                    telegram_community: form.telegram_community,
                }, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Profil Berhasil Diperbarui!',
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
