<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold">
                    User Management
                </h1>

                <p class="mt-2 text-indigo-100">
                    Manage system users and access roles.
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="bg-white text-indigo-700 px-5 py-3 rounded-xl font-semibold shadow-md hover:bg-indigo-50 transition">
                + Add User
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
            <h2 class="text-xl font-bold text-gray-800">User List</h2>
        </div>


        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left">No.</th>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($users as $user)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ strtolower($user->role->name) == 'admin'
                                    ? 'bg-indigo-100 text-indigo-700'
                                    : 'bg-green-100 text-green-700' }}">

                                {{ $user->role->name }}

                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <a href="{{ route('users.show', $user->id) }}"
                               class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl text-xs font-semibold transition">
                                View
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            No user found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</x-app-layout>