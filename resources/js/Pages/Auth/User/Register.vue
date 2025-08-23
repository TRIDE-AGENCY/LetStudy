<template>
    <Head>
        <title>Daftar − LetStudy</title>
    </Head>

    <main id="kt_body" class="app-blank app-blank">
        <div class="d-flex flex-column flex-root bg-white" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column stepper-multistep"
                id="kt_stepper">
				<div class="d-flex flex-column flex-lg-row-auto w-lg-400px w-xl-550px">
					<div class="d-flex flex-column position-lg-fixed top-0 bottom-0 w-lg-400px w-xl-550px bg-myprimary">
						<div class="d-flex flex-center p-15 p-lg-20">
                            <img alt="Logo" src="/assets/media/logos/logo-full-white.png" class="h-40px h-md-50px" />
						</div>
                        <div class="px-8 px-sm-20 px-lg-10 px-xl-12">
                            <h1 class="text-center text-white lh-sm fw-bold fs-2qx fs-xl-2x mb-4">
                                Mulai Perjalanan <br>Belajar Anda Bersama Kami ✨
                            </h1>
                            <p class="text-center text-white opacity-75 fs-4 mb-0">
                                Belajar jadi lebih mudah dan menyenangkan, kapan saja, dan di mana saja.
                            </p>
                        </div>
						<div class="d-flex flex-row-fluid justify-content-center p-10 p-md-15">
							<div class="stepper-nav">
								<div class="stepper-item current" data-kt-stepper-element="nav">
									<div class="stepper-wrapper">
										<div class="stepper-icon rounded-3 p-8">
											<i class="stepper-check ri-check-line fs-1"></i>
											<span class="fs-2 fw-bold stepper-number">1</span>
										</div>
										<div class="stepper-label">
											<p class="stepper-desc fw-normal text-uppercase mb-2 fs-7"
                                                style="letter-spacing: 0.06em;">
                                                Langkah 1
                                            </p>
											<h3 class="stepper-title fs-1 mb-0">Informasi Pribadi</h3>
										</div>
									</div>
									<div class="stepper-line h-40px"></div>
								</div>
                                <div class="stepper-item" data-kt-stepper-element="nav">
									<div class="stepper-wrapper">
										<div class="stepper-icon rounded-3 p-8">
											<i class="stepper-check ri-check-line fs-1"></i>
											<span class="fs-2 fw-bold stepper-number">2</span>
										</div>
										<div class="stepper-label">
											<p class="stepper-desc fw-normal text-uppercase mb-2 fs-7"
                                                style="letter-spacing: 0.06em;">
                                                Langkah 2
                                            </p>
											<h3 class="stepper-title fs-1 mb-0">Kredensial Akun</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex flex-center flex-wrap pt-5 px-15 px-lg-20 pb-15 pb-lg-20">
                            <p class="text-white fs-4 mb-0"><span class="opacity-75">Sudah memiliki akun? </span><Link href="/login" class="fw-semibold btn-link-white">Masuk</Link></p>
						</div>
					</div>
				</div>
				<div class="d-flex flex-column flex-row-fluid py-15 py-lg-0">
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<div class="w-100 w-sm-500px mx-auto">
							<form @submit.prevent="submit" class="my-auto px-8 px-sm-20 px-lg-10 px-xl-12 w-100">
								<div class="current" data-kt-stepper-element="content">
									<div class="w-100">
                                        <h1 class="text-center text-dark lh-sm fw-bold fs-2qx fs-xl-2x mb-15">
                                            Daftar Member
                                        </h1>
										<div class="mb-6 fv-row">
                                            <label class="required form-label fs-6">Nama Lengkap</label>
                                            <input type="text" class="form-control fs-5" v-model="form.name" required
                                                placeholder="Masukkan nama disini..."
                                                :class="{ 'is-invalid': errors.name }" />
                                            <div v-if="errors.name" class="text-mydanger mt-2">
                                                {{ errors . name }}
                                            </div>
                                        </div>
                                        <div class="mb-6 fv-row">
                                            <label class="required form-label fs-6">Jenis Kelamin</label>
                                            <div class="btn-group w-100" data-kt-buttons="true"
                                                data-kt-buttons-target="[data-kt-button]">
                                                <label
                                                    class="btn w-50 btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                    data-kt-button="true"
                                                    :class="{ active: form.gender === 'L' }">
                                                    <input class="btn-check" type="radio" v-model="form.gender"
                                                        value="L" />
                                                    Laki-laki
                                                </label>
                                                <label
                                                    class="btn w-50 btn-active-myprimary text-gray-700 text-hover-white text-active-white btn-outline"
                                                    data-kt-button="true"
                                                    :class="{ active: form.gender === 'P' }">
                                                    <input class="btn-check" type="radio" v-model="form.gender"
                                                        value="P" />
                                                    Perempuan
                                                </label>
                                            </div>
                                            <div v-if="errors.gender" class="text-danger mt-2">
                                                {{ errors . gender }}
                                            </div>
                                        </div>
                                        <div class="mb-6 fv-row">
                                            <label class="form-label fs-6">Tempat, Tanggal Lahir</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control fs-5" v-model="form.birth_place"
                                                    placeholder="Kota Asal" />
                                                <input class="form-control fs-5" v-model="form.birth_date"
                                                    placeholder="Pilih Tanggal Lahir" id="kt_datepicker_1"/>
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Asal Sekolah / Kampus</label>
                                            <select class="form-select fs-5" required v-model="form.education"
                                                :class="{ 'is-invalid': errors.education }">
                                                <option v-for="(education, index) in educations" :key="index"
                                                    :value="education.name">{{ education . name }}</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            <div v-if="form.education === 'Lainnya'" class="mt-3">
                                                <input type="text" class="form-control fs-5" v-model="form.education_other"
                                                    placeholder="Masukkan nama sekolah / kampus lain..." />
                                            </div>
                                            <div v-if="errors.education" class="text-mydanger mt-2">
                                                {{ errors . education }}
                                            </div>
                                        </div>
									</div>
								</div>
								<div class="" data-kt-stepper-element="content">
									<div class="w-100">
                                        <h1 class="text-center text-dark lh-sm fw-bold fs-2qx fs-xl-2x mb-15">
                                            Daftar Member
                                        </h1>
                                        <div class="mb-6 fv-row">
                                            <label class="required form-label fs-6">Alamat Email</label>
                                            <input type="email" class="form-control fs-5" v-model="form.email"
                                                required placeholder="Masukkan alamat email disini..."
                                                :class="{ 'is-invalid': errors.email }" />
                                            <div v-if="errors.email" class="text-danger mt-2">
                                                {{ errors . email }}
                                            </div>
                                        </div>
                                        <div class="mb-6 fv-row">
                                            <label class="required form-label fs-6">Kata Sandi</label>
                                            <input type="password" class="form-control fs-5" v-model="form.password"
                                                placeholder="Masukkan kata sandi disini..."
                                                :class="{ 'is-invalid': errors.password }" />
                                            <div v-if="errors.password" class="text-danger mt-2">
                                                {{ errors . password }}
                                            </div>
                                        </div>
                                        <div class="fv-row">
                                            <label class="required form-label fs-6">Konfirmasi Kata Sandi</label>
                                            <input type="password" class="form-control fs-5" v-model="form.password_confirmation"
                                                placeholder="Masukkan konfirmasi kata sandi disini..." />
                                        </div>
									</div>
								</div>
								<div class="d-flex pt-12 gap-4">
									<button type="button" class="btn btn-mylight" data-kt-stepper-action="previous">
                                        Kembali
                                    </button>
                                    <div class="w-100">
                                        <button type="submit" id="kt_sign_up_button" class="btn btn-myprimary w-100" 
                                            :disabled="!isStepOneValid" data-kt-stepper-action="submit">
                                            <span class="indicator-label">
                                                Daftar
                                            </span>
                                            <span class="indicator-progress">
                                                Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-myprimary w-100" data-kt-stepper-action="next"
                                            :disabled="!isStepOneValid">
                                            Selanjutnya
                                        </button>
                                    </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
    </main>
