<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RMSys - Advisory</title>

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
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        indigo: {
                            50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc', 400: '#818cf8',
                            500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81', 950: '#1e1b4b',
                        },
                        'gray-850': '#1a202c',
                    }
                }
            }
        };
    </script>

    <style>
        /* Hide the default DataTables search box if 'f' is still in dom string.
           However, we remove 'f' from dom, so this might not be strictly needed,
           but keeping it doesn't hurt. */
        .dataTables_filter {
            display: none !important;
        }

        /* Hide the actual DataTables buttons, but keep them functional for programmatic clicks */
        .dt-button.hidden-button {
            display: none !important;
        }

        /* Customizing DataTables pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
                @apply px-2.5 py-1 text-xs rounded-md mx-1;
                background-color: #ffffff; /* Light mode background */
                color: #4b5563; /* Light mode gray-700 text */
                border: 1px solid #d1d5db; /* Light mode gray-300 border */
                min-width: 30px;
                height: 30px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                line-height: 1;
                box-sizing: border-box;
                transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
                text-decoration: none; /* Ensure no underline */
        }

        /* Dark mode overrides for pagination buttons */
        html.dark .dataTables_wrapper .dataTables_paginate .paginate_button {
                    background-color: #374151; /* Dark mode gray-700 background */
                    color: #d1d5db; /* Dark mode gray-300 text */
                    border-color: #4b5563; /* Dark mode gray-600 border */
                }

        /* Hover state for pagination buttons (excluding the current page) */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background-color: #f3f4f6; /* Light mode hover (gray-100) */
        }
        html.dark .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
                    background-color: #4b5563; /* Dark mode hover (gray-600) */
                }

        /* Styling for the current page number button */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #4f46e5; /* Active background (indigo-600) */
            color: #ffffff; /* Active text color */
            border-color: #4f46e5; /* Active border color */
            pointer-events: none; /* Make the current page unclickable */
        }

        /* Styling for disabled pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            /* Ensure disabled buttons also get dark mode styling */
            background-color: #e5e7eb; /* Light mode */
            border-color: #e5e7eb; /* Light mode */
        }
        html.dark .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
                    background-color: #4b5563; /* Dark mode */
                    border-color: #4b5563; /* Dark mode */
                }

        /* Specific styling for Previous and Next buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next,
        .dataTables_wrapper .dataTables_paginate .paginate_button.first, /* ADDED */
        .dataTables_wrapper .dataTables_paginate .paginate_button.last {  /* ADDED */
            font-size: 0; /* Hide text, only show icon */
            position: relative; /* For absolute positioning of icon */
            padding-left: 0; /* Remove default padding from text */
            padding-right: 0; /* Remove default padding from text */
            width: 30px; /* Fixed width for icon buttons */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous::before {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            content: "\f053"; /* fa-chevron-left */
            font-size: 0.8rem; /* Icon size - slightly smaller for better fit */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.next::after {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            content: "\f054"; /* fa-chevron-right */
            font-size: 0.8rem; /* Icon size - slightly smaller for better fit */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* ADDED: Icons for First and Last buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button.first::before {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            content: "\f100"; /* fa-backward (double left arrow) */
            font-size: 0.8rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.last::after {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            content: "\f101"; /* fa-forward (double right arrow) */
            font-size: 0.8rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Customizing DataTables info text */
        .dataTables_wrapper .dataTables_info {
            @apply text-gray-600 dark:text-gray-400 text-sm mb-2 md:mb-0; /* Apply Tailwind classes directly */
        }

        /* Custom scrollbar for better aesthetics */
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

        /* Additional style to ensure DataTable wrappers also respect dark mode */
        .dataTables_wrapper {
            @apply text-gray-700 dark:text-gray-200;
        }

        /* Print styles */
        @media print {
            /* Hide interactive elements and UI components not relevant for print */
            .no-print,
            .modal,
            #mobileMenuButton,
            #mobileDarkModeToggle,
            #desktopDarkModeToggle,
            #sidebar,
            header,
            /* DataTables specific controls */
            .dt-buttons,
            .dataTables_length,
            .dataTables_filter,
            .dataTables_info,
            .dataTables_paginate,
            /* Custom search and date filters */
            #searchInput,
            #minDate,
            #maxDate,
            .flex-wrap.items-center.gap-3.justify-start.w-full,
            /* Action buttons */
            #newAdvisoryButton,
            #customExportButton,
            #customExportDropdown {
                display: none !important;
            }

            /* Reset body and main container styles for print layout */
            body {
                background-color: #fff !important;
                color: #000 !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            main {
                margin-left: 0 !important;
                padding: 20px !important;
                box-shadow: none !important;
                width: auto !important;
            }
            /* Remove backgrounds/shadows that interfere with print */
            .bg-white, .dark\:bg-gray-800 {
                background-color: transparent !important;
            }
            .rounded-lg, .shadow-xl {
                border-radius: 0 !important;
                box-shadow: none !important;
            }

            /* Table specific print styles for readability */
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                margin-top: 20px !important;
            }
            th, td {
                border: 1px solid #ccc !important;
                padding: 8px !important;
                color: #000 !important;
            }
            thead {
                background-color: #f2f2f2 !important;
            }
            /* Striped rows for better readability in print */
            #advisoryTable tbody tr:nth-child(even) {
                background-color: #f8f8f8 !important;
            }
            #advisoryTable tbody tr {
                background-color: #fff !important;
            }

            /* Print header for context on the printed page */
            .print-header {
                text-align: center;
                margin-bottom: 20px;
                color: #000 !important;
            }
            .print-header h1 {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 5px;
                line-height: 1.2;
            }
            .print-header p {
                font-size: 16px;
                margin-bottom: 3px;
                line-height: 1.2;
            }
            .print-header .date-generated {
                font-size: 14px;
                margin-top: 10px;
            }
        }

        /* Flexbox for the info and paginate elements for consistent spacing and alignment */
        .dataTables_wrapper .dataTables_info {
            flex-grow: 1; /* Allow info to take up available space */
            text-align: left; /* Align info to the left */
        }

        .dataTables_wrapper .dataTables_paginate {
            display: flex; /* Use flexbox for pagination buttons */
            align-items: center; /* Vertically align buttons */
            gap: 0.25rem; /* Small gap between buttons */
            justify-content: flex-end; /* Align pagination to the right */
        }

        /* Override specific DataTables pagination classes to integrate better with Tailwind */
        .dataTables_wrapper .dataTables_paginate .ellipsis {
            @apply px-2.5 py-1 text-xs rounded-md mx-1 text-gray-500 dark:text-gray-400;
        }

        /* Custom styling for the length dropdown */
        .dataTables_length select {
            @apply px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200;
            display: inline-block; /* Ensure it behaves like a block element for sizing */
            width: auto; /* Allow content to determine width */
            vertical-align: middle; /* Align with text */
        }

        .dataTables_length label {
            @apply text-gray-700 dark:text-gray-300 text-sm font-medium mr-2;
        }

        /* Styles for the overall top section generated by DataTables DOM */
        .dataTables_wrapper .dt-top {
        @apply flex flex-col sm:flex-row items-center justify-between py-4; /* Add padding, flex for alignment */
        /* Flex-col for smaller screens, flex-row for larger */
        }

        /* Styles for the group containing 'Show entries' and 'Buttons' */
        .dataTables_wrapper .dt-length-buttons {
            @apply flex items-center gap-4 mb-4 sm:mb-0; /* Adjust gap and margin for responsiveness */
        }

        /* Styles for the overall bottom section generated by DataTables DOM */
        .dataTables_wrapper .dt-bottom {
            @apply flex flex-col sm:flex-row items-center justify-between py-4; /* Add padding, flex for alignment */
        }

        /* Styles for the table information text */
        .dataTables_wrapper .dt-info-text {
            @apply mb-4 sm:mb-0; /* Margin for mobile vs desktop alignment */
        }

        /* Styles for the pagination controls */
        .dataTables_wrapper .dt-pagination-controls {
            /* No specific changes needed here if your .dataTables_paginate styles are already good */
            /* They will now be contained within this div */
        }

        /* Ensure .dataTables_length (Show entries) and .dt-buttons are also styled correctly */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dt-buttons {
            /* Your existing padding: 1rem 0; and dark:text-gray-300 should still apply. */
            /* If you want less vertical padding for these specific elements within their new container,
            you might adjust here, e.g., padding: 0.5rem 0; */
        }

        /* DataTables Custom Layout Classes - these are now the classes for the divs generated by `dom` */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate,
        .dataTables_wrapper .dt-buttons { /* Include dt-buttons here for consistent padding */
            padding: 1rem 0; /* Add consistent padding around DataTables controls */
            @apply dark:text-gray-300;
        }

        /* Adjustments for button container in flex layout */
        /* These are now applied to the classes used in the dom string */
        .dt-top-left {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem; /* Gap between length and buttons */
            align-items: center;
        }

        .dt-top-right {
             margin-left: auto; /* Pushes search to the right */
        }

        /* Ensure input and button sizes are consistent */
        .dataTables_length select,
        #searchInput,
        #minDate,
        #maxDate {
            height: 42px; /* Standardize height with buttons */
        }

        /* Align custom buttons with other form elements */
        .flex-wrap > div {
            align-items: center;
        }

        /* Styles for the print selection modal (if still used - not in this current setup) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto; /* Centered */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            @apply dark:bg-gray-800 dark:text-gray-200;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            @apply dark:border-gray-600;
        }

        .modal-header h2 {
            @apply text-xl font-bold;
        }

        .modal-close-button {
            @apply text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-body .column-checkbox-item {
            @apply flex items-center mb-2;
        }

        .modal-body .column-checkbox-item input {
            @apply mr-2;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .modal-footer button {
            @apply px-4 py-2 rounded-md font-medium transition-colors duration-200;
        }

        .modal-footer button:first-child {
            @apply bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-gray-200;
            margin-right: 10px;
        }

        .modal-footer button:last-child {
            @apply bg-indigo-600 hover:bg-indigo-700 text-white;
        }

        /* Enhanced table styles */
        #advisoryTable thead th {
            border-bottom: 2px solid theme('colors.indigo.500'); /* Stronger accent border */
            @apply dark:border-indigo-600;
        }

        #advisoryTable tbody tr {
            border-bottom: 1px solid theme('colors.gray.200');
            @apply dark:border-gray-700;
        }

        #advisoryTable tbody tr:last-child {
            border-bottom: none; /* No border for the last row */
        }

        #advisoryTable tbody td {
            padding: 12px 16px; /* Slightly more vertical padding for spaciousness */
        }

        /* Striped rows for better readability */
        #advisoryTable tbody tr:nth-child(even) {
            @apply bg-gray-50 dark:bg-gray-850; /* A slightly darker background for even rows */
        }

        #advisoryTable tbody tr:hover {
            @apply bg-indigo-50 dark:bg-indigo-950; /* Subtle highlight on hover */
            cursor: pointer;
        }

        /* Action buttons in table */
        #advisoryTable td .inline-flex {
            @apply items-center justify-center; /* Center actions if needed */
        }
        #advisoryTable td .inline-flex > * {
            margin-left: 0.5rem;
            margin-right: 0.5rem;
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
                    hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('home') ? 'page' : 'false' }}">
                    <i class="fas fa-tachometer-alt mr-3 text-lg" aria-hidden="true"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('advisory.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                    bg-indigo-700 text-white shadow-md" aria-current="{{ Request::routeIs('advisory.index') ? 'page' : 'false' }}">
                    <i class="fas fa-bullhorn mr-3 text-lg" aria-hidden="true"></i><span>Advisory</span>
                </a>
                <a href="{{ route('memorandum.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                    hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('memorandum.index') ? 'page' : 'false' }}">
                    <i class="fas fa-file-alt mr-3 text-lg" aria-hidden="true"></i><span>Memorandum</span>
                </a>
                <a href="{{ route('specialorder.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                    hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('specialorder.index') ? 'page' : 'false' }}">
                    <i class="fas fa-folder-open mr-3 text-lg"aria-hidden="true"></i><span>Special Order</span>
                </a>
                <a href="{{ route('weeklymailing.index') }}" class="sidebar-link block px-4 py-2 text-sm font-medium rounded-md flex items-center transition-colors duration-200
                    hover:bg-gray-700 hover:text-white" aria-current="{{ Request::routeIs('weeklymailing.index') ? 'page' : 'false' }}">
                    <i class="fas fa-envelope-open-text mr-3 text-lg"aria-hidden="true"></i><span>Weekly Mailing</span>
                </a>
            </nav>
            <footer class="p-4 border-t border-gray-700 text-xs mt-auto">
                <div class="text-gray-400 dark:text-gray-500">
                    <p class="mb-0.5">&copy; {{ date('Y') }} Philippine Statistical Authority (PSA).</p>
                    <p class="mb-1">All rights reserved.</p>
                </div>
                <address class="not-italic mt-2 mb-1 text-gray-400 dark:text-gray-500">
                    Contact: <a
                        href="https://mail.google.com/mail/?view=cm&fs=1&to=euniceaseneta@gmail.com&su=Support%20Request%20from%20Records%20Management%20Section&body=Dear%20RMS%20IT%20Support,%0A%0AI%20hope%20this%20email%20finds%20you%20well.%0A%0A[Please%20describe%20your%20issue%20here]%0A%0AThank%20you."
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

        <main class="flex-1
                    ml-0 lg:ml-64
                    overflow-y-auto
                    p-6 md:p-8
                    bg-gray-50 dark:bg-gray-900
                    text-gray-800 dark:text-gray-200">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
                <div class="flex flex-col gap-4 mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Advisory</h1>
                    <div class="flex flex-wrap items-center gap-3 justify-start w-full">
                        <div class="relative w-full md:w-auto flex-grow">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                                <span class="fas fa-search text-sm" aria-hidden="true"></span>
                            </div>
                            <input
                                id="searchInput"
                                type="text"
                                placeholder="Search advisories..."
                                class="pl-10 pr-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:outline-none w-full transition-all duration-200"
                                aria-label="Search advisories"
                            />
                        </div>

                        <div class="flex items-center space-x-2 flex-wrap gap-2">
                            <label for="minDate" class="text-gray-700 dark:text-gray-300 text-sm font-medium">From:</label>
                            <input
                                type="date"
                                id="minDate"
                                class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                aria-label="Minimum date for filter"
                            />
                            <label for="maxDate" class="text-gray-700 dark:text-gray-300 text-sm font-medium">To:</label>
                            <input
                                type="date"
                                id="maxDate"
                                class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                aria-label="Maximum date for filter"
                            />
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 justify-end w-full">
                        <a
                            href="{{ route('advisory.create') }}"
                            id="newAdvisoryButton"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white w-10 h-10 rounded-md shadow-md inline-flex items-center justify-center flex-shrink-0 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            aria-label="Add New Advisory"
                            title="Add New Advisory"
                        >
                            <i class="fas fa-plus text-lg" aria-hidden="true"></i>
                        </a>

                        <div class="relative inline-block text-left">
                            <button
                                type="button"
                                id="customExportButton"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                                aria-haspopup="true"
                                aria-expanded="false"
                                aria-controls="customExportDropdown"
                            >
                                <i class="fas fa-download mr-2" aria-hidden="true"></i> Options <i class="fas fa-chevron-down ml-2 text-xs" aria-hidden="true"></i>
                            </button>

                            <div
                                id="customExportDropdown"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none hidden z-10"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="customExportButton"
                            >
                                <div class="py-1">
                                    <a href="#" id="exportExcel" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">
                                        <i class="fas fa-file-excel mr-2 text-green-600 dark:text-green-400" aria-hidden="true"></i> Export to Excel
                                    </a>
                                    <a href="#" id="exportPdf" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">
                                        <i class="fas fa-file-pdf mr-2 text-red-600 dark:text-red-400" aria-hidden="true"></i> Export to PDF
                                    </a>
                                    <a href="#" id="printTableOption" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">
                                        <i class="fas fa-print mr-2 text-blue-600 dark:text-blue-400" aria-hidden="true"></i> Print Table
                                    </a>
                                    <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                                    <div class="px-4 pt-2 pb-1 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">
                                        Column Visibility
                                    </div>
                                    <div id="columnVisibilityCheckboxes" class="px-4 pb-2 space-y-2" role="group" aria-label="Column Visibility Options">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session()->has('success'))
                <div id="successMessage" class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <div id="dataTableContainer"></div>

                <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                    <table
                        id="advisoryTable"
                        class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800"
                        role="table"
                        aria-label="Advisory Report"
                    >
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th scope="col" class="px-4 py-3 font-semibold text-xs uppercase tracking-wider">Issued By</th>
                                <th scope="col" class="px-4 py-3 font-semibold text-xs uppercase tracking-wider">Title / Description</th>
                                <th scope="col" class="px-4 py-3 font-semibold text-xs uppercase tracking-wider">Date of Advisory</th>
                                <th scope="col" class="px-4 py-3 font-semibold text-xs uppercase tracking-wider">Date Received</th>
                                <th scope="col" class="px-4 py-3 font-semibold text-xs uppercase tracking-wider text-center no-print">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @if(isset($advisories) && count($advisories) > 0)
                                @foreach($advisories as $advisory)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-850 transition-colors duration-150">
                                    <td class="px-4 py-3">{{ $advisory->name }}</td>
                                    <td class="px-4 py-3 break-words max-w-md">{{ $advisory->title_description }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($advisory->date_of_advisory)->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($advisory->date_received)->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3 text-center whitespace-nowrap no-print">
                                        <div class="inline-flex items-center space-x-2">
                                            <a href="{{ route('advisory.index', $advisory->id) }}" title="View Advisory" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                                            <a href="{{ route('advisory.edit', $advisory->id) }}" title="Edit Advisory" class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300 transition-colors duration-200">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('advisory.destroy', $advisory->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this advisory?');" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete Advisory" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">No advisories found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>


    <script>
        $(document).ready(function() {
            // Check initial dark mode state and update icons
            const updateDarkModeIcons = () => {
                const isDark = document.documentElement.classList.contains('dark');
                const iconClass = isDark ? 'fa-sun' : 'fa-moon';
                document.querySelectorAll('#darkModeIcon, #darkModeIconSidebar').forEach(icon => {
                    icon.classList.remove('fa-sun', 'fa-moon');
                    icon.classList.add(iconClass);
                });
            };

            updateDarkModeIcons();

            // Dark Mode Toggles
            const toggleDarkMode = () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateDarkModeIcons();
                // Re-draw table to apply dark mode styles if DataTables has specific theme classes
                if ($.fn.DataTable.isDataTable('#advisoryTable')) {
                    $('#advisoryTable').DataTable().draw();
                }
            };

            $('#mobileDarkModeToggle').on('click', toggleDarkMode);
            $('#desktopDarkModeToggle').on('click', toggleDarkMode);

            // Sidebar Toggle for Mobile
            const sidebar = $('#sidebar');
            const mainContent = $('main');
            $('#mobileMenuButton').on('click', function() {
                sidebar.toggleClass('-translate-x-full');
                mainContent.toggleClass('ml-0 lg:ml-64'); // Adjust main content margin
            });

            // Handle initial state for larger screens
            $(window).on('resize', function() {
                if ($(window).width() >= 1024) { // Equivalent to lg breakpoint
                    sidebar.removeClass('-translate-x-full');
                    mainContent.addClass('lg:ml-64').removeClass('ml-0');
                } else {
                    sidebar.addClass('-translate-x-full');
                    mainContent.removeClass('lg:ml-64').addClass('ml-0');
                }
            }).trigger('resize'); // Trigger on load

            // Hide success message after 3 seconds
            setTimeout(function() {
                $('#successMessage').fadeOut('slow');
            }, 3000);

            // --- DataTables Initialization ---

            // Extend DataTables with a custom print title
            $.fn.dataTable.ext.buttons.print.text = 'Print All Visible Columns';

        // Initialize DataTable
        var table = $('#advisoryTable').DataTable({
            "order": [], // Disable initial sorting
            "paging": true,
            "lengthChange": true,
            "searching": true, // Keep this as true to enable DataTables' internal search logic
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "full_numbers", // This adds "First", "Previous", "Next", "Last"
            dom: '<"dt-top"<"dt-length-buttons"lB>f>t<"dt-bottom"<"dt-info-text"i><"dt-pagination-controls"p>>',    
            "language": {
                "search": "", // Remove default search label
                "searchPlaceholder": "Search advisories...",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)"
            },
        // --- MODIFIED: lengthMenu to include "All" ---
        "lengthMenu": [
            [10, 25, 50, -1], // Values for the dropdown: 10, 25, 50, -1 (for All)
            ['10', '25', '50', 'All'] // Display text for each value
        ],
                buttons: [
                    // Excel Export Button
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel', // This text will be hidden by our CSS
                        title: 'Advisory Report - ' + new Date().toLocaleDateString('en-CA', { year: 'numeric', month: '2-digit', day: '2-digit' }), // Changed locale to 'en-CA' for YYYY-MM-DD
                        className: 'hidden-button', // Hide the default button
                        exportOptions: {
                            columns: ':visible:not(.no-print)' // Export only visible columns, exclude 'no-print' (actions)
                        },
                        filename: function() {
                            const now = new Date();
                            const year = now.getFullYear();
                            const month = (now.getMonth() + 1).toString().padStart(2, '0');
                            const day = now.getDate().toString().padStart(2, '0');
                            return `Advisory_Report_${year}${month}${day}`;
                        }
                    },
                    // PDF Export Button
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF', // This text will be hidden by our CSS
                        title: 'Advisory Report - ' + new Date().toLocaleDateString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' }),
                        className: 'hidden-button', // Hide the default button
                        orientation: 'portrait', // Landscape orientation for more columns
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible:not(.no-print)' // Export only visible columns, exclude 'no-print' (actions)
                        },
                        customize: function (doc) {
                            // Customizations for pdfmake generated PDF
                            doc.content[0].text = 'PHILIPPINE STATISTICS AUTHORITY\nGENERAL SERVICES DIVISION\nRECORDS MANAGEMENT SECTION\nADVISORY REPORT'; // Report title
                            doc.content[0].alignment = 'center';
                            doc.content[0].fontSize = 11;
                            doc.content[0].bold = true;
                            
                            // Get current date
                            const today = new Date();
                            // Extract year, month, and day
                            const year = today.getFullYear();
                            // Months are 0-indexed, so add 1 and pad with '0' if less than 10
                            const month = String(today.getMonth() + 1).padStart(2, '0');
                            // Pad day with '0' if less than 10
                            const day = String(today.getDate()).padStart(2, '0');

                            // Create the yyyy-mm-dd format
                            const formattedDate = `${year}-${month}-${day}`;

                            doc.content.splice(1, 0, { // Add date generated below title
                                text: 'Date Generated: ' + formattedDate, // Use the new formatted date
                                alignment: 'center',
                                bold: true,
                                fontSize: 10,
                                margin: [0, 5, 0, 15] // top, right, bottom, left
                            });

                            // Styling for table header
                            doc.styles.tableHeader = {
                                //fillColor: '#FFFFFF', // Light gray background
                                color: '#000', // Black text
                                bold: true,
                                alignment: 'center' // Center header text
                            };

                            // Add borders to the table
                            // This ensures the table spans the width and has borders
                            doc.content[doc.content.length - 1].table.widths = Array(doc.content[doc.content.length - 1].table.body[0].length + 1).join('*').split('');
                            doc.content[doc.content.length - 1].layout = {
                                hLineWidth: function (i, node) { return 1; },
                                vLineWidth: function (i, node) { return 1; },
                                hLineColor: function (i, node) { return '#aaa'; },
                                vLineColor: function (i, node) { return '#aaa'; },
                                paddingLeft: function(i, node) { return 8; },
                                paddingRight: function(i, node) { return 8; },
                                paddingTop: function(i, node) { return 8; },
                                paddingBottom: function(i, node) { return 8; }
                            };

                            // Apply striped rows
                            doc.content[doc.content.length - 1].table.body.forEach(function(row, i) {
                                if (i % 2 === 1) { // Check for odd index (even rows in 0-indexed array)
                                    row.forEach(function(cell) {
                                        cell.fillColor = '#FFFFFF'; // Light gray for even rows
                                    });
                                }
                            });

                            // Set default text color to black for PDF
                            doc.defaultStyle.color = '#000';
                        },
                        filename: function() {
                            const now = new Date();
                            const year = now.getFullYear();
                            const month = (now.getMonth() + 1).toString().padStart(2, '0');
                            const day = now.getDate().toString().padStart(2, '0');
                            return `Advisory_Report_${year}${month}${day}`;
                        }
                    },
                    // Print Button
                    {
                        extend: 'print',
                        text: 'Print Table', // This text will be hidden by our CSS
                        className: 'hidden-button', // Hide the default button
                        exportOptions: {
                            columns: ':visible:not(.no-print)' // Print only visible columns, exclude 'no-print' (actions)
                        },
                        // --- IMPORTANT: Set the default title for the print button to empty ---
                        title: '', // This makes the browser's native print header blank.
                        messageTop: function() {
                        // This function generates the HTML for your custom header
                        const now = new Date();
                        const year = now.getFullYear();
                        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed, add 1. Pad with '0' for single digits.
                        const day = String(now.getDate()).padStart(2, '0'); // Pad with '0' for single digits.

                        const formattedDate = `${year}-${month}-${day}`; // yyyy-mm-dd format

                            return `
                                <div class="print-header" style="text-align: center; margin-bottom: 20px; color: #000;">
                                    <h1 style="font-size: 16px; font-weight: bold; margin-bottom: 3px; line-height: 1.2;">PHILIPPINE STATISTICS AUTHORITY</h1>
                                    <p style="font-size: 16px; font-weight: bold; margin-bottom: 3px; line-height: 1.2;">GENERAL SERVICES DIVISION</p>
                                    <p style="font-size: 16px; font-weight: bold; margin-bottom: 3px; line-height: 1.2;">RECORDS MANAGEMENT SECTION</p>
                                    <p style="font-size: 16px; font-weight: bold; margin-bottom: 3px; line-height: 1.2;">ADVISORY REPORT</p>
                                    <p class="date-generated" style="font-size: 14px; margin-top: 10px;">Date Generated: ${formattedDate}</p>
                                </div>
                            `;
                        },
                        messageBottom: null // Remove any default bottom message if present
                    },
        ],
        "columnDefs": [
            { "targets": [4], "orderable": false }, // Disable sorting for 'Actions' column
            { "targets": [0], "visible": true }     // <--- This line ensures 'Issued By' (index 0) is visible
        ]
    });

    // --- Link Custom Search Input to DataTables ---
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // --- Date Range Filtering ---
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#minDate').val();
            var max = $('#maxDate').val();
            // Column index 2: Date of Advisory, Column index 3: Date Received
            // Assuming dates in your table cells are in 'YYYY-MM-DD' format from Laravel
            // If not, you might need to parse them with Moment.js:
            // var dateAdvisory = moment(data[2], 'MM/DD/YYYY').format('YYYY-MM-DD'); // Example if table date is MM/DD/YYYY
            // var dateReceived = moment(data[3], 'MM/DD/YYYY').format('YYYY-MM-DD'); // Example if table date is MM/DD/YYYY
            var dateAdvisory = data[2];
            var dateReceived = data[3];

            // Convert input dates to Moment objects for reliable comparison if they exist
            var minMoment = min ? moment(min) : null;
            var maxMoment = max ? moment(max) : null;

            // Convert table dates to Moment objects for reliable comparison
            var advisoryMoment = moment(dateAdvisory);
            var receivedMoment = moment(dateReceived);

            // If no min or max date is set, show all rows
            if (!minMoment && !maxMoment) {
                return true;
            }

            // Check if both advisory and received dates fall within the range
            var advisoryInRange = (!minMoment || advisoryMoment.isSameOrAfter(minMoment, 'day')) &&
                                  (!maxMoment || advisoryMoment.isSameOrBefore(maxMoment, 'day'));

            var receivedInRange = (!minMoment || receivedMoment.isSameOrAfter(minMoment, 'day')) &&
                                  (!maxMoment || receivedMoment.isSameOrBefore(maxMoment, 'day'));

            // Return true if BOTH advisory and received dates are in range
            return advisoryInRange && receivedInRange;
        }
    );

    $('#minDate, #maxDate').on('change', function() {
        table.draw();
    });

    // --- Export Options Dropdown ---
    var customExportButton = document.getElementById('customExportButton');
    var customExportDropdown = document.getElementById('customExportDropdown');

    // Toggle dropdown visibility
    customExportButton.addEventListener('click', function() {
        customExportDropdown.classList.toggle('hidden');
        this.setAttribute('aria-expanded', customExportDropdown.classList.contains('hidden') ? 'false' : 'true');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!customExportButton.contains(event.target) && !customExportDropdown.contains(event.target)) {
            customExportDropdown.classList.add('hidden');
            customExportButton.setAttribute('aria-expanded', 'false');
        }
    });

    // Hook up export buttons to DataTables' internal buttons
    $('#exportExcel').on('click', function(e) {
        e.preventDefault();
        table.button('.buttons-excel').trigger(); // Trigger the hidden DataTables Excel button
        customExportDropdown.classList.add('hidden'); // Close dropdown
    });

    $('#exportPdf').on('click', function(e) {
        e.preventDefault();
        table.button('.buttons-pdf').trigger(); // Trigger the hidden DataTables PDF button
        customExportDropdown.classList.add('hidden'); // Close dropdown
    });

    $('#printTableOption').on('click', function(e) {
        e.preventDefault();
        table.button('.buttons-print').trigger(); // Trigger the hidden DataTables Print button
        customExportDropdown.classList.add('hidden'); // Close dropdown
    });

    // --- Column Visibility Checkboxes ---
    var columnVisibilityCheckboxes = $('#columnVisibilityCheckboxes');
    table.columns().every(function(index) {
        var column = this;
        // Skip the "Actions" column (index 4) if you don't want it toggled
        if (index === 4) { // Only skip "Actions" column for checkbox generation
            return;
        }
        var title = $(column.header()).text();
        // Create a unique ID for the checkbox
        var checkboxId = 'toggleColumn' + index;
        columnVisibilityCheckboxes.append(
            `<div class="column-checkbox-item">
                <input type="checkbox" id="${checkboxId}" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out dark:bg-gray-700 dark:border-gray-600 dark:checked:bg-indigo-600" data-column="${index}" ${column.visible() ? 'checked' : ''}>
                <label for="${checkboxId}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">${title}</label>
            </div>`
        );
    });

        // Event listener for column visibility checkboxes
        columnVisibilityCheckboxes.on('change', 'input[type="checkbox"]', function() {
            var columnIdx = $(this).data('column');
            var column = table.column(columnIdx);
            column.visible(!column.visible()); // Toggle column visibility
        });
    });
    </script>
</body>
</html>