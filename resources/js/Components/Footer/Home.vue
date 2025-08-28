<template>
    <div id="footer">
        <div class="bg-myprimary py-12">
            <div class="container">
                <div class="row g-10">
                    <div class="col-12 col-md-5 col-xl-6 d-flex flex-column gap-10 justify-content-between">
                        <div class="d-flex flex-column align-items-start gap-8">
                            <img alt="Logo" src="/assets/media/logos/logo-full-white.png"
                                class="logo-default h-40px" />
                            <!-- <div class="d-flex gap-3">
                                <a v-if="sosmed.instagram" :href="sosmed.instagram" target="_blank">
                                    <i class="fs-3 btn-link-footer ri-instagram-line"></i>
                                </a>
                                <a v-if="sosmed.youtube" :href="sosmed.youtube" target="_blank">
                                    <i class="fs-3 btn-link-footer ri-youtube-fill"></i>
                                </a>
                                <a v-if="sosmed.tiktok" :href="sosmed.tiktok" target="_blank">
                                    <i class="fs-3 btn-link-footer ri-tiktok-fill"></i>
                                </a>
                                <a v-if="sosmed.linkedin" :href="sosmed.linkedin" target="_blank">
                                    <i class="fs-3 btn-link-footer ri-linkedin-box-fill"></i>
                                </a>
                                <a v-if="sosmed.x" :href="sosmed.x" target="_blank">
                                    <i class="fs-3 btn-link-footer ri-twitter-x-line"></i>
                                </a>
                            </div> -->
                        </div>
                        <div class="d-flex gap-3">
                            <a v-if="sosmed.instagram" :href="sosmed.instagram" target="_blank">
                                <i class="fs-3 btn-link-footer ri-instagram-line"></i>
                            </a>
                            <a v-if="sosmed.youtube" :href="sosmed.youtube" target="_blank">
                                <i class="fs-3 btn-link-footer ri-youtube-fill"></i>
                            </a>
                            <a v-if="sosmed.tiktok" :href="sosmed.tiktok" target="_blank">
                                <i class="fs-3 btn-link-footer ri-tiktok-fill"></i>
                            </a>
                            <a v-if="sosmed.linkedin" :href="sosmed.linkedin" target="_blank">
                                <i class="fs-3 btn-link-footer ri-linkedin-box-fill"></i>
                            </a>
                            <a v-if="sosmed.x" :href="sosmed.x" target="_blank">
                                <i class="fs-3 btn-link-footer ri-twitter-x-line"></i>
                            </a>
                        </div>
                        <!-- <p class="text-white opacity-75 d-none d-md-block fs-6 mb-0">2025 © LetStudy.id, All Right Reserved</p> -->
                    </div>
                    <div class="col-12 col-md-7 col-xl-6 justify-content-md-end">
                        <div class="row g-10 pt-2 pt-md-0">
                            <div class="col-6 col-sm-4">
                                <p class="text-white fs-5 mb-4 fw-semibold text-uppercase"
                                    style="letter-spacing: 0.08em;">Navigasi</p>
                                <div class="d-flex flex-column gap-2">
                                    <a href="/" class="btn-link-footer fs-5">Beranda</a>
                                    <a href="/blogs" class="btn-link-footer fs-5">Blog</a>
                                    <a href="/faqs" class="btn-link-footer fs-5">FAQs</a>
                                    <a href="/member-area" class="btn-link-footer fs-5">Member Area</a>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4">
                                <p class="text-white fs-5 mb-4 fw-semibold text-uppercase"
                                    style="letter-spacing: 0.08em;">Produk</p>
                                <div class="d-flex flex-column gap-2">
                                    <a href="/letstudy-ptn" class="btn-link-footer fs-5">LetStudy PTN</a>
                                    <a href="/letstudy-english" class="btn-link-footer fs-5">LetStudy English</a>
                                    <a href="/letstudy-karier" class="btn-link-footer fs-5">LetStudy Karier</a>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4">
                                <p class="text-white fs-5 mb-4 fw-semibold text-uppercase"
                                    style="letter-spacing: 0.08em;">Organisasi</p>
                                <div class="d-flex flex-column gap-2">
                                    <a href="/about-us" class="btn-link-footer fs-5">Tentang</a>
                                    <a href="/our-team" class="btn-link-footer fs-5">Tim LetStudy</a>
                                    <a href="/contact-us" class="btn-link-footer fs-5">Hubungi Kami</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-6" style="background-color: var(--bs-myprimary-500);">
            <div class="container d-flex flex-column flex-md-row gap-3 justify-content-between">
                <p class="text-white opacity-50 fs-6 mb-0 order-1 order-md-0">2025 © LetStudy.id, All Right Reserved</p>
                <div class="d-flex gap-6 gap-md-8">
                    <a href="/terms-and-condition" class="btn-link-footer-light fs-6">Syarat & Ketentuan</a>
                    <a href="/privacy-policy" class="btn-link-footer-light fs-6">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    defineProps({
        sosmed: Object
    })
</script>