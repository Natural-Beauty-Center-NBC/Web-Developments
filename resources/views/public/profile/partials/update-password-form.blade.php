<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form id="update-form-password" method="post" action="{{ route('profile.change-password') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900">Old Password</label>
            <input name="old_password" type="password" id="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="••••••••" required />
        </div>
        <div>
            <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
            <input name="new_password" type="password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="••••••••" required />
        </div>
        <div class="mb-4">
            <input type="checkbox" id="togglePassword" class="mr-1">
            <label for="togglePassword" class="text-sm text-gray-900 dark:text-white">Show Password</label>
        </div>
        <button type="button" onclick="confirmUpdatePassword()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("togglePassword").addEventListener("change", function() {
        const oldPassword = document.getElementById("old_password");
        const newPassword = document.getElementById("new_password");
        if (this.checked) {
            oldPassword.type = "text";
            newPassword.type = "text";
        } else {
            oldPassword.type = "password";
            newPassword.type = "password";
        }
    });

    function confirmUpdatePassword() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Password akan diubah secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`update-form-password`).submit();
            }
        });
    }
</script>