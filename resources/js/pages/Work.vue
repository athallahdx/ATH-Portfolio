<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight, BriefcaseBusiness, Calendar, Code, Folder, Tag as TagIcon } from '@lucide/vue';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { show as workShow } from '@/routes/work';

interface TagItem {
	id: number;
	name: string;
}

interface PortfolioItem {
	id: number;
	slug: string;
	title: string;
	description: string | null;
	start_date: string | null;
	end_date: string | null;
	url: string | null;
	tags?: TagItem[];
	images?: { image: string; label: string | null }[];
}

interface PaginationLink {
	url: string | null;
	label: string;
	active: boolean;
}

interface PaginatedPortfolios {
	data: PortfolioItem[];
	links: PaginationLink[];
}

defineProps<{
	portfolios?: PaginatedPortfolios;
	hasActivePortfolios?: boolean;
}>();

const formatDateRange = (start: string | null, end: string | null): string => {
	if (!start) {
		return 'Dates not specified';
	}

	const formatDate = (date: string): string => new Date(date).toLocaleDateString('en-US', { year: 'numeric', month: 'short' });

	return `${formatDate(start)} - ${end ? formatDate(end) : 'Present'}`;
};
</script>

<template>
	<Head title="Work Experience | Athallah Tsany Satriyaji" />

	<PublicLayout>
		<main class="relative min-h-screen overflow-hidden bg-[#030712] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
			<div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,rgba(14,165,233,0.08),transparent_65%)]"></div>

			<div class="relative mx-auto w-full max-w-7xl space-y-14">
				<header class="mx-auto max-w-3xl space-y-5 text-center">
					<div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-cyan-400/20 bg-cyan-400/10 text-cyan-300">
						<BriefcaseBusiness class="h-7 w-7" />
					</div>
					<h1 class="text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">Work Experience</h1>
					<p class="text-base leading-relaxed text-slate-400 sm:text-lg">A selection of roles, collaborations, and practical engineering work.</p>
				</header>

				<section v-if="portfolios?.data?.length" class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 lg:gap-6">
					<Link v-for="work in portfolios.data" :key="work.id" :href="workShow({ portfolio: work.slug }).url" class="group flex flex-col overflow-hidden border border-slate-800/90 bg-slate-900/20 transition-colors hover:border-cyan-500/40">
						<div class="relative aspect-video overflow-hidden border-b border-slate-900 bg-slate-950">
							<img v-if="work.images?.[0]" :src="`/storage/${work.images[0].image}`" :alt="work.images[0].label || work.title" class="h-full w-full object-cover grayscale transition duration-500 group-hover:scale-[1.02] group-hover:grayscale-0" />
							<div v-else class="flex h-full flex-col items-center justify-center gap-3 bg-linear-to-tr from-slate-900 via-cyan-950/20 to-slate-900 text-cyan-300">
								<Code class="h-8 w-8" />
								<span class="text-xs font-bold uppercase tracking-widest">{{ work.tags?.[0]?.name || 'Experience' }}</span>
							</div>
						</div>

						<div class="flex grow flex-col justify-between gap-5 p-4 sm:p-5">
							<div class="space-y-3">
								<div class="flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500">
									<span class="inline-flex items-center gap-1.5"><Calendar class="h-3.5 w-3.5" />{{ formatDateRange(work.start_date, work.end_date) }}</span>
									<span v-if="work.tags?.[0]" class="inline-flex items-center gap-1.5 font-semibold text-cyan-300"><TagIcon class="h-3.5 w-3.5" />{{ work.tags[0].name }}</span>
								</div>
								<h2 class="text-lg font-semibold leading-snug text-white transition-colors group-hover:text-cyan-300">{{ work.title }}</h2>
								<p class="line-clamp-3 text-sm leading-relaxed text-slate-400">{{ work.description || 'Work experience details are coming soon.' }}</p>
							</div>

							<div>
								<div class="flex items-center justify-between border-t border-slate-800/80 pt-4">
									<span class="inline-flex items-center gap-1 text-xs font-bold text-cyan-300 transition-colors group-hover:text-cyan-200">View experience <ArrowRight class="h-3.5 w-3.5" /></span>
								</div>
							</div>
						</div>
					</Link>
				</section>

				<section v-else class="space-y-4 border border-slate-800/80 bg-slate-900/20 px-6 py-20 text-center">
					<Folder class="mx-auto h-8 w-8 text-slate-600" />
					<h2 class="text-lg font-bold text-white">{{ !portfolios || !hasActivePortfolios ? 'No work experience available' : 'No work entries found' }}</h2>
					<p class="text-sm text-slate-400">Work experience will appear here when it is available.</p>
				</section>

				<nav v-if="portfolios?.links && portfolios.links.length > 3" class="flex justify-center gap-1.5 pt-4" aria-label="Work pagination">
					<Link v-for="(link, index) in portfolios.links" :key="index" :href="link.url || '#'" class="rounded-lg border border-slate-800 px-4 py-2 text-xs font-semibold text-slate-400 transition hover:border-cyan-500/40 hover:text-white" :class="link.active ? 'bg-cyan-500/15 text-cyan-300' : ''"><span v-html="link.label"></span></Link>
				</nav>
			</div>
		</main>
	</PublicLayout>
</template>
