<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <body>
        <form id="update-form" class="my-6" method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-4">
                <div class="flex gap-4 mb-2">
                    <div class="flex-1">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="JohnDoe" value="{{ $user->nama }}" required disabled />
                    </div>
                    <div class="flex-1">
                        <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900">Email Pribadi</label>
                        <input name="jenis" type="email" id="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="johndoe@gmail.com" value="{{ $user->email }}" required disabled />
                    </div>
                </div>
                <div class="flex gap-4 mb-2">
                    <div class="flex-1">
                        <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                        <input name="no_telp" type="tel" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="BDAY" value="{{ $user->no_telp }}" required disabled />
                    </div>
                    <div class="flex-1">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                        <input name="alamat" type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Ulang Tahun" value="{{ $user->alamat }}" required disabled />
                    </div>
                </div>
                <div>
                    <label for="alergi" class="block mb-2 text-sm font-medium text-gray-900">Alergi</label>
                    <input name="alergi" type="text" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Alergi Seafood" value="{{ $user->alergi }}" disabled />
                </div>

                <div class="flex w-full justify-end">
                    <button type="button" onclick="enableEdit()" id="edit-button" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                    <button type="button" onclick="disableEdit()" id="cancel-button" class="hidden w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</button>
                    <button type="button" onclick="confirmUpdate()" id="submit-button" class="hidden w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                </div>
            </div>
        </form>
    </body>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function enableEdit() {
        const inputs = document.querySelectorAll("#update-form input");
        const cancelButton = document.getElementById("cancel-button");
        const submitButton = document.getElementById("submit-button");

        // Enable input fields
        inputs.forEach(input => input.disabled = false);

        // Show Cancel and Submit buttons, hide Edit button
        cancelButton.classList.remove("hidden");
        submitButton.classList.remove("hidden");
        event.target.classList.add("hidden");
    }

    function disableEdit() {
        const inputs = document.querySelectorAll("#update-form input");
        const editButton = document.getElementById("edit-button");
        const submitButton = document.getElementById("submit-button");

        // Enable input fields
        inputs.forEach(input => input.disabled = true);

        // Show Edit button, hide Cancel and Submit buttons
        editButton.classList.remove("hidden");
        submitButton.classList.add("hidden");
        event.target.classList.add("hidden");

        // Redirect to profile.edit route
        window.location.href = "{{ route('profile.edit') }}";
    }

    function confirmUpdate() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Profile akan diubah!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`update-form`).submit();
            }
        });
    }
</script>