<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">Add Country</h1>
        <p class="mt-2 text-indigo-100">Create a new country option for journal screening.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="{{ route('countries.store') }}" method="POST">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Country Name <span class="text-red-500">*</span>
                </label>

                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                       required>

                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('countries.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl">
                    Cancel
                </a>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow-md">
                    Save Country
                </button>
            </div>
        </form>
    </div>

</x-app-layout>