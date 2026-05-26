<x-app-layout>

@php
    $scores = [
        'Indexing Status' => $marks->section_2a ?? 0,
        'Peer Review Process' => $marks->section_2b ?? 0,
        'Editorial Board Verification' => $marks->section_2c ?? 0,
        'APC / Fee Transparency' => $marks->section_2d ?? 0,
        'Publication Ethics Guidelines' => $marks->section_2e ?? 0,
        'Spam / Mass Invitation' => $marks->section_3a ?? 0,
        'Rapid Publication Promise' => $marks->section_3b ?? 0,
        'Suspicious Indexing Claims' => $marks->section_3c ?? 0,
        'Misleading Website Information' => $marks->section_3d ?? 0,
        'Ethical Publishing Practices' => $marks->section_4a ?? 0,
        'Research Integrity Risk' => $marks->section_4b ?? 0,
    ];

    $total = array_sum($scores);
    $average = round($total / count($scores), 1);

    if ($average >= 8) {
        $classification = 'Legitimate';
        $riskLevel = 'Low Risk';
        $color = 'green';
        $recommendation = 'This journal shows lower predatory risk indicators based on the submitted screening criteria.';
        
    } elseif ($average >= 5) {
        $classification = 'Questionable';
        $riskLevel = 'Medium Risk';
        $color = 'yellow';
        $recommendation = 'This journal has several areas that require further checking. Review the journal carefully before making a submission decision.';
    } else {
        $classification = 'Suspected Predatory';
        $riskLevel = 'High Risk';
        $color = 'red';
        $recommendation = 'This journal shows strong predatory risk indicators. Further verification is strongly recommended before submitting any manuscript.';
       
    }
@endphp

