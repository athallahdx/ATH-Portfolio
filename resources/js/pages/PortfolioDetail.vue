<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowLeft,
    ArrowUpRight,
    Calendar,
    Code,
    Folder,
    Tag as TagIcon,
} from '@lucide/vue';
import { computed } from 'vue';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { portfolio as portfolioRoute } from '@/routes';
import { show as portfolioShow } from '@/routes/portfolio';

interface PortfolioType {
    id: number;
    name: string;
    description: string | null;
}

interface TechstackItem {
    id: number;
    name: string;
    icon: string | null;
}

interface TagItem {
    id: number;
    name: string;
}

interface PortfolioImage {
    id: number;
    image: string;
    label: string | null;
    sort_order: number;
}

interface PortfolioItem {
    id: number;
    slug: string;
    title: string;
    description: string | null;
    start_date: string | null;
    end_date: string | null;
    url: string | null;
    contributions: string[] | null;
    type?: PortfolioType | null;
    techstacks?: TechstackItem[];
    tags?: TagItem[];
    images?: PortfolioImage[];
}

const props = defineProps<{
    portfolio: PortfolioItem;
    related: PortfolioItem[];
}>();

const getImageUrl = (image: string): string => image.startsWith('http') ? image : `/storage/${image}`;

const formatDate = (date: string | null): string => {
    if (!date) {
        return 'Not specified';
    }

    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
    });
};

const dateRange = computed(() => `${formatDate(props.portfolio.start_date)} - ${props.portfolio.end_date ? formatDate(props.portfolio.end_date) : 'Present'}`);
</script>

