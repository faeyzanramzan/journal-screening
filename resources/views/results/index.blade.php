<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">

        <h1 class="text-3xl font-bold">
            Screening Results
        </h1>

        <p class="mt-2 text-indigo-100">
            View all journal screening evaluation results and credibility analysis.
        </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

    <!-- TOTAL -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Total Screened
                </p>

                <h2 class="text-3xl font-bold mt-2 text-blue-600">
                    {{ $totalScreened }}
                </h2>
            </div>

        </div>
    </div>

    <!-- LEGITIMATE -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Legitimate
                </p>

                <h2 class="text-3xl font-bold mt-2 text-green-600">
                    {{ $legitimate }}
                </h2>

                <p class="text-xs text-green-500 mt-2 font-medium">
                    Low Risk (1.0 – 4.9)
                </p>
            </div>
        </div>

    </div>

    <!-- QUESTIONABLE -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Questionable
                </p>

                <h2 class="text-3xl font-bold mt-2 text-yellow-500">
                    {{ $questionable }}
                </h2>

                <p class="text-xs text-yellow-500 mt-2 font-medium">
                    Medium Risk (5.0 – 7.9)
                </p>
            </div>

        </div>

    </div>

    <!-- PREDATORY -->
    <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-red-500">

        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Suspected Predatory
                </p>

                <h2 class="text-3xl font-bold mt-2 text-red-600">
                    {{ $predatory }}
                </h2>

                <p class="text-xs text-red-500 mt-2 font-medium">
                    High Risk (8.0 – 10.0)
                </p>
            </div>

        </div>

    </div>

</div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">

        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">
                Result List
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Final journal screening and trust evaluation summary.
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left">No.</th>
                        <th class="px-6 py-4 text-left">Journal Name</th>
                        <th class="px-6 py-4 text-left">Publisher</th>
                        <th class="px-6 py-4 text-left">Country</th>
                        <th class="px-6 py-4 text-left">Score</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($journals as $journal)

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
                                $riskLevel = 'Low Risk';
                                $statusColor = 'green';
                            } elseif ($average >= 5) {
                                $status = 'Questionable';
                                $riskLevel = 'Medium Risk';
                                $statusColor = 'yellow';
                            } else {
                                $status = 'High Risk';
                                $riskLevel = 'High Risk';
                                $statusColor = 'red';
                                
                            }

                        @endphp

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                <div>
                                    <h4 class="font-semibold text-gray-800">
                                        {{ $journal->name }}
                                    </h4>

                                    <p class="text-xs text-gray-500 mt-1">
                                        ISSN: {{ $journal->issn }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $journal->publisher }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $journal->country->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="font-bold text-indigo-700">
                                    {{ $average }}/10
                                </span>
                            </td>

                            <td class="px-6 py-4">

                                @if($statusColor == 'green')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $status }}
                                    </span>
                                @elseif($statusColor == 'yellow')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $status }}
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $status }}
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <a href="{{ route('results.show', $journal->id) }}"
                                   class="inline-flex items-center gap-2
                                          bg-indigo-50 hover:bg-indigo-100
                                          text-indigo-700 px-4 py-2 rounded-xl
                                          text-xs font-semibold transition">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-4 h-4"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12H9m12 0A9 9 0 113 12a9 9 0 0118 0z"/>
                                    </svg>

                                    See Result

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">

                                <h3 class="text-lg font-bold text-gray-800">
                                    No screening result available
                                </h3>

                                <p class="text-gray-500 mt-2">
                                    Submit a journal screening first.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>