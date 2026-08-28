<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { portfolio, contact as contactRoute } from '@/routes';
import { 
    BriefcaseBusiness, 
    Download, 
    ArrowRight, 
    Mail, 
    Phone, 
    MessageSquare, 
    ExternalLink, 
    Sparkles,
    Briefcase,
    BookOpen,
    Code,
    Send
} from '@lucide/vue';

// Define the interface for props passed by controller
interface AboutMeItem {
    id: number;
    title: string;
    image: string;
    description: string;
}

interface CVItem {
    id: number;
    name: string;
    version: string;
    file: string;
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
    name: string;
    description: string;
    sort_order: number;
    is_active: boolean;
}

interface PortfolioItem {
    id: number;
    title: string;
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

interface ContactInfo {
    name: string;
    email: string | null;
    whatsapp: string | null;
    linkedin: string | null;
    github: string | null;
    instagram: string | null;
}

const props = defineProps<{
    aboutme: AboutMeItem[];
    curriculumvitae: CVItem | null;
    portfolios: PortfolioItem[];
    expertises: ExpertiseItem[];
    techstacks: TechstackItem[];
    contact: ContactInfo | null;
}>();

// Active tab for About Me section (e.g. Experience vs Education)
const activeAboutTab = ref('experience');

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
const formatDateRange = (start: string, end: string | null) => {
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'short' };
    const startDate = new Date(start).toLocaleDateString('en-US', options);
    const endDate = end ? new Date(end).toLocaleDateString('en-US', options) : 'Present';
    return `${startDate} - ${endDate}`;
};

// Default about description if database is empty
const defaultHeroDescription = "I am a Full Stack Developer dedicated to crafting clean, high-performance web applications. I specialize in building end-to-end solutions that merge sophisticated backend logic with intuitive, interactive user interfaces.";
const defaultAboutMe = "I am a passionate software engineer with experience developing enterprise-grade systems and customer-centric platforms. My focus is on writing maintainable, well-tested code and implementing state-of-the-art UI/UX patterns that captivate users.";
</script>

