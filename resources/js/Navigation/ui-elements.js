import {CalendarIcon, ChartBarIcon, FolderIcon, HomeIcon, InboxIcon, UsersIcon, CubeIcon} from "@heroicons/vue/outline";

export const navigation = [
    { name: 'Dashboard', href: 'dashboard', icon: HomeIcon, current: route().current('dashboard') },
    { name: 'Users', href: 'admin.users.index', icon: HomeIcon, current: route().current('admin.users.index') },
    { name: 'Roles', href: 'admin.roles.index', icon: CubeIcon, current: route().current('admin.roles.index') },
    { name: 'Team', href: 'dashboard', icon: UsersIcon, current: false },
    { name: 'Projects', href: 'dashboard', icon: FolderIcon, current: false },
    { name: 'Calendar', href: 'dashboard', icon: CalendarIcon, current: false },
    { name: 'Documents', href: 'dashboard', icon: InboxIcon, current: false },
    { name: 'Reports', href: 'dashboard', icon: ChartBarIcon, current: false },
    { name: 'Telescope', href: 'telescope', icon: ChartBarIcon, current: false },
]

export const userNavigation = [
    { name: 'Your Profile', href: route('profile.show') },
    { name: 'API Tokens', href: route('api-tokens.index') },
    { name: 'Settings', href: '#' },
]
