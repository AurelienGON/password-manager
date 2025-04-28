<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import SecretCard from "@/Components/SecretCard.vue";

const props = defineProps({
    secret: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="My Secrets">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight capitalize"
            >
                {{ secret.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid place-content-stretch md:place-content-center p-4">
                    <div class="md:min-w-[580px]">
                        <SecretCard :secret="secret" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
