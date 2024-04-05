<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</head>

<body class="font-[Poppins]">
    {{-- Nav Bar --}}
    <header class="bg-blue-600">
        <nav class="flex justify-between items-center w-[92%]  mx-auto">
            <a href="{{ url('/') }}">
                <img class="w-16 cursor-pointer min-w-32" src="https://kmd.com.sg/images/logo/logo1.png" alt="...">
            </a>
            <div
                class="nav-links text-white uppercase duration-500 md:static absolute bg-blue-600 md:min-h-fit min-h-[45vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[1vw] gap-8">
                    <li>
                        <a class="text-gray-200 hover:bg-blue-500  block rounded-md px-3 py-2 text-base font-medium active"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <a class="text-gray-200 hover:bg-blue-500 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                            href="{{ url('/') }}">Company</a>
                    </li>
                    <li>
                        <a class="text-gray-200 hover:bg-blue-500 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                            href="{{ url('/') }}">Line of business</a>
                    </li>
                    <li>
                        <a class="text-gray-200 hover:bg-blue-500 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                            href="{{ url('/') }}">Job Openings</a>
                    </li>
                    <li class="relative">
                        <button id="newsDropdownButton"
                            class="bg-blue-700 text-white block rounded-md px-3 py-2 text-base font-medium focus:outline-none"
                            aria-expanded="false">News</button>
                        <!-- Dropdown menu -->
                        <div id="newsDropdown"
                            class="hidden absolute left-0 mt-1 w-28 bg-white rounded-md shadow-lg py-1 z-10">
                            <a href="{{ route('media') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Media</a>
                            <a href="{{ route('csr') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">CSR</a>
                        </div>
                    </li>
                    <li>
                        <a class="text-gray-200 hover:bg-blue-500 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                            href="{{ url('/') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-6">
                {{-- <button class="bg-[#ece9e4] text-white px-5 py-2 rounded-full hover:bg-[#f4efe7]">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="rounded-md px-2 py-0 text-sky-900 hover:text-sky-900/70">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="rounded-md px-2 py-0 text-sky-900 ring-1 ring-transparent transition hover:text-sky-900/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Log
                                    in</a>
                                <p class="text-sky-900">/</p>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="rounded-md px-2 py-0 text-sky-900 ring-1 ring-transparent transition hover:text-sky-900/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">Register</a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </button> --}}
                <ion-icon onclick="onToggleMenu(this)" name="menu"
                    class="text-3xl cursor-pointer md:hidden text-white"></ion-icon>
            </div>
        </nav>
    </header>

    <div class="h-fit min-h-auto py-12 bg-gray-200">
        <div class="container mx-auto ">
            <h1 class="text-2xl text-center font-bold mb-4">CSR Posts</h1>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- year left side -->
                <div class="col-span-1">
                    <h2 class="text-lg font-semibold mb-2">Select year: </h2>
                    <div id="selectedYear" class="mb-4"></div> <!-- selected year -->
                    <ul>
                        @foreach ($uniqueYears as $year)
                            <li class="mb-1">
                                <button
                                    class="year-button bg-white hover:bg-gray-100 px-3 py-1 rounded w-48 text-left border {{ $selectedYear == $year ? 'border-blue-500' : 'border-gray-300' }}"
                                    data-year="{{ $year }}">{{ $year }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-span-3 gap-4 overflow-auto" id="post-container">
                    @foreach ($csrPosts as $post)
                        <div
                            class="flex flex-col md:flex-row md:items-start gap-4 border p-4 rounded bg-white post-item year-{{ $post->year }} mb-4">
                            <!-- Display Post Image -->
                            @if ($post->featured_image)
                                <div class="flex-shrink-0 md:mr-4 w-full h-48 md:w-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                                        alt="{{ $post->title }}" class="object-cover w-full h-full rounded">
                                </div>
                            @endif
                            <!-- Post Details -->
                            <div class="post-content flex-grow">
                                <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                                <div class="py-4 whitespace-normal break-words">
                                    {{ \Illuminate\Support\Str::limit(strip_tags(app('htmlpurifier')->purify($post->content)), 280, $end = '...') }}
                                </div>
                                <a href="{{ route('detailpost.show', $post->id) }}"
                                    class="text-blue-600 hover:underline">Read more</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>




    <footer class="bg-gray-300 dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-2xl">
            <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class=" hover:underline">About</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Careers</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Brand Center</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Blog</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Help center</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Discord Server</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Twitter</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Facebook</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Licensing</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Download</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">iOS</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Android</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">Windows</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline">MacOS</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="px-4 py-6 bg-gray-100 dark:bg-gray-700 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">© 2023 <a
                        href="https://flowbite.com/">Flowbite™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
                    <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 21 16">
                            <path
                                d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 17">
                            <path fill-rule="evenodd"
                                d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Dribbble account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const navLinks = document.querySelector('.nav-links');

        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu';
            navLinks.classList.toggle('top-[6%]');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const newsDropdownButton = document.getElementById('newsDropdownButton');
            const newsDropdownMenu = document.getElementById('newsDropdown');

            newsDropdownButton.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true' || false;
                this.setAttribute('aria-expanded', !expanded);
                newsDropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            window.addEventListener('click', function(e) {
                if (!newsDropdownButton.contains(e.target) && !newsDropdownMenu.contains(e.target)) {
                    newsDropdownMenu.classList.add('hidden');
                    newsDropdownButton.setAttribute('aria-expanded', 'false');
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const yearButtons = document.querySelectorAll('.year-button');
            const selectedYearElement = document.getElementById('selectedYear');

            // 初始化函数，显示最新的年份的帖子
            function init() {
                const latestYear = '{{ $latestYear }}';

                // 隐藏所有帖子
                const allPosts = document.querySelectorAll('.post-item');
                allPosts.forEach(post => post.classList.add('hidden'));

                // 显示最新的年份的帖子
                const selectedPosts = document.querySelectorAll('.year-' + latestYear);
                selectedPosts.forEach(post => post.classList.remove('hidden'));

            }

            yearButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const selectedYear = this.getAttribute('data-year');

                    // 隐藏所有帖子
                    const allPosts = document.querySelectorAll('.post-item');
                    allPosts.forEach(post => post.classList.add('hidden'));

                    // 显示选择年份的帖子
                    const selectedPosts = document.querySelectorAll('.year-' + selectedYear);
                    selectedPosts.forEach(post => post.classList.remove('hidden'));
                });
            });

            // 调用初始化函数
            init();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.year-button');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    buttons.forEach(btn => {
                        btn.classList.remove('border-blue-500');
                        btn.classList.add('border-gray-300');
                    });

                    this.classList.remove('border-gray-300');
                    this.classList.add('border-blue-500');
                });
            });
        });
    </script>
</body>

</html>
