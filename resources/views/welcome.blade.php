
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Stories</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-black text-white">

<div class="flex min-h-screen flex-col">

    <!-- Navigation -->
    <header class="border-b border-gray-800 px-6 py-5">
        <div class="mx-auto flex max-w-6xl items-center justify-between">

            <a href="{{ url('/') }}" class="text-2xl font-bold">
                Black <span class="text-[#D3222C]">Stories</span>
            </a>

            <div class="flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg bg-gray-800 px-4 py-2 text-white transition hover:bg-gray-700">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                        Register
                    </a>
                @endauth
            </div>

        </div>
    </header>

    <!-- Main content -->
    <main class="flex flex-1 items-center justify-center px-6 py-16">
        <div class="w-full max-w-4xl rounded-xl border border-gray-700 bg-gray-900 p-8 text-center shadow-lg md:p-14">

            <h1 class="mb-6 text-4xl font-bold md:text-5xl">
                Welcome to Black <span class="text-[#D3222C]">Stories</span>
            </h1>

            <p class="mx-auto mb-8 max-w-2xl text-lg text-gray-300">
                Discover mysterious stories, solve puzzles and test your creativity.
                Can you figure out what really happened?
            </p>

            <div class="mx-auto mb-8 max-w-2xl rounded-lg border border-gray-700 bg-black p-6">
                <h2 class="mb-3 text-xl font-bold">
                    How does it work?
                </h2>

                <p class="text-gray-300">
                    Read the front of a mysterious card and try to solve the story.
                    When you think you know the answer, reveal the back of the card
                    to discover what really happened.
                </p>
                <p class="text-gray-300">
                    Best played with multiple people. One person, or multiple people only look at the front of the card and can ask questions to which the other person, who has already read the back of the card, may only answer with yes or no.
                    Keep doing this until you think you have the answer.
                </p>
            </div>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-block rounded-lg bg-[#D3222C] px-6 py-3 font-semibold text-white transition hover:bg-red-800">
                    Go to dashboard
                </a>
            @else
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('login') }}"
                       class="rounded-lg bg-[#D3222C] px-6 py-3 font-semibold text-white transition hover:bg-red-800">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-lg bg-gray-700 px-6 py-3 font-semibold text-white transition hover:bg-gray-600">
                        Create an account
                    </a>
                </div>

                <p class="mt-5 text-sm text-gray-400">
                    Log in or create an account to explore the cards.
                </p>
            @endauth

        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800 px-6 py-5 text-center text-sm text-gray-500">
        Black Stories
    </footer>

</div>

</body>
</html>
