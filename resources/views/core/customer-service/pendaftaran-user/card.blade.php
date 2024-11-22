@extends('core.customer-service.layouts.main')

@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="card flex justify-center items-center">
        <div class="card w-[28rem] h-[18rem] border-2 border-black rounded-lg p-6 bg-white text-center relative overflow-hidden">
            <div class="flex items-center justify-center">
                <!-- Logo NBC -->
                <div class="card-logo text-4xl font-bold text-pink-500 mr-3">
                    <img src="{{ asset('assets/nbc-logo.PNG') }}" alt="NBC Logo" class="w-12 h-auto">
                </div>
                <!-- Title -->
                <div class="card-title text-lg font-semibold text-pink-500">
                    Natural Beauty Center
                </div>
            </div>

            <!-- Address -->
            <div class="card-address text-xs text-gray-700 mt-2">
                Jl. Babarsari No. 43 Yogyakarta 55281<br>Telp. (0274) 487711
            </div>

            <!-- ID Customer -->
            <div class="card-number text-base font-bold my-6">{{ $user->id_user }}</div> <!-- changed to $user -->

            <!-- Card Details -->
            <div class="card-details text-xs text-left mx-4">
                <p>Card Holder Since<br>Month / Year</p>
                <p>{{ \Carbon\Carbon::parse($user->created_at)->format('m / y') }}</p> <!-- changed to $user -->
                <p class="card-holder text-lg font-bold truncate w-full">{{ strtoupper($user->nama) }}</p> <!-- changed to $user -->
            </div>

            <!-- Footer -->
            <div class="card-footer absolute bottom-2 w-full text-center text-xs text-gray-500">
                Your NBC Card has no expiration date
            </div>
        </div>
    </div>

    <div class="mt-6 text-right">
        <a href="{{ route('user-service.index') }}" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition duration-200">
            Back
        </a>
    </div>
</div>
@endsection
