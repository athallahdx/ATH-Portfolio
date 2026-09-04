<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { 
    Code, 
    ArrowRight, 
    ExternalLink, 
    Calendar, 
    Folder, 
    Tag as TagIcon,
    X,
} from '@lucide/vue';
import { computed } from 'vue';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { portfolio as portfolioRoute } from '@/routes';
import { show as portfolioShow } from '@/routes/portfolio';

interface TechstackItem {
    id: number;
    name: string;
    icon: string;
}

interface TagItem {
    id: number;
    name: string;
}

interface FilterOptions {
    tags: TagItem[];
    techstacks: { id: number; name: string }[];
}

type FilterValue = string | string[];

interface PortfolioItem {
    id: number;
    title: string;
    slug: string;
    description: string;
    client: string | null;
    start_date: string;
    end_date: string | null;
    url: string | null;
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
    portfolios?: PaginatedPortfolios;
    hasActivePortfolios?: boolean;
    filters?: {
        tag?: FilterValue;
        techstack?: FilterValue;
    };
    filterOptions?: FilterOptions;
}>();

const selectedValues = (value?: FilterValue): string[] => value ? (Array.isArray(value) ? value : [value]) : [];

const hasActiveFilters = computed(() => selectedValues(props.filters?.tag).length > 0 || selectedValues(props.filters?.techstack).length > 0);

const filterUrl = (filter: 'tag' | 'techstack', value: string): string => portfolioRoute({
    query: {
        tag: filter === 'tag'
            ? selectedValues(props.filters?.tag).includes(value)
                ? selectedValues(props.filters?.tag).filter((item) => item !== value)
                : [...selectedValues(props.filters?.tag), value]
            : selectedValues(props.filters?.tag),
        techstack: filter === 'techstack'
            ? selectedValues(props.filters?.techstack).includes(value)
                ? selectedValues(props.filters?.techstack).filter((item) => item !== value)
                : [...selectedValues(props.filters?.techstack), value]
            : selectedValues(props.filters?.techstack),
    },
}).url;

const openPortfolio = (slug: string): void => {
    router.visit(portfolioShow({ portfolio: slug }).url);
};

