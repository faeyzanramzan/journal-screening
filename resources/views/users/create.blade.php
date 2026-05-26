<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">Add User</h1>
        <p class="mt-2 text-indigo-100">Create new system user.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email Address
                    </label>

                    <input type="email"
                           name="email"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Role
                    </label>

                    <select name="role_id"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required>

                        <option value="">Select Role</option>

                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>

                    <input type="password"
                           name="password"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('users.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl">
                    Cancel
                </a>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow-md">
                    Save User
                </button>

            </div>

        </form>

    </div>

</x-app-layout>