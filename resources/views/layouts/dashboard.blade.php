<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RMSys - Dashboard</title>

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
        // Configure Tailwind to enable dark mode based on the 'dark' class
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Custom scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px; /* For horizontal scrollbars */
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
        /* Firefox scrollbar support */
        * {
            scrollbar-width: thin;
            scrollbar-color: theme('colors.indigo.400') theme('colors.gray.100');
        }
        html.dark * {
            scrollbar-color: theme('colors.indigo.600') theme('colors.gray.800');
        }


        /* General transition and shadow for stat cards (kept from your original dashboard CSS) */
        .stat-card { transition: all 0.3s ease-in-out; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.15); }

        /* Sidebar link styling (kept from your original dashboard CSS, but note the active state will be handled by JS) */
        .sidebar-link.active { background-color: rgba(255, 255, 255, 0.1); color: #f0f9ff; }
        .sidebar-link:hover { background-color: rgba(255, 255, 255, 0.05); }

        /* Google Sheets Card specific styles (kept from your original dashboard CSS) */
        .sheet-card {
            background-color: #ffffff; /* white */
            border: 1px solid #e2e8f0; /* gray-200 */
            transition: all 0.3s ease;
            border-radius: 0.75rem; /* rounded-xl */
            padding: 1.25rem;
            display: flex;
            align-items: flex-start; /* Align items to the top for better title display */
            gap: 1rem;
            color: #1a202c; /* gray-900 */
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            position: relative;
        }

        .dark .sheet-card {
            background-color: #2d3748; /* gray-800 */
            border-color: #4a5568; /* gray-600 */
            color: #e2e8f0; /* gray-200 */
        }

        .sheet-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .dark .sheet-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .sheet-card i.fa-file-excel {
            font-size: 2.25rem; /* Larger icon */
            color: #107a41; /* Google Sheets green */
        }
        .dark .sheet-card i.fa-file-excel {
            color: #34d399; /* light green for dark mode */
        }

        .sheet-card .sheet-info {
            flex-grow: 1;
            overflow: hidden; /* Ensures text truncation works */
            cursor: pointer; /* Indicates it's clickable */
        }
        .sheet-card .sheet-info h3 {
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            margin-bottom: 0.25rem;
            font-size: 1.125rem; /* text-lg */
        }
        .sheet-card .sheet-info p {
            font-size: 0.875rem; /* text-sm */
            opacity: 0.85;
            word-break: break-all; /* Allow breaking long URLs */
            white-space: normal; /* Allow URL to wrap */
        }
        .sheet-card button.remove-btn {
            background: transparent;
            border: none;
            color: #ef4444; /* red-500 */
            font-size: 1.25rem;
            cursor: pointer;
            transition: color 0.2s ease;
            align-self: flex-start; /* Align to the top of the card */
            padding: 0.25rem; /* Add some padding for easier clicking */
        }
        .sheet-card button.remove-btn:hover {
            color: #b91c1c; /* red-700 */
        }

        /* Improved Add Button Styles (kept from your original dashboard CSS) */
        button[type="submit"] {
            @apply bg-indigo-600 text-white font-semibold rounded-md px-6 py-2 shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            user-select: none;
            border: none;
            /* subtle shadow */
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.4);
        }
        button[type="submit"]:hover {
            background-color: #4338ca; /* darker indigo */
            box-shadow: 0 6px 12px rgba(67, 56, 202, 0.6);
            transform: translateY(-2px);
        }
        button[type="submit"]:active {
            background-color: #3730a3;
            box-shadow: 0 2px 4px rgba(55, 48, 163, 0.8);
            transform: translateY(0);
        }
        button[type="submit"]:focus-visible {
            outline: 3px solid #a5b4fc;
            outline-offset: 2px;
        }
        button[type="submit"] i {
            font-size: 1.125rem;
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
                        src="https://i.ibb.co/whXMHLFg/Philippine-Statistics-Authority-svg.png"
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
        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="{{ route('home') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                bg-indigo-700 text-white shadow-md" aria-current="{{ Request::routeIs('home') ? 'page' : 'false' }}">
                <i class="fas fa-tachometer-alt mr-3 text-lg"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('advisory.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('advisory.*') ? 'page' : 'false' }}">
                <i class="fas fa-bullhorn mr-3 text-lg"></i><span>Advisory</span>
            </a>
            <a href="{{ route('memorandum.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('memorandum.*') ? 'page' : 'false' }}">
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

    <main class="flex-1 ml-0 lg:ml-64 p-6 overflow-y-auto space-y-6">
        <section aria-label="Current Date and Time" class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-2xl font-semibold">Dashboard</h2>
                <p id="dateDisplay" class="text-gray-600 dark:text-gray-400"></p>
            </div>
            <div id="clockDisplay" class="text-xl font-mono"></div>
        </section>

        <section aria-labelledby="quick-actions-header" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h3 id="quick-actions-header" class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-yellow-500"></i>
            Quick Actions
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('advisory.create') }}" class="stat-card flex items-center justify-center gap-3 rounded-lg bg-indigo-600 text-white p-4 shadow-md hover:bg-indigo-700 transition">
                    <i class="fas fa-exclamation-circle fa-2x"></i>
                    <span>Add Advisory</span>
                </a>
                <a href="{{ route('memorandum.create') }}" class="stat-card flex items-center justify-center gap-3 rounded-lg bg-green-600 text-white p-4 shadow-md hover:bg-green-700 transition">
                    <i class="fas fa-file-signature fa-2x"></i>
                    <span>Add Memorandum</span>
                </a>
                <a href="{{ route('specialorder.create') }}" class="stat-card flex items-center justify-center gap-3 rounded-lg bg-purple-600 text-white p-4 shadow-md hover:bg-purple-700 transition">
                    <i class="fas fa-folder-plus fa-2x"></i>
                    <span>Add Special Order</span>
                </a>
                <a href="{{ route('weeklymailing.create') }}" class="stat-card flex items-center justify-center gap-3 rounded-lg bg-pink-600 text-white p-4 shadow-md hover:bg-pink-700 transition">
                    <i class="fas fa-envelope fa-2x"></i>
                    <span>Add Weekly Mailing</span>
                </a>
            </div>
        </section>

        <section aria-labelledby="gsheets-header" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h3 id="gsheets-header" class="text-xl font-semibold mb-4">
            <i class="fas fa-table text-green-500 mr-2"></i> Google Sheets Pinner
            </h3>

        <form id="sheetForm" class="mb-6" aria-describedby="formHelp">
            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                    <label for="sheetName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sheet Name</label>
                    <input type="text" id="sheetName" name="sheetName" aria-describedby="nameError"
                            class="w-full rounded-md border border-gray-200 bg-gray-50 text-gray-800 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required />
                    <p id="nameError" class="text-red-600 text-sm mt-1 hidden">Sheet name is required.</p>
                </div>
                <div class="flex-1 flex flex-col">
                    <label for="sheetURL" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sheet URL</label>
                    <div class="flex space-x-2 items-center">
                        <input type="url" id="sheetURL" name="sheetURL" aria-describedby="urlError urlDuplicateError"
                                class="w-full rounded-md border border-gray-200 bg-gray-50 text-gray-800 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required />
                        <button
                            type="submit"
                            id="addSheetButton"
                            class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 transition"
                            disabled
                            aria-label="Add Sheet"
                        >
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <p id="urlError" class="text-red-600 text-sm mt-1 hidden">Please enter a valid Google Sheets URL.</p>
                    <p id="urlDuplicateError" class="text-red-600 text-sm mt-1 hidden">This Google Sheet is already pinned.</p>
                </div>
            </div>
        </form>

            <div id="pinnedSheets" aria-live="polite" aria-atomic="true" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"></div>
        </section>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Theme Toggle Functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileDarkModeToggle = document.getElementById('mobileDarkModeToggle');
        const desktopDarkModeToggle = document.getElementById('desktopDarkModeToggle');
        const sidebar = document.getElementById('sidebar');

        // Function to toggle sidebar visibility
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('flex'); // Ensure it becomes flex when shown
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

        // Date and clock display (kept from your original dashboard JS)
        function updateDateTime() {
            const dateDisplay = document.getElementById('dateDisplay');
            const clockDisplay = document.getElementById('clockDisplay');

            const now = new Date();

            // Format date (e.g., Monday, May 26, 2025)
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateDisplay.textContent = now.toLocaleDateString(undefined, options);

            // Format time (HH:MM:SS AM/PM)
            clockDisplay.textContent = now.toLocaleTimeString();
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();


        // Google Sheets Pinner Script (kept from your original dashboard JS)
        const sheetForm = document.getElementById('sheetForm');
        const sheetNameInput = document.getElementById('sheetName');
        const sheetURLInput = document.getElementById('sheetURL');
        const addButton = document.getElementById('addSheetButton');
        const pinnedSheetsContainer = document.getElementById('pinnedSheets');
        const nameError = document.getElementById('nameError');
        const urlError = document.getElementById('urlError');
        const urlDuplicateError = document.getElementById('urlDuplicateError');

        // Retrieve pinned sheets from localStorage or initialize empty array
        let pinnedSheets = JSON.parse(localStorage.getItem('pinnedSheets')) || [];

        function isValidSheetUrl(url) {
            const pattern = /^https:\/\/docs\.google\.com\/spreadsheets\/d\/([a-zA-Z0-9-_]+)(\/.*)?$/;
            return pattern.test(url);
        }

        function renderPinnedSheets() {
            pinnedSheetsContainer.innerHTML = '';
            if (pinnedSheets.length === 0) {
                pinnedSheetsContainer.innerHTML = '<p class="text-gray-500 dark:text-gray-400">No pinned Google Sheets yet.</p>';
                return;
            }

            pinnedSheets.forEach(({ name, url }, index) => {
                const card = document.createElement('div');
                card.className = 'sheet-card';

                card.innerHTML = `
                    <i class="fas fa-file-excel" aria-hidden="true"></i>
                    <div class="sheet-info" tabindex="0" role="link" aria-label="Open ${name} Google Sheet" onclick="window.open('${url}', '_blank')" onkeypress="if(event.key==='Enter') window.open('${url}', '_blank')">
                        <h3>${name}</h3>
                        <p title="${url}">${url}</p>
                    </div>
                    <button class="remove-btn" aria-label="Remove ${name} Google Sheet" data-index="${index}"><i class="fas fa-trash-alt"></i></button>
                `;

                pinnedSheetsContainer.appendChild(card);
            });

            // Add event listeners to remove buttons
            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const idx = parseInt(e.currentTarget.dataset.index, 10);
                    pinnedSheets.splice(idx, 1);
                    localStorage.setItem('pinnedSheets', JSON.stringify(pinnedSheets));
                    renderPinnedSheets();
                    validateForm(); // re-validate form in case removed duplicate URL
                });
            });
        }

        function validateForm() {
            const name = sheetNameInput.value.trim();
            const url = sheetURLInput.value.trim();

            let valid = true;

            if (!name) {
                nameError.style.display = 'block';
                valid = false;
            } else {
                nameError.style.display = 'none';
            }

            if (!url || !isValidSheetUrl(url)) {
                urlError.style.display = 'block';
                valid = false;
            } else {
                urlError.style.display = 'none';
            }

            if (pinnedSheets.some(sheet => sheet.url === url)) {
                urlDuplicateError.style.display = 'block';
                valid = false;
            } else {
                urlDuplicateError.style.display = 'none';
            }

            addButton.disabled = !valid;

            return valid;
        }

        sheetNameInput.addEventListener('input', validateForm);
        sheetURLInput.addEventListener('input', validateForm);

        sheetForm.addEventListener('submit', (e) => {
            e.preventDefault();

            if (!validateForm()) return;

            const name = sheetNameInput.value.trim();
            const url = sheetURLInput.value.trim();

            pinnedSheets.push({ name, url });
            localStorage.setItem('pinnedSheets', JSON.stringify(pinnedSheets));

            renderPinnedSheets();

            sheetNameInput.value = '';
            sheetURLInput.value = '';
            addButton.disabled = true;
            sheetNameInput.focus();
        });

        // Initial render
        renderPinnedSheets();
        validateForm();
    });
</script>

</body>
</html>