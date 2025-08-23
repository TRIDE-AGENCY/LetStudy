<template>
    <Head>
        <title>Hubungi Kami − LetStudy</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="flex-grow-1">
                <div id="home" class="bg-white">
                    <Navbar />
                    <div class="container d-flex flex-column w-100 w-md-700px w-lg-auto">
                        <div class="d-flex flex-column align-items-center text-center py-10 py-md-20">
                            <h1 class="text-center text-dark lh-sm fw-bold fs-3hx mb-4">
                                Hubungi Kami 📩
                            </h1>
                            <p class="text-center text-gray-600 fs-2 fw-semibold mb-0">
                                Hubungi kami untuk mendapatkan <span class="text-myprimary fw-bold">informasi</span> yang <span class="text-myprimary fw-bold">lebih mendetail</span> mengenai LetStudy!
                            </p>
                        </div>
                    </div>
                </div>
                <div id="contact" class="container d-flex flex-column py-10 py-md-20">
                    <div class="row g-6">
                        <div class="col-12 col-md-4">
                            <div class="d-flex flex-column gap-4">
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-body d-flex flex-grow align-items-center gap-4 p-6">
                                        <div class="p-2 rounded d-flex align-items-center justify-content-center">
                                            <i class="ri-phone-fill text-myprimary fs-3qx"></i>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <h3 class="mb-2">Telepon</h3>
                                            <p class="fs-3 fw-semibold text-gray-600 mb-0 text-truncate-1 white-space-nowrap">+62 812-3456-7890</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-body d-flex flex-grow align-items-center gap-4 p-6">
                                        <div class="p-2 rounded d-flex align-items-center justify-content-center">
                                            <i class="ri-mail-send-fill text-myprimary fs-3qx"></i>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <h3 class="mb-2">Email</h3>
                                            <p class="fs-3 fw-semibold text-gray-600 mb-0 text-truncate-1 white-space-nowrap">mail@letstudy.co.id</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card rounded-4 border border-gray-300">
                                    <div class="card-body d-flex flex-grow align-items-center gap-4 p-6">
                                        <div class="p-2 rounded d-flex align-items-center justify-content-center">
                                            <i class="ri-whatsapp-line text-myprimary fs-3qx"></i>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1">
                                            <h3 class="mb-2">Komunitas</h3>
                                            <p class="fs-3 fw-semibold text-gray-600 mb-0 text-truncate-1 white-space-nowrap">WhatsApp Group</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="card rounded-4 border border-gray-300">
                                <div class="card-header p-6 d-flex flex-column m-0 border-bottom border-gray-300" style="min-height: unset;">
                                    <h3 class="mb-2">Yuk, Tinggalkan Pesan ✨</h3>
                                    <p class="fs-5 text-gray-600 m-0">
                                        Punya pertanyaan atau saran? Kami akan balas secepatnya!
                                    </p>
                                </div>
                                <form @submit.prevent="submit">
                                    <div class="card-body p-6">
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Nama</label>
                                            <input type="text" class="form-control fs-5" v-model="form.name" required
                                                placeholder="Masukkan nama disini..."
                                                :class="{ 'is-invalid': errors.name }" />
                                            <div v-if="errors.name" class="text-mydanger mt-2">
                                                {{ errors . name }}
                                            </div>
                                        </div>
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label fs-6">Alamat Email</label>
                                            <input type="email" class="form-control fs-5" v-model="form.email"
                                                required placeholder="Masukkan alamat email disini..."
                                                :class="{ 'is-invalid': errors.email }" />
                                            <div v-if="errors.email" class="text-mydanger mt-2">
                                                {{ errors . email }}
                                            </div>
                                        </div>
                                        <div class="mb-7 fv-row">
                                            <label class="required form-label fs-6">Pesan</label>
                                            <textarea class="form-control fs-5" data-kt-autosize="true" rows="5" required
                                                placeholder="Masukkan pesan disini..." v-model="form.message"
                                                :class="{ 'is-invalid': errors.message }">
                                            </textarea>
                                            <div v-if="errors.message" class="text-mydanger mt-2">
                                                {{ errors . message }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-mylighten fs-5 me-3">Reset</button>
                                            <button type="submit" id="submit_button"
                                                class="btn btn-sm btn-myprimary fs-5">
                                                <span class="indicator-label">
                                                    Kirim Pesan
                                                </span>
                                                <span class="indicator-progress">
                                                    Mohon Tunggu... <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Footer :sosmed="sosmed" />

            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <i class="fs-1 ri-arrow-up-double-line"></i>
            </div>
        </div>
    </main>
</template>

<script>
    import Navbar from "../../../Components/Navbar/Home.vue";
    import Footer from "../../../Components/Footer/Home.vue";
    import { Head, usePage, router } from '@inertiajs/vue3';
    import { reactive } from 'vue';

    export default {
        components: {
            Head,
            Navbar,
            Footer,
        },

        props: {
            errors: Object,
            sosmed: Object,
        },

        setup(props) {
            const page = usePage();

            const form = reactive({
                name: page.props.auth?.user?.name ?? '',   
                email: page.props.auth?.user?.email ?? '', 
                message: '',
            });

            const submit = () => {
                const submitBtn = document.querySelector('#submit_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                const payload = new FormData();
                payload.append('name', form.name);
                payload.append('email', form.email);
                payload.append('message', form.message);

                const cleanup = () => {
                    if (submitBtn) {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.removeAttribute('disabled');
                    }
                };

                router.post('/contact-us', payload, {
                    onSuccess: () => {
                        form.message = '';
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pesan Berhasil Dikirim!',
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
    };
</script>
