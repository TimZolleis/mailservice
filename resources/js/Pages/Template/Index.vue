<template>
    <Teleport to="body">
        <LargeModal
            title="Create Template"
            :show="showCreateModal"
            @close="showCreateModal = false"
        >
            <CreateTemplateComponent
                @success="showCreateModal = false"
            ></CreateTemplateComponent>
        </LargeModal>
    </Teleport>
    <div class="flex py-3 justify-between border-b">
        <PageHeader title="Templates" />
        <BlackButton
            button-text="Add"
            class="rounded ring ring-1 ring-gray-600 text-white bg-black font-inter"
            type="button"
            @click="addTemplate"
        >
        </BlackButton>
    </div>
    <main class="py-3 space-y-2">
        <TemplateComponent
            v-for="template in templates"
            :template="template"
        ></TemplateComponent>
    </main>
</template>

<script setup lang="ts">
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import { Variable } from "../../models/Variable";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import BlackButton from "../../components/common/BlackButton.vue";
import AddVariableComponent from "../../components/variables/AddVariableComponent.vue";
import { ref } from "@vue/reactivity";
import Modal from "../../components/common/Modal.vue";
import { Project } from "../../models/Project";
import VariableComponent from "../../components/variables/VariableComponent.vue";
import TemplateComponent from "../../components/templates/TemplateComponent.vue";
import { Template } from "../../models/Template";
import { useRelativeNavigation } from "../../composables/navigation";
import LargeModal from "../../components/common/LargeModal.vue";
import CreateTemplateComponent from "../../components/templates/CreateTemplateComponent.vue";

defineOptions({ layout: ProjectLayout });

const showCreateModal = ref(false);
const showEditModal = ref(false);

const props = defineProps<{
    templates: Template[];
}>();

function addTemplate() {
    showCreateModal.value = true;
}
</script>

<style scoped></style>