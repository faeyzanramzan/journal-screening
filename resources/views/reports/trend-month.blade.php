<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">
            Journals Screened in {{ $monthName }} {{ $year }}
        </h1>
        <p class="mt-2 text-indigo-100">
            List of journal screenings for the selected month.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left">No.</th>
                    <th class="px-6 py-4 text-left">Journal</th>
                    <th class="px-6 py-4 text-left">Publisher</th>
                    <th class="px-6 py-4 text-left">Country</th>
                    <th class="px-6 py-4 text-left">Score</th>
                    <th class="px-6 py-4 text-left">Risk</th>
                    <th class="px-6 py-4 text-left">Date</th>
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
                        $risk = 'Low Risk';
                        $riskClass = 'bg-green-100 text-green-700';
                    } elseif ($average >= 5) {
                        $risk = 'Medium Risk';
                        $riskClass = 'bg-yellow-100 text-yellow-700';
                    } else {
                        $risk = 'High Risk';
                        $riskClass = 'bg-red-100 text-red-700';
                        
                    }
                @endphp

                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $journal->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $journal->publisher }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $journal->country->name ?? '-' }}</td>
                        <td class="px-6 py-4 font-bold text-indigo-600">
                            {{ $average }}/10
                        </td>

                        <td class="px-6 py-4">
                            <span class="{{ $riskClass }} px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $risk }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-600">{{ $journal->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            No journals found for this month.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('reports.trend') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl">
            Back
        </a>
    </div>

</x-app-layout>