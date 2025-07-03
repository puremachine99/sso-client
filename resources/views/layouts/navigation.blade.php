<nav class="bg-white shadow-lg backdrop-blur-sm bg-opacity-80">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}"
                class="text-2xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent hover:from-indigo-700 hover:to-purple-700 transition-all duration-300">
                {{config('app.name', 'SmartID')}}
            </a>

            <div class="flex items-center space-x-6">
                @if (session('access_token'))
                    <a href="{{ route('client.home') }}"
                        class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors duration-200 hover:underline underline-offset-4 decoration-2">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout.client') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-rose-600 hover:text-rose-800 transition-colors duration-200 group">
                            <span class="group-hover:underline underline-offset-4 decoration-2">Logout</span>
                            <i class="ml-1 fas fa-sign-out-alt transition-transform group-hover:translate-x-0.5"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login.smartid') }}"
                        class="text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-md hover:shadow-lg">
                        Login dengan SmartID
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
