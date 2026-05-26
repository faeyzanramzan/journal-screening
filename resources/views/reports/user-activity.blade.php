<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">

        <h1 class="text-3xl font-bold">
            User Activity Report
        </h1>

        <p class="mt-2 text-indigo-100">
            Monitor user screening activities and participation.
        </p>

    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left">No.</th>
                    <th class="px-6 py-4 text-left">User</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Total Screenings</th>
                    <th class="px-6 py-4 text-left">Joined Date</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($users as $user)

                    <tr class="hover:bg-gray-50">

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
                            <a href="{{ route('reports.user-activity.show', $user->id) }}"
                            class="font-bold text-indigo-600 hover:underline">
                                {{ $user->journals_count }}
                            </a>
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            No user activity data available.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</x-app-layout>