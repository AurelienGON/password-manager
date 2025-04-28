<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import SecretCard from "@/Components/SecretCard.vue";

const props = defineProps({
    secrets: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="My Secrets">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Secrets
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-4">
                    <SecretCard
                        v-for="secret in secrets"
                        :key="secret.id"
                        :secret="secret"
                    />
                </div>
                <p
                    v-if="secrets.length < 1"
                    class="p-6 border rounded-lg shadow-md bg-white relative w-full"
                >
                    No secrets found.
                </p>
            </div>
        </div>
    </AppLayout>
</template>
