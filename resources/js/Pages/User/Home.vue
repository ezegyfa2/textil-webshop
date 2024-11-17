<template>
    <MainLayout>
        <Header/>
        <BlogGroup
            :blog1="props.main_blog1"
            :blog2="props.main_blog2"
            :blog3="props.main_blog3"
        />
        <DescriptionSection 
            id="about_us"
            title="Bine ați venit la MATextil"
            content="Bine ați venit în magazinul nostru online, dedicat companiilor care caută îmbrăcăminte de lucru și accesorii de calitate, produse responsabil din bumbac organic. Credem în crearea unor articole durabile și confortabile, care să reflecte grija față de angajați și față de mediu. Fiecare produs este realizat din bumbac organic, oferind nu doar rezistență, ci și o atingere delicată pentru piele. În magazinul nostru, veți găsi atât echipamente de lucru practice, cât și accesorii de încredere, potrivite pentru diverse domenii de activitate. Designurile noastre sunt moderne, adaptate cerințelor actuale, și se pretează excelent pentru personalizare prin branding. Astfel, companiile își pot transmite identitatea prin echipamentele angajaților. Fiecare articol de îmbrăcăminte este realizat cu atenție la detalii și la nevoile utilizatorului. Cu produsele noastre, veți investi în echipamente care respectă standardele de calitate, siguranță și sustenabilitate."
            button-text="Produsele noastre"
            src="storage/images/header/5.jpg"
            :image_max_height="600"
            :href="route('product.index')"
        />
        <CategorySection :categories="brands"/>
        <ClientOpinionSection class="top-section-separator"/>
        <BlogSection
            :blog1="blog1"
            :blog2="blog2"
            :blog3="blog3"
        />
    </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/User/MainLayout.vue';
import Header from '@/Components/User/Home/Header.vue';
import BlogGroup from '@/Components/User/Home/BlogGroup.vue';
import CategorySection from '@/Components/User/Home/CategorySection.vue';
import DescriptionSection from '@/Components/User/DescriptionSection.vue';
import ClientOpinionSection from '@/Components/User/Home/ClientOpinionSection.vue';
import BlogSection from '@/Components/User/Home/BlogSection.vue';
import { BlogShort } from '@/types/blog';

const props = defineProps<{
    main_blog1: BlogShort,
    main_blog2: BlogShort,
    main_blog3: BlogShort,
    blog1: BlogShort,
    blog2: BlogShort,
    blog3: BlogShort,
    brands: Array,
}>();
</script>
