<template>
    <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
        data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-lg-start w-lg-175px">
                    <a href="/">
                        <img alt="Logo" src="/assets/media/logos/logo-full-default.png" class="logo-default h-30px h-lg-40px" />
                        <img alt="Logo" src="/assets/media/logos/logo-full-default.png" class="logo-sticky h-30px h-lg-35px" />
                    </a>
                </div>
                <div class="d-lg-block" id="kt_header_nav_wrapper">
                    <div class="d-lg-block p-5 p-lg-0 flex-column gap-6 justify-content-between" data-kt-drawer="true" data-kt-drawer-name="landing-menu"
                        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                        data-kt-drawer-width="225px" data-kt-drawer-direction="start"
                        data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                        data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                        <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-semibold"
                            id="kt_landing_menu" data-kt-menu="true">
                            <div class="menu-item">
                                <a :class="{ 'active': $page.url === '/' }"
                                    class="menu-link nav-link navbar-link" data-kt-drawer-dismiss="true" href="/">Beranda</a>
                            </div>
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" 
                                class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                                <span :class="{ 'active': $page.url.startsWith('/letstudy-') }"
                                    class="menu-link nav-link navbar-link">
                                    <span class="menu-title">Produk</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                                <div class="menu-sub menu-sub-lg-down-accordion rounded-4 menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-225px">
                                    <div class="menu-item">
                                        <a :class="{ 'active': $page.url === '/letstudy-ptn' }"
                                            class="menu-link nav-link navbar-link align-items-center gap-3" href="/letstudy-ptn">
                                            <i class="fs-3 ri-graduation-cap-fill"></i>
                                            <span class="menu-title">LetStudy PTN</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a :class="{ 'active': $page.url === '/letstudy-english' }"
                                            class="menu-link nav-link navbar-link align-items-center gap-3" href="/letstudy-english">
                                            <i class="fs-3 ri-translate-2"></i>
                                            <span class="menu-title">LetStudy English</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a :class="{ 'active': $page.url === '/letstudy-karier' }"
                                            class="menu-link nav-link navbar-link align-items-center gap-3" href="/letstudy-karier">
                                            <i class="fs-3 ri-briefcase-fill"></i>
                                            <span class="menu-title">LetStudy Karier</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a :class="{ 'active': $page.url.startsWith('/blogs') }"
                                    class="menu-link nav-link navbar-link" data-kt-drawer-dismiss="true" href="/blogs">Blog</a>
                            </div>
                            <div class="menu-item">
                                <a :class="{ 'active': $page.url.startsWith('/faqs') }"
                                    class="menu-link nav-link navbar-link" data-kt-drawer-dismiss="true" href="/faqs">FAQs</a>
                            </div>
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" 
                                class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                                <span :class="{ 'active': $page.url.startsWith('/about') || $page.url === '/our-team' || $page.url === '/contact-us'}"
                                    class="menu-link nav-link navbar-link">
                                    <span class="menu-title">Tentang</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                                <div class="menu-sub menu-sub-lg-down-accordion rounded-4 menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-175px">
                                    <div class="menu-item">
                                        <a :class="{ 'active': $page.url === '/about-us' }"
                                            class="menu-link nav-link navbar-link align-items-center gap-3" href="/about-us">
                                            <span class="menu-title">Tentang Kami</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a :class="{ 'active': $page.url === '/our-team' }"
                                            class="menu-link nav-link navbar-link align-items-center gap-3" href="/our-team">
                                            <span class="menu-title">TIm LetStudy</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a :class="{ 'active': $page.url === '/contact-us' }"
                                            class="menu-link nav-link navbar-link align-items-center gap-3" href="/contact-us">
                                            <span class="menu-title">Hubungi Kami</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a v-if="isLoggedIn" data-kt-drawer-dismiss="true" href="/member-area" class="btn btn-sm btn-myprimary pe-3 fs-5 d-inline-flex d-lg-none gap-2 align-items-center justify-content-center">
                            <span>Member Area</span>
                            <i class="fs-3 ri-arrow-right-up-line"></i>
                        </a>
                        <div v-else class="d-flex gap-3 d-inline-flex d-lg-none">
                            <a data-kt-drawer-dismiss="true" href="/login" class="w-100 btn btn-sm btn-mysecondary fs-5 gap-2 align-items-center">
                                <span>Masuk</span>
                            </a>
                            <a data-kt-drawer-dismiss="true" href="/register" class="w-100 btn btn-sm btn-myprimary fs-5 gap-2 align-items-center">
                                <span>Daftar</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row text-end me-n3 me-lg-0 justify-content-lg-end w-lg-175px">
                    <a v-if="isLoggedIn" href="/member-area" class="btn btn-sm btn-myprimary pe-3 fs-5 d-none d-lg-inline-flex gap-2 align-items-center">
                        <span>Member Area</span>
                        <i class="fs-3 ri-arrow-right-up-line"></i>
                    </a>
                    <div v-else class="d-flex gap-3 d-none d-lg-inline-flex">
                        <a href="/login" class="btn btn-sm btn-mysecondary fs-5 gap-2 align-items-center">
                            <span>Masuk</span>
                        </a>
                        <a href="/register" class="btn btn-sm btn-myprimary fs-5 gap-2 align-items-center">
                            <span>Daftar</span>
                        </a>
                    </div>
                    <button class="btn btn-icon btn-myicon w-40px h-40px d-flex d-lg-none" id="kt_landing_menu_toggle">
                        <i class="ri-menu-line fs-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { usePage } from '@inertiajs/vue3';
    import { computed } from 'vue'

    export default {
        setup() {
            const page = usePage();
            const user = computed(() => page.props.auth?.user);
            const isLoggedIn = computed(() => !!user.value);

            return {
                isLoggedIn,
            }
        }
    }
</script>

<style>

</style>