<template>
    <Head title="Home | Athallah Tsany Satriyaji" />

    <PublicLayout>
        <!-- SECTION 1: HERO SECTION -->
        <section class="relative flex min-h-[calc(100vh-4.5rem)] items-center overflow-hidden px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="relative z-10 mx-auto grid w-full max-w-7xl grid-cols-1 items-center gap-12 lg:grid-cols-12 lg:gap-16">
                <!-- Text Intro -->
                <div class="space-y-6 text-left lg:col-span-7">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/25 text-blue-400 text-xs font-semibold uppercase tracking-wider animate-pulse">
                        <Sparkles class="w-3.5 h-3.5" />
                        Available for Opportunities
                    </div>
                    
                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.05] tracking-[-0.04em] text-white sm:text-5xl lg:text-7xl">
                        Hi, I'm <br class="sm:hidden" />
                        <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">
                            Athallah Tsany
                        </span>
                    </h1>
                    
                    <h2 class="text-xl sm:text-2xl font-semibold text-slate-300">
                        Full Stack Web Developer
                    </h2>
                    
                    <p class="text-slate-400 text-base sm:text-lg max-w-xl leading-relaxed">
                        {{ aboutme[0]?.description ?? defaultHeroDescription }}
                    </p>
                    
                    <!-- Call to Actions -->
                    <div class="flex flex-wrap gap-4 pt-2">
                        <Link 
                            :href="contactRoute().url" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 font-semibold text-white shadow-lg shadow-blue-500/25 transition-all duration-300 hover:-translate-y-0.5"
                        >
                            Let's Connect
                            <ArrowRight class="w-4 h-4" />
                        </Link>
                        
                        <a 
                            v-if="curriculumvitae" 
                            :href="'/storage/' + curriculumvitae.file" 
                            download 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 font-semibold text-slate-200 border border-slate-700 hover:border-slate-600 transition-all duration-300 hover:-translate-y-0.5"
                        >
                            Download CV
                            <Download class="w-4 h-4" />
                        </a>
                        
                        <a 
                            v-if="contact?.linkedin" 
                            :href="contact.linkedin" 
                            target="_blank" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-800/40 hover:bg-slate-800/80 font-semibold text-slate-300 border border-slate-800 hover:border-slate-700 transition-all duration-300"
                        >
                            <BriefcaseBusiness class="w-4 h-4 text-blue-400" />
                            LinkedIn
                        </a>
                    </div>
                </div>

                <!-- Avatar / Visual Element -->
                <div class="lg:col-span-5 flex justify-center lg:justify-end relative">
                    <div class="relative w-72 h-72 sm:w-80 sm:h-80 lg:w-96 lg:h-96">
                        <!-- Glowing background behind image -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/30 to-indigo-500/30 rounded-3xl blur-2xl transform rotate-6 scale-95 animate-pulse"></div>
                        
                        <!-- Image Container with glassmorphism border -->
                        <div class="absolute inset-0 rounded-3xl border border-slate-700/50 overflow-hidden bg-slate-900/60 backdrop-blur-xl p-3 shadow-2xl">
                            <img 
                                v-if="aboutme[0]?.image" 
                                :src="'/storage/' + aboutme[0].image" 
                                alt="Athallah Tsany Satriyaji" 
                                class="w-full h-full object-cover rounded-2xl grayscale hover:grayscale-0 transition-all duration-500"
                            />
                            <!-- Fallback profile illustration / abstract styling -->
                            <div v-else class="w-full h-full rounded-2xl bg-gradient-to-br from-slate-850 to-slate-950 flex flex-col items-center justify-center border border-slate-800/50 p-6 text-center space-y-4">
                                <div class="w-20 h-20 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 border border-blue-500/20 shadow-inner">
                                    <Code class="w-10 h-10" />
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-white font-bold text-lg">Athallah Tsany Satriyaji</h3>
                                    <p class="text-xs text-blue-400 font-mono">&lt;FullStackDeveloper /&gt;</p>
                                </div>
                                <p class="text-xs text-slate-400 max-w-[200px]">
                                    Specializing in Laravel, Vue 3, & Tailwind CSS
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: ABOUT ME -->
        <section class="py-24 px-4 sm:px-6 lg:px-8 border-t border-slate-900 bg-[#02050e]/60 relative">
            <div class="max-w-7xl mx-auto">
                <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        About Me
                    </h2>
                    <div class="h-1 w-20 bg-blue-500 mx-auto rounded-full"></div>
                    <p class="text-slate-400 text-md leading-relaxed">
                        {{ aboutme[1]?.description ?? defaultAboutMe }}
                    </p>
                </div>

                <!-- Experience & Education Slider/Tabs -->
                <div class="max-w-4xl mx-auto bg-slate-900/40 border border-slate-800/60 rounded-2xl p-6 sm:p-8 backdrop-blur-md shadow-xl">
                    <div class="flex justify-center border-b border-slate-800 pb-4 mb-8">
                        <div class="inline-flex bg-slate-950 p-1.5 rounded-xl border border-slate-800/80">
                            <button 
                                @click="activeAboutTab = 'experience'" 
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300"
                                :class="activeAboutTab === 'experience' ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:text-white'"
                            >
                                <Briefcase class="w-4 h-4" />
                                Experience
                            </button>
                            <button 
                                @click="activeAboutTab = 'education'" 
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300"
                                :class="activeAboutTab === 'education' ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:text-white'"
                            >
                                <BookOpen class="w-4 h-4" />
                                Education
                            </button>
                        </div>
                    </div>

                    <!-- Slide Contents -->
                    <div class="space-y-8 relative min-h-[250px]">
                        <!-- Tab 1: Experience -->
                        <div v-if="activeAboutTab === 'experience'" class="space-y-8 animate-fade-in">
                            <div class="relative border-l border-blue-500/20 ml-3 pl-6 sm:pl-8 space-y-8">
                                <!-- Experience Item 1 -->
                                <div class="relative">
                                    <span class="absolute -left-[35px] top-1.5 w-4 h-4 rounded-full bg-blue-500 border-4 border-slate-950 shadow-[0_0_8px_rgba(59,130,246,0.6)]"></span>
                                    <div class="space-y-2">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                            <h4 class="text-lg font-bold text-white">Lead Full-Stack Developer</h4>
                                            <span class="text-xs font-semibold px-2.5 py-1 rounded bg-blue-500/10 border border-blue-500/25 text-blue-400 sm:self-start">
                                                2024 - Present
                                            </span>
                                        </div>
                                        <p class="text-sm text-slate-300 font-medium">Independent Software Engineer & Tech Lead</p>
                                        <p class="text-sm text-slate-400 leading-relaxed">
                                            Designing and shipping scalable products for various startups. Built custom e-commerce engines, real-time messaging platforms, and structured management platforms using Laravel, Inertia, Vue, and Tailind CSS.
                                        </p>
                                    </div>
                                </div>

                                <!-- Experience Item 2 -->
                                <div class="relative">
                                    <span class="absolute -left-[35px] top-1.5 w-4 h-4 rounded-full bg-blue-500/60 border-4 border-slate-950"></span>
                                    <div class="space-y-2">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                            <h4 class="text-lg font-bold text-white">Full Stack Web Developer</h4>
                                            <span class="text-xs font-semibold px-2.5 py-1 rounded bg-slate-800 border border-slate-700 text-slate-400 sm:self-start">
                                                2022 - 2024
                                            </span>
                                        </div>
                                        <p class="text-sm text-slate-300 font-medium">Software Development Firm</p>
                                        <p class="text-sm text-slate-400 leading-relaxed">
                                            Designed RESTful APIs, optimized databases, and engineered reactive user interfaces. Implemented robust authorization systems, automated tests, and streamlined deployment pipelines.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Education -->
                        <div v-if="activeAboutTab === 'education'" class="space-y-8 animate-fade-in">
                            <div class="relative border-l border-indigo-500/20 ml-3 pl-6 sm:pl-8 space-y-8">
                                <!-- Education Item 1 -->
                                <div class="relative">
                                    <span class="absolute -left-[35px] top-1.5 w-4 h-4 rounded-full bg-indigo-500 border-4 border-slate-950 shadow-[0_0_8px_rgba(99,102,241,0.6)]"></span>
                                    <div class="space-y-2">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                            <h4 class="text-lg font-bold text-white">Bachelor of Computer Science</h4>
                                            <span class="text-xs font-semibold px-2.5 py-1 rounded bg-indigo-500/10 border border-indigo-500/25 text-indigo-400 sm:self-start">
                                                Graduated
                                            </span>
                                        </div>
                                        <p class="text-sm text-slate-300 font-medium">Major in Software Engineering</p>
                                        <p class="text-sm text-slate-400 leading-relaxed">
                                            Acquired foundational and advanced knowledge of algorithms, database architectures, network communication, object-oriented design patterns, and human-computer interaction.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: MY EXPERTISE -->
        <section class="border-t border-slate-900 bg-[#030712] px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        My Expertise
                    </h2>
                    <div class="h-1 w-20 bg-blue-500 mx-auto rounded-full"></div>
                    <p class="text-slate-400 text-md leading-relaxed">
                        What I excel at. I deliver premium code and systems that scale.
                    </p>
                </div>

                <!-- Expertise Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div 
                        v-for="exp in expertises" 
                        :key="exp.id"
                        class="group relative bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 hover:border-blue-500/30 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1"
                    >
                        <div class="h-12 w-12 rounded-xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 mb-6">
                            <Code class="w-6 h-6" />
                        </div>
                        
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors duration-300">
                            {{ exp.name }}
                        </h3>
                        
                        <p class="text-slate-400 text-sm leading-relaxed">
                            {{ exp.description }}
                        </p>
                    </div>
                    
                    <!-- Fallback items if database is empty -->
                    <template v-if="expertises.length === 0">
                        <div class="group relative bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 hover:border-blue-500/30 transition-all duration-300">
                            <div class="h-12 w-12 rounded-xl bg-blue-600/10 flex items-center justify-center text-blue-400 mb-6">
                                <Code class="w-6 h-6" />
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">Full Stack Development</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                End-to-end web application development from database schemas to reactive modern interfaces using Laravel, Vue 3, and Inertia.js.
                            </p>
                        </div>
                        <div class="group relative bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 hover:border-blue-500/30 transition-all duration-300">
                            <div class="h-12 w-12 rounded-xl bg-blue-600/10 flex items-center justify-center text-blue-400 mb-6">
                                <Code class="w-6 h-6" />
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">Backend Architecture</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                Creating secure RESTful APIs, optimizing queries, caching strategies, queue jobs, and authorization policies.
                            </p>
                        </div>
                        <div class="group relative bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 hover:border-blue-500/30 transition-all duration-300">
                            <div class="h-12 w-12 rounded-xl bg-blue-600/10 flex items-center justify-center text-blue-400 mb-6">
                                <Code class="w-6 h-6" />
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">DevOps & Deployment</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                Containerizing applications with Docker, managing deployment pipelines, and hosting applications on secure cloud systems.
                            </p>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- SECTION 5: TECHSTACK -->
        <section class="border-t border-slate-900 bg-[#02050e]/60 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        My Techstack
                    </h2>
                    <div class="h-1 w-20 bg-blue-500 mx-auto rounded-full"></div>
                    <p class="text-slate-400 text-md leading-relaxed">
                        The core languages, frameworks, and technologies I build with.
                    </p>
                </div>

                <!-- Flex / Grid wrap layout -->
                <div class="flex flex-wrap justify-center gap-4 max-w-4xl mx-auto">
                    <div 
                        v-for="tech in techstacks" 
                        :key="tech.id"
                        class="flex items-center gap-3 px-5 py-3 rounded-2xl bg-slate-900/40 border border-slate-800/60 hover:border-blue-500/20 hover:bg-slate-900/80 transition-all duration-300 hover:scale-105"
                    >
                        <span class="text-blue-400 font-mono text-sm">&lt;/&gt;</span>
                        <span class="text-sm font-semibold text-slate-200">{{ tech.name }}</span>
                    </div>
                    
                    <!-- Fallback techstacks -->
                    <template v-if="techstacks.length === 0">
                        <div v-for="techName in ['TypeScript', 'JavaScript', 'PHP', 'Laravel', 'Vue.js', 'React', 'Tailwind CSS', 'MySQL', 'PostgreSQL', 'Docker', 'Redis', 'Inertia.js']" :key="techName" class="flex items-center gap-3 px-5 py-3 rounded-2xl bg-slate-900/40 border border-slate-800/60 hover:border-blue-500/25 transition-all">
                            <span class="text-blue-400 font-mono text-sm">&lt;/&gt;</span>
                            <span class="text-sm font-semibold text-slate-200">{{ techName }}</span>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- SECTION 6: PORTFOLIO BRIEF -->
        <section class="border-t border-slate-900 bg-[#030712] px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                    <div class="space-y-4 max-w-2xl">
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Recent Work
                        </h2>
                        <div class="h-1 w-20 bg-blue-500 rounded-full"></div>
                        <p class="text-slate-400 text-md leading-relaxed">
                            A curated showcase of web apps, tools, and platforms I've recently built.
                        </p>
                    </div>
                    <div>
                        <Link 
                            :href="portfolio().url" 
                            class="inline-flex items-center gap-2 text-sm font-bold text-blue-400 hover:text-blue-300 transition-colors"
                        >
                            View All Projects
                            <ArrowRight class="w-4 h-4" />
                        </Link>
                    </div>
                </div>

                <!-- Portfolios Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <div 
                        v-for="proj in portfolios" 
                        :key="proj.id"
                        class="flex flex-col bg-slate-900/25 border border-slate-850 rounded-2xl overflow-hidden hover:border-slate-700/60 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1"
                    >
                        <!-- Image representation -->
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

                        <!-- Info -->
                        <div class="flex-grow p-6 flex flex-col justify-between space-y-6">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <span>{{ formatDateRange(proj.start_date, proj.end_date) }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-white">
                                    {{ proj.title }}
                                </h3>
                                <p class="text-sm text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ proj.description }}
                                </p>
                            </div>

                            <div class="space-y-4 pt-2">
                                <!-- Tech tags -->
                                <div v-if="proj.techstacks && proj.techstacks.length > 0" class="flex flex-wrap gap-1.5">
                                    <span 
                                        v-for="ts in proj.techstacks.slice(0, 4)" 
                                        :key="ts.id"
                                        class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-950 border border-slate-800 text-slate-300"
                                    >
                                        {{ ts.name }}
                                    </span>
                                    <span v-if="proj.techstacks.length > 4" class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-950 border border-slate-800 text-slate-400">
                                        +{{ proj.techstacks.length - 4 }} more
                                    </span>
                                </div>

                                <!-- Link button -->
                                <div class="border-t border-slate-800/80 pt-4 flex items-center justify-between">
                                    <Link 
                                        :href="`/portfolio/${proj.id}`" 
                                        class="text-xs font-bold text-blue-400 hover:text-blue-300 inline-flex items-center gap-1 transition-colors"
                                    >
                                        Read Details
                                        <ArrowRight class="w-3.5 h-3.5" />
                                    </Link>
                                    
                                    <a 
                                        v-if="proj.url" 
                                        :href="proj.url" 
                                        target="_blank" 
                                        class="text-slate-400 hover:text-white transition-colors"
                                        aria-label="View site"
                                    >
                                        <ExternalLink class="w-4 h-4" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-12">
                    <Link 
                        :href="portfolio().url" 
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-slate-850 hover:bg-slate-800 font-semibold text-slate-200 border border-slate-800 hover:border-slate-700 transition-all duration-300 hover:-translate-y-0.5"
                    >
                        Browse All Projects
                        <ArrowRight class="w-4 h-4" />
                    </Link>
                </div>
            </div>
        </section>

        <!-- SECTION 7: CONTACT -->
        <section class="border-t border-slate-900 bg-[#02050e]/60 px-4 py-20 sm:px-6 sm:py-24 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        Get In Touch
                    </h2>
                    <div class="h-1 w-20 bg-blue-500 mx-auto rounded-full"></div>
                    <p class="text-slate-400 text-md leading-relaxed">
                        Let's work together! Fill out the form or reach out directly.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start max-w-5xl mx-auto">
                    <!-- Column 1: Info -->
                    <div class="lg:col-span-5 space-y-6">
                        <h3 class="text-2xl font-bold text-white">Contact Info</h3>
                        <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                            Have an exciting project you want to build or just want to chat? Send a message and let's explore opportunities.
                        </p>

                        <div class="space-y-4 pt-4">
                            <div v-if="contact?.email" class="flex items-center gap-4">
                                <div class="h-10 w-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 border border-blue-500/20">
                                    <Mail class="w-5 h-5" />
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Email</p>
                                    <a :href="'mailto:' + contact.email" class="text-sm font-medium text-slate-200 hover:text-blue-400 transition-colors">
                                        {{ contact.email }}
                                    </a>
                                </div>
                            </div>

                            <div v-if="contact?.whatsapp" class="flex items-center gap-4">
                                <div class="h-10 w-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 border border-blue-500/20">
                                    <Phone class="w-5 h-5" />
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">WhatsApp</p>
                                    <a :href="'https://wa.me/' + contact.whatsapp.replace(/\D/g, '')" target="_blank" class="text-sm font-medium text-slate-200 hover:text-blue-400 transition-colors">
                                        {{ contact.whatsapp }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Form -->
                    <div class="lg:col-span-7 bg-slate-900/40 border border-slate-800/60 rounded-2xl p-6 sm:p-8 backdrop-blur-md">
                        <form @submit.prevent="handleContactSubmit" class="space-y-5">
                            <div>
                                <label for="name" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    v-model="contactForm.name"
                                    required 
                                    placeholder="Your Name"
                                    class="w-full bg-slate-950 border border-slate-850 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-blue-500/80 transition-all text-sm"
                                />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="email" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        v-model="contactForm.email"
                                        required 
                                        placeholder="your@email.com"
                                        class="w-full bg-slate-950 border border-slate-850 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-blue-500/80 transition-all text-sm"
                                    />
                                </div>
                                <div>
                                    <label for="whatsapp" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">WhatsApp / Phone</label>
                                    <input 
                                        type="text" 
                                        id="whatsapp" 
                                        v-model="contactForm.whatsapp"
                                        placeholder="+1 234 567"
                                        class="w-full bg-slate-950 border border-slate-850 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-blue-500/80 transition-all text-sm"
                                    />
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Message</label>
                                <textarea 
                                    id="message" 
                                    v-model="contactForm.message"
                                    required 
                                    rows="5"
                                    placeholder="Brief project details..."
                                    class="w-full bg-slate-950 border border-slate-850 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-blue-500/80 transition-all text-sm resize-none"
                                ></textarea>
                            </div>

                            <button 
                                type="submit" 
                                :disabled="isSubmitting"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-500 disabled:bg-blue-600/50 font-semibold text-white transition-all duration-300 shadow-lg shadow-blue-500/10 cursor-pointer"
                            >
                                <Send v-if="!isSubmitting" class="w-4 h-4" />
                                <span v-else class="h-4 w-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                                {{ isSubmitting ? 'Preparing Mail...' : 'Send Message' }}
                            </button>

                            <p v-if="showSuccessMessage" class="text-xs text-emerald-400 font-semibold mt-2 text-center animate-pulse">
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
</style>
