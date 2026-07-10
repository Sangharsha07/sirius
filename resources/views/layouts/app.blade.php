<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <style>
            /* Global Layout Adjustments */
            body {
                background-color: #f5f7fb !important;
            }
            .page {
                max-width: 1200px;
                margin: 0 auto;
                padding: 40px 24px;
            }
            .page-desc {
                color: #6b7280;
                font-size: 1.05rem;
                margin-bottom: 32px;
                line-height: 1.6;
            }

            /* Unified Premium Section Box Design */
            .section-box {
                background: #ffffff;
                padding: 32px;
                border-radius: 20px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
                border: 1px solid #eef2f6;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            /* Premium Inputs and Form Layout Adjustments */
            .custom-form-group {
                margin-bottom: 20px;
            }
            .custom-form-group label {
                display: block;
                font-weight: 600;
                font-size: 0.9rem;
                margin-bottom: 8px;
                color: #374151;
            }
            .custom-input, .custom-select, .custom-textarea {
                width: 100%;
                padding: 14px 16px;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                outline: none;
                font-size: 0.95rem;
                background-color: #f8fafc;
                color: #1f2937;
                transition: all 0.2s ease;
            }
            .custom-input:focus, .custom-select:focus, .custom-textarea:focus {
                border-color: #2563eb;
                background-color: #ffffff;
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            }

            /* Master Action Button Setup */
            .prime-btn {
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
                color: #ffffff;
                border: none;
                padding: 14px 28px;
                border-radius: 12px;
                font-weight: 600;
                font-size: 0.95rem;
                cursor: pointer;
                box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
                transition: all 0.2s ease;
            }
            .prime-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            }
            .prime-btn:active {
                transform: translateY(0);
            }

            /* Dashboard Style Item List Container Templates */
            .interactive-item {
                background: #ffffff;
                padding: 24px;
                border-radius: 16px;
                border: 1px solid #eef2f6;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
                transition: all 0.2s ease;
            }
            .interactive-item:hover {
                transform: translateX(4px);
                border-color: #cbd5e1;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
        <div class="min-h-screen bg-gray-50 dark:bg-slate-900 transition-colors duration-150">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-slate-800 shadow-sm border-b border-gray-100 dark:border-slate-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>