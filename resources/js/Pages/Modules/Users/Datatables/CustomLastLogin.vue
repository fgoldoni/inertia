<script setup>
const props = defineProps({
    row: Object,
});
</script>

<template>
    <div v-if="props.row.sessions.length > 0" class="space-y-6">
        <div v-for="(session, i) in props.row.sessions" :key="i" class="flex items-center">
            <div>
                <svg
                    v-if="session.agent.is_desktop"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="w-8 h-8 text-gray-500"
                >
                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>

                <svg
                    v-else
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="w-8 h-8 text-gray-500"
                >
                    <path d="M0 0h24v24H0z" stroke="none" /><rect
                    x="7"
                    y="4"
                    width="10"
                    height="16"
                    rx="1"
                /><path d="M11 5h2M12 17v.01" />
                </svg>
            </div>

            <div class="ml-3">
                <div class="text-sm text-gray-600">
                    {{ session.agent.platform ? session.agent.platform : 'Unknown' }} - {{ session.agent.browser ? session.agent.browser : 'Unknown' }}
                </div>

                <div>
                    <div class="text-xs text-gray-500">
                        {{ session.ip_address }},

                        <span v-if="session.is_current_device" class="text-green-500 font-semibold">This device</span>
                        <span v-else>Last active {{ session.last_active }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
