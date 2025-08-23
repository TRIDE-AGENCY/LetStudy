<template>
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <div class="app-sidebar-logo px-6 border-end border-gray-300" id="kt_app_sidebar_logo">
            <a href="/">
                <img alt="Logo" src="/assets/media/logos/logo-full-default.png"
                    class="h-40px app-sidebar-logo-default theme-light-show" />
            </a>
        </div>
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid border-end border-gray-300">
            <div id="kt_app_sidebar_menu_wrapper"
                class="app-sidebar-wrapper d-flex flex-column justify-content-between hover-scroll-overlay-y my-6"
                data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention px-4" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url === '/member-area' }" href="/member-area">
                            <span class="menu-icon">
                                <i
                                    :class="[$page.url === '/member-area' ? 'ri-home-4-fill' : 'ri-home-4-line',
                                        'fs-2'
                                    ]"></i>
                            </span>
                            <span :class="[$page.url === '/member-area' ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">
                                Member Area
                            </span>
                        </Link>
                    </div>
                    <div class="menu-item pt-4">
                        <div class="menu-content py-1">
                            <span class="text-gray-500 fw-semibold text-uppercase fs-7" style="letter-spacing: 0.06em;">Produk</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" v-for="(product, index) in products" :key="index" class="menu-item menu-accordion">
                        <span class="menu-link menu-link-mysecondary" :class="{ 'active': $page.url.startsWith(`/member-area/${product.slug}`) }">
                            <span class="menu-icon">
                                <i :class="[getProductIconClass(product), 'fs-2']"></i>
                            </span>
                            <span :class="[$page.url.startsWith(`/member-area/${product.slug}`) ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">
                                {{ product.title }}
                            </span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div v-if="product.sub_products && product.sub_products.length > 0" class="menu-sub menu-sub-accordion ms-10">
                            <div v-for="(subProduct, subIndex) in product.sub_products" :key="subIndex" class="menu-item">
                                <Link class="menu-link menu-link-mysecondary sub-menu-link me-0" :class="{ 'active': $page.url.startsWith(`/member-area/${product.slug}/${subProduct.slug}`) }" :href="`/member-area/${product.slug}/${subProduct.slug}/ebooks`">
                                    <span :class="[$page.url.startsWith(`/member-area/${product.slug}/${subProduct.slug}`) ? 'fw-bolder' : 'fw-semibold', 'menu-title fs-5']">
                                        {{ subProduct.title }}
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="menu-item pt-4">
                        <div class="menu-content py-1">
                            <span class="text-gray-500 fw-semibold text-uppercase fs-7" style="letter-spacing: 0.06em;">Lainnya</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/products') }" href="/about-us">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/products') ? 'ri-service-fill' :
                                    'ri-service-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/products') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Tentang LetStudy</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/products') }" href="/contact-us">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/products') ? 'ri-customer-service-2-fill' :
                                    'ri-customer-service-2-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/products') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Hubungi Kami</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/member-area/user') }" href="/member-area/user">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/member-area/user') ? 'ri-account-circle-fill' :
                                    'ri-account-circle-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/member-area/user') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Akun</span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        Link
    } from '@inertiajs/vue3';

    export default {
        components: {
            Link,
        },
        props: {
            products: Array,  
        },
        methods: {
            getProductIconClass(product) {
                const isActive = this.$page.url.startsWith(`/member-area/${product.slug}`);
                const map = {
                    'LetStudy PTN': isActive ? 'ri-graduation-cap-fill' : 'ri-graduation-cap-line',
                    'LetStudy English': 'ri-translate',
                    'LetStudy Karier': isActive ? 'ri-briefcase-fill' : 'ri-briefcase-line',
                };
                return map[product.title] || (isActive ? 'ri-record-circle-fill' : 'ri-record-circle-line');
            }
        }
    }
</script>

<style>
</style>
