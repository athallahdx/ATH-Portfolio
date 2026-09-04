<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { 
    Download, 
    ArrowRight, 
    Mail, 
    Phone, 
    ExternalLink, 
    Code,
    Send,
    ChevronLeft,
    ChevronRight
} from '@lucide/vue';
import { onMounted, onUnmounted, ref } from 'vue';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { portfolio, work, contact as contactRoute} from '@/routes';
import { show as portfolioShow } from '@/routes/portfolio';
import { show as workShow } from '@/routes/work';

// Define the interface for props passed by controller
interface AboutMeItem {
    id: number;
    title: string;
    image: string;
    description: string;
}

interface HeroItem {
    position: string;
    image: string;
    description: string;
}

interface CVItem {
    id: number;
    name: string;
    cv: string;
    is_active: boolean;
}

interface TechstackItem {
    id: number;
    name: string;
    icon: string;
    sort_order: number;
    is_active: boolean;
}

interface ExpertiseItem {
    id: number;
    icon: string;
    name: string;
    description: string;
    sort_order: number;
    is_active: boolean;
}

interface PortfolioItem {
    id: number;
    title: string;
    slug: string;
    description: string;
    start_date: string;
    end_date: string | null;
    url: string | null;
    contributions: string[];
    type?: {
        name: string;
    };
    techstacks?: TechstackItem[];
    images?: {
        image: string;
        label: string;
    }[];
}

interface WorkItem {
    id: number;
    title: string;
    slug: string;
    description: string | null;
    client: string | null;
    start_date: string | null;
    end_date: string | null;
    url: string | null;
    tags?: { id: number; name: string }[];
    images?: {
        image: string;
        label: string | null;
    }[];
}

interface ContactInfo {
    name: string;
    email: string | null;
    whatsapp: string | null;
    linkedin: string | null;
    github: string | null;
    instagram: string | null;
}

const props = defineProps<{
    hero: HeroItem | null;
    aboutme: AboutMeItem[];
    curriculumvitae: CVItem | null;
    portfolios: PortfolioItem[];
    works: WorkItem[];
    expertises: ExpertiseItem[];
    techstacks: TechstackItem[];
    contact: ContactInfo | null;
}>();

const activeAboutIndex = ref(0);
let aboutCarouselInterval: ReturnType<typeof setInterval> | undefined;

const showNextAbout = () => {
    if (props.aboutme.length > 0) {
        activeAboutIndex.value = (activeAboutIndex.value + 1) % props.aboutme.length;
    }
};

const showPreviousAbout = () => {
    if (props.aboutme.length > 0) {
        activeAboutIndex.value = (activeAboutIndex.value - 1 + props.aboutme.length) % props.aboutme.length;
    }
};

onMounted(() => {
    if (props.aboutme.length > 1) {
        aboutCarouselInterval = setInterval(showNextAbout, 5000);
    }
});

onUnmounted(() => {
    if (aboutCarouselInterval) {
        clearInterval(aboutCarouselInterval);
    }
});

// Form state for Contact Form
const contactForm = ref({
    name: '',
    email: '',
    whatsapp: '',
    message: ''
});

const isSubmitting = ref(false);
const showSuccessMessage = ref(false);

const handleContactSubmit = () => {
    isSubmitting.value = true;
    
    // Simulate sending email / whatsapp integration
    setTimeout(() => {
        isSubmitting.value = false;
        showSuccessMessage.value = true;
        
        // Build email body
        const subject = encodeURIComponent(`Portfolio Contact from ${contactForm.value.name}`);
        const body = encodeURIComponent(
            `Name: ${contactForm.value.name}\n` +
            `Email: ${contactForm.value.email}\n` +
            `WhatsApp: ${contactForm.value.whatsapp}\n\n` +
            `Message:\n${contactForm.value.message}`
        );
        
        const mailtoUrl = `mailto:${props.contact?.email ?? 'contact@example.com'}?subject=${subject}&body=${body}`;
        
        // Open user's email client
        window.location.href = mailtoUrl;
        
        // Reset form
        contactForm.value = {
            name: '',
            email: '',
            whatsapp: '',
            message: ''
        };
        
        // Hide success message after 5 seconds
        setTimeout(() => {
            showSuccessMessage.value = false;
        }, 5000);
    }, 1000);
};

