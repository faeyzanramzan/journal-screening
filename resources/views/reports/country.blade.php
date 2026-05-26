<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">Country Analysis Report</h1>
        <p class="mt-2 text-indigo-100">
            Visual analysis of journal screening results based on publisher country.
        </p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Horizontal Bar Visualization -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Country Risk Distribution
            </h2>

            <div class="space-y-6">
                @forelse($countryReports as $report)
                    @php
                        $max = max($report['total'], 1);
                        $legitimateWidth = ($report['legitimate'] / $max) * 100;
                        $questionableWidth = ($report['questionable'] / $max) * 100;
                        $predatoryWidth = ($report['predatory'] / $max) * 100;
                    @endphp

                    <div>
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold text-gray-800">
                                {{ $report['country'] }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $report['total'] }} journals
                            </p>
                        </div>

                        <div class="h-5 w-full bg-gray-100 rounded-full overflow-hidden flex">
                            <div class="bg-green-500 h-full"
                                 style="width: {{ $legitimateWidth }}%">
                            </div>

                            <div class="bg-yellow-400 h-full"
                                 style="width: {{ $questionableWidth }}%">
                            </div>

                            <div class="bg-red-500 h-full"
                                 style="width: {{ $predatoryWidth }}%">
                            </div>
                        </div>

                        <div class="flex gap-4 mt-2 text-xs text-gray-500">
                            <span>Legitimate: {{ $report['legitimate'] }}</span>
                            <span>Questionable: {{ $report['questionable'] }}</span>
                            <span>Predatory: {{ $report['predatory'] }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-10">
                        No visualization data available.
                    </p>
                @endforelse
            </div>
        </div>

        <!-- Legend -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Risk Legend
            </h2>

            <div class="space-y-4 text-sm">
                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-full bg-green-500"></span>
                    <span>Legitimate / Low Risk</span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-full bg-yellow-400"></span>
                    <span>Questionable / Medium Risk</span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="w-4 h-4 rounded-full bg-red-500"></span>
                    <span>Suspected Predatory / High Risk</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Ranking Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mt-6">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">
                Country Ranking Table
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Countries ranked by total screened journals.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left">Rank</th>
                        <th class="px-6 py-4 text-left">Country</th>
                        <th class="px-6 py-4 text-left">Total</th>
                        <th class="px-6 py-4 text-left">Legitimate</th>
                        <th class="px-6 py-4 text-left">Questionable</th>
                        <th class="px-6 py-4 text-left">Suspected Predatory</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse(collect($countryReports)->sortByDesc('total') as $report)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-indigo-600">
                                #{{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $report['country'] }}
                            </td>

                            <td class="px-6 py-4 font-bold text-blue-600">
                                {{ $report['total'] }}
                            </td>

                            <td class="px-6 py-4 text-green-600 font-semibold">
                                {{ $report['legitimate'] }}
                            </td>

                            <td class="px-6 py-4 text-yellow-500 font-semibold">
                                {{ $report['questionable'] }}
                            </td>

                            <td class="px-6 py-4 text-red-600 font-semibold">
                                {{ $report['predatory'] }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                No country analysis data available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>