const handlePortfolioCardKeydown = (event: KeyboardEvent, slug: string): void => {
    if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        openPortfolio(slug);
    }
};

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
        <div class="relative min-h-screen bg-[#030712] px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <!-- Grid decoration background -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(59,130,246,0.05),transparent_70%)] pointer-events-none z-0"></div>

            <div class="relative z-10 mx-auto w-full max-w-7xl space-y-14">
                <!-- Header -->
                <div class="mx-auto max-w-3xl space-y-5 text-center">
                    <h1 class="max-w-3xl text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">
                        My <span class="bg-linear-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">Project Directory</span>
                    </h1>
                    <p class="mx-auto max-w-2xl text-base leading-relaxed text-slate-400 sm:text-lg">
                        Explore detailed case studies and technical architectures of platforms, API setups, and systems I have designed and deployed.
                    </p>
                </div>

                <!-- Filter Controls / Tags -->
                <div class="mx-auto max-w-5xl space-y-5 border-y border-slate-800/80 px-1 py-5 sm:px-2">
                    <div class="flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
                        <h2 class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Filter projects</h2>
                        <div v-if="filters?.tag || filters?.techstack" class="flex">
                            <Link 
                                :href="portfolioRoute().url"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 border border-red-500/25 text-red-400 hover:bg-red-500 hover:text-white transition-all text-xs font-semibold"
                            >
                                Clear Active Filters
                                <X class="w-3.5 h-3.5" />
                            </Link>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <Link
                            v-for="tag in filterOptions?.tags ?? []"
                            :key="`tag-${tag.id}`"
                            :href="filterUrl('tag', tag.name)"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-slate-800 bg-slate-950/70 px-3 py-1.5 text-xs font-semibold text-slate-400 transition-colors hover:border-blue-500/40 hover:text-blue-300"
                            :class="selectedValues(filters?.tag).includes(tag.name) ? 'border-blue-500/60 bg-blue-500/15 text-blue-300' : ''"
                        >
                            <TagIcon class="h-3.5 w-3.5" />
                            {{ tag.name }}
                        </Link>
                        <Link
                            v-for="techstack in filterOptions?.techstacks ?? []"
                            :key="`techstack-${techstack.id}`"
                            :href="filterUrl('techstack', techstack.name)"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-slate-800 bg-slate-950/70 px-3 py-1.5 text-xs font-semibold text-slate-400 transition-colors hover:border-indigo-500/40 hover:text-indigo-300"
                            :class="selectedValues(filters?.techstack).includes(techstack.name) ? 'border-indigo-500/60 bg-indigo-500/15 text-indigo-300' : ''"
                        >
                            <Code class="h-3.5 w-3.5" />
                            {{ techstack.name }}
                        </Link>
                    </div>

                    <!-- Active Tag / Techstack Alert -->
                    <div v-if="filters?.tag || filters?.techstack" class="flex flex-wrap gap-2 items-center pt-2 text-xs">
                        <span class="text-slate-500 font-semibold uppercase tracking-wider">Active Filters:</span>
                        <div v-for="tag in selectedValues(filters?.tag)" :key="`active-tag-${tag}`" class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-blue-500/10 border border-blue-500/25 text-blue-400 font-medium">
                            <TagIcon class="w-3.5 h-3.5" />
                            Tag: {{ tag }}
                        </div>
                        <div v-for="techstack in selectedValues(filters?.techstack)" :key="`active-techstack-${techstack}`" class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-indigo-500/10 border border-indigo-500/25 text-indigo-400 font-medium">
                            <Code class="w-3.5 h-3.5" />
                            Techstack: {{ techstack }}
                        </div>
                    </div>
                </div>

                <!-- Portfolios Grid -->
                <div v-if="portfolios?.data?.length" class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 lg:gap-6">
                    <div 
                        v-for="proj in portfolios.data" 
                        :key="proj.id"
                        class="group flex cursor-pointer flex-col overflow-hidden border border-slate-800/90 bg-slate-900/20 transition-colors duration-300 hover:border-slate-700"
                        role="link"
                        tabindex="0"
                        :aria-label="`View details for ${proj.title}`"
                        @click="openPortfolio(proj.slug)"
                        @keydown="handlePortfolioCardKeydown($event, proj.slug)"
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
                            <div v-else class="w-full h-full bg-linear-to-tr from-slate-900 via-blue-950/20 to-slate-900 flex flex-col items-center justify-center p-6 text-center space-y-2">
                                <span class="h-10 w-10 rounded-xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                                    <Code class="w-5 h-5" />
                                </span>
                                <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">{{ proj.tags?.[0]?.name ?? 'Application' }}</span>
                            </div>
                        </div>

                        <!-- Project Information -->
                        <div class="flex grow flex-col justify-between space-y-5 p-4 sm:p-5">
                            <div class="space-y-2.5">
                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <span class="flex items-center gap-1">
                                        <Calendar class="w-3.5 h-3.5 text-slate-500" />
                                        {{ formatDateRange(proj.start_date, proj.end_date) }}
                                    </span>
                                    <span v-if="proj.tags?.[0]" class="flex items-center gap-1 font-semibold text-blue-400">
                                        <Folder class="w-3.5 h-3.5" />
                                        {{ proj.tags[0].name }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold leading-snug text-white transition-colors group-hover:text-blue-400">
                                    {{ proj.title }}
                                </h3>
                                <p class="text-sm text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ proj.description }}
                                </p>
                            </div>

                            <div class="space-y-3">
                                <!-- Tech tags -->
                                <div v-if="proj.techstacks && proj.techstacks.length > 0" class="flex flex-wrap gap-1">
                                    <Link 
                                        v-for="ts in proj.techstacks.slice(0, 4)" 
                                        :key="ts.id"
                                        :href="filterUrl('techstack', ts.name)"
                                        @click.stop
                                        @keydown.stop
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
                                        :href="portfolioShow({ portfolio: proj.slug }).url"
                                        @click.stop
                                        @keydown.stop
                                        class="text-xs font-bold text-blue-400 hover:text-blue-300 inline-flex items-center gap-1 transition-colors"
                                    >
                                        Read Details
                                        <ArrowRight class="w-3.5 h-3.5" />
                                    </Link>
                                    
                                    <a 
                                        v-if="proj.url" 
                                        :href="proj.url" 
                                        target="_blank" 
                                        @click.stop
                                        @keydown.stop
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
                    <h3 class="text-lg font-bold text-white">
                        {{ !portfolios
                            ? 'Portfolio data is unavailable'
                            : !props.hasActivePortfolios
                                ? 'No portfolio projects available'
                                : 'No projects found' }}
                    </h3>
                    <p class="text-slate-400 text-sm max-w-sm mx-auto">
                        {{ !portfolios
                            ? 'Portfolio projects could not be loaded right now. Please check back later.'
                            : !props.hasActivePortfolios
                                ? 'There are currently no active portfolio projects to display.'
                                : 'No projects match the selected active filters. Try clearing filters to see the full list of works.' }}
                    </p>
                    <Link 
                        v-if="hasActiveFilters"
                        :href="portfolioRoute().url"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 font-semibold text-xs text-slate-200 border border-slate-750"
                    >
                        Reset All Filters
                    </Link>
                </div>

                <!-- Pagination Links -->
                <div v-if="portfolios?.links && portfolios.links.length > 3" class="flex justify-center items-center gap-1.5 pt-6">
                    <Link 
                        v-for="(link, index) in portfolios.links" 
                        :key="index"
                        :href="link.url || '#'"
                        class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-200"
                        :class="link.active 
                            ? 'bg-blue-600 border-blue-500 text-white shadow-md shadow-blue-500/20' 
                            : (!link.url ? 'text-slate-650 cursor-not-allowed border-slate-900' : 'bg-slate-900/40 border-slate-850 text-slate-400 hover:border-slate-700 hover:text-white')"
                    >
                        <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
