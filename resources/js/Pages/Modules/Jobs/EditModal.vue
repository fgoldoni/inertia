<script setup>
import {ref, reactive, onMounted} from 'vue'
import LoadingButton from '@/Shared/LoadingButton.vue'
import {Dialog, DialogPanel, TransitionChild, TransitionRoot, Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import { QuestionMarkCircleIcon } from '@heroicons/vue/solid'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetTextarea from '@/Jetstream/Textarea.vue'
import JetInputError from '@/Jetstream/InputError.vue';
import ValidationErrors from '@/Shared/ValidationErrors.vue';
import ImageUpload from '@/Shared/ImageUpload.vue'
import BaseListbox from '@/Shared/BaseListbox.vue'
import DatePicker from '@/Shared/DatePicker.vue'
import AvatarInput from '@/Shared/AvatarInput.vue'
import BaseComboboxes from '@/Shared/BaseComboboxes.vue'
import BasePackages from '@/Shared/BasePackages.vue'
import Tags from '@/Shared/Tags.vue'
import Skills from '@/Shared/Skills.vue'
import Logs from '@/Shared/Logs.vue'
import Seo from '@/Shared/Seo.vue'
import BaseDisclosure from '@/Components/BaseDisclosure.vue'
import { useJobs } from '@/Composables/UseJobs.js'
import {useMedia} from "@/Composables/UseMedia.js";
import {useAvatar} from "@/Composables/UseAvatar.js";
import pickBy from "lodash/pickBy";
import {Errors} from "@/Plugins/errors.js";
import { ElNotification } from 'element-plus'
import { DocumentTextIcon, PencilAltIcon } from '@heroicons/vue/solid'

const tabs = [
    { name: 'Edit Modal', key: 'edit_modal', icon: PencilAltIcon },
    { name: 'Logs', key: 'logs', icon: DocumentTextIcon },
]

const currentTab = ref('edit_modal')


const { data: job, doFetchData: doFetchJob } = useJobs()

const props = defineProps({
    editing: Object,
    filters: Object,
    states: Array,
    basePageRoute: String,
});

const isOpen = ref(true)

const form = reactive({
    id: props.editing.id,
    name: props.editing.name,
    content: props.editing.content,
    company_id: props.editing.company_id,

    area: props.editing.categories?.find(element => element.type === "area")?.id,
    industry: props.editing.categories?.find(element => element.type === "industry")?.id,
    job_type: props.editing.categories?.find(element => element.type === "jobType")?.id,
    job_level: props.editing.categories?.find(element => element.type === "jobLevel")?.id,
    gender: props.editing.categories?.find(element => element.type === "gender")?.id,
    experience: props.editing.categories?.find(element => element.type === "experience")?.id,
    career_level: props.editing.categories?.find(element => element.type === "careerLevel")?.id,
    apply_type: props.editing.categories?.find(element => element.type === "applyType")?.id,

    salary_type: props.editing.salary_type,
    salary_min: props.editing.salary_min,
    salary_max: props.editing.salary_max,
    negotiable: props.editing.negotiable,

    address: props.editing.address,
    city_id: props.editing.city_id,
    zip: props.editing.zip,
    country_id: props.editing.country_id,
    iframe: props.editing.iframe,

    files: props.editing.attachments,
    state: props.editing.state,
    closing_to: props.editing.closing_to,

    skills: {
        responsibilities: props.editing.categories?.filter(element => element.type === "responsibility").map(element => element.id),
        skills: props.editing.categories?.filter(element => element.type === "skill").map(element => element.id),
        benefits: props.editing.categories?.filter(element => element.type === "benefit").map(element => element.id)
    },

    seo: {
        seo_title: props.editing.seo_title,
        seo_description: props.editing.seo_description,
    },

    defaultSrc: 'https://ui-avatars.com/api/?name=' + encodeURIComponent(props.editing.name) + '&color=7F9CF5&background=EBF4FF',
    avatar: props.editing.avatar_path,
    errors: new Errors(),
    password: '',
    processing: false,
});



onMounted(() => {
    doFetchJob();
})


const closeModal = () => {
    document.querySelector('#cancelButtonRef').click()
}

const onSubmit = () => {

    axios.put(route('admin.jobs.update', form.id), pickBy({
        name: form.name,
        content: form.content,

        company_id: form.company_id,
        area: form.area,
        industry: form.industry,

        salary_min: form.salary_min,
        salary_max: form.salary_max,
        negotiable: form.negotiable,
        salary_type: form.salary_type,

        job_type: form.job_type,
        experience: form.experience,

        career_level: form.career_level,
        gender: form.gender,

        job_level: form.job_level,
        address: form.address,
        country_id: form.country_id,
        city_id: form.city_id,
        zip: form.zip,


        iframe: form.iframe,
        state: form.state,

        closing_to: form.closing_to,
        apply_type: form.apply_type,

        ...form.skills.benefits,
        ...form.skills.responsibilities,
        ...form.skills.skills,

        avatar_path: useAvatar.value.media?.avatar_path,
        files: useMedia.value.doMediaFetchIds(),
        ...props.filters
    })).then((response) => {
        form.processing = false;
        ElNotification({
            title: 'Great!',
            message: response.data.message,
            type: 'success',
        })
        closeModal()
    }).catch(error => {
        form.processing = false;
        form.errors.onFailed(error);
    });

};


</script>

<template>
    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-10">

            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="hidden fixed inset-0 bg-secondary-500 bg-opacity-75 transition-opacity md:block" />
            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto" v-if="job.data">


                <div class="flex items-stretch md:items-center justify-center min-h-full text-center md:px-2 lg:px-4">

                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95" enter-to="opacity-100 translate-y-0 md:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 md:scale-100" leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95">

                        <DialogPanel class="relative text-base bg-secondary-100 text-left transform transition w-full md:max-w-4xl md:px-4 md:my-8 lg:max-w-6xl">

                            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:hidden">
                                    <label for="tabs" class="sr-only">Select a tab</label>
                                    <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                                    <select id="tabs" name="tabs" class="block w-full focus:ring-primary-500 focus:border-primary-500 border-secondary-300 rounded-md" v-model="currentTab">
                                        <option v-for="tab in tabs" :key="tab.name" :value="tab.key">{{ tab.name }}</option>
                                    </select>
                                </div>
                                <div class="hidden sm:block">
                                    <div class="border-b border-secondary-200">
                                        <nav class="px-4 -mb-px flex space-x-8" aria-label="Tabs">
                                            <a v-for="tab in tabs" :key="tab.name" href="javascript:;" @click="currentTab = tab.key" :class="[tab.key === currentTab ? 'border-primary-500 text-primary-600' : 'border-transparent text-secondary-500 hover:text-secondary-700 hover:border-secondary-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.key === currentTab ? 'page' : undefined">
                                                <component :is="tab.icon" :class="[tab.key === currentTab ? 'text-primary-500' : 'text-secondary-400 group-hover:text-secondary-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                                                <span>{{ tab.name }}</span>
                                            </a>
                                        </nav>
                                    </div>
                                </div>
                            </div>


                            <div v-if="currentTab === 'logs'">

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div>
                                        <div class="grid grid-cols-1">
                                            <div class="col-span-1">
                                                <Logs :options="props.editing.logs"></Logs>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div v-if="currentTab === 'edit_modal'">

                                <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                        <div>

                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                                                <div class="col-span-1 sm:col-span-3">

                                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

                                                        <div class="col-span-1 sm:col-span-2">

                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                <div class="col-span-1 sm:col-span-2" v-if="form.errors.any()">
                                                                    <ValidationErrors :errors="form.errors.all()" class="mb-4" />
                                                                </div>


                                                                <BaseDisclosure :title="__('Name & Description')" default-open>

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <JetLabel for="name" value="Job Title" required/>

                                                                            <JetInput
                                                                                id="name"
                                                                                name="name"
                                                                                v-model="form.name"
                                                                                type="text"
                                                                                class="mt-1 block w-full"
                                                                                required
                                                                                autofocus/>

                                                                            <JetInputError :message="form.errors.get('name')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <JetLabel for="content" value="Job Description" required/>

                                                                            <JetTextarea
                                                                                id="content"
                                                                                name="content"
                                                                                v-model="form.content"
                                                                                type="text"
                                                                                required
                                                                                class="mt-1 block w-full"
                                                                            />

                                                                            <div class="mt-3 flex items-center justify-between">
                                                                                <a href="#" class="group inline-flex items-start text-sm space-x-2 text-secondary-500 hover:text-secondary-900">
                                                                                    <QuestionMarkCircleIcon class="flex-shrink-0 h-5 w-5 text-secondary-400 group-hover:text-secondary-500" aria-hidden="true" />
                                                                                    <span> Some HTML is okay. </span>
                                                                                </a>
                                                                            </div>

                                                                            <JetInputError :message="form.errors.get('content')" class="mt-2"/>
                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>


                                                                <BaseDisclosure :title="__('Assets')">

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                        <div class="col-span-1">

                                                                            <JetLabel :value="__('Logo')" class="mb-2"/>

                                                                            <AvatarInput v-model="form.avatar" :default-src="form.defaultSrc" model='Modules\Jobs\Entities\Job'></AvatarInput>

                                                                        </div>

                                                                        <div class="col-span-1">

                                                                            <JetLabel :value="__('Featured Image')" class="mb-2"/>

                                                                            <ImageUpload v-model="form.files"></ImageUpload>

                                                                            <JetInputError :message="form.errors.get('files')" class="mt-2"/>
                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>

                                                                <BaseDisclosure :title="__('Companies & Areas')">

                                                                    <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseListbox :options="job.data.companies" v-model="form.company_id"  placeholder="Companies"  label="Companies"/>

                                                                            <JetInputError :message="form.errors.get('company_id')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseListbox :options="job.data.areas" v-model="form.area" placeholder="Areas" label="Areas"/>

                                                                            <JetInputError :message="form.errors.get('area')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseListbox :options="job.data.industries" v-model="form.industry" placeholder="Industries" label="Industries"/>

                                                                            <JetInputError :message="form.errors.get('industry')" class="mt-2"/>

                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>


                                                                <BaseDisclosure :title="__('Salaries')">

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                        <div class="col-span-1">

                                                                            <JetLabel for="salary_min" value="Min. Salary" />

                                                                            <JetInput
                                                                                id="salary_min"
                                                                                name="salary_min"
                                                                                v-model="form.salary_min"
                                                                                type="number"
                                                                                class="mt-1 block w-full"
                                                                            />

                                                                            <JetInputError :message="form.errors.get('salary_min')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1">

                                                                            <JetLabel for="salary_max" value="Max. Salary" />

                                                                            <JetInput
                                                                                id="salary_max"
                                                                                name="salary_max"
                                                                                v-model="form.salary_max"
                                                                                type="number"
                                                                                class="mt-1 block w-full"
                                                                            />

                                                                            <JetInputError :message="form.errors.get('salary_max')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">
                                                                            <SwitchGroup as="div" class="flex items-center whitespace-nowrap">
                                                                                <Switch v-model="form.negotiable" :class="[form.negotiable ? 'bg-primary-600' : 'bg-secondary-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500']">
                                                                                    <span aria-hidden="true" :class="[form.negotiable ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                                                                                </Switch>
                                                                                <SwitchLabel as="span" class="ml-3">
                                                                                    <span class="text-sm font-medium text-secondary-500">Negotiable Salary</span>
                                                                                </SwitchLabel>
                                                                            </SwitchGroup>

                                                                            <JetInputError :message="form.errors.get('negotiable')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseListbox :options="job.data.salaryTypes" v-model="form.salary_type" placeholder="Salary Types" label="Salary Types"/>

                                                                            <JetInputError :message="form.errors.get('salary_type')" class="mt-2"/>

                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>


                                                                <BaseDisclosure :title="__('Experiences & Career')">

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseListbox :options="job.data.jobTypes" v-model="form.job_type" placeholder="Job Type" label="Job Type"/>

                                                                            <JetInputError :message="form.errors.get('job_type')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1">

                                                                            <BaseListbox :options="job.data.experiences" v-model="form.experience" placeholder="Experiences" label="Experiences"/>

                                                                            <JetInputError :message="form.errors.get('experience')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1">

                                                                            <BaseListbox :options="job.data.careerLevels" v-model="form.career_level" placeholder="Career Level" label="Career Level"/>

                                                                            <JetInputError :message="form.errors.get('career_level')" class="mt-2"/>

                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>


                                                                <BaseDisclosure :title="__('Gender & Qualification')">

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseListbox :options="job.data.genders" v-model="form.gender"  placeholder="Gender" label="Gender"/>

                                                                            <JetInputError :message="form.errors.get('gender')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseListbox :options="job.data.jobLevels" v-model="form.job_level"  :placeholder="__('Qualification')" :label="__('Qualification')"/>

                                                                            <JetInputError :message="form.errors.get('job_level')" class="mt-2"/>

                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>


                                                                <BaseDisclosure :title="__('Friendly Address')">

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <JetLabel for="address" value="Friendly Address" />

                                                                            <JetInput
                                                                                id="address"
                                                                                name="address"
                                                                                v-model="form.address"
                                                                                type="text"
                                                                                class="mt-1 block w-full"
                                                                            />

                                                                            <JetInputError :message="form.errors.get('address')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <BaseComboboxes v-model="form.country_id" placeholder="No category" api-url="api.countries.index" label="Country" :default-value="props.editing.country?.name" key="select-country"></BaseComboboxes>

                                                                            <JetInputError :message="form.errors.get('country_id')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1">

                                                                            <BaseComboboxes v-model="form.city_id" :country-id="form.country_id" placeholder="No city" api-url="api.cities.index" label="City" :default-value="props.editing.city?.name" key="select-city"></BaseComboboxes>

                                                                            <JetInputError :message="form.errors.get('city_id')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1">

                                                                            <JetLabel for="zip" :value="__('Postal / Zip code')" />

                                                                            <JetInput
                                                                                id="zip"
                                                                                name="zip"
                                                                                v-model="form.zip"
                                                                                type="text"
                                                                                class="mt-1 block w-full"
                                                                            />

                                                                            <JetInputError :message="form.errors.get('zip')" class="mt-2"/>
                                                                        </div>

                                                                        <div class="col-span-1 sm:col-span-2">

                                                                            <JetLabel for="iframe" value="iFrame" />

                                                                            <JetTextarea
                                                                                id="iframe"
                                                                                name="iframe"
                                                                                v-model="form.iframe"
                                                                                type="text"
                                                                                class="mt-1 block w-full"
                                                                            />

                                                                            <div class="mt-3 flex items-center justify-between">
                                                                                <a href="#" class="group inline-flex items-start text-sm space-x-2 text-secondary-500 hover:text-secondary-900">
                                                                                    <QuestionMarkCircleIcon class="flex-shrink-0 h-5 w-5 text-secondary-400 group-hover:text-secondary-500" aria-hidden="true" />
                                                                                    <span> Some HTML is okay. </span>
                                                                                </a>
                                                                            </div>

                                                                            <JetInputError :message="form.errors.get('iframe')" class="mt-2"/>
                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>


                                                                <BaseDisclosure :title="__('Responsibilities, Skills & Benefits')">

                                                                    <Skills :options="job.data" :editing="props.editing" v-model="form.skills"></Skills>

                                                                </BaseDisclosure>

                                                                <div class="bg-white rounded-lg shadow-md divide-y divide-secondary-200 dark:bg-secondary-800 dark:divide-secondary-700 shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2">

                                                                    <Seo :editing="props.editing" v-model="form.seo"></Seo>

                                                                </div>


                                                            </div>

                                                        </div>

                                                        <div class="col-span-1">

                                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                <div class="bg-white rounded-lg shadow-md  border-2 border-secondary-200 col-span-1 sm:col-span-2">

                                                                    <div class="p-4 grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                        <div class="col-span-1">

                                                                            <BaseListbox :options="job.data.states" v-model="form.state"  placeholder="Publish"  label="Publish"/>

                                                                            <JetInputError :message="form.errors.get('state')" class="mt-2"/>

                                                                        </div>

                                                                        <div class="col-span-1">

                                                                            <JetLabel :value="__('Application Deadline Date')" />

                                                                            <DatePicker></DatePicker>

                                                                            <p class="mt-2 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                                                                Specify a deadline date so that your job are scheduled on your store.
                                                                            </p>


                                                                            <JetInputError :message="form.errors.get('closing_to')" class="mt-2"/>

                                                                        </div>

                                                                    </div>

                                                                </div>


                                                                <BaseDisclosure :title="__('Job Apply Types')">

                                                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">

                                                                        <div class="col-span-1">

                                                                            <BaseListbox :options="job.data.applyTypes" v-model="form.apply_type" :placeholder="__('Job Apply Types')" :label="__('Job Apply Types')"/>

                                                                            <JetInputError :message="form.errors.get('apply_type')" class="mt-2"/>

                                                                        </div>

                                                                    </div>

                                                                </BaseDisclosure>

                                                                <BaseDisclosure :title="__('Jobs Tags')">

                                                                    <Tags></Tags>

                                                                </BaseDisclosure>

                                                                <BaseDisclosure :title="__('Your Packages')">

                                                                    <BasePackages></BasePackages>

                                                                </BaseDisclosure>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="bg-secondary-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                        <LoadingButton type="submit" :loading="form.processing"
                                                       class="uppercase w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">

                                            {{ __('Save') }}

                                        </LoadingButton>

                                        <Link :href="props.basePageRoute" preserve-state preserve-scroll
                                              class="uppercase mt-3 w-full inline-flex justify-center rounded-md border border-secondary-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-secondary-700 hover:bg-secondary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                              id="cancelButtonRef"
                                              ref="cancelButtonRef">

                                            {{ __('Cancel') }}

                                        </Link>

                                    </div>

                                </form>

                            </div>



                        </DialogPanel>

                    </TransitionChild>

                </div>

            </div>

        </Dialog>

    </TransitionRoot>

</template>
