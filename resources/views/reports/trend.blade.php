<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">Screening Trend Report</h1>
        <p class="mt-2 text-indigo-100">
            Monthly trend of journal screening activities.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">
            Monthly Screening Trend
        </h2>

        <div class="space-y-5">
            @forelse($monthlyData as $data)
                @php
                    $monthName = DateTime::createFromFormat('!m', $data->month)->format('F');
                    $max = max($monthlyData->max('total'), 1);
                    $width = ($data->total / $max) * 100;
                @endphp

                <div>
                    <div class="flex justify-between mb-2">
                        <p class="font-semibold text-gray-700">
                            {{ $monthName }} {{ $data->year }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $data->total }} screenings
                        </p>
                    </div>

                    <div class="w-full bg-gray-100 rounded-full h-5 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 h-5 rounded-full"
                             style="width: {{ $width }}%">
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-10">
                    No screening trend data available.
                </p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">
                Trend Data Table
            </h2>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left">No.</th>
                    <th class="px-6 py-4 text-left">Month</th>
                    <th class="px-6 py-4 text-left">Year</th>
                    <th class="px-6 py-4 text-left">Total Screenings</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($monthlyData as $data)
                    @php
                        $monthName = DateTime::createFromFormat('!m', $data->month)->format('F');
                    @endphp

                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $monthName }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $data->year }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('reports.trend.month', [$data->year, $data->month]) }}"
                            class="font-bold text-indigo-600 hover:underline">
                                {{ $data->total }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            No trend data available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>