import { defineAsyncComponent } from 'vue'

const useModal = {
    computed: {
        modalComponent() {
            return this.$page.props.modal
                ? defineAsyncComponent(() => import(`@/Pages/${this.$page.props.modal}.vue`))
                : false
        }
    }
}

export { useModal }
