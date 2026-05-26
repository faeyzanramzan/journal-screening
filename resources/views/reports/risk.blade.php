<x-app-layout>

    @php
        $legitimatePercent = round(($legitimate / $totalData) * 100);
        $questionablePercent = round(($questionable / $totalData) * 100);
        $predatoryPercent = round(($predatory / $totalData) * 100);
    @endphp

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">

        <h1 class="text-3xl font-bold">
            Risk Distribution Report
        </h1>

        <p class="mt-2 text-indigo-100">
            Overall risk percentage distribution of screened journals.
        </p>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Donut Style -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-md p-8">

            <h2 class="text-xl font-bold text-gray-800 mb-8">
                Journal Risk Distribution
            </h2>

            <div class="flex justify-center">

                <div class="relative w-80 h-80 rounded-full overflow-hidden">

                    <div class="absolute inset-0 rounded-full"
                        style="
                            background:
                            conic-gradient(
                                #22c55e 0% {{ $legitimatePercent }}%,
                                #facc15 {{ $legitimatePercent }}% {{ $legitimatePercent + $questionablePercent }}%,
                                #ef4444 {{ $legitimatePercent + $questionablePercent }}% 100%
                            );
                        ">
                    </div>

                    <div class="absolute inset-12 bg-white rounded-full flex flex-col items-center justify-center shadow-inner">

                        <h3 class="text-5xl font-bold text-indigo-600">
                            {{ $totalData }}
                        </h3>

                        <p class="text-gray-500 text-sm mt-2">
                            Total Journals
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Legend -->
        <div class="bg-white rounded-2xl shadow-md p-6">

            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Distribution Summary
            </h2>

            <div class="space-y-6">

                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-4 h-4 rounded-full bg-green-500"></span>
                            <span class="font-medium">Legitimate</span>
                        </div>

                        <span class="font-bold text-green-600">
                            {{ $legitimatePercent }}%
                        </span>
                    </div>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $legitimate }} journals
                    </p>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-4 h-4 rounded-full bg-yellow-400"></span>
                            <span class="font-medium">Questionable</span>
                        </div>

                        <span class="font-bold text-yellow-500">
                            {{ $questionablePercent }}%
                        </span>
                    </div>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $questionable }} journals
                    </p>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-4 h-4 rounded-full bg-red-500"></span>
                            <span class="font-medium">Suspected Predatory</span>
                        </div>

                        <span class="font-bold text-red-600">
                            {{ $predatoryPercent }}%
                        </span>
                    </div>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $predatory }} journals
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>