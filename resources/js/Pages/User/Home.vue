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
            content="Fie că lucrați în construcții, industrie, logistică sau alte domenii, noi vă oferim echipamente profesionale care combină durabilitatea, confortul și stilul. În magazinul nostru veți găsi o gamă variată de produse special concepute pentru a asigura siguranța și eficiența la locul de muncă."
            button-text="Produsele noastre"
            src="storage/images/Welcome.jpg"
            :href="route('product.index')"
        />
        <CategorySection :categories="categories"/>
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
    categories: Array,
}>();
</script>