<template>
    <Head :title="`${portfolio.title} | Portfolio`" />

    <PublicLayout>
        <main class="relative min-h-screen overflow-hidden bg-[#030712] px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(59,130,246,0.08),transparent_65%)]"></div>

            <div class="relative mx-auto max-w-6xl space-y-12">
                <Link
                    :href="portfolioRoute().url"
                    class="inline-flex items-center gap-2 text-md font-semibold text-slate-400 transition-colors hover:text-white"
                >
                    <ArrowLeft class="h-6 w-6" />
                    Back to projects
                </Link>

                <header class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-end">
                    <div class="space-y-5">
                        <div class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-[0.16em] text-blue-400">
                            <span v-if="portfolio.tags?.length" class="inline-flex items-center gap-1.5">
                                <Folder class="h-4 w-4" />
                                {{ portfolio.tags?.[0]?.name }}
                            </span>
                            <span class="text-slate-700">/</span>
                            <span class="inline-flex items-center gap-1.5 text-slate-500">
                                <Calendar class="h-4 w-4" />
                                {{ dateRange }}
                            </span>
                        </div>
                        <h1 class="max-w-4xl text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">
                            {{ portfolio.title }}
                        </h1>
                        <p class="max-w-3xl text-base leading-relaxed text-slate-400 sm:text-lg">
                            {{ portfolio.description || 'A portfolio project built with thoughtful architecture and practical engineering.' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3 lg:justify-end">
                        <a
                            v-if="portfolio.url"
                            :href="portfolio.url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-blue-500"
                        >
                            Visit project
                            <ArrowUpRight class="h-4 w-4" />
                        </a>
                        <span v-else class="inline-flex items-center gap-2 rounded-lg border border-slate-800 px-5 py-3 text-sm font-semibold text-slate-500">
                            Project link unavailable
                        </span>
                    </div>
                </header>

                <section v-if="portfolio.images?.length" class="grid gap-4 sm:grid-cols-2">
                    <figure
                        v-for="(image, index) in portfolio.images"
                        :key="image.id"
                        class="group overflow-hidden rounded-xl border border-slate-800/80 bg-slate-950"
                        :class="index === 0 ? 'sm:col-span-2' : ''"
                    >
                        <img
                            :src="getImageUrl(image.image)"
                            :alt="image.label || portfolio.title"
                            class="aspect-video h-full w-full object-cover transition duration-500 group-hover:scale-[1.02]"
                        />
                        <figcaption v-if="image.label" class="border-t border-slate-800/80 px-4 py-3 text-xs text-slate-400">
                            {{ image.label }}
                        </figcaption>
                    </figure>
                </section>

                <section v-else class="flex min-h-64 items-center justify-center rounded-xl border border-slate-800/80 bg-slate-900/20 p-8 text-center">
                    <div class="space-y-3">
                        <Code class="mx-auto h-8 w-8 text-slate-600" />
                        <p class="text-sm text-slate-500">No project images available.</p>
                    </div>
                </section>

                <div class="grid gap-8 lg:grid-cols-[1.3fr_0.7fr]">
                    <section class="space-y-4">
                        <h2 class="text-2xl font-bold text-white">Project overview</h2>
                        <p class="whitespace-pre-line text-sm leading-7 text-slate-400 sm:text-base">
                            {{ portfolio.description || 'No project overview has been added yet.' }}
                        </p>
                    </section>

                    <aside class="space-y-6 rounded-xl border border-slate-800/80 bg-slate-900/30 p-6">
                        <div v-if="portfolio.contributions?.length" class="space-y-3">
                            <h2 class="text-sm font-bold uppercase tracking-[0.16em] text-slate-300">Contributions</h2>
                            <ul class="space-y-2 text-sm text-slate-400">
                                <li v-for="contribution in portfolio.contributions" :key="contribution" class="flex gap-2">
                                    <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-blue-400"></span>
                                    {{ contribution }}
                                </li>
                            </ul>
                        </div>

                        <div v-if="portfolio.techstacks?.length" class="space-y-3">
                            <h2 class="text-sm font-bold uppercase tracking-[0.16em] text-slate-300">Technology</h2>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="techstack in portfolio.techstacks" :key="techstack.id" class="inline-flex items-center gap-1.5 rounded-md border border-slate-700 bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-slate-300">
                                    <Code class="h-3.5 w-3.5 text-blue-400" />
                                    {{ techstack.name }}
                                </span>
                            </div>
                        </div>

                        <div v-if="portfolio.tags?.length" class="space-y-3">
                            <h2 class="text-sm font-bold uppercase tracking-[0.16em] text-slate-300">Tags</h2>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="tag in portfolio.tags" :key="tag.id" class="inline-flex items-center gap-1.5 rounded-md border border-slate-700 bg-slate-950 px-2.5 py-1.5 text-xs font-semibold text-slate-300">
                                    <TagIcon class="h-3.5 w-3.5 text-blue-400" />
                                    {{ tag.name }}
                                </span>
                            </div>
                        </div>
                    </aside>
                </div>

                <section v-if="related.length" class="space-y-6 border-t border-slate-800/80 pt-10">
                    <div class="flex items-end justify-between gap-4">
                        <div>
                            <p class="font-mono text-xs uppercase tracking-[0.16em] text-blue-400/80">// continue-exploring</p>
                            <h2 class="mt-2 text-2xl font-bold text-white">Related projects</h2>
                        </div>
                        <Link :href="portfolioRoute().url" class="hidden text-sm font-semibold text-blue-400 hover:text-blue-300 sm:inline-flex sm:items-center sm:gap-2">
                            View all
                            <ArrowUpRight class="h-4 w-4" />
                        </Link>
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        <Link
                            v-for="project in related"
                            :key="project.id"
                            :href="portfolioShow({ slug: project.slug }).url"
                            class="group overflow-hidden rounded-xl border border-slate-800/80 bg-slate-900/25 transition-colors hover:border-blue-500/40"
                        >
                            <div class="aspect-video overflow-hidden bg-slate-950">
                                <img
                                    v-if="project.images?.[0]"
                                    :src="getImageUrl(project.images[0].image)"
                                    :alt="project.title"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
                                />
                                <div v-else class="flex h-full items-center justify-center text-slate-600">
                                    <Code class="h-7 w-7" />
                                </div>
                            </div>
                            <div class="space-y-2 p-5">
                                <p class="text-xs font-semibold uppercase tracking-wider text-blue-400">{{ project.type?.name || 'Project' }}</p>
                                <h3 class="font-bold text-white group-hover:text-blue-400">{{ project.title }}</h3>
                                <p class="line-clamp-2 text-sm leading-relaxed text-slate-400">{{ project.description }}</p>
                            </div>
                        </Link>
                    </div>
                </section>
            </div>
        </main>
    </PublicLayout>
</template>