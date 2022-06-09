import {CalendarIcon, ChartBarIcon, FolderIcon, HomeIcon, InboxIcon, UsersIcon} from "@heroicons/vue/outline";

export const navigation = [
    { name: 'Dashboard', href: 'dashboard', icon: HomeIcon, current: route().current('dashboard') },
    { name: 'Users', href: 'admin.users.index', icon: HomeIcon, current: route().current('users') },
    { name: 'Team', href: 'dashboard', icon: UsersIcon, current: false },
    { name: 'Projects', href: 'dashboard', icon: FolderIcon, current: false },
    { name: 'Calendar', href: 'dashboard', icon: CalendarIcon, current: false },
    { name: 'Documents', href: 'dashboard', icon: InboxIcon, current: false },
    { name: 'Reports', href: 'dashboard', icon: ChartBarIcon, current: false },
]

export const userNavigation = [
    { name: 'Your Profile', href: route('profile.show') },
    { name: 'Settings', href: '#' },
]
