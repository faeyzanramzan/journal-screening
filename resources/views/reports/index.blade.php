<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">Screening Summary Report</h1>
        <p class="mt-2 text-indigo-100">
            Overall summary of journal screening results and risk classification.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-6">

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Total Screened</p>
            <h2 class="text-4xl font-bold mt-2 text-blue-600">{{ $totalScreened }}</h2>
            <p class="text-sm text-gray-400 mt-2">Total screened journals</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Legitimate</p>
            <h2 class="text-4xl font-bold mt-2 text-green-600">{{ $legitimate }}</h2>
            <p class="text-sm text-gray-400 mt-2">Low Risk 1.0–4.9</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Questionable</p>
            <h2 class="text-4xl font-bold mt-2 text-yellow-500">{{ $questionable }}</h2>
            <p class="text-sm text-gray-400 mt-2">Medium Risk 5.0–7.9</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Suspected Predatory</p>
            <h2 class="text-4xl font-bold mt-2 text-red-600">{{ $predatory }}</h2>
            <p class="text-sm text-gray-400 mt-2">High Risk 8.0–10.0</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-indigo-500">
            <p class="text-sm text-gray-500">Average Score</p>
            <h2 class="text-4xl font-bold mt-2 text-indigo-600">{{ $overallAverage }}/10</h2>
            <p class="text-sm text-gray-400 mt-2">Overall average risk score</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Classification Guide
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-green-50 border border-green-100 rounded-2xl p-5">
                <h3 class="font-bold text-green-700">Legitimate</h3>
                <p class="text-sm text-gray-600 mt-2">Low Risk score between 1.0 and 4.9.</p>
            </div>

            <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-5">
                <h3 class="font-bold text-yellow-700">Questionable</h3>
                <p class="text-sm text-gray-600 mt-2">Medium Risk score between 5.0 and 7.9.</p>
            </div>

            <div class="bg-red-50 border border-red-100 rounded-2xl p-5">
                <h3 class="font-bold text-red-700">Suspected Predatory</h3>
                <p class="text-sm text-gray-600 mt-2">High Risk score between 8.0 and 10.0.</p>
            </div>
        </div>
    </div>

</x-app-layout>