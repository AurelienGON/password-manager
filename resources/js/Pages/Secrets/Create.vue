<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    title: "",
    site: "",
    username: "",
    password: "",
    notes: "",
});

const showPassword = ref(false);

function togglePasswordVisibility() {
    showPassword.value = !showPassword.value;
}

function submit() {
    form.post(route("secrets.store"), {
        preserveScroll: true,
    });
}
</script>

<template>
    <AppLayout title="Create Secret">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Secret
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-4 sm:mx-auto sm:px-6 lg:px-8">
                <form
                    @submit.prevent="submit"
                    class="bg-white p-6 rounded-lg shadow-md"
                >
                    <div class="mb-4">
                        <InputLabel for="title" value="Title *" />
                        <TextInput
                            id="title"
                            v-model="form.title"
                            type="text"
                            class="mt-1 block w-full"
                            autofocus
                        />
                        <p
                            v-if="form.errors.title"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.title }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="site" value="Site URL *" />
                        <TextInput
                            id="site"
                            v-model="form.site"
                            type="url"
                            class="mt-1 block w-full"
                        />
                        <p
                            v-if="form.errors.site"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.site }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="username" value="Username *" />
                        <TextInput
                            id="username"
                            v-model="form.username"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <p
                            v-if="form.errors.username"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.username }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="password" value="Password *" />
                        <div class="flex items-center">
                            <TextInput
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                class="mt-1 block w-full"
                            />
                            <button
                                @click="togglePasswordVisibility"
                                class="ml-2 text-gray-500 hover:text-indigo-700"
                                type="button"
                            >
                                <span v-if="showPassword" class="material-icons"
                                    >visibility_off</span
                                >
                                <span v-else class="material-icons"
                                    >visibility</span
                                >
                            </button>
                        </div>
                        <p
                            v-if="form.errors.password"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <InputLabel for="notes" value="Notes" />
                        <textarea
                            id="notes"
                            v-model="form.notes"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            rows="4"
                        ></textarea>
                        <p
                            v-if="form.errors.notes"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.notes }}
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                        >
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<style>
/* Ensure Material Icons are available */
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");
</style>
