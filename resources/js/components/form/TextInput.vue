<template>
    <div class="flex flex-col gap-1 py-2 w-full">
        <label
            class="font-inter text-label-medium text-gray-600"
            v-if="useLabel"
            >{{ label }}</label
        >
        <div class="flex gap-2 items-center">
            <div class="w-full">
                <input
                    class="peer block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-sm shadow-md hover:shadow-lg transition ease-in-out focus:border-black focus:outline-none focus:ring-0"
                    :value="modelValue"
                    @input="$emit('update:modelValue', $event.target.value)"
                    type="text"
                    :placeholder="placeholder"
                />
                <p
                    v-if="errorMessage"
                    class="font-inter text-red-500 text-label-small py-2 px-3"
                >
                    {{ errorMessage }}
                </p>
            </div>
            <slot name="after-input"></slot>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps<{
    label?: string;
    errorMessage?: string;
    modelValue: any;
    useLabel: boolean;
    placeholder?: string;
}>();

const emits = defineEmits(["update:modelValue"]);
</script>

<style scoped></style>
