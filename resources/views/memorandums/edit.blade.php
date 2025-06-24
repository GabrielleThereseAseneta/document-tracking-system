<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RMSys - Edit Memorandum #{{ $memorandum->id }}</title>

    <link rel="icon" href="https://i.ibb.co/whXMHLFg/Philippine-Statistics-Authority-svg.png" type="image/png">

    <script>
        // Check for theme in localStorage or system preference immediately
        const isDark = localStorage.getItem('theme') === 'dark' ||
                        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Tailwind CSS configuration (now consistent with Advisory)
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'], // Apply Inter font globally
                    },
                    colors: {
                        indigo: {
                            50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc', 400: '#818cf8',
                            500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81', 950: '#1e1b4b',
                        },
                        'gray-850': '#1a202c', // A warmer gray for better contrast in dark mode
                    }
                }
            }
        };
    </script>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    <style>
        /* Custom scrollbar for better aesthetics (now consistent with Advisory) */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: theme('colors.gray.100');
            border-radius: 10px;
        }
        html.dark ::-webkit-scrollbar-track {
            background: theme('colors.gray.800');
        }

        ::-webkit-scrollbar-thumb {
            background: theme('colors.indigo.400');
            border-radius: 10px;
        }
        html.dark ::-webkit-scrollbar-thumb {
            background: theme('colors.indigo.600');
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 dark:text-gray-200 font-sans antialiased">

<header
    class="lg:hidden flex justify-between items-center p-4 bg-gray-800 text-white sticky top-0 z-20 shadow-md"
    role="banner"
>
    <button id="mobileMenuButton" class="focus:outline-none p-2 -ml-2 rounded-md hover:bg-gray-700" aria-label="Toggle Sidebar">
        <i class="fas fa-bars text-xl"></i>
    </button>
    <h1 class="text-lg font-semibold tracking-wide">RMSys</h1>
    <button id="mobileDarkModeToggle" class="focus:outline-none p-2 -mr-2 rounded-md hover:bg-gray-700" aria-label="Toggle Dark Mode">
        <i id="darkModeIcon" class="fas text-xl transition-transform"></i>
    </button>
</header>

<div class="flex h-screen">
    <aside
        id="sidebar"
        class="w-64 bg-gray-800 text-gray-300 flex-col hidden lg:flex fixed h-full z-10 shadow-lg overflow-y-auto transform transition-transform duration-300 ease-in-out"
        role="navigation"
        aria-label="Main Navigation"
    >
        <div class="px-4 py-5 border-b border-gray-700 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center hover:opacity-90 transition-opacity" aria-label="Go to Dashboard">
                <div
                    class="bg-white p-1.5 rounded-full mr-3 flex items-center justify-center shadow-sm"
                    style="min-height: 48px; min-width: 48px;"
                >
                    <img
                        src="https://i.ibb.co/whXMHLFg/Philippine-Statistics-Authority-svg.png" {{-- Updated logo path if necessary --}}
                        alt="RMSys Logo"
                        class="h-10 w-10 object-contain"
                    />
                </div>
                <h2 class="text-xl font-bold text-white tracking-tight">RMSys</h2>
            </a>
            <button id="desktopDarkModeToggle" class="focus:outline-none p-2 rounded-md hover:bg-gray-700 hidden lg:block" aria-label="Toggle Dark Mode">
                <i id="darkModeIconSidebar" class="fas text-lg transition-transform"></i>
            </button>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1"> {{-- Adjusted padding for consistency --}}
            <a href="{{ route('home') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('home') ? 'page' : 'false' }}">
                <i class="fas fa-tachometer-alt mr-3 text-lg"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('advisory.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('advisory.*') ? 'page' : 'false' }}">
                <i class="fas fa-bullhorn mr-3 text-lg"></i><span>Advisory</span>
            </a>
            <a href="{{ route('memorandum.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                bg-indigo-700 text-white shadow-md" aria-current="{{ Request::routeIs('memorandum.*') ? 'page' : 'false' }}"> {{-- Added shadow-md --}}
                <i class="fas fa-file-alt mr-3 text-lg"></i><span>Memorandum</span>
            </a>
            <a href="{{ route('specialorder.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('specialorder.*') ? 'page' : 'false' }}">
                <i class="fas fa-folder-open mr-3 text-lg"></i><span>Special Order</span>
            </a>
            <a href="{{ route('weeklymailing.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('weeklymailing.*') ? 'page' : 'false' }}">
                <i class="fas fa-envelope-open-text mr-3 text-lg"></i><span>Weekly Mailing</span>
            </a>
        </nav>
        <footer class="p-4 border-t border-gray-700 text-xs mt-auto">
            <div class="text-gray-400 dark:text-gray-500">
                <p class="mb-0.5">&copy; {{ date('Y') }} Philippine Statistical Authority (PSA).</p>
                <p class="mb-1">All rights reserved.</p>
            </div>
            <address class="not-italic mt-2 mb-1 text-gray-400 dark:text-gray-500">
                Contact: <a
                    href="https://mail.google.com/mail/?view=cm&fs=1&to=euniceaseneta@gmail.com&su=Support%20Request%20from%20Records%20Management%20Section&body=Dear%20RMS%20IT%20Support,%0A%0AI%20hope%20this%20email%20finds%20you%20well.%0A%0A[Please%20describe%20your%20issue%20here]%0A%0AThank%20you,"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="underline text-indigo-300 hover:text-indigo-400 transition-colors duration-200"
                    title="Click to email RMS IT Support (opens Gmail in new tab)"
                >
                    RMS IT Support
                </a>
            </address>
            <div class="mt-2 text-gray-500 dark:text-gray-600">
                <p>Version: 1.0.0</p>
            </div>
        </footer>
    </aside>

    <div class="flex flex-col flex-grow lg:ml-64 bg-gray-50 dark:bg-gray-900">
        <main class="flex-1 flex items-center justify-center p-6 md:p-8 text-gray-800 dark:text-gray-200">
            <div class="w-full max-w-3xl bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Memorandum #{{ $memorandum->id }}</h1> {{-- Consistent title styling --}}

                @if($errors->any())
                    <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg mb-6" role="alert"> {{-- Consistent error styling --}}
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('memorandum.update', $memorandum->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6"> {{-- Adjusted to be consistent with Advisory's primary layout --}}
                        <div>
                            <label for="memo_number" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Memorandum Number</label>
                            <input type="text" id="memo_number" name="memo_number" value="{{ old('memo_number', $memorandum->memo_number) }}" required
                                class="w-full px-5 py-2.5 text-sm rounded-md border dark:border-gray-600 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $memorandum->name) }}" required
                                class="w-full px-5 py-2.5 text-sm rounded-md border dark:border-gray-600 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label for="title_description" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Title / Description</label>
                            <input type="text" id="title_description" name="title_description" value="{{ old('title_description', $memorandum->title_description) }}" required
                                class="w-full px-5 py-2.5 text-sm rounded-md border dark:border-gray-600 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> {{-- Dates now in a two-column grid like Advisory --}}
                            <div>
                                <label for="memo_date" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Memorandum Date</label>
                                <input type="date" id="memo_date" name="memo_date" value="{{ old('memo_date', $memorandum->memo_date) }}" required
                                    class="w-full px-5 py-2.5 text-sm rounded-md border dark:border-gray-600 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="date_received" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Date Received</label>
                                <input type="date" id="date_received" name="date_received" value="{{ old('date_received', $memorandum->date_received) }}" required
                                    class="w-full px-5 py-2.5 text-sm rounded-md border dark:border-gray-600 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-md shadow-md inline-flex items-center transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> {{-- Consistent button styling --}}
                            <i class="fas fa-save mr-2"></i> <span>Update</span>
                        </button>
                        <button type="button" onclick="history.back()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 text-sm px-4 py-2 rounded-md shadow-md inline-flex items-center transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"> {{-- Consistent button styling --}}
                            <i class="fas fa-times mr-2"></i> <span>Cancel</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Theme Toggle Functionality (Now unified with Advisory)
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileDarkModeToggle = document.getElementById('mobileDarkModeToggle');
        const desktopDarkModeToggle = document.getElementById('desktopDarkModeToggle');
        const sidebar = document.getElementById('sidebar');

        // Function to toggle sidebar visibility
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('flex');
            });
        }

        // Function to update dark mode icon based on current theme
        function updateDarkModeIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            if (mobileDarkModeToggle) {
                mobileDarkModeToggle.querySelector('i').className = isDark ? 'fas fa-sun text-yellow-400' : 'fas fa-moon text-white';
            }
            if (desktopDarkModeToggle) {
                desktopDarkModeToggle.querySelector('i').className = isDark ? 'fas fa-sun text-yellow-400' : 'fas fa-moon text-gray-300';
            }
        }

        // Function to toggle dark mode
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
            updateDarkModeIcon();
        }

        // Attach event listeners for dark mode toggles
        if (mobileDarkModeToggle) {
            mobileDarkModeToggle.addEventListener('click', toggleDarkMode);
        }
        if (desktopDarkModeToggle) {
            desktopDarkModeToggle.addEventListener('click', toggleDarkMode);
        }

        // Initial icon update on page load
        updateDarkModeIcon();

        // Gmail Link functionality (now unified with Advisory)
        document.getElementById('gmailLink')?.addEventListener('click', function (e) {
            e.preventDefault();
            const email = 'euniceaseneta@gmail.com';
            const subject = encodeURIComponent('Support Request from Records Management Section');
            const body = encodeURIComponent('Dear RMS IT Support,\n\nI hope this email finds you well.\n\n[Please describe your issue here]\n\nThank you,');
            window.open(`https://mail.google.com/mail/?view=cm&fs=1&to=${email}&su=${subject}&body=${body}`, '_blank');
        });

        // The searchInput logic was not present in the Advisory edit page and seems unrelated to editing,
        // so it has been removed for consistency and to simplify the script.
    });
</script>

</body>
</html>