<x-guest-layout>
    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-xl dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            <img src="{{ asset('assets/nbc-logo.PNG') }}" class="h-10 border border-[#FF9EAA] rounded-xl mb-2" alt="NBC Logo" />
            Welcome Back!
        </h2>
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login.save') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                    email</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@company.com" required>
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                    password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="mt-2">
                    <input type="checkbox" id="togglePassword" class="mr-1">
                    <label for="togglePassword" class="text-sm text-gray-900 dark:text-white">Show Password</label>
                </div>
            </div>
            <div class="flex items-start">
                <a href="{{ route('password.request') }}" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Forgot
                    Password?</a>
            </div>
            <button type="submit"
                class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-3 text-center me-2 mb-2">Login
                to your account</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Not registered yet? <a class="text-blue-700 hover:underline dark:text-blue-500"
                    href="{{ route('register') }}">Create account (Customer Only)</a>
            </div>
        </form>
    </div>
</x-guest-layout>

<script>
    document.getElementById("togglePassword").addEventListener("change", function() {
        const passwordInput = document.getElementById("password");
        if (this.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
</script>