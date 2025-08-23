<template>
    <Head>
        <title>Detail Blog − LetStudy</title>
    </Head>

    <main id="kt_body" class="bg-light position-relative app-blank" data-kt-name="metronic" data-bs-spy="scroll"
        data-bs-target="#kt_landing_menu">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div id="home" class="bg-white flex-grow-1">
                <Navbar />
                <div class="container d-flex flex-column w-100 w-md-700px w-lg-900px py-10 py-md-20">
                    <div class="overflow-hidden position-relative rounded-4 ratio ratio-4x3">
                        <img :src="`/storage/${blog.image}`"
                            class="img-fluid object-fit-cover mw-100" alt="" />
                    </div>
                    <h3 class="text-dark text-center lh-sm fs-2hx pt-10 mb-5">{{ blog.title }}</h3>
                    <div class="d-flex justify-content-center gap-4 mb-15">
                        <p class="fw-semibold text-myprimary fs-5 mb-1 text-uppercase"
                            style="letter-spacing: 0.06em;">
                            {{ blog.sub_product?.title ?? 'General' }}
                        </p>
                        <p class="text-gray-400 fs-5 mb-0 text-uppercase"
                            style="letter-spacing: 0.04em;">{{ formatDate(blog.created_at) }}</p>
                    </div>
                    <div id="content-editor" class="fs-4" v-html="blog.content"></div>
                    <div class="mt-13 d-flex gap-4">
                        <p class="text-gray-600 fs-5 mb-0">Bagikan blog ini</p>
                        <div class="d-flex gap-3">
                            <a :href="`https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`" target="_blank">
                                <i class="ri-facebook-box-fill fs-2x text-myprimary"></i>
                            </a>
                            <a :href="`https://wa.me/?text=${encodeURIComponent(currentUrl)}`" target="_blank">
                                <i class="ri-whatsapp-fill fs-2x text-myprimary"></i>
                            </a>
                            <i id="copy-icon" class="ri-file-copy-2-line fs-2x text-myprimary cursor-pointer"></i>
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
    import { Head } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';

    export default {
        components: {
            Head,
            Navbar,
            Footer,
        },

        props: {
            blog: Object,
            sosmed: Object,
        },

        data() {
            return {
                currentUrl: window.location.href
            }
        },

        mounted() {
            document.getElementById('copy-icon').addEventListener('click', this.copyToClipboard);
        },

        methods: {
            copyToClipboard() {
                navigator.clipboard.writeText(this.currentUrl).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Link blog berhasil disalin!',
                        text: 'Terima kasih telah membantu menyebarkan informasi ini 🙌',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-icon',
                        }
                    });
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyalin!',
                        text: 'Silakan coba lagi.',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'swal-custom-icon',
                        }
                    });
                });
            },
        },

        setup() {
            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return new Intl.DateTimeFormat('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric',
                }).format(date);
            };

            return {
                formatDate,
            }
        }
    };
</script>