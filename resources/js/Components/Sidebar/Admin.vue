<template>
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <div class="app-sidebar-logo px-6 border-end border-gray-300" id="kt_app_sidebar_logo">
            <Link href="/admin/dashboard">
                <img alt="Logo" src="/assets/media/logos/logo-full-default.png"
                    class="h-40px app-sidebar-logo-default theme-light-show" />
            </Link>
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
                            :class="{ 'active': $page.url.startsWith('/admin/dashboard') }" href="/admin/dashboard">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/dashboard') ? 'ri-dashboard-fill' : 'ri-dashboard-line',
                                    'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/dashboard') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Dashboard</span>
                        </Link>
                    </div>
                    <div class="menu-item pt-4">
                        <div class="menu-content py-1">
                            <span class="text-gray-500 fw-semibold text-uppercase fs-7" style="letter-spacing: 0.06em;">Halaman</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/pages/letstudy') }" href="/admin/pages/letstudy">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/pages/letstudy') ? 'ri-home-4-fill' :
                                    'ri-home-4-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/pages/letstudy') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">LetStudy</span>
                        </Link>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/pages/products') }" href="/admin/pages/products">
                            <span class="menu-icon">
                                <i
                                    :class="[$page.url.startsWith('/admin/pages/products') ? 'ri-apps-2-fill' :
                                        'ri-apps-2-line', 'fs-2'
                                    ]"></i>
                            </span>
                            <span
                                :class="[$page.url.startsWith('/admin/pages/products') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Produk</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion ms-10">
                            <div v-for="(product, index) in products" :key="index" class="menu-item">
                                <Link class="menu-link menu-link-mysecondary sub-menu-link me-0" :class="{ 'active': $page.url.startsWith(`/admin/pages/products/${product.slug}`) }" :href="`/admin/pages/products/${product.slug}`">
                                    <span :class="[$page.url.startsWith(`/admin/pages/products/${product.slug}`) ? 'fw-bolder' : 'fw-semibold', 'menu-title fs-5']">
                                        {{ product.title }}
                                    </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/pages/legal') }" href="/admin/pages/legal">
                            <span class="menu-icon">
                                <i
                                    :class="[$page.url.startsWith('/admin/pages/legal') ? 'ri-scales-3-fill' :
                                        'ri-scales-3-line', 'fs-2'
                                    ]"></i>
                            </span>
                            <span
                                :class="[$page.url.startsWith('/admin/pages/legal') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Legalitas</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion ms-10">
                            <div class="menu-item">
                                <Link class="menu-link menu-link-mysecondary sub-menu-link me-0" :class="{ 'active': $page.url === '/admin/pages/legal/terms-and-condition' }" href="/admin/pages/legal/terms-and-condition">
                                    <span
                                        :class="[$page.url === '/admin/pages/legal/terms-and-condition' ? 'fw-bolder' : 'fw-semibold', 'menu-title fs-5']">Syarat & Ketentuan</span>
                                </Link>
                            </div>
                            <div class="menu-item">
                                <Link class="menu-link menu-link-mysecondary sub-menu-link me-0" :class="{ 'active': $page.url === '/admin/pages/legal/privacy-policy' }" href="/admin/pages/legal/privacy-policy">
                                    <span
                                        :class="[$page.url === '/admin/pages/legal/privacy-policy' ? 'fw-bolder' : 'fw-semibold', 'menu-title fs-5']">Kebijakan Privasi</span>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item pt-4">
                        <div class="menu-content py-1">
                            <span class="text-gray-500 fw-semibold text-uppercase fs-7" style="letter-spacing: 0.06em;">Member Area</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" v-for="(product, index) in products" :key="index" class="menu-item menu-accordion">
                        <span class="menu-link menu-link-mysecondary" :class="{ 'active': $page.url.startsWith(`/admin/${product.slug}`) }">
                            <span class="menu-icon">
                                <i :class="[getProductIconClass(product), 'fs-2']"></i>
                            </span>
                            <span :class="[$page.url.startsWith(`/admin/${product.slug}`) ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">
                                {{ product.title }}
                            </span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div v-if="product.sub_products && product.sub_products.length > 0" class="menu-sub menu-sub-accordion ms-10">
                            <div v-for="(subProduct, subIndex) in product.sub_products" :key="subIndex" class="menu-item">
                                <Link class="menu-link menu-link-mysecondary sub-menu-link me-0" :class="{ 'active': $page.url.startsWith(`/admin/${product.slug}/${subProduct.slug}`) }" :href="`/admin/${product.slug}/${subProduct.slug}/ebooks`">
                                    <span :class="[$page.url.startsWith(`/admin/${product.slug}/${subProduct.slug}`) ? 'fw-bolder' : 'fw-semibold', 'menu-title fs-5']">
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
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/messages') }" href="/admin/messages">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/messages') ? 'ri-chat-history-fill' :
                                    'ri-chat-history-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/messages') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Pesan Masuk</span>
                        </Link>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/master/educations') }" href="/admin/master/educations">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/master/educations') ? 'ri-database-fill' :
                                    'ri-database-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/master/educations') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Master Pendidikan</span>
                        </Link>
                    </div>
                    <!-- <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/products') }" href="/admin/products">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/products') ? 'ri-database-fill' :
                                    'ri-database-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/products') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Master Produk</span>
                        </Link>
                    </div> -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/management') }" href="/admin/management">
                            <span class="menu-icon">
                                <i
                                    :class="[$page.url.startsWith('/admin/management') ? 'ri-team-fill' :
                                        'ri-team-line', 'fs-2'
                                    ]"></i>
                            </span>
                            <span
                                :class="[$page.url.startsWith('/admin/management') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Manajemen Akun</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion ms-10">
                            <div class="menu-item">
                                <Link class="menu-link menu-link-mysecondary sub-menu-link me-0" :class="{ 'active': $page.url.startsWith(`/admin/management/user`) }" href="/admin/management/user">
                                    <span
                                        :class="[$page.url.startsWith(`/admin/management/user`) ? 'fw-bolder' : 'fw-semibold', 'menu-title fs-5']">Member</span>
                                </Link>
                            </div>
                            <div class="menu-item">
                                <Link class="menu-link menu-link-mysecondary sub-menu-link me-0" :class="{ 'active': $page.url.startsWith(`/admin/management/admin`) }" href="/admin/management/admin">
                                    <span
                                        :class="[$page.url.startsWith(`/admin/management/admin`) ? 'fw-bolder' : 'fw-semibold', 'menu-title fs-5']">Admin</span>
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/profile') }" href="/admin/profile">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/profile') ? 'ri-bank-fill' :
                                    'ri-bank-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/profile') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Profil LetStudy</span>
                        </Link>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/teams') }" href="/admin/teams">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/teams') ? 'ri-parent-fill' :
                                    'ri-parent-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/teams') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Tim LetStudy</span>
                        </Link>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary"
                            :class="{ 'active': $page.url.startsWith('/admin/user') }" href="/admin/user">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/user') ? 'ri-account-circle-fill' :
                                    'ri-account-circle-line', 'fs-2'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/user') ? 'fw-bold' : 'fw-semibold', 'menu-title fs-5']">Akun</span>
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
                const isActive = this.$page.url.startsWith(`/admin/${product.slug}`);
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
