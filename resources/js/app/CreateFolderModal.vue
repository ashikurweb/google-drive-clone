<script setup>
    import Modal from '@/Components/Modal.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import { useForm } from '@inertiajs/vue3';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { nextTick, ref } from 'vue';
  
    const { modelValue } = defineProps({
        modelValue: Boolean
    });

    const folderNameInput = ref(null);

    const emit = defineEmits(['update:modelValue']);

    const form = useForm({
        name: '',
    });

    function createFolder () {
        form.post(route('folder.create'), {
            preserveScroll: true,
            onSuccess: () => {
                closeModal();
                form.reset();

                // Show success notification
            },
            onError: () => {
                folderNameInput.value.focus();
            },
        });
    }

    function closeModal () {
        emit('update:modelValue', false);
        form.clearErrors();
        form.reset();
    }

    function onShow () {
        nextTick(() => folderNameInput.value.focus());
    }
</script>


<template>
    <modal :show="modelValue" max-width="md" @show="onShow" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create New Folder
            </h2>

            <div class="mt-6">
                <InputLabel for="folderName" value="Folder Name" class="sr-only"/>
                <TextInput type="text"
                           ref="folderNameInput" 
                           id="folderName" v-model="form.name"
                           class="mt-1 block w-full"
                           :class="form.errors.name ? 'border-red-600 focus:border-red-600 focus:ring-red-600' : ''"
                           placeholder="Folder Name"
                           @keyup.enter="createFolder"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>
                <PrimaryButton @click="createFolder" class="ml-3" :class="{ 'opacity-25' : form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </div>
    </modal>
</template>