// Formats portfolio dates
const formatDateRange = (start: string | null, end: string | null) => {
    if (!start) {
        return 'Dates not specified';
    }

    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'short' };
    const startDate = new Date(start).toLocaleDateString('en-US', options);
    const endDate = end ? new Date(end).toLocaleDateString('en-US', options) : 'Present';
    
    return `${startDate} - ${endDate}`;
};

// Default about description if database is empty
const defaultHeroDescription = "I am a Full Stack Developer dedicated to crafting clean, high-performance web applications. I specialize in building end-to-end solutions that merge sophisticated backend logic with intuitive, interactive user interfaces.";
const defaultAboutMe = "I am a passionate software engineer with experience developing enterprise-grade systems and customer-centric platforms. My focus is on writing maintainable, well-tested code and implementing state-of-the-art UI/UX patterns that captivate users.";

const getImageUrl = (image: string) => image.startsWith('http') ? image : `/storage/${image}`;
</script>

<template>
    <Head title="Home | Athallah Tsany Satriyaji" />

    <PublicLayout>
        <!-- SECTION 1: HERO SECTION -->
        <section class="relative flex min-h-[calc(100vh-4.5rem)] items-center px-4 py-20 sm:px-6 lg:px-8">
            <div class="mx-auto grid w-full max-w-6xl grid-cols-1 items-center gap-16 lg:grid-cols-12 lg:gap-12">
                <!-- Text Intro -->
                <div class="order-2 lg:order-1 lg:col-span-7">
                    <div class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 bg-blue-500/5 px-3 py-1 text-xs font-medium tracking-wide text-blue-300">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-blue-400"></span>
                        </span>
                        Available for opportunities
                    </div>

                    <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Hi, I'm
                        <span class="bg-linear-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">Athallah Tsany</span>
                    </h1>

                    <h2 class="mt-3 text-lg font-medium text-slate-400 sm:text-xl">
                        {{ hero?.position ?? 'Full Stack Web Developer' }}
                    </h2>

                    <p class="mt-6 max-w-xl text-base leading-relaxed text-slate-400">
                        {{ hero?.description ?? defaultHeroDescription }}
                    </p>

                    <!-- Call to Actions -->
                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <Link 
                            :href="contactRoute().url" 
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-500"
                        >
                            Let's Connect
                            <ArrowRight class="h-4 w-4" />
                        </Link>

                        <a 
                            v-if="curriculumvitae" 
                            :href="'/storage/' + curriculumvitae.cv" 
                            download 
                            class="inline-flex items-center gap-2 rounded-lg border border-slate-800 bg-slate-900 px-5 py-2.5 text-sm font-semibold text-slate-200 transition-all duration-300 hover:-translate-y-0.5 hover:border-slate-700 hover:bg-slate-800"
                        >
                            Download CV
                            <Download class="h-4 w-4" />
                        </a>

                        <a 
                            v-if="contact?.linkedin" 
                            :href="contact.linkedin" 
                            target="_blank" 
                            class="inline-flex items-center gap-2 rounded-lg px-5 py-2.5 text-sm font-semibold text-slate-400 transition-colors duration-300 hover:text-white border-2 border-slate-800 hover:border-blue-500/50 hover:bg-blue-600/20 hover:-translate-y-0.5"
                        >
                            <img src="/images/linkedin.png" class="h-5 w-5 m-0" alt="LinkedIn">
                            LinkedIn
                            <ExternalLink class="h-4 w-4" />
                        </a>
                    </div>
                </div>

                <!-- Avatar / Visual Element -->
                <div class="order-1 flex justify-center lg:order-2 lg:col-span-5 lg:justify-end">
                    <img 
                        v-if="hero?.image" 
                        :src="getImageUrl(hero.image)" 
                        alt="Athallah Tsany Satriyaji" 
                        class="h-80 w-64 max-h-128 object-contain grayscale transition-all duration-500 hover:grayscale-0 sm:h-96 sm:w-80 lg:h-112 lg:w-88"
                    />
                    <!-- Fallback profile illustration / abstract styling -->
                    <div v-else class="flex h-64 w-64 flex-col items-center justify-center space-y-4 p-6 text-center sm:h-80 sm:w-80 lg:h-88 lg:w-88">
                        <div class="flex h-16 w-16 items-center justify-center text-blue-400">
                            <Code class="h-8 w-8" />
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-base font-bold text-white">Athallah Tsany Satriyaji</h3>
                            <p class="font-mono text-xs text-blue-400">&lt;FullStackDeveloper /&gt;</p>
                        </div>
                        <p class="max-w-50 text-xs text-slate-400">
                            Specializing in Laravel, Vue 3, &amp; Tailwind CSS
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: ABOUT ME -->
        <section class="border-t border-slate-900 bg-[#02050e]/60 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="mx-auto mb-14 max-w-2xl text-center sm:mb-16">
                    <p class="mb-3 font-mono text-xs font-medium uppercase tracking-[0.2em] text-blue-400/80">// about-me</p>
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">About Me</h2>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                        Get to know me through my background, experience, and approach to building software.
                    </p>
                </div>

                <div v-if="aboutme.length > 0" class="mx-auto max-w-3xl rounded-xl border border-slate-800/60 bg-slate-900/40 p-6 sm:p-8">
                    <div class="relative min-h-55">
                        <article :key="aboutme[activeAboutIndex].id" class="animate-fade-in grid gap-6 text-left sm:grid-cols-5 sm:items-start">
                            <div class="aspect-4/5 overflow-hidden rounded-xl border border-blue-500/30 bg-slate-950 sm:col-span-2">
                                <img
                                    v-if="aboutme[activeAboutIndex].image"
                                    :src="getImageUrl(aboutme[activeAboutIndex].image)"
                                    :alt="aboutme[activeAboutIndex].title"
                                    class="h-full w-full object-cover"
                                />
                                <div v-else class="flex h-full items-center justify-center p-6 text-center text-sm text-slate-500">
                                    About Me
                                </div>
                            </div>
                            <div class="space-y-4 sm:col-span-3">
                                <h3 class="text-xl font-bold text-white">
                                    {{ aboutme[activeAboutIndex].title }}
                                </h3>
                                <p class="text-sm leading-relaxed text-slate-400 sm:text-base">
                                    {{ aboutme[activeAboutIndex].description }}
                                </p>
                            </div>
                        </article>

                        <div v-if="aboutme.length > 1" class="mt-8 flex items-center justify-between border-t border-slate-800 pt-5">
                            <button
                                type="button"
                                aria-label="Previous About Me entry"
                                class="rounded-lg border border-slate-700 p-2 text-slate-300 transition-colors hover:border-blue-500 hover:text-white"
                                @click="showPreviousAbout"
                            >
                                <ChevronLeft class="h-4 w-4" />
                            </button>
                            <div class="flex gap-2" aria-label="About Me entries">
                                <button
                                    v-for="(item, index) in aboutme"
                                    :key="item.id"
                                    type="button"
                                    :aria-label="`Show ${item.title}`"
                                    class="h-2.5 w-2.5 rounded-full transition-colors"
                                    :class="index === activeAboutIndex ? 'bg-blue-400' : 'bg-slate-700 hover:bg-slate-500'"
                                    @click="activeAboutIndex = index"
                                ></button>
                            </div>
                            <button
                                type="button"
                                aria-label="Next About Me entry"
                                class="rounded-lg border border-slate-700 p-2 text-slate-300 transition-colors hover:border-blue-500 hover:text-white"
                                @click="showNextAbout"
                            >
                                <ChevronRight class="h-4 w-4" />
                            </button>
                        </div>
                    </div>
                </div>
                <div v-else class="mx-auto max-w-3xl rounded-xl border border-slate-800/60 bg-slate-900/40 p-8 text-center">
                    <p class="text-sm leading-relaxed text-slate-400">{{ defaultAboutMe }}</p>
                </div>
            </div>
        </section>

        <!-- SECTION 4: MY EXPERTISE -->
        <section class="border-t border-slate-900 bg-[#030712] px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="mx-auto mb-14 max-w-2xl text-center sm:mb-16">
                    <p class="mb-3 font-mono text-xs font-medium uppercase tracking-[0.2em] text-blue-400/80">// expertise</p>
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">My Expertise</h2>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                        What I excel at. I deliver premium code and systems that scale.
                    </p>
                </div>

                <!-- Expertise Cards Grid -->
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                    <div 
                        v-for="exp in expertises" 
                        :key="exp.id"
                        class="group rounded-xl border border-slate-800/60 bg-slate-900/30 p-6 transition-colors duration-300 hover:border-blue-500/30"
                    >
                        <div class="mb-6 flex h-11 w-11 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-600/10 text-blue-400 transition-colors duration-300 hover:border-blue-500/25 hover:bg-slate-900/80 group-hover:text-white">
                            <img :src="`storage/${exp.icon}`" class="h-5 w-5" />
                        </div>
                        
                        <h3 class="mb-2 text-lg font-bold text-white transition-colors duration-300 group-hover:text-blue-400">
                            {{ exp.name }}
                        </h3>
                        
                        <p class="text-sm leading-relaxed text-slate-400">
                            {{ exp.description }}
                        </p>
                    </div>
                    
                    <!-- Fallback items if database is empty -->
                    <template v-if="expertises.length === 0">
                        <div class="rounded-xl border border-slate-800/60 bg-slate-900/30 p-6">
                            <div class="mb-6 flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600/10 text-blue-400">
                                <Code class="h-5 w-5" />
                            </div>
                            <h3 class="mb-2 text-lg font-bold text-white">Full Stack Development</h3>
                            <p class="text-sm leading-relaxed text-slate-400">
                                End-to-end web application development from database schemas to reactive modern interfaces using Laravel, Vue 3, and Inertia.js.
                            </p>
                        </div>
                        <div class="rounded-xl border border-slate-800/60 bg-slate-900/30 p-6">
                            <div class="mb-6 flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600/10 text-blue-400">
                                <Code class="h-5 w-5" />
                            </div>
                            <h3 class="mb-2 text-lg font-bold text-white">Backend Architecture</h3>
                            <p class="text-sm leading-relaxed text-slate-400">
                                Creating secure RESTful APIs, optimizing queries, caching strategies, queue jobs, and authorization policies.
                            </p>
                        </div>
                        <div class="rounded-xl border border-slate-800/60 bg-slate-900/30 p-6">
                            <div class="mb-6 flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600/10 text-blue-400">
                                <Code class="h-5 w-5" />
                            </div>
                            <h3 class="mb-2 text-lg font-bold text-white">DevOps &amp; Deployment</h3>
                            <p class="text-sm leading-relaxed text-slate-400">
                                Containerizing applications with Docker, managing deployment pipelines, and hosting applications on secure cloud systems.
                            </p>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- SECTION 5: TECHSTACK -->
        <section class="border-t border-slate-900 bg-[#02050e]/60 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="mx-auto mb-14 max-w-2xl text-center sm:mb-16">
                    <p class="mb-3 font-mono text-xs font-medium uppercase tracking-[0.2em] text-blue-400/80">// techstack</p>
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">My Techstack</h2>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                        The core languages, frameworks, and technologies I build with.
                    </p>
                </div>

                <!-- Flex / Grid wrap layout -->
                <div class="mx-auto flex max-w-3xl flex-wrap justify-center gap-3">
                    <div 
                        v-for="tech in techstacks" 
                        :key="tech.id"
                        class="flex items-center gap-2.5 rounded-lg border border-slate-800/60 bg-slate-900/40 px-4 py-2.5 transition-colors duration-300 hover:border-blue-500/25 hover:bg-slate-900/80"
                    >
                        <img v-if="tech.icon" :src="`storage/${tech.icon}`" class="h-4 w-4" />
                        <span class="text-sm font-semibold text-slate-200">{{ tech.name }}</span>
                    </div>
                    
                    <!-- Fallback techstacks -->
                    <template v-if="techstacks.length === 0">
                        <div v-for="techName in ['TypeScript', 'JavaScript', 'PHP', 'Laravel', 'Vue.js', 'React', 'Tailwind CSS', 'MySQL', 'PostgreSQL', 'Docker', 'Redis', 'Inertia.js']" :key="techName" class="flex items-center gap-2.5 rounded-lg border border-slate-800/60 bg-slate-900/40 px-4 py-2.5 transition-colors duration-300 hover:border-blue-500/25">
                            <span class="font-mono text-sm text-blue-400">&lt;/&gt;</span>
                            <span class="text-sm font-semibold text-slate-200">{{ techName }}</span>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- SECTION 6: PORTFOLIO BRIEF -->
        <section v-if="portfolios?.length" class="border-t border-slate-900 bg-[#030712] px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="mb-14 flex flex-col gap-6 sm:mb-16 md:flex-row md:items-end md:justify-between">
                    <div class="max-w-2xl">
                        <p class="mb-3 font-mono text-xs font-medium uppercase tracking-[0.2em] text-blue-400/80">// recent-projects</p>
                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Recent Projects</h2>
                        <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                            A curated showcase of web apps, tools, and platforms I've recently built.
                        </p>
                    </div>
                    <div>
                        <Link 
                            :href="portfolio().url" 
                            class="inline-flex items-center gap-2 text-sm font-semibold text-blue-400 transition-colors hover:text-blue-300"
                        >
                            View All Projects
                            <ArrowRight class="h-4 w-4" />
                        </Link>
                    </div>
                </div>

                <!-- Portfolios Grid -->
                <div class="mb-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div 
                        v-for="proj in portfolios" 
                        :key="proj.id"
                        class="flex flex-col overflow-hidden rounded-xl border border-slate-850 bg-slate-900/25 transition-colors duration-300 hover:border-slate-700/60"
                    >
                        <!-- Image representation -->
                        <div class="relative flex aspect-video w-full items-center justify-center overflow-hidden border-b border-slate-900 bg-slate-950">
                            <img 
                                v-if="proj.images && proj.images.length > 0"
                                :src="'/storage/' + proj.images[0].image"
                                :alt="proj.title"
                                class="h-full w-full object-cover grayscale transition-all duration-500 hover:grayscale-0"
                            />
                            <!-- Placeholder gradient visual -->
                            <div v-else class="flex h-full w-full flex-col items-center justify-center space-y-2 bg-linear-to-tr from-slate-900 via-blue-950/20 to-slate-900 p-6 text-center">
                                <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-600/10 text-blue-400">
                                    <Code class="h-5 w-5" />
                                </span>
                                <span class="text-xs font-bold uppercase tracking-widest text-blue-400">{{ proj.type?.name ?? 'Application' }}</span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="flex grow flex-col justify-between space-y-6 p-6">
                            <div class="space-y-3">
                                <span class="text-xs text-slate-500">{{ formatDateRange(proj.start_date, proj.end_date) }}</span>
                                <h3 class="text-lg font-bold text-white">
                                    {{ proj.title }}
                                </h3>
                               
                            </div>

                            <div class="space-y-4">
                                <!-- Tech tags -->
                                <div v-if="proj.techstacks && proj.techstacks.length > 0" class="flex flex-wrap gap-1.5">
                                    <span 
                                        v-for="ts in proj.techstacks.slice(0, 4)" 
                                        :key="ts.id"
                                        class="rounded border border-slate-800 bg-slate-950 px-2 py-0.5 text-[10px] font-semibold text-slate-300"
                                    >
                                        {{ ts.name }}
                                    </span>
                                    <span v-if="proj.techstacks.length > 4" class="rounded border border-slate-800 bg-slate-950 px-2 py-0.5 text-[10px] font-semibold text-slate-400">
                                        +{{ proj.techstacks.length - 4 }} more
                                    </span>
                                </div>

                                <!-- Link button -->
                                <div class="flex items-center justify-between border-t border-slate-800/80 pt-4">
                                    <Link 
                                        :href="portfolioShow({ portfolio: proj.slug }).url"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-blue-400 transition-colors hover:text-blue-300"
                                    >
                                        Read Details
                                        <ArrowRight class="h-3.5 w-3.5" />
                                    </Link>
                                    
                                    <a 
                                        v-if="proj.url"
                                        :href="proj.url"
                                        target="_blank" 
                                        class="text-slate-400 transition-colors hover:text-white"
                                        aria-label="View site"
                                    >
                                        <ExternalLink class="h-4 w-4" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <Link 
                        :href="portfolio().url" 
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-800 bg-slate-900 px-6 py-3 text-sm font-semibold text-slate-200 transition-all duration-300 hover:-translate-y-0.5 hover:border-slate-700 hover:bg-slate-800"
                    >
                        Browse All Projects
                        <ArrowRight class="h-4 w-4" />
                    </Link>
                </div>
            </div>
        </section>

         <!-- SECTION 7: WORK BRIEF -->
        <section v-if="works?.length" class="border-t border-slate-900 bg-[#030712] px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="mb-14 flex flex-col gap-6 sm:mb-16 md:flex-row md:items-end md:justify-between">
                    <div class="max-w-2xl">
                        <p class="mb-3 font-mono text-xs font-medium uppercase tracking-[0.2em] text-blue-400/80">// recent-work</p>
                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Recent Work Experience</h2>
                        <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                            A selection of roles, collaborations, and professional experience.
                        </p>
                    </div>
                    <div>
                        <Link 
                            :href="work().url" 
                            class="inline-flex items-center gap-2 text-sm font-semibold text-blue-400 transition-colors hover:text-blue-300"
                        >
                            View All Work
                            <ArrowRight class="h-4 w-4" />
                        </Link>
                    </div>
                </div>

                <!-- Portfolios Grid -->
                <div class="mb-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div 
                        v-for="workItem in works" 
                        :key="workItem.id"
                        class="flex flex-col overflow-hidden rounded-xl border border-slate-850 bg-slate-900/25 transition-colors duration-300 hover:border-slate-700/60"
                    >
                        <!-- Image representation -->
                        <div class="relative flex aspect-video w-full items-center justify-center overflow-hidden border-b border-slate-900 bg-slate-950">
                            <img 
                                v-if="workItem.images && workItem.images.length > 0"
                                :src="'/storage/' + workItem.images[0].image"
                                :alt="workItem.title"
                                class="h-full w-full object-cover grayscale transition-all duration-500 hover:grayscale-0"
                            />
                            <!-- Placeholder gradient visual -->
                            <div v-else class="flex h-full w-full flex-col items-center justify-center space-y-2 bg-linear-to-tr from-slate-900 via-blue-950/20 to-slate-900 p-6 text-center">
                                <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-600/10 text-blue-400">
                                    <Code class="h-5 w-5" />
                                </span>
                                <span class="text-xs font-bold uppercase tracking-widest text-blue-400">{{ workItem.tags?.[0]?.name ?? 'Experience' }}</span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="flex grow flex-col justify-between gap-5 p-5">
                            <div class="space-y-2">
                                <h3 class="text-lg font-bold leading-snug text-white">
                                    {{ workItem.title }}
                                </h3>
                                <p class="line-clamp-2 text-sm leading-relaxed text-slate-400">
                                    {{ workItem.client || 'Work experience details are coming soon.' }}
                                </p>
                                <p class="pt-1 text-xs text-slate-500">{{ formatDateRange(workItem.start_date, workItem.end_date) }}</p>
                            </div>

                            <div class="space-y-3">
                                <!-- Tech tags -->
                                <div v-if="workItem.tags && workItem.tags.length > 0" class="flex flex-wrap gap-1.5">
                                    <span 
                                        v-for="tag in workItem.tags.slice(0, 4)" 
                                        :key="tag.id"
                                        class="rounded border border-slate-800 bg-slate-950 px-2 py-0.5 text-[10px] font-semibold text-slate-300"
                                    >
                                        {{ tag.name }}
                                    </span>
                                    <span v-if="workItem.tags.length > 4" class="rounded border border-slate-800 bg-slate-950 px-2 py-0.5 text-[10px] font-semibold text-slate-400">
                                        +{{ workItem.tags.length - 4 }} more
                                    </span>
                                </div>

                                <!-- Link button -->
                                <div class="flex items-center justify-between border-t border-slate-800/80 pt-3">
                                    <Link 
                                        :href="workShow({ portfolio: workItem.slug }).url"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-blue-400 transition-colors hover:text-blue-300"
                                    >
                                        View Experience
                                        <ArrowRight class="h-3.5 w-3.5" />
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <Link 
                        :href="work().url" 
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-800 bg-slate-900 px-6 py-3 text-sm font-semibold text-slate-200 transition-all duration-300 hover:-translate-y-0.5 hover:border-slate-700 hover:bg-slate-800"
                    >
                        Browse All Work
                        <ArrowRight class="h-4 w-4" />
                    </Link>
                </div>
            </div>
        </section>

        <!-- SECTION 8: CONTACT -->
        <section class="border-t border-slate-900 bg-[#02050e]/60 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="mx-auto mb-14 max-w-2xl text-center sm:mb-16">
                    <p class="mb-3 font-mono text-xs font-medium uppercase tracking-[0.2em] text-blue-400/80">// get-in-touch</p>
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Get In Touch</h2>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                        Let's work together! Fill out the form or reach out directly.
                    </p>
                </div>

                <div class="mx-auto grid max-w-4xl grid-cols-1 items-start gap-12 lg:grid-cols-12">
                    <!-- Column 1: Info -->
                    <div class="lg:col-span-5">
                        <h3 class="text-xl font-bold text-white">Contact Info</h3>
                        <p class="mt-3 max-w-sm text-sm leading-relaxed text-slate-400">
                            Have an exciting project you want to build or just want to chat? Send a message and let's explore opportunities.
                        </p>

                        <div class="mt-6 space-y-4">
                            <div v-if="contact?.email" class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-500/10 text-blue-400">
                                    <Mail class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Email</p>
                                    <a :href="'mailto:' + contact.email" class="text-sm font-medium text-slate-200 transition-colors hover:text-blue-400">
                                        {{ contact.email }}
                                    </a>
                                </div>
                            </div>

                            <div v-if="contact?.whatsapp" class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-blue-500/20 bg-blue-500/10 text-blue-400">
                                    <Phone class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">WhatsApp</p>
                                    <a :href="'https://wa.me/' + contact.whatsapp.replace(/\D/g, '')" target="_blank" class="text-sm font-medium text-slate-200 transition-colors hover:text-blue-400">
                                        {{ contact.whatsapp }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Form -->
                    <div class="rounded-xl border border-slate-800/60 bg-slate-900/40 p-6 sm:p-8 lg:col-span-7">
                        <form @submit.prevent="handleContactSubmit" class="space-y-5">
                            <div>
                                <label for="name" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    v-model="contactForm.name"
                                    required 
                                    placeholder="Your Name"
                                    class="w-full rounded-lg border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-slate-200 placeholder-slate-600 transition-colors focus:border-blue-500/80 focus:outline-none"
                                />
                            </div>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="email" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Email</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        v-model="contactForm.email"
                                        required 
                                        placeholder="your@email.com"
                                        class="w-full rounded-lg border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-slate-200 placeholder-slate-600 transition-colors focus:border-blue-500/80 focus:outline-none"
                                    />
                                </div>
                                <div>
                                    <label for="whatsapp" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">WhatsApp / Phone</label>
                                    <input 
                                        type="text" 
                                        id="whatsapp" 
                                        v-model="contactForm.whatsapp"
                                        placeholder="+1 234 567"
                                        class="w-full rounded-lg border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-slate-200 placeholder-slate-600 transition-colors focus:border-blue-500/80 focus:outline-none"
                                    />
                                </div>
                            </div>

                            <div>
                                <label for="message" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Message</label>
                                <textarea 
                                    id="message" 
                                    v-model="contactForm.message"
                                    required 
                                    rows="5"
                                    placeholder="Brief project details..."
                                    class="w-full resize-none rounded-lg border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-slate-200 placeholder-slate-600 transition-colors focus:border-blue-500/80 focus:outline-none"
                                ></textarea>
                            </div>

                            <button 
                                type="submit" 
                                :disabled="isSubmitting"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/10 transition-all duration-300 hover:bg-blue-500 disabled:cursor-not-allowed disabled:bg-blue-600/50"
                            >
                                <Send v-if="!isSubmitting" class="h-4 w-4" />
                                <span v-else class="h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></span>
                                {{ isSubmitting ? 'Preparing Mail...' : 'Send Message' }}
                            </button>

                            <p v-if="showSuccessMessage" class="text-center text-xs font-semibold text-emerald-400">
                                Opening your email client to send the message...
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>

<style scoped>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@media (prefers-reduced-motion: reduce) {
    .animate-fade-in {
        animation: none;
    }
}
</style>
