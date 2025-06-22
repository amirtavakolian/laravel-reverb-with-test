<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .post-content p {
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .post-content img {
            border-radius: 0.5rem;
            margin: 2rem auto;
            max-width: 100%;
            height: auto;
        }

        .post-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 2rem 0 1rem;
        }

        .post-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 1.5rem 0 0.75rem;
        }

        .post-content ul, .post-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .post-content ul {
            list-style-type: disc;
        }

        .post-content ol {
            list-style-type: decimal;
        }

        .post-content li {
            margin-bottom: 0.5rem;
        }

        .post-content blockquote {
            border-left: 4px solid #e2e8f0;
            padding-left: 1rem;
            margin: 1.5rem 0;
            color: #64748b;
            font-style: italic;
        }

        .post-content a {
            color: #3b82f6;
            text-decoration: underline;
        }

        .post-content a:hover {
            color: #2563eb;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="container mx-auto px-4 py-12 max-w-4xl">
    <!-- Back button -->
    <div class="mb-8">
        <button onclick="window.history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to posts
        </button>
    </div>

    <!-- Post container -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden fade-in">
        <!-- Featured image -->
        <div class="w-full h-64 md:h-80 lg:h-96 overflow-hidden">
            <img id="post-image" src="{{ $post->image }}" alt="Post image" class="w-full h-full object-cover">
        </div>

        <!-- Post content -->
        <div class="p-6 md:p-8">
            <!-- Post meta -->
            <div class="flex items-center text-sm text-gray-500 mb-4">
                    <span class="mr-4">
                        <i class="far fa-calendar-alt mr-1"></i>
                        <span id="post-date">June 15, 2023</span>
                    </span>
                <span>
                        <i class="far fa-clock mr-1"></i>
                        <span id="read-time">5 min read</span>
                    </span>
            </div>

            <!-- Post title -->
            <h1 id="post-title" class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ $post->title }}</h1>

            <!-- Post content -->
            <div id="post-content" class="post-content text-gray-700">
                {{ $post->description }}
            </div>

            <!-- Tags -->
            <div class="mt-10 pt-6 border-t border-gray-100">
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm">Mindfulness</span>
                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-sm">Wellbeing</span>
                    <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-sm">Digital Detox</span>
                    <span class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-full text-sm">Mental Health</span>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-100 flex items-start">
                <img src="{{ $post->user->avatar }}" alt="Author" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <h4 class="font-semibold text-gray-800">{{ $post->user->name }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments section -->
    <div class="mt-16">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Comments ({{ $post->comments->count() }})</h3>

        <!-- Comments list -->
        <div class="space-y-6 mb-10">
            @foreach($post->comments->where('is_approved', 1) as $comment)
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-start mb-4">
                    <img src="{{ $comment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}" alt="User" class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <h4 class="font-medium text-gray-800">{{ $comment->user->name }}</h4>
                    </div>
                </div>
                <p class="text-gray-700">{{ $comment->content }}</p>
            </div>
            @endforeach
        </div>

        <!-- Comment form -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h4 class="font-medium text-gray-800 mb-4">Leave a comment</h4>
            @auth()
            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('site.comment.store', $post) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                    <textarea id="comment" name="body" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body') }}</textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Post Comment</button>
            </form>
            @else
                <h4>Please <a style="color: blue;" href="{{ route('login-form') }}">login</a> to write comment</h4>
            @endauth
        </div>
    </div>
</div>
</body>
</html>
