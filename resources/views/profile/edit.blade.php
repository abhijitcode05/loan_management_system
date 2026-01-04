<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Update Profile Info -->
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Profile Information
                </h3>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Update Password
                </h3>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account -->
            <div class="bg-white shadow-md rounded-2xl p-6 border border-red-200">
                <h3 class="text-lg font-semibold text-red-600 mb-4">
                    Delete Account
                </h3>
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
