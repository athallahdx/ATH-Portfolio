<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { 
    Mail, 
    Phone, 
    MessageSquare, 
    ExternalLink, 
    Send, 
    BriefcaseBusiness, 
    Code, 
    Sparkles, 
    ArrowRight,
    CheckCircle
} from '@lucide/vue';

// Define the interface for contact details from the database
interface ContactInfo {
    name: string;
    email: string | null;
    whatsapp: string | null;
    linkedin: string | null;
    github: string | null;
    instagram: string | null;
}

const props = defineProps<{
    contact: ContactInfo | null;
}>();

// Form state for Contact Form
const contactForm = ref({
    name: '',
    email: '',
    whatsapp: '',
    serviceType: 'Full-Stack Development',
    budget: '$1,000 - $3,000',
    message: ''
});

const isSubmitting = ref(false);
const showSuccessMessage = ref(false);
const submitMethod = ref<'email' | 'whatsapp'>('email');

const handleContactSubmit = () => {
    isSubmitting.value = true;
    
    // Simulate sending email / whatsapp integration
    setTimeout(() => {
        isSubmitting.value = false;
        showSuccessMessage.value = true;
        
        const contactEmail = props.contact?.email ?? 'contact@example.com';
        const contactWhatsApp = props.contact?.whatsapp ?? '';
        
        // Build email / whatsapp body text
        const subject = `Work/Service Request: ${contactForm.value.serviceType}`;
        const messageText = 
            `Hello Athallah,\n\n` +
            `I'm interested in your ${contactForm.value.serviceType} services. Here are the details:\n\n` +
            `- Name: ${contactForm.value.name}\n` +
            `- Email: ${contactForm.value.email}\n` +
            `- WhatsApp/Phone: ${contactForm.value.whatsapp || 'Not provided'}\n` +
            `- Budget Range: ${contactForm.value.budget}\n\n` +
            `Project Description:\n${contactForm.value.message}`;
            
        if (submitMethod.value === 'email') {
            const mailtoUrl = `mailto:${contactEmail}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(messageText)}`;
            window.location.href = mailtoUrl;
        } else {
            // Format phone number (remove non-numeric chars except leading + if any)
            const cleanPhone = contactWhatsApp.replace(/[^\d+]/g, '');
            const waUrl = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(messageText)}`;
            window.open(waUrl, '_blank');
        }
        
        // Reset form
        contactForm.value = {
            name: '',
            email: '',
            whatsapp: '',
            serviceType: 'Full-Stack Development',
            budget: '$1,000 - $3,000',
            message: ''
        };
        
        // Hide success message after 5 seconds
        setTimeout(() => {
            showSuccessMessage.value = false;
        }, 5000);
    }, 1000);
};

// Available services for the dropdown
const serviceOptions = [
    'Full-Stack Development',
    'Backend API Design',
    'Frontend / UI Development',
    'Mobile Application Development',
    'System Maintenance & Support',
    'Other Consulting / Custom Project'
];

// Budget options
const budgetOptions = [
    '< $1,000',
    '$1,000 - $3,000',
    '$3,000 - $5,000',
    '$5,000 - $10,000',
    '$10,000+'
];
</script>

<template>
    <Head title="Contact Me | Athallah Tsany Satriyaji" />

    <PublicLayout>
        <!-- Background decorative gradients -->
        <div class="relative min-h-[calc(100vh-4rem)] flex flex-col justify-center py-16 px-4 sm:px-6 lg:px-8 overflow-hidden bg-[#030712]">
            <!-- Subtle background grids & glow -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(59,130,246,0.06),transparent_60%)] pointer-events-none z-0"></div>
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[1px] bg-gradient-to-r from-transparent via-blue-500/20 to-transparent pointer-events-none"></div>

            <div class="max-w-6xl mx-auto w-full relative z-10 space-y-12">
                <!-- Header Title -->
                <div class="text-center max-w-3xl mx-auto space-y-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider animate-pulse">
                        <Sparkles class="w-3.5 h-3.5" />
                        Let's build something epic
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                        Start a Project with <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">Athallah</span>
                    </h1>
                    <p class="text-slate-400 text-base sm:text-lg max-w-xl mx-auto">
                        Need a custom application, scalable backend structure, or full-stack solution? Get in touch and let's discuss details.
                    </p>
                </div>

                <!-- Contact Section Main Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <!-- Column 1: Info and Direct Links -->
                    <div class="lg:col-span-5 space-y-6">
                        <div class="bg-slate-900/40 border border-slate-800/60 rounded-3xl p-6 sm:p-8 backdrop-blur-md space-y-6 relative overflow-hidden">
                            <!-- Glow -->
                            <div class="absolute -right-16 -top-16 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl pointer-events-none"></div>

                            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                <BriefcaseBusiness class="w-5 h-5 text-blue-400" />
                                Hire My Services
                            </h3>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                I am available for freelance work, contract gigs, and collaboration on interesting projects. Select the type of service you need in the form to get a personalized proposal.
                            </p>

                            <!-- Direct channels -->
                            <div class="space-y-4 pt-4 border-t border-slate-800/60">
                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Direct Contact Channels</h4>
                                
                                <div v-if="contact?.email" class="flex items-center gap-4 group">
                                    <div class="h-11 w-11 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 border border-blue-500/20 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                        <Mail class="w-5 h-5" />
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-[10px] text-slate-500 uppercase tracking-wider font-bold">Email Address</p>
                                        <a :href="'mailto:' + contact.email" class="text-sm font-semibold text-slate-200 hover:text-blue-400 transition-colors">
                                            {{ contact.email }}
                                        </a>
                                    </div>
                                </div>

                                <div v-if="contact?.whatsapp" class="flex items-center gap-4 group">
                                    <div class="h-11 w-11 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 border border-emerald-500/20 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                                        <Phone class="w-5 h-5" />
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-[10px] text-slate-500 uppercase tracking-wider font-bold">WhatsApp / Phone</p>
                                        <a :href="'https://wa.me/' + contact.whatsapp.replace(/\D/g, '')" target="_blank" class="text-sm font-semibold text-slate-200 hover:text-emerald-400 transition-colors">
                                            {{ contact.whatsapp }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Links -->
                            <div class="pt-6 border-t border-slate-800/60">
                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Follow & Connect</h4>
                                <div class="flex flex-wrap gap-3">
                                    <a 
                                        v-if="contact?.github" 
                                        :href="contact.github" 
                                        target="_blank" 
                                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-950 hover:bg-slate-900 border border-slate-800 hover:border-slate-700 font-semibold text-sm text-slate-300 transition-all duration-300"
                                    >
                                        <Code class="w-4 h-4 text-slate-400" />
                                        GitHub
                                        <ExternalLink class="w-3 h-3 text-slate-500" />
                                    </a>
                                    <a 
                                        v-if="contact?.linkedin" 
                                        :href="contact.linkedin" 
                                        target="_blank" 
                                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-950 hover:bg-slate-900 border border-slate-800 hover:border-slate-700 font-semibold text-sm text-slate-300 transition-all duration-300"
                                    >
                                        <BriefcaseBusiness class="w-4 h-4 text-blue-400" />
                                        LinkedIn
                                        <ExternalLink class="w-3 h-3 text-slate-500" />
                                    </a>
                                    <a 
                                        v-if="contact?.instagram" 
                                        :href="contact.instagram" 
                                        target="_blank" 
                                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-950 hover:bg-slate-900 border border-slate-800 hover:border-slate-700 font-semibold text-sm text-slate-300 transition-all duration-300"
                                    >
                                        <Sparkles class="w-4 h-4 text-purple-400" />
                                        Instagram
                                        <ExternalLink class="w-3 h-3 text-slate-500" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Form -->
                    <div class="lg:col-span-7 bg-slate-900/40 border border-slate-800/60 rounded-3xl p-6 sm:p-8 backdrop-blur-md relative overflow-hidden">
                        <!-- Glow -->
                        <div class="absolute -left-20 -bottom-20 w-40 h-40 bg-indigo-600/10 rounded-full blur-2xl pointer-events-none"></div>

                        <form @submit.prevent="handleContactSubmit" class="space-y-6">
                            <h3 class="text-xl font-bold text-white mb-2">Project Details</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Your Name</label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        v-model="contactForm.name"
                                        required 
                                        placeholder="John Doe"
                                        class="w-full bg-slate-950 border border-slate-850 focus:border-blue-500/80 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-650 focus:outline-none transition-all text-sm shadow-inner"
                                    />
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Your Email</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        v-model="contactForm.email"
                                        required 
                                        placeholder="john@example.com"
                                        class="w-full bg-slate-950 border border-slate-850 focus:border-blue-500/80 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-650 focus:outline-none transition-all text-sm shadow-inner"
                                    />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="whatsapp" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">WhatsApp / Phone (Optional)</label>
                                    <input 
                                        type="text" 
                                        id="whatsapp" 
                                        v-model="contactForm.whatsapp"
                                        placeholder="+1 234 567 890"
                                        class="w-full bg-slate-950 border border-slate-850 focus:border-blue-500/80 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-650 focus:outline-none transition-all text-sm shadow-inner"
                                    />
                                </div>
                                <div>
                                    <label for="serviceType" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Service Needed</label>
                                    <select 
                                        id="serviceType" 
                                        v-model="contactForm.serviceType"
                                        class="w-full bg-slate-950 border border-slate-850 focus:border-blue-500/80 rounded-xl px-4 py-3 text-slate-200 focus:outline-none transition-all text-sm"
                                    >
                                        <option v-for="option in serviceOptions" :key="option" :value="option">
                                            {{ option }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="budget" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Estimated Budget Range</label>
                                <div class="flex flex-wrap gap-2">
                                    <button 
                                        type="button" 
                                        v-for="bOpt in budgetOptions" 
                                        :key="bOpt"
                                        @click="contactForm.budget = bOpt"
                                        class="px-4 py-2 text-xs font-semibold rounded-lg border transition-all duration-200 cursor-pointer"
                                        :class="contactForm.budget === bOpt 
                                            ? 'bg-blue-600 border-blue-500 text-white shadow-md shadow-blue-500/20' 
                                            : 'bg-slate-950 border-slate-850 text-slate-400 hover:border-slate-700 hover:text-white'"
                                    >
                                        {{ bOpt }}
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Project Brief / Message</label>
                                <textarea 
                                    id="message" 
                                    v-model="contactForm.message"
                                    required 
                                    rows="5"
                                    placeholder="Explain your goals, features needed, timeline or details here..."
                                    class="w-full bg-slate-950 border border-slate-850 focus:border-blue-500/80 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-650 focus:outline-none transition-all text-sm resize-none shadow-inner"
                                ></textarea>
                            </div>

                            <!-- Submit Method Switcher -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-2">
                                <div class="flex gap-4">
                                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-400">
                                        <input 
                                            type="radio" 
                                            name="submitMethod" 
                                            value="email" 
                                            v-model="submitMethod"
                                            class="text-blue-500 focus:ring-blue-500 bg-slate-950 border-slate-850" 
                                        />
                                        Submit via Email
                                    </label>
                                    <label v-if="contact?.whatsapp" class="inline-flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-400">
                                        <input 
                                            type="radio" 
                                            name="submitMethod" 
                                            value="whatsapp" 
                                            v-model="submitMethod"
                                            class="text-emerald-500 focus:ring-emerald-500 bg-slate-950 border-slate-850" 
                                        />
                                        Submit via WhatsApp
                                    </label>
                                </div>

                                <button 
                                    type="submit" 
                                    :disabled="isSubmitting"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-semibold text-white transition-all duration-350 cursor-pointer shadow-lg hover:-translate-y-0.5"
                                    :class="submitMethod === 'email' 
                                        ? 'bg-blue-600 hover:bg-blue-500 shadow-blue-500/20' 
                                        : 'bg-emerald-600 hover:bg-emerald-500 shadow-emerald-500/20'"
                                >
                                    <Send v-if="!isSubmitting" class="w-4 h-4" />
                                    <span v-else class="h-4 w-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                                    {{ isSubmitting ? 'Redirecting...' : (submitMethod === 'email' ? 'Send Email Request' : 'Chat via WhatsApp') }}
                                </button>
                            </div>

                            <!-- Success/Redirection Message -->
                            <transition
                                enter-active-class="transition duration-300 ease-out"
                                enter-from-class="opacity-0 translate-y-2"
                                enter-to-class="opacity-100 translate-y-0"
                                leave-active-class="transition duration-200 ease-in"
                                leave-from-class="opacity-100 translate-y-0"
                                leave-to-class="opacity-0 translate-y-2"
                            >
                                <div v-if="showSuccessMessage" class="flex items-center gap-2.5 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-xs font-medium">
                                    <CheckCircle class="w-4 h-4 shrink-0" />
                                    <span>Opening the messaging channel. Thanks for reaching out!</span>
                                </div>
                            </transition>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
