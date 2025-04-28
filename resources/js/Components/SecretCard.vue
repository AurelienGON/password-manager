<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    secret: {
        type: Object,
        required: true,
    },
});
const deleteSecretForm = useForm({});

const showPassword = ref(false);
const flashMessage = ref("");
const showDeleteConfirmation = ref(false);

function togglePasswordVisibility() {
    showPassword.value = !showPassword.value;
}

function copyToClipboard(value, message) {
    navigator.clipboard
        .writeText(value)
        .then(() => {
            flashMessage.value = message;
            setTimeout(() => {
                flashMessage.value = "";
            }, 1500);
        })
        .catch(() => {
            flashMessage.value = "Failed to copy!";
            setTimeout(() => {
                flashMessage.value = "";
            }, 1500);
        });
}

const deleteSecret = () => {
    deleteSecretForm.delete(route("secrets.destroy", props.secret.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="p-6 border rounded-lg shadow-md bg-white relative">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">
            {{ secret.title }}
        </h2>

        <div class="mb-4">
            <p class="text-sm font-medium text-gray-700 mb-1">Site URL</p>
            <div class="flex items-center">
                <span class="bg-gray-100 px-2 py-1 rounded w-full break-all">
                    {{ secret.site }}
                </span>
                <button class="ml-2 text-gray-500 hover:text-indigo-700">
                    <a :href="secret.site" target="_blank">
                        <span class="material-icons"> open_in_new </span>
                    </a>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-sm font-medium text-gray-700 mb-1">Username</p>
            <div class="flex items-center">
                <span class="bg-gray-100 px-2 py-1 rounded w-full break-all">
                    {{ secret.username }}
                </span>
                <button
                    @click="
                        copyToClipboard(secret.username, 'Username copied!')
                    "
                    class="ml-2 text-gray-500 hover:text-indigo-700"
                >
                    <span class="material-icons">content_copy</span>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-sm font-medium text-gray-700 mb-1">Password</p>
            <div class="flex items-center">
                <span
                    class="font-mono bg-gray-100 px-2 py-1 rounded w-full break-all"
                >
                    {{ showPassword ? secret.password : "••••••••" }}
                </span>
                <button
                    @click="togglePasswordVisibility"
                    class="ml-2 text-gray-500 hover:text-indigo-700"
                >
                    <span v-if="showPassword" class="material-icons"
                        >visibility_off</span
                    >
                    <span v-else class="material-icons">visibility</span>
                </button>
                <button
                    @click="
                        copyToClipboard(secret.password, 'Password copied!')
                    "
                    class="ml-2 text-gray-500 hover:text-indigo-700"
                >
                    <span class="material-icons">content_copy</span>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-sm font-medium text-gray-700 mb-1">Notes</p>
            <div class="bg-gray-100 px-2 py-1 rounded w-full break-all">
                {{ secret.notes || "-" }}
            </div>
        </div>

        <p class="text-xs text-gray-500 text-left">
            <strong>Last Updated:</strong>
            {{ new Date(secret.updated_at).toLocaleString() }}
        </p>

        <!-- Action buttons -->
        <div class="mt-4 flex justify-end space-x-4">
            <Link
                :href="route('secrets.edit', secret.id)"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                as="button"
            >
                Edit
            </Link>
            <form @submit.prevent="showDeleteConfirmation = true">
                <button
                    type="submit"
                    :disabled="deleteSecretForm.processing"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                >
                    Delete
                </button>
            </form>
        </div>

        <!-- Flash message with fade transition -->
        <transition name="fade">
            <div
                v-if="flashMessage"
                class="absolute top-0 left-0 bg-green-100 text-green-800 text-sm font-semibold py-3 px-6 rounded shadow-md"
            >
                {{ flashMessage }}
            </div>
        </transition>
    </div>

    <ConfirmationModal :show="showDeleteConfirmation" @close="showDeleteConfirmation = false">
    <template #title>
        Delete Secret
    </template>

    <template #content>
        Are you sure you want to delete This Secret? <strong>it will be permanently deleted!.</strong>
    </template>

    <template #footer>
        <SecondaryButton @click.native="showDeleteConfirmation = false">
            Nevermind
        </SecondaryButton>

        <DangerButton class="ml-2" @click.native="deleteSecret" :class="{ 'opacity-25': deleteSecretForm.processing }" :disabled="deleteSecretForm.processing">
            Delete Secret
        </DangerButton>
    </template>
</ConfirmationModal>
</template>

<style>
/* Ensure Material Icons are available */
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");

/* Fade transition styles */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease-out;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
