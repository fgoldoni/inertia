import {ShieldCheckIcon, MapIcon, AcademicCapIcon, DocumentSearchIcon, SparklesIcon, ShareIcon, FolderIcon, HomeIcon, UsersIcon, GlobeIcon, CubeIcon, ViewGridAddIcon} from "@heroicons/vue/outline";

export const navigation = [
    { name: 'Dashboard', href: 'admin.dashboard.index', icon: HomeIcon, current: route().current('admin.dashboard.index') },
    { name: 'Users', href: 'admin.users.index', icon: UsersIcon, current: route().current('admin.users.index') },
    { name: 'Roles & Permissions', href: 'admin.roles.index', icon: ShieldCheckIcon, current: route().current('admin.roles.index') },
    { name: 'Teams', href: 'admin.teams.index', icon: ViewGridAddIcon, current: route().current('admin.teams.index') },
    { name: 'Categories', href: 'admin.categories.index', icon: ShareIcon, current: route().current('admin.categories.index') },
    { name: 'Countries', href: 'admin.countries.index', icon: GlobeIcon, current: route().current('admin.countries.index') },
    { name: 'Divisions', href: 'admin.divisions.index', icon: SparklesIcon, current: route().current('admin.divisions.index') },
    { name: 'Cities', href: 'admin.cities.index', icon: MapIcon, current: route().current('admin.cities.index') },
    { name: 'Companies', href: 'admin.companies.index', icon: CubeIcon, current: route().current('admin.companies.index') },
    { name: 'Jobs', href: 'admin.jobs.index', icon: AcademicCapIcon, current: route().current('admin.jobs.index') },
    { name: 'Resumes', href: 'admin.resumes.index', icon: AcademicCapIcon, current: route().current('admin.resumes.index') },
    { name: 'Applies', href: 'admin.applicants.index', icon: AcademicCapIcon, current: route().current('admin.applicants.index') },
    { name: 'Telescope', href: 'telescope', icon: DocumentSearchIcon, current: false },
]

export const userNavigation = [
    { name: 'Your Profile', href: route('profile.show') },
    { name: 'API Tokens', href: route('api-tokens.index') },
    { name: 'Settings', href: '#' },
]
