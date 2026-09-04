<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { 
    Menu, 
    X, 
    Mail, 
    Briefcase,
    Home as HomeIcon,
    PhoneCall
} from '@lucide/vue';
import { ref } from 'vue';
import { home, portfolio, contact } from '@/routes';

interface ContactInfo {
    name: string;
    email: string | null;
    whatsapp: string | null;
    linkedin: string | null;
    github: string | null;
    instagram: string | null;
}

// Mobile menu open/close state
const isMobileMenuOpen = ref(false);

const page = usePage<{ contact?: ContactInfo | null }>();

const contactInfo = page.props.contact;

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
    <div class="relative flex min-h-screen flex-col overflow-x-hidden bg-[#030712] font-sans text-slate-100 selection:bg-blue-500/30 selection:text-blue-200">
        <div class="pointer-events-none absolute inset-x-0 top-0 z-0 h-128 bg-linear-to-b from-blue-950/25 via-transparent to-transparent"></div>

        <header class="sticky top-0 z-50 w-full border-b border-slate-800/70 bg-[#030712]/85 backdrop-blur-xl">
            <div class="mx-auto flex h-18 w-full max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <Link :href="home().url" class="group z-50 flex min-w-0 items-center gap-3 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400 focus-visible:ring-offset-2 focus-visible:ring-offset-[#030712]">
                    <img src="/favicon.svg" class="h-10 w-10 rounded-md m-0 shadow-lg shadow-blue-500/20 transition-transform duration-300 group-hover:scale-105" alt="web icon">
                    <span class="truncate text-base font-bold tracking-tight text-slate-100 transition-colors duration-300 group-hover:text-blue-400 sm:text-lg">
                        Athallah Tsany
                    </span>
                </Link>

                <nav class="hidden items-center gap-1 rounded-full border border-slate-800/80 bg-slate-950/30 p-1 md:flex" aria-label="Primary navigation">
                    <Link :href="home().url" class="relative rounded-full px-4 py-2 text-sm font-medium transition-colors duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400" :class="isRouteActive('/') ? 'bg-blue-500/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'">
                        Home
                    </Link>
                    <Link :href="portfolio().url" class="relative rounded-full px-4 py-2 text-sm font-medium transition-colors duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400" :class="isRouteActive('/portfolio') ? 'bg-blue-500/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'">
                        Portfolio
                    </Link>
                    <Link :href="contact().url" class="relative rounded-full px-4 py-2 text-sm font-medium transition-colors duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400" :class="isRouteActive('/contact') ? 'bg-blue-500/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'">
                        Contact Me
                    </Link>
                </nav>

                <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="rounded-xl border border-slate-800 p-2.5 text-slate-300 transition-colors hover:border-slate-700 hover:bg-slate-800/70 hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400 md:hidden" aria-label="Toggle menu">
                    <Menu v-if="!isMobileMenuOpen" class="h-5 w-5" />
                    <X v-else class="h-5 w-5" />
                </button>
            </div>

            <transition enter-active-class="transition duration-200 ease-out" enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-2">
                <div v-if="isMobileMenuOpen" class="border-t border-slate-800/70 bg-[#030712] px-4 py-4 shadow-2xl sm:px-6 md:hidden">
                    <nav class="mx-auto flex w-full max-w-7xl flex-col gap-1" aria-label="Mobile navigation">
                        <Link :href="home().url" @click="isMobileMenuOpen = false" class="flex min-h-12 items-center gap-3 rounded-xl px-4 text-base font-medium transition-colors" :class="isRouteActive('/') ? 'bg-blue-500/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'"><HomeIcon class="h-5 w-5" />Home</Link>
                        <Link :href="portfolio().url" @click="isMobileMenuOpen = false" class="flex min-h-12 items-center gap-3 rounded-xl px-4 text-base font-medium transition-colors" :class="isRouteActive('/portfolio') ? 'bg-blue-500/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'"><Briefcase class="h-5 w-5" />Portfolio</Link>
                        <Link :href="contact().url" @click="isMobileMenuOpen = false" class="flex min-h-12 items-center gap-3 rounded-xl px-4 text-base font-medium transition-colors" :class="isRouteActive('/contact') ? 'bg-blue-500/10 text-blue-400' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white'"><PhoneCall class="h-5 w-5" />Contact Me</Link>
                    </nav>
                </div>
            </transition>
        </header>

        <main class="relative z-10 flex-1">
            <slot />
        </main>

        <footer class="relative z-10 border-t border-slate-800/80 bg-[#02050e] py-12 sm:py-16">
            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
                    <div class="space-y-5 sm:col-span-2">
                        <Link :href="home().url" class="group flex w-fit items-center gap-3 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400">
                            <img src="/favicon.svg" class="h-10 w-10 rounded-md m-0 shadow-lg shadow-blue-500/20 transition-transform duration-300 group-hover:scale-105" alt="web icon">
                            <span class="text-base font-bold tracking-tight text-white transition-colors duration-300 group-hover:text-blue-400 sm:text-lg">Athallah Tsany Satriyaji</span>
                        </Link>
                        <p class="max-w-md text-sm leading-6 text-slate-400 sm:text-[15px]">
                            A passionate developer crafting robust web solutions with Laravel, Vue.js, and modern technologies. Dedicated to performance, clean architecture, and exquisite user experiences.
                        </p>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300">Navigation</h4>
                        <ul class="flex flex-col gap-3">
                            <li><Link :href="home().url" class="text-sm text-slate-400 transition-colors duration-200 hover:text-white">Home</Link></li>
                            <li><Link :href="portfolio().url" class="text-sm text-slate-400 transition-colors duration-200 hover:text-white">Portfolio</Link></li>
                            <li><Link :href="contact().url" class="text-sm text-slate-400 transition-colors duration-200 hover:text-white">Contact</Link></li>
                        </ul>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300">Connect</h4>
                        <div class="flex gap-3">
                            <a v-if="contactInfo?.github" :href="contactInfo.github" target="_blank" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-800/70 text-slate-400 transition-all duration-300 hover:border-blue-500/50 hover:bg-blue-600/20 hover:text-blue-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400" aria-label="GitHub"><img src="/images/github-white.png" class="h-5 w-5" alt="GitHub" /></a>
                            <a v-if="contactInfo?.linkedin" :href="contactInfo.linkedin" target="_blank" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-800/70 text-slate-400 transition-all duration-300 hover:border-blue-500/50 hover:bg-blue-600/20 hover:text-blue-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400" aria-label="LinkedIn"><img src="/images/linkedin.png" class="h-5 w-5" alt="LinkedIn" /></a>
                            <a v-if="contactInfo?.email" :href="`mailto:${contactInfo.email}`" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-800/70 text-slate-400 transition-all duration-300 hover:border-blue-500/50 hover:bg-blue-600/20 hover:text-blue-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400" aria-label="Email"><Mail class="h-5 w-5" /></a>
                        </div>
                    </div>
                </div>
                <div class="mt-10 border-t border-slate-800/60 pt-6">
                    <p class="text-xs leading-5 text-slate-500">&copy; {{ currentYear }} Athallah Tsany Satriyaji. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
