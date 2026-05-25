<x-app-layout>

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <h1 class="text-3xl font-bold">{{ $journal->name }}</h1>
        <p class="mt-2 text-indigo-100">
            Journal information and screening mark summary.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Journal Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Journal Name</p>
                <p class="font-semibold text-gray-800">{{ $journal->name }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Website</p>
                <p class="font-semibold text-gray-800">{{ $journal->website }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Publisher</p>
                <p class="font-semibold text-gray-800">{{ $journal->publisher }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">ISSN</p>
                <p class="font-semibold text-gray-800">{{ $journal->issn }}</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-500">Country</p>
                <p class="font-semibold text-gray-800">{{ $journal->country->name ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Screening Mark Summary</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            @foreach([
                'section_2a' => '2A - Indexing',
                'section_2b' => '2B - Peer Review',
                'section_2c' => '2C - Editorial Board',
                'section_2d' => '2D - APC Transparency',
                'section_2e' => '2E - Ethics Guidelines',
                'section_3a' => '3A - Spam Invitation',
                'section_3b' => '3B - Rapid Publication',
                'section_3c' => '3C - Fake Impact Claims',
                'section_3d' => '3D - Misleading Website',
                'section_4a' => '4A - Ethical Publishing',
                'section_4b' => '4B - Research Integrity Risk',
            ] as $field => $label)
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-gray-500">{{ $label }}</p>
                    <p class="font-bold text-gray-800">{{ $marks->$field ?? '-' }}/10</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <a href="{{ route('screen-journal.index') }}"
               class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl">
                Back
            </a>
        </div>
    </div>

</x-app-layout>