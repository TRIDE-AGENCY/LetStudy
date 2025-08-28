<template>
    <Head>
        <title>Masuk − LetStudy</title>
    </Head>

    <main id="kt_body" class="app-blank app-blank bg-myprimary scroll-y">
        <div class="d-flex flex-column flex-root bg-myprimary" id="kt_app_root">
            <div class="d-flex flex-column h-100 w-100 w-sm-500px w-md-550px w-lg-600px mx-auto">
                <div class="d-flex flex-center p-15 p-lg-20">
                    <a href="/">
                        <img alt="Logo" src="/assets/media/logos/logo-full-white.png" class="h-40px h-md-50px" />
                    </a>
                </div>
                <div class="d-flex flex-column h-100 justify-content-center mx-8">
                    <form @submit.prevent="submit">
                        <div class="d-flex flex-column bg-white rounded-4 border border-gray-300
                            justify-content-center p-10 p-md-15">
                            <h1 class="text-center text-dark lh-sm fw-bold fs-2qx fs-xl-2x mb-4">
                                Mulai Perjalanan <br>Belajar Anda Bersama Kami ✨
                            </h1>
                            <p class="text-center text-gray-600 opacity-75 fs-4 mb-10 mb-md-15">
                                Masuk dan lanjutkan belajar dengan cara yang lebih mudah dan menyenangkan.
                            </p>
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-6 fv-row">
                                    <label class="required form-label fs-6">Alamat Email</label>
                                    <input type="email" class="form-control fs-5" autocomplete="off" v-model="form.email"
                                        required placeholder="Masukkan alamat email disini..."
                                        :class="{ 'is-invalid': errors.email || $page.props.session.error || errors.email }" />
                                    <div v-if="errors.message" class="text-danger mt-2">
                                        {{ errors.message }}
                                    </div>
                                    <div v-if="$page.props.session.error" class="text-danger mt-2">
                                        {{ $page.props.session.error }}
                                    </div>
                                    <div v-if="errors.email" class="text-danger mt-2">
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
                                    <input type="password" class="form-control fs-5" v-model="form.password"
                                        placeholder="Masukkan kata sandi disini..."
                                        :class="{ 'is-invalid': errors.password }" />
                                    <div v-if="errors.password" class="text-danger mt-2">
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
                        </div>
                    </form>
                </div>
                <div class="d-flex flex-center align-items-end flex-wrap p-15 p-lg-20">
                    <p class="text-white fs-4 mb-0"><span class="opacity-75">Belum memiliki akun? </span><Link href="/register" class="fw-semibold btn-link-white">Daftar</Link></p>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive } from 'vue';

    export default {
        components: {
            Head,
            Link
        },

        props: {
            errors: Object,
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

                router.post('/login', {
                    email: form.email,
                    password: form.password,
                }, {
                    onSuccess: (page) => {
                        if (!page.props.session?.error) {
                            window.location.reload();
                        }
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

<style>
</style>
