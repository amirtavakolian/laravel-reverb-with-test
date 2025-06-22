<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وبلاگ | لیست پست‌ها</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Vazirmatn', sans-serif;
        }

        .post-card {
            transition: all 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Navbar -->
<nav class="gradient-bg text-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="#" class="text-2xl font-bold">وبلاگ <span class="text-yellow-300">من</span></a>

            <div class="hidden md:flex space-x-6 space-x-reverse">
                <a href="#" class="hover:text-yellow-300 transition">خانه</a>
                <a href="#" class="hover:text-yellow-300 transition">پست‌ها</a>
                <a href="#" class="hover:text-yellow-300 transition">درباره ما</a>
                <a href="#" class="hover:text-yellow-300 transition">تماس با ما</a>
            </div>

            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-3">
        <a href="#" class="block py-2 hover:text-yellow-300 transition">خانه</a>
        <a href="#" class="block py-2 hover:text-yellow-300 transition">پست‌ها</a>
        <a href="#" class="block py-2 hover:text-yellow-300 transition">درباره ما</a>
        <a href="#" class="block py-2 hover:text-yellow-300 transition">تماس با ما</a>
    </div>
</nav>

<!-- Hero Section -->
<header class="gradient-bg text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">به وبلاگ ما خوش آمدید</h1>
        <p class="text-xl md:text-2xl mb-8">آخرین مطالب و مقالات را در اینجا بخوانید</p>
        <div class="relative max-w-md mx-auto">
            <input type="text" placeholder="جستجو در پست‌ها..."
                   class="w-full py-3 px-4 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-300">
            <button class="absolute left-3 top-3 text-gray-500">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row">
        <!-- Posts Section -->
        <div class="w-full md:w-3/4 md:pe-6">


            <!-- Posts List -->
            <div id="posts-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <img src="{{ $post->image }}" alt="" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $post->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500"><i
                                    class="far fa-calendar-alt ml-1"></i> ۲ روز پیش</span>
                            <a href="{{ route('site.post.show', $post) }}"
                               class="text-blue-600 hover:text-blue-800 transition">Read More <i
                                    class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-10">
                <nav class="inline-flex rounded-md shadow">
                    <a href="#"
                       class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">۳</a>
                    <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">۲</a>
                    <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">۱</a>
                    <a href="#"
                       class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full md:w-1/4 mt-8 md:mt-0">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">دسته‌بندی‌ها</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">تکنولوژی <span
                                class="text-xs bg-gray-200 px-2 py-1 rounded-full">۱۵</span></a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">برنامه‌نویسی <span
                                class="text-xs bg-gray-200 px-2 py-1 rounded-full">۲۳</span></a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">طراحی <span
                                class="text-xs bg-gray-200 px-2 py-1 rounded-full">۸</span></a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">تجارت <span
                                class="text-xs bg-gray-200 px-2 py-1 rounded-full">۱۲</span></a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition">زندگی <span
                                class="text-xs bg-gray-200 px-2 py-1 rounded-full">۱۷</span></a></li>
                </ul>
            </div>


            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">مشترک شوید</h3>
                <p class="text-gray-600 mb-4">با وارد کردن ایمیل خود، از آخرین پست‌ها با خبر شوید.</p>
                <form>
                    <input type="email" placeholder="آدرس ایمیل"
                           class="w-full px-4 py-2 border border-gray-300 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition">عضویت
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h4 class="text-xl font-bold mb-4">درباره ما</h4>
                <p class="text-gray-400">وبلاگ تخصصی در زمینه برنامه‌نویسی و تکنولوژی. ما سعی داریم بهترین مطالب را برای
                    شما تهیه کنیم.</p>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">لینک‌های سریع</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition">خانه</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">پست‌ها</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">درباره ما</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">تماس با ما</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">دسته‌بندی‌ها</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition">تکنولوژی</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">برنامه‌نویسی</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">طراحی</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">تجارت</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">ارتباط با ما</h4>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-center">
                        <i class="fas fa-map-marker-alt ml-2"></i>
                        تهران، خیابان آزادی، پلاک ۱۲۳
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone ml-2"></i>
                        ۰۲۱-۱۲۳۴۵۶۷۸
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope ml-2"></i>
                        info@example.com
                    </li>
                </ul>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i
                            class="fab fa-telegram text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i
                            class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i
                            class="fab fa-linkedin text-xl"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
            <p>تمامی حقوق برای وبلاگ من محفوظ است. © ۱۴۰۲</p>
        </div>
    </div>
</footer>

</body>
</html>
