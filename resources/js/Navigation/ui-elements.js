import {CalendarIcon, ChartBarIcon, FolderIcon, HomeIcon, InboxIcon, UsersIcon, CubeIcon} from "@heroicons/vue/outline";

export const navigation = [
    { name: 'Dashboard', href: 'dashboard', icon: HomeIcon, current: route().current('dashboard') },
    { name: 'Team', href: 'dashboard', icon: UsersIcon, current: false },
    { name: 'Users', href: 'admin.users.index', icon: HomeIcon, current: route().current('admin.users.index') },
    { name: 'Roles', href: 'admin.roles.index', icon: CubeIcon, current: route().current('admin.roles.index') },
    { name: 'Categories', href: 'admin.categories.index', icon: FolderIcon, current: route().current('admin.categories.index') },
    { name: 'Countries', href: 'admin.countries.index', icon: FolderIcon, current: route().current('admin.countries.index') },
    { name: 'Divisions', href: 'admin.divisions.index', icon: FolderIcon, current: route().current('admin.divisions.index') },
    { name: 'Cities', href: 'admin.cities.index', icon: FolderIcon, current: route().current('admin.cities.index') },
    { name: 'Companies', href: 'admin.companies.index', icon: FolderIcon, current: route().current('admin.companies.index') },
    { name: 'Jobs', href: 'admin.jobs.index', icon: FolderIcon, current: route().current('admin.jobs.index') },
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
