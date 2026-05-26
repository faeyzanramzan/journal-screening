<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">User Details</h1>
        <p class="mt-2 text-indigo-100">View user information.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Full Name</p>
                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Email</p>
                <p class="font-semibold text-gray-800">{{ $user->email }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Role</p>
                <p class="font-semibold text-gray-800">{{ $user->role->name }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Created At</p>
                <p class="font-semibold text-gray-800">
                    {{ $user->created_at->format('d M Y h:i A') }}
                </p>
            </div>

        </div>

        <div class="mt-8">

            <a href="{{ route('users.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl">
                Back
            </a>

        </div>

    </div>

</x-app-layout>