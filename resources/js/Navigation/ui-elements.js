import {ShieldCheckIcon, MapIcon, IdentificationIcon, LightningBoltIcon, AcademicCapIcon, DocumentSearchIcon, SparklesIcon, ShareIcon, FolderIcon, HomeIcon, UsersIcon, GlobeIcon, CubeIcon, ViewGridAddIcon} from "@heroicons/vue/outline";

export const navigation = [
    { name: 'Dashboard', href: 'admin.dashboard.index', icon: HomeIcon, current: route().current('admin.dashboard.index'), permission: 'access_dashboard' },
    { name: 'Users', href: 'admin.users.index', icon: UsersIcon, current: route().current('admin.users.index'), permission: 'browse_users' },
    { name: 'Roles & Permissions', href: 'admin.roles.index', icon: ShieldCheckIcon, current: route().current('admin.roles.index'), permission: 'browse_roles' },
    { name: 'Teams', href: 'admin.teams.index', icon: ViewGridAddIcon, current: route().current('admin.teams.index'), permission: 'browse_teams' },
    { name: 'Categories', href: 'admin.categories.index', icon: ShareIcon, current: route().current('admin.categories.index'), permission: 'browse_categories' },
    { name: 'Countries', href: 'admin.countries.index', icon: GlobeIcon, current: route().current('admin.countries.index'), permission: 'browse_countries' },
    { name: 'Divisions', href: 'admin.divisions.index', icon: SparklesIcon, current: route().current('admin.divisions.index'), permission: 'browse_countries' },
    { name: 'Cities', href: 'admin.cities.index', icon: MapIcon, current: route().current('admin.cities.index'), permission: 'browse_countries' },
    { name: 'Companies', href: 'admin.companies.index', icon: CubeIcon, current: route().current('admin.companies.index'), permission: 'browse_companies' },
    { name: 'Jobs', href: 'admin.jobs.index', icon: AcademicCapIcon, current: route().current('admin.jobs.index'), permission: 'browse_jobs' },
    { name: 'Resumes', href: 'admin.resumes.index', icon: IdentificationIcon, current: route().current('admin.resumes.index'), permission: 'browse_resumes' },
    { name: 'Applied Jobs', href: 'admin.applicants.index', icon: LightningBoltIcon, current: route().current('admin.applicants.index'), permission: 'browse_applicants' },
    { name: 'Telescope', href: 'telescope', icon: DocumentSearchIcon, current: false, permission: 'log_viewer' },
]

export const userNavigation = [
    { name: 'Your Profile', href: route('profile.show') },
    { name: 'API Tokens', href: route('api-tokens.index') },
    { name: 'Settings', href: '#' },
]