<div class="space-y-6">

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold">Screening Result</h1>
                <p class="mt-2 text-indigo-100">
                    Full journal credibility screening report.
                </p>
            </div>

            <div class="flex items-center gap-3">
    
                <a href="{{ route('results.index') }}"
                class="inline-flex items-center gap-2 bg-white text-indigo-700 px-5 py-3 rounded-xl font-semibold shadow-md hover:bg-indigo-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                    Back to Results
                </a>

                <a href="{{ route('results.pdf', $journal->id) }}"
                class="inline-flex items-center gap-2 bg-white text-indigo-700 px-5 py-3 rounded-xl font-semibold shadow-md hover:bg-indigo-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                </svg>
                    Export PDF
                </a>

            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $journal->name }}
                </h2>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-600">
                    <p><strong>ISSN:</strong> {{ $journal->issn }}</p>
                    <p><strong>Publisher:</strong> {{ $journal->publisher }}</p>
                    <p><strong>Country:</strong> {{ $journal->country->name ?? '-' }}</p>
                    <p><strong>Website:</strong> {{ $journal->website }}</p>
                </div>
            </div>

            <div class="rounded-2xl p-6 border
                {{ $color == 'red' ? 'bg-red-50 border-red-200' : '' }}
                {{ $color == 'yellow' ? 'bg-yellow-50 border-yellow-200' : '' }}
                {{ $color == 'green' ? 'bg-green-50 border-green-200' : '' }}">

                <p class="text-sm font-semibold uppercase
                    {{ $color == 'red' ? 'text-red-600' : '' }}
                    {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                    {{ $color == 'green' ? 'text-green-600' : '' }}">
                    {{ $riskLevel }}
                </p>

                <h3 class="text-5xl font-bold mt-2
                    {{ $color == 'red' ? 'text-red-600' : '' }}
                    {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                    {{ $color == 'green' ? 'text-green-600' : '' }}">
                    {{ $average }}<span class="text-xl">/10</span>
                </h3>

                <p class="text-sm text-gray-600 mt-2">
                    Average Risk Score
                </p>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4
            {{ $color == 'red' ? 'border-red-500' : '' }}
            {{ $color == 'yellow' ? 'border-yellow-500' : '' }}
            {{ $color == 'green' ? 'border-green-500' : '' }}">
            <p class="text-sm text-gray-500">Classification</p>
            <h3 class="text-2xl font-bold mt-2
                {{ $color == 'red' ? 'text-red-600' : '' }}
                {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                {{ $color == 'green' ? 'text-green-600' : '' }}">
                {{ $classification }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-indigo-500">
            <p class="text-sm text-gray-500">Average Score</p>
            <h3 class="text-2xl font-bold mt-2 text-indigo-600">
                {{ $average }}/10
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4
            {{ $color == 'red' ? 'border-red-500' : '' }}
            {{ $color == 'yellow' ? 'border-yellow-500' : '' }}
            {{ $color == 'green' ? 'border-green-500' : '' }}">
            <p class="text-sm text-gray-500">Risk Level</p>
            <h3 class="text-2xl font-bold mt-2
                {{ $color == 'red' ? 'text-red-600' : '' }}
                {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                {{ $color == 'green' ? 'text-green-600' : '' }}">
                {{ $riskLevel }}
            </h3>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2 bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Indicator Scoring Summary
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">No.</th>
                            <th class="px-4 py-3 text-left">Indicator</th>
                            <th class="px-4 py-3 text-left">Score</th>
                            <th class="px-4 py-3 text-left">Risk</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach($scores as $label => $score)
                            @php
                                if ($score >= 8) {
                                    $rowRisk = 'Low Risk';
                                    $rowColor = 'green';
                                } elseif ($score >= 5) {
                                    $rowRisk = 'Medium Risk';
                                    $rowColor = 'yellow';
                                } else {
                                    $rowRisk = 'High Risk';
                                    $rowColor = 'red';
                                    
                                }
                            @endphp

                            <tr>
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-medium text-gray-700">{{ $label }}</td>
                                <td class="px-4 py-3 font-bold">{{ $score }}/10</td>
                                <td class="px-4 py-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $rowColor == 'red' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $rowColor == 'yellow' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $rowColor == 'green' ? 'bg-green-100 text-green-700' : '' }}">
                                        {{ $rowRisk }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="2" class="px-4 py-4 font-bold text-gray-800">Average Score</td>
                            <td colspan="2" class="px-4 py-4 font-bold text-indigo-700">
                                {{ $average }}/10
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Score Distribution
            </h2>

            <div class="flex justify-center">
                <div class="relative w-56 h-56 rounded-full flex items-center justify-center
                    {{ $color == 'red' ? 'bg-red-100' : '' }}
                    {{ $color == 'yellow' ? 'bg-yellow-100' : '' }}
                    {{ $color == 'green' ? 'bg-green-100' : '' }}">
                    <div class="bg-white w-36 h-36 rounded-full flex flex-col items-center justify-center shadow-inner">
                        <span class="text-4xl font-bold
                            {{ $color == 'red' ? 'text-red-600' : '' }}
                            {{ $color == 'yellow' ? 'text-yellow-600' : '' }}
                            {{ $color == 'green' ? 'text-green-600' : '' }}">
                            {{ $average }}
                        </span>
                        <span class="text-xs text-gray-500">/10</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-3 text-sm">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    <span>1.0–4.9 Low Risk / Legitimate</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                    <span>5.0–7.9 Medium Risk / Questionable</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-red-500"></span>
                    <span>8.0–10.0 High Risk / Suspected Predatory</span>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Recommendation
        </h2>

        <div class="rounded-2xl p-5
            {{ $color == 'red' ? 'bg-red-50 border border-red-100' : '' }}
            {{ $color == 'yellow' ? 'bg-yellow-50 border border-yellow-100' : '' }}
            {{ $color == 'green' ? 'bg-green-50 border border-green-100' : '' }}">
            <p class="text-gray-700 leading-relaxed">
                {{ $recommendation }}
            </p>
        </div>
    </div>

</div>

</x-app-layout>