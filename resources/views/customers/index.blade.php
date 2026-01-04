<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800">
                Customer List
            </h2>

            <a href="{{ route('customers.create') }}"
               class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                + Add New Customer
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-md rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Address</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($customers as $customer)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-700">{{ $customer->id }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $customer->name }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $customer->email }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $customer->phone }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $customer->address }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">

                                        <a href="{{ route('customers.edit', $customer->id) }}"
                                                class="inline-block px-3 py-1.5 bg-yellow-500 text-black text-xs font-semibold rounded-lg border border-yellow-600 hover:bg-yellow-600 transition">
                                                        Edit
                                        </a>


                                        <form action="{{ route('customers.destroy', $customer->id) }}"
                                              method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <x-danger-button class="px-3 py-1.5 text-xs rounded-lg">
                                                Delete
                                            </x-danger-button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
