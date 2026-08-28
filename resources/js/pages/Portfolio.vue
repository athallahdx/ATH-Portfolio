<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { 
    Code, 
    ArrowRight, 
    ExternalLink, 
    Calendar, 
    Folder, 
    Tag as TagIcon,
    X,
    Layers
} from '@lucide/vue';

interface TechstackItem {
    id: number;
    name: string;
    icon: string;
}

interface TagItem {
    id: number;
    name: string;
}

interface PortfolioType {
    id: number;
    name: string;
    description: string | null;
}

interface PortfolioItem {
    id: number;
    title: string;
    description: string;
    start_date: string;
    end_date: string | null;
    url: string | null;
    type?: PortfolioType;
    techstacks?: TechstackItem[];
    tags?: TagItem[];
    images?: {
        image: string;
        label: string;
    }[];
}

interface PaginationLinks {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedPortfolios {
    data: PortfolioItem[];
    links: PaginationLinks[];
    current_page: number;
    last_page: number;
    total: number;
}

const props = defineProps<{
    portfolios: PaginatedPortfolios;
    types: PortfolioType[];
    filters: {
        tag?: string;
        techstack?: string;
        type?: string;
    };
}>();

// Formats portfolio dates
const formatDateRange = (start: string, end: string | null) => {
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'short' };
    const startDate = new Date(start).toLocaleDateString('en-US', options);
    const endDate = end ? new Date(end).toLocaleDateString('en-US', options) : 'Present';
    return `${startDate} - ${endDate}`;
};
</script>

