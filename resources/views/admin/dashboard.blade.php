<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Customer Section -->
                <div class="bg-white shadow-md rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">
                            Customers
                        </h3>

                        <a href="{{ route('customers.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                            + Add Customer
                        </a>
                    </div>

                    <p class="mt-2 text-gray-600">
                        Total Customers: {{ $totalCustomers ?? 'N/A' }}
                    </p>
                </div>

                <!-- Loans Section -->
<!-- Loans Section -->
<div class="bg-white shadow-md rounded-2xl p-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-700">
            Loans
        </h3>
        <div class="flex justify-end space-x-2">
            <a href="{{ route('loans.create') }}"
               class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                + Add Loan
            </a>
            <a href="{{ route('loans.index') }}"
                class="inline-flex items-center ml-2 px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-xl hover:bg-green-700 transition">
                View Loans
            </a>
        </div>
    </div>
    <p class="mt-2 text-gray-600">
        Total Loans: {{ $totalLoans ?? 'N/A' }}
    </p>
</div>



                <!-- Reports Section -->
                <div class="bg-white shadow-md rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">
                            Reports
                        </h3>
                        {{-- <a href="{{ route('reports.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-semibold rounded-xl hover:bg-purple-700 transition">
                            View Reports
                        </a> --}}

                    </div>
                    <p class="mt-2 text-gray-600">
                        Generate or view reports
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