</template>

<script>
    import { Head, Link, router } from '@inertiajs/vue3';
    import { reactive, computed, onMounted } from 'vue';
    import flatpickr from 'flatpickr';

    export default {
        components: {
            Head,
            Link
        },

        props: {
            errors: Object,
            educations: Array,
        },

        setup() {
            const form = reactive({
                name: '',
                gender: '',
                birth_place: '',
                birth_date: '',
                education: '',
                education_other: '',
                email: '',
                password: '',
                password_confirmation: '',
            });

            const isStepOneValid = computed(() => {
                return form.name && form.gender && form.education;
            });

            onMounted(() => {
                const element = document.querySelector("#kt_stepper");
                const stepper = new KTStepper(element);

                stepper.on("kt.stepper.next", function(stepper) {
                    stepper.goNext();
                });

                stepper.on("kt.stepper.previous", function(stepper) {
                    stepper.goPrevious();
                });

                flatpickr("#kt_datepicker_1", {
                    dateFormat: "Y-m-d"
                });
            });

            const submit = () => {
                const payload = {
                    ...form,
                    education: form.education === 'Lainnya' ? form.education_other : form.education
                };

                const submitBtn = document.querySelector('#kt_sign_up_button');
                if (submitBtn) {
                    submitBtn.setAttribute('data-kt-indicator', 'on');
                    submitBtn.setAttribute('disabled', true);
                }

                router.post('/register', payload, {
                    onSuccess: () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Akun Member Berhasil Disimpan!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal-custom-icon',
                            },
                        });
                        window.location.reload();
                    },
                    onFinish: () => {
                        if (submitBtn) {
                            submitBtn.removeAttribute('data-kt-indicator');
                            submitBtn.removeAttribute('disabled');
                        }
                    },
                });
            };

            return {
                form,
                isStepOneValid,
                submit,
            };
        }
    }
</script>

<style>
    #kt_body {
        height: 100vh;
    }

    #kt_app_root,
    .flex-root,
    .flex-column-fluid {
        height: 100%;
    }
</style>