<template>
    <Head title="Portfolio | Athallah Tsany Satriyaji" />

    <PublicLayout>
        <div class="relative min-h-screen py-20 px-4 sm:px-6 lg:px-8 bg-[#030712]">
            <!-- Grid decoration background -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(59,130,246,0.05),transparent_70%)] pointer-events-none z-0"></div>

            <div class="max-w-7xl mx-auto relative z-10 space-y-12">
                <!-- Header -->
                <div class="text-center max-w-3xl mx-auto space-y-4">
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight">
                        My <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">Project Directory</span>
                    </h1>
                    <div class="h-1 w-20 bg-blue-500 mx-auto rounded-full"></div>
                    <p class="text-slate-400 text-sm sm:text-base max-w-xl mx-auto">
                        Explore detailed case studies and technical architectures of platforms, API setups, and systems I have designed and deployed.
                    </p>
                </div>

                <!-- Filter Controls / Tags -->
                <div class="space-y-4 max-w-5xl mx-auto bg-slate-900/30 border border-slate-850 p-6 rounded-2xl backdrop-blur-md">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-slate-350 text-sm font-semibold">
                            <Layers class="w-4 h-4 text-blue-400" />
                            Categories / Project Types:
                        </div>
                        <div v-if="filters.type || filters.tag || filters.techstack" class="flex">
                            <Link 
                                href="/portfolio" 
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 border border-red-500/25 text-red-400 hover:bg-red-500 hover:text-white transition-all text-xs font-semibold"
                            >
                                Clear Active Filters
                                <X class="w-3.5 h-3.5" />
                            </Link>
                        </div>
                    </div>

                    <!-- Type Filter Tabs -->
                    <div class="flex flex-wrap gap-2 pt-2">
                        <Link 
                            href="/portfolio" 
                            class="px-4 py-2 rounded-xl text-xs font-bold border transition-all duration-300"
                            :class="!filters.type 
                                ? 'bg-blue-600 border-blue-500 text-white shadow-md shadow-blue-500/20' 
                                : 'bg-slate-950 border-slate-850 text-slate-400 hover:border-slate-700 hover:text-white'"
                        >
                            All Categories
                        </Link>
                        
                        <Link 
                            v-for="pType in types" 
                            :key="pType.id"
                            :href="'/portfolio?type=' + encodeURIComponent(pType.name)"
                            class="px-4 py-2 rounded-xl text-xs font-bold border transition-all duration-300"
                            :class="filters.type === pType.name 
                                ? 'bg-blue-600 border-blue-500 text-white shadow-md shadow-blue-500/25' 
                                : 'bg-slate-950 border-slate-850 text-slate-400 hover:border-slate-700 hover:text-white'"
                        >
                            {{ pType.name }}
                        </Link>
                    </div>

                    <!-- Active Tag / Techstack Alert -->
                    <div v-if="filters.tag || filters.techstack" class="flex flex-wrap gap-2 items-center pt-2 text-xs">
                        <span class="text-slate-500 font-semibold uppercase tracking-wider">Active Filters:</span>
                        <div v-if="filters.tag" class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-blue-500/10 border border-blue-500/25 text-blue-400 font-medium">
                            <TagIcon class="w-3.5 h-3.5" />
                            Tag: {{ filters.tag }}
                        </div>
                        <div v-if="filters.techstack" class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-indigo-500/10 border border-indigo-500/25 text-indigo-400 font-medium">
                            <Code class="w-3.5 h-3.5" />
                            Techstack: {{ filters.techstack }}
                        </div>
                    </div>
                </div>

                <!-- Portfolios Grid -->
                <div v-if="portfolios.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="proj in portfolios.data" 
                        :key="proj.id"
                        class="flex flex-col bg-slate-900/25 border border-slate-850 rounded-2xl overflow-hidden hover:border-slate-700/60 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1"
                    >
                        <!-- Project Image / Icon -->
                        <div class="relative aspect-video w-full bg-slate-950 overflow-hidden border-b border-slate-900 flex items-center justify-center">
                            <img 
                                v-if="proj.images && proj.images.length > 0"
                                :src="'/storage/' + proj.images[0].image"
                                :alt="proj.title"
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500"
                            />
                            <!-- Placeholder gradient visual -->
                            <div v-else class="w-full h-full bg-gradient-to-tr from-slate-900 via-blue-950/20 to-slate-900 flex flex-col items-center justify-center p-6 text-center space-y-2">
                                <span class="h-10 w-10 rounded-xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                                    <Code class="w-5 h-5" />
                                </span>
                                <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">{{ proj.type?.name ?? 'Application' }}</span>
                            </div>
                        </div>

                        <!-- Project Information -->
                        <div class="flex-grow p-6 flex flex-col justify-between space-y-6">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <span class="flex items-center gap-1">
                                        <Calendar class="w-3.5 h-3.5 text-slate-500" />
                                        {{ formatDateRange(proj.start_date, proj.end_date) }}
                                    </span>
                                    <span v-if="proj.type" class="flex items-center gap-1 font-semibold text-blue-400">
                                        <Folder class="w-3.5 h-3.5" />
                                        {{ proj.type.name }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors">
                                    {{ proj.title }}
                                </h3>
                                <p class="text-sm text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ proj.description }}
                                </p>
                            </div>

                            <div class="space-y-4 pt-2">
                                <!-- Tech tags -->
                                <div v-if="proj.techstacks && proj.techstacks.length > 0" class="flex flex-wrap gap-1.5">
                                    <Link 
                                        v-for="ts in proj.techstacks.slice(0, 4)" 
                                        :key="ts.id"
                                        :href="'/portfolio?techstack=' + encodeURIComponent(ts.name)"
                                        class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-950 border border-slate-800 hover:border-blue-500/30 text-slate-350 hover:text-white transition-colors"
                                    >
                                        {{ ts.name }}
                                    </Link>
                                    <span v-if="proj.techstacks.length > 4" class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-950 border border-slate-800 text-slate-400">
                                        +{{ proj.techstacks.length - 4 }} more
                                    </span>
                                </div>

                                <!-- Read details CTA -->
                                <div class="border-t border-slate-800/80 pt-4 flex items-center justify-between">
                                    <Link 
                                        :href="'/portfolio/' + proj.id" 
                                        class="text-xs font-bold text-blue-400 hover:text-blue-300 inline-flex items-center gap-1 transition-colors"
                                    >
                                        Read Project Case Study
                                        <ArrowRight class="w-3.5 h-3.5" />
                                    </Link>
                                    
                                    <a 
                                        v-if="proj.url" 
                                        :href="proj.url" 
                                        target="_blank" 
                                        class="text-slate-400 hover:text-white transition-colors"
                                        aria-label="Launch project site"
                                    >
                                        <ExternalLink class="w-4 h-4" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-20 bg-slate-900/10 border border-slate-850 rounded-3xl max-w-4xl mx-auto space-y-4">
                    <div class="h-12 w-12 rounded-xl bg-slate-800 flex items-center justify-center text-slate-500 mx-auto">
                        <Folder class="w-6 h-6" />
                    </div>
                    <h3 class="text-lg font-bold text-white">No projects found</h3>
                    <p class="text-slate-400 text-sm max-w-sm mx-auto">
                        No projects match the selected active filters. Try clearing filters to see the full list of works.
                    </p>
                    <Link 
                        href="/portfolio" 
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 font-semibold text-xs text-slate-200 border border-slate-750"
                    >
                        Reset All Filters
                    </Link>
                </div>

                <!-- Pagination Links -->
                <div v-if="portfolios.links && portfolios.links.length > 3" class="flex justify-center items-center gap-1.5 pt-6">
                    <Link 
                        v-for="(link, index) in portfolios.links" 
                        :key="index"
                        :href="link.url || '#'"
                        v-html="link.label"
                        class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-200"
                        :class="link.active 
                            ? 'bg-blue-600 border-blue-500 text-white shadow-md shadow-blue-500/20' 
                            : (!link.url ? 'text-slate-650 cursor-not-allowed border-slate-900' : 'bg-slate-900/40 border-slate-850 text-slate-400 hover:border-slate-700 hover:text-white')"
                    />
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
