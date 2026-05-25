<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Country Management</h1>
                <p class="mt-2 text-indigo-100">Manage publisher countries used in journal screening.</p>
            </div>

            <a href="{{ route('countries.create') }}"
               class="bg-white text-indigo-700 px-5 py-3 rounded-xl font-semibold shadow-md hover:bg-indigo-50 transition">
                + Add Country
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-6 py-4 rounded-2xl mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">Country List</h2>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left">No.</th>
                    <th class="px-6 py-4 text-left">Country Name</th>
                    <th class="px-6 py-4 text-left">Created At</th>
                    <th class="px-6 py-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($countries as $country)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $country->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $country->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                           <div class="flex items-center gap-2">

    <a href="{{ route('countries.show', $country->id) }}"
       class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl text-xs font-semibold transition">
        View
    </a>

    <form x-data="{ openDeleteModal: false }"
          action="{{ route('countries.destroy', $country->id) }}"
          method="POST">

        @csrf
        @method('DELETE')

        <!-- Button -->
        <button type="button"
            @click="openDeleteModal = true"
            class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-xl text-xs font-semibold transition">
            Delete
        </button>

        <!-- STYLE_JOURNAL Popup -->
        <div x-show="openDeleteModal"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">

            <div
                x-transition
                class="relative w-full max-w-md mx-4 overflow-hidden rounded-3xl bg-white shadow-2xl">

                <!-- Header -->
                <div class="bg-gradient-to-r from-red-500 to-rose-500 p-6 text-white">

                    <h2 class="text-2xl font-bold">
                        Delete Country
                    </h2>

                    <p class="text-red-100 text-sm mt-1">
                        This action cannot be undone.
                    </p>

                </div>

                <!-- Body -->
                <div class="p-6">

                    <div class="bg-red-50 border border-red-100 rounded-2xl p-4">

                        <p class="text-gray-700 leading-relaxed">
                            Are you sure you want to permanently delete
                            <strong>{{ $country->name }}</strong> ?
                        </p>

                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 mt-8">

                        <button type="button"
                            @click="openDeleteModal = false"
                            class="px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">

                            Cancel

                        </button>

                        <button type="submit"
                            class="px-5 py-3 rounded-xl bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white font-semibold shadow-lg transition-all duration-300">

                            Yes, Delete

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            No country added yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>