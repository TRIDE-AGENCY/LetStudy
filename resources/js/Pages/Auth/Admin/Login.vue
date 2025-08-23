<template>

    <Head>
        <title>Administrator − Letstudy</title>
    </Head>

    <main id="kt_body" class="app-blank app-blank bg-myprimary scroll-y">
        <div class="d-flex flex-column flex-root bg-myprimary" id="kt_app_root">
            <div class="d-flex flex-column h-100 w-100 w-sm-500px w-md-550px w-lg-600px mx-auto">
                <div class="d-flex flex-center p-15 p-lg-20">
                    <img alt="Logo" src="/assets/media/logos/logo-full-white.png" class="h-40px h-md-50px" />
                </div>
                <div class="d-flex flex-column h-100 justify-content-center mx-8">
                    <div class="d-flex flex-column bg-white rounded-4 border border-gray-300
                        justify-content-center p-10 p-md-15">
                        <h1 class="text-center text-dark lh-sm fw-bold fs-2qx fs-xl-2x mb-4">
                            Administrator
                        </h1>
                        <p class="text-center text-gray-600 opacity-75 fs-4 mb-10 mb-md-15">
                            Masuk untuk mengelola halaman website LetStudy
                        </p>
                        <form @submit.prevent="submit">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-6 fv-row">
                                    <label class="required form-label fs-6">Alamat Email</label>
                                    <input type="email" class="form-control fs-5" name="email" autocomplete="off" v-model="form.email"
                                        required placeholder="Masukkan alamat email disini..." :class="{ 'is-invalid': errors.email }"/>
                                    <div v-if="errors.email" class="text-mydanger mt-2">
                                        {{ errors . email }}
                                    </div>
                                </div>
                                <div class="mb-12 fv-row">
                                    <div class="d-flex justify-content-between gap-6">
                                        <label class="required form-label fs-6">Kata Sandi</label>
                                        <a href="/admin/forgot-password"
                                            class="btn btn-link btn-link-myprimary p-0 text-gray-600 fs-6">
                                            Lupa kata sandi?
                                        </a>
                                    </div>
                                    <input type="password" class="form-control fs-5" name="password" autocomplete="off" v-model="form.password"
                                        required placeholder="Masukkan kata sandi disini..." :class="{ 'is-invalid': errors.password }"/>
                                    <div v-if="errors.password" class="text-mydanger mt-2">
                                        {{ errors . password }}
                                    </div>
                                </div>
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-myprimary w-100">
                                    <span class="indicator-label">
                                        Masuk
                                    </span>
                                    <span class="indicator-progress">
                                        Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex flex-center align-items-end flex-wrap p-15 p-lg-20">
                    <p class="text-white opacity-75 fs-4 mb-0">@2025 LetStudy.id</p>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import {
        Head,
        Link,
        router
    } from '@inertiajs/vue3';
    import {
        reactive
    } from 'vue';

    export default {
        components: {
            Head,
            Link
        },

        props: {
            errors: Object,
            session: Object
        },

        setup() {
            const form = reactive({
                email: '',
                password: '',
            });

            const submit = () => {
                const submitBtn = document.querySelector('#kt_sign_in_submit');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                router.post('/admin/login', {
                    email: form.email,
                    password: form.password,
                }, {
                    onSuccess: () => {
                        window.location.reload();
                    },
                    onFinish: () => {
                        if (submitBtn) {
                            submitBtn.removeAttribute('data-kt-indicator');
                            submitBtn.removeAttribute('disabled');
                        }
                    }
                });
            }

            return {
                form,
                submit,
            };

        }

    }
</script>
