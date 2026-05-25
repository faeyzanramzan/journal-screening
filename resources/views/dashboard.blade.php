<x-app-layout>

    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">
            Journal Screening Dashboard
        </h1>

        <p class="mt-2 text-indigo-100">
            Welcome back, {{ Auth::user()->name }}.
            Monitor journal credibility screening and reporting activities.
        </p>

        <div class="mt-4 inline-block bg-white/20 px-4 py-2 rounded-lg text-sm">
            Role: {{ Auth::user()->role->name ?? 'User' }}
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <!-- TOTAL JOURNALS -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-blue-500">

        <div class="flex items-start justify-between">

            <div>
                <p class="text-gray-500 text-sm font-medium">
                    Total Journals
                </p>

                <h2 class="text-4xl font-bold mt-3 text-gray-800">
                    {{ $totalJournals }}
                </h2>

                <p class="text-sm text-gray-400 mt-3">
                    Screened journals in database
                </p>
            </div>

        </div>

    </div>

    <!-- LEGITIMATE -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-green-500">

        <div class="flex items-start justify-between">

            <div>
                <p class="text-gray-500 text-sm font-medium">
                    Legitimate
                </p>

                <h2 class="text-4xl font-bold mt-3 text-green-600">
                    {{ $highTrust }}
                </h2>

                <p class="text-sm text-gray-400 mt-3">
                    Low Risk (1.0 – 4.9)
                </p>
            </div>


        </div>

    </div>

    <!-- QUESTIONABLE -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-yellow-500">

        <div class="flex items-start justify-between">

            <div>
                <p class="text-gray-500 text-sm font-medium">
                    Questionable
                </p>

                <h2 class="text-4xl font-bold mt-3 text-yellow-500">
                    {{ $moderateTrust }}
                </h2>

                <p class="text-sm text-gray-400 mt-3">
                    Medium Risk (5.0 – 7.9)
                </p>
            </div>

          
        </div>

    </div>

    <!-- PREDATORY -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-red-500">

        <div class="flex items-start justify-between">

            <div>
                <p class="text-gray-500 text-sm font-medium">
                    Suspected Predatory
                </p>

                <h2 class="text-4xl font-bold mt-3 text-red-600">
                    {{ $riskyJournals }}
                </h2>

                <p class="text-sm text-gray-400 mt-3">
                    High Risk (8.0 – 10.0)
                </p>
            </div>


        </div>

    </div>

</div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">

        <!-- Recent Screening -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-md p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">
                    Recent Screenings
                </h2>

                <a href="{{ route('screen-journal.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm shadow-md transition">
                    + New Screening
                </a>
            </div>

            <table class="w-full">
                <thead>
                    <tr class="border-b text-left text-gray-500 text-sm">
                        <th class="pb-3">Journal</th>
                        <th class="pb-3">Score</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Date</th>
                    </tr>
                </thead>

                <tbody class="text-sm">

                @forelse($journals->take(5) as $journal)

                    @php

                        $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

                        $total =
                            ($marks->section_2a ?? 0) +
                            ($marks->section_2b ?? 0) +
                            ($marks->section_2c ?? 0) +
                            ($marks->section_2d ?? 0) +
                            ($marks->section_2e ?? 0) +
                            ($marks->section_3a ?? 0) +
                            ($marks->section_3b ?? 0) +
                            ($marks->section_3c ?? 0) +
                            ($marks->section_3d ?? 0) +
                            ($marks->section_4a ?? 0) +
                            ($marks->section_4b ?? 0);

                        $average = round($total / 11, 1);

                        if ($average >= 8) {

                            $status = 'Legitimate';
                            $badge = 'bg-green-100 text-green-700';

                        } elseif ($average >= 5) {

                            $status = 'Questionable';
                            $badge = 'bg-yellow-100 text-yellow-700';

                        } else {

                            $status = 'Suspected Predatory';
                            $badge = 'bg-red-100 text-red-700';
                            

                        }

                    @endphp

                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- JOURNAL -->
                        <td class="py-4">

                            <div>
                                <h4 class="font-semibold text-gray-800">
                                    {{ $journal->name }}
                                </h4>

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $journal->publisher }}
                                </p>
                            </div>

                        </td>

                        <!-- SCORE -->
                        <td>

                            <span class="font-bold text-indigo-600">
                                {{ $average }}/10
                            </span>

                        </td>

                        <!-- STATUS -->
                        <td>

                            <span class="{{ $badge }} px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $status }}
                            </span>

                        </td>

                        <!-- DATE -->
                        <td class="text-gray-500">

                            {{ $journal->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="py-10 text-center">

                            <div class="text-gray-500">

                                <p class="font-semibold text-gray-700">
                                    No journal screening found
                                </p>

                                <p class="text-sm mt-1">
                                    Start by adding your first journal screening.
                                </p>

                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>
            </table>

        </div>

        <!-- Right Side -->
        <div class="space-y-6">

            <!-- User Card -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">
                    User Information
                </h2>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Name</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold">{{ Auth::user()->email }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="font-semibold">
                            {{ Auth::user()->role->name ?? 'User' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-indigo-50 rounded-2xl shadow-md p-6 border border-indigo-100">
                <h2 class="text-lg font-bold text-indigo-700 mb-3">
                    Ethical Foundations 
                    <br>
                    Maqasid al-Shariah
                </h2>

                <ul class="space-y-2 text-sm text-gray-700">
                    <li>✔ Hifz al-'Aql (Intellect)</li>
                    <li>✔ Hifz al-Mal (Wealth)</li>
                    <li>✔ Hifz al-Nasf (Lineage)</li>
                    <li>✔ Hifz al-Din (Religion)</li>
                    <li>✔ Hifz al-Nafs (Life)</li>
                </ul>
            </div>

        </div>

    </div>

</x-app-layout>