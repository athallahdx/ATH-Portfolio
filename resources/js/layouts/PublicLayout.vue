<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { home, portfolio, contact, dashboard, login } from '@/routes';
import { 
    Menu, 
    X, 
    Github, 
    Linkedin, 
    Mail, 
    ArrowUpRight, 
    Briefcase,
    Home as HomeIcon,
    PhoneCall
} from '@lucide/vue';

// Mobile menu open/close state
const isMobileMenuOpen = ref(false);

const page = usePage();

// Helper to determine if a link is active
const isRouteActive = (routeUrl: string) => {
    const currentPath = page.url;
    if (routeUrl === '/') {
        return currentPath === '/' || currentPath === '';
    }
    return currentPath.startsWith(routeUrl);
};

// Year for footer
const currentYear = new Date().getFullYear();
</script>

<template>
    <div class="min-h-screen bg-[#030712] text-slate-100 font-sans flex flex-col selection:bg-blue-500/30 selection:text-blue-200">
        <!-- Background decorative gradients -->
        <div class="absolute top-0 left-0 w-full h-[600px] bg-gradient-to-b from-blue-950/20 via-transparent to-transparent pointer-events-none z-0"></div>
        <div class="absolute top-1/4 right-0 w-[400px] h-[400px] bg-blue-900/10 rounded-full blur-[120px] pointer-events-none z-0"></div>
        <div class="absolute bottom-1/4 left-0 w-[300px] h-[300px] bg-indigo-900/10 rounded-full blur-[100px] pointer-events-none z-0"></div>

        <!-- Sticky Header / Navbar -->
        <header class="sticky top-0 z-50 w-full border-b border-slate-800/60 bg-[#030712]/80 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <!-- Logo -->
                <Link :href="home().url" class="flex items-center gap-2 group z-50">
                    <span class="h-9 w-9 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-bold text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                        A
                    </span>
                    <span class="font-bold text-lg tracking-tight bg-gradient-to-r from-white via-slate-100 to-slate-300 bg-clip-text text-transparent group-hover:text-blue-400 transition-colors duration-300">
                        Athallah Tsany
                    </span>
                </Link>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center gap-8">
                    <Link 
                        :href="home().url" 
                        class="text-sm font-medium transition-colors duration-300 relative py-1"
                        :class="isRouteActive('/') ? 'text-blue-400 font-semibold' : 'text-slate-300 hover:text-white'"
                    >
                        Home
                        <span v-if="isRouteActive('/')" class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-500 rounded-full shadow-[0_1px_8px_rgba(59,130,246,0.5)]"></span>
                    </Link>
                    <Link 
                        :href="portfolio().url" 
                        class="text-sm font-medium transition-colors duration-300 relative py-1"
                        :class="isRouteActive('/portfolio') ? 'text-blue-400 font-semibold' : 'text-slate-300 hover:text-white'"
                    >
                        Portfolio
                        <span v-if="isRouteActive('/portfolio')" class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-500 rounded-full shadow-[0_1px_8px_rgba(59,130,246,0.5)]"></span>
                    </Link>
                    <Link 
                        :href="contact().url" 
                        class="text-sm font-medium transition-colors duration-300 relative py-1"
                        :class="isRouteActive('/contact') ? 'text-blue-400 font-semibold' : 'text-slate-300 hover:text-white'"
                    >
                        Contact
                        <span v-if="isRouteActive('/contact')" class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-500 rounded-full shadow-[0_1px_8px_rgba(59,130,246,0.5)]"></span>
                    </Link>
                </nav>

                <!-- Mobile Menu Button -->
                <button 
                    @click="isMobileMenuOpen = !isMobileMenuOpen" 
                    class="md:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 transition-colors"
                    aria-label="Toggle menu"
                >
                    <Menu v-if="!isMobileMenuOpen" class="w-6 h-6" />
                    <X v-else class="w-6 h-6" />
                </button>
            </div>

            <!-- Mobile Navigation Menu -->
            <transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0 translate-y-1"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 translate-y-1"
            >
                <div v-if="isMobileMenuOpen" class="md:hidden border-t border-slate-800/80 bg-[#030712] py-4 px-4 space-y-3 shadow-xl">
                    <Link 
                        :href="home().url" 
                        @click="isMobileMenuOpen = false"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-base font-medium transition-colors"
                        :class="isRouteActive('/') ? 'bg-blue-600/15 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white'"
                    >
                        <HomeIcon class="w-5 h-5" />
                        Home
                    </Link>
                    <Link 
                        :href="portfolio().url" 
                        @click="isMobileMenuOpen = false"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-base font-medium transition-colors"
                        :class="isRouteActive('/portfolio') ? 'bg-blue-600/15 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white'"
                    >
                        <Briefcase class="w-5 h-5" />
                        Portfolio
                    </Link>
                    <Link 
                        :href="contact().url" 
                        @click="isMobileMenuOpen = false"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-base font-medium transition-colors"
                        :class="isRouteActive('/contact') ? 'bg-blue-600/15 text-blue-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white'"
                    >
                        <PhoneCall class="w-5 h-5" />
                        Contact
                    </Link>
                </div>
            </transition>
        </header>

        <!-- Main Content Area -->
        <main class="flex-grow z-10">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-800/80 bg-[#02050e] py-12 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Column 1: Info -->
                    <div class="md:col-span-2 space-y-4">
                        <Link :href="home().url" class="flex items-center gap-2 group">
                            <span class="h-8 w-8 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-bold text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                                A
                            </span>
                            <span class="font-bold text-md tracking-tight text-white group-hover:text-blue-400 transition-colors duration-300">
                                Athallah Tsany Satriyaji
                            </span>
                        </Link>
                        <p class="text-sm text-slate-400 max-w-sm">
                            A passionate developer crafting robust web solutions with Laravel, Vue.js, and modern technologies. Dedicated to performance, clean architecture, and exquisite user experiences.
                        </p>
                    </div>

                    <!-- Column 2: Navigation Links -->
                    <div class="space-y-4">
                        <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Navigation</h4>
                        <ul class="space-y-2">
                            <li>
                                <Link :href="home().url" class="text-sm text-slate-400 hover:text-white transition-colors duration-200">
                                    Home
                                </Link>
                            </li>
                            <li>
                                <Link :href="portfolio().url" class="text-sm text-slate-400 hover:text-white transition-colors duration-200">
                                    Portfolio
                                </Link>
                            </li>
                            <li>
                                <Link :href="contact().url" class="text-sm text-slate-400 hover:text-white transition-colors duration-200">
                                    Contact
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Column 3: Social & Contact -->
                    <div class="space-y-4">
                        <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Connect</h4>
                        <div class="flex gap-4">
                            <a 
                                href="https://github.com" 
                                target="_blank" 
                                class="h-9 w-9 rounded-lg bg-slate-800/80 hover:bg-blue-600/20 hover:text-blue-400 flex items-center justify-center text-slate-400 border border-slate-700 transition-all duration-300"
                                aria-label="GitHub"
                            >
                                <Github class="w-5 h-5" />
                            </a>
                            <a 
                                href="https://linkedin.com" 
                                target="_blank" 
                                class="h-9 w-9 rounded-lg bg-slate-800/80 hover:bg-blue-600/20 hover:text-blue-400 flex items-center justify-center text-slate-400 border border-slate-700 transition-all duration-300"
                                aria-label="LinkedIn"
                            >
                                <Linkedin class="w-5 h-5" />
                            </a>
                            <a 
                                href="mailto:contact@example.com" 
                                class="h-9 w-9 rounded-lg bg-slate-800/80 hover:bg-blue-600/20 hover:text-blue-400 flex items-center justify-center text-slate-400 border border-slate-700 transition-all duration-300"
                                aria-label="Email"
                            >
                                <Mail class="w-5 h-5" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-800/60 mt-8 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500">
                        &copy; {{ currentYear }} Athallah Tsany Satriyaji. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
