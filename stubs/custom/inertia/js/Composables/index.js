import { createPopper } from '@popperjs/core'
import { useDark, useToggle } from '@vueuse/core'
import { ref, onMounted, watchEffect, reactive } from 'vue'

export const isDark = useDark()
export const isSearchPanelOpen = ref(false)
export const isSettingsPanelOpen = ref(false)
export const toggleDarkMode = useToggle(isDark)
export const isNotificationsPanelOpen = ref(false)

export const sidebarState = reactive({
    isOpen: window.innerWidth > 1024,
    isHovered: false,
    handleHover(value) {
        if (window.innerWidth < 1024) {
            return
        }
        sidebarState.isHovered = value
    },
    handleWindowResize() {
        if (window.innerWidth <= 1024) {
            sidebarState.isOpen = false
        } else {
            sidebarState.isOpen = true
        }
    },
})

export const scrolling = reactive({
    down: false,
    up: false,
})

let lastScrollTop = 0

export const handleScroll = () => {
    let st = window.pageYOffset || document.documentElement.scrollTop
    if (st > lastScrollTop) {
        // downscroll
        scrolling.down = true
        scrolling.up = false
    } else {
        // upscroll
        scrolling.down = false
        scrolling.up = true
        if (st == 0) {
            //  reset
            scrolling.down = false
            scrolling.up = false
        }
    }
    lastScrollTop = st <= 0 ? 0 : st // For Mobile or negative scrolling
}

export function usePopper(options) { 
	let reference = ref(null)
	let popper = ref(null)

	onMounted(() => {
		watchEffect(onInvalidate => {
			if (!popper.value) return
			if (!reference.value) return

			let popperEl = popper.value.el || popper.value
			let referenceEl = reference.value.el || reference.value

			if (!(referenceEl instanceof HTMLElement)) return
			if (!(popperEl instanceof HTMLElement)) return

			let { destroy } = createPopper(referenceEl, popperEl, options)

			onInvalidate(destroy)
		})
	})

	return [reference, popper]
}