

<x-app-layout>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-6 py-4 rounded-2xl mb-6 shadow">
        {{ session('success') }}
    </div>
@endif

    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">Screen Journal</h1>
                <p class="mt-2 text-indigo-100">
                    View screened journals and start a new credibility evaluation.
                </p>
            </div>

            

            <a href="{{ route('screen-journal.create') }}"
               class="bg-white text-indigo-700 px-5 py-3 rounded-xl font-semibold shadow-md hover:bg-indigo-50 transition">
                + Add New Journal
            </a>
        </div>
    </div>

    <!-- <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Total Screened</p>
            <h2 class="text-3xl font-bold mt-2">0</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Legitimate</p>
            <h2 class="text-3xl font-bold mt-2 text-green-600">0</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Questionable</p>
            <h2 class="text-3xl font-bold mt-2 text-yellow-500">0</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Predatory Risk</p>
            <h2 class="text-3xl font-bold mt-2 text-red-600">0</h2>
        </div>
    </div> -->

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="p-6 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Marked Journal List</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Journals that have been screened will appear here.
                </p>
            </div>

           <form method="GET" action="{{ route('screen-journal.index') }}">

                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search journal..."
                    class="rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left">No.</th>
                        <th class="px-6 py-4 text-left">Journal Name</th>
                        <th class="px-6 py-4 text-left">Publisher</th>
                        <th class="px-6 py-4 text-left">Country</th>
                        <th class="px-6 py-4 text-left">Website</th>
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
                            $statusColor = 'green';
                        } elseif ($average >= 5) {
                            $status = 'Questionable';
                            $statusColor = 'yellow';
                        } else {
                            $status = 'Predatory Risk';
                            $statusColor = 'red';
                        }
                    @endphp

                    <tr class="hover:bg-gray-50 transition">

                        <!-- NO -->
                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $loop->iteration }}
                        </td>

                        <!-- JOURNAL -->
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

                        <!-- PUBLISHER -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $journal->publisher }}
                        </td>

                        <!-- COUNTRY -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $journal->country->name ?? '-' }}
                        </td>

                         <!-- WEBSITE -->
                        <td class="px-6 py-4 text-gray-700">
                            <a href="{{ $journal->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                                {{ $journal->website }}
                            </a>
                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-2">

                                <a href="{{ route('screen-journal.show', $journal->id) }}"
                                    class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-3 py-2 rounded-lg text-xs font-semibold transition">
                                        View
                                    </a>

                                    <form x-data="{ openDeleteModal: false }"
                                        action="{{ route('screen-journal.destroy', $journal->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <!-- Delete Button -->
                                        <button type="button"
                                            @click="openDeleteModal = true"
                                            class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-lg text-xs font-semibold transition">
                                            Delete
                                        </button>

                                        <!-- STYLE_JOURNAL Popup -->
                                        <div x-show="openDeleteModal"
                                            x-cloak
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">

                                            <div
                                                x-transition
                                                class="relative w-full max-w-md mx-4 overflow-hidden rounded-3xl bg-white shadow-2xl">

                                                <!-- Top Gradient -->
                                                <div class="bg-gradient-to-r from-red-500 to-rose-500 p-6 text-white">

                                                    <div class="flex items-center gap-4">

                                                        <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-md">

                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-7 h-7"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor">

                                                                <path stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-1-3H10a1 1 0 00-1 1v2h6V5a1 1 0 00-1-1z"/>
                                                            </svg>

                                                        </div>

                                                        <div>
                                                            <h2 class="text-2xl font-bold">
                                                                Delete Journal
                                                            </h2>

                                                            <p class="text-red-100 text-sm mt-1">
                                                                This action cannot be undone.
                                                            </p>
                                                        </div>

                                                    </div>

                                                </div>

                                                <!-- Content -->
                                                <div class="p-6">

                                                    <div class="bg-red-50 border border-red-100 rounded-2xl p-4">

                                                        <p class="text-gray-700 leading-relaxed">
                                                            Are you sure you want to permanently delete
                                                            this journal screening record?
                                                        </p>

                                                    </div>

                                                    <!-- Actions -->
                                                    <div class="flex justify-end gap-3 mt-8">

                                                        <button type="button"
                                                            @click="openDeleteModal = false"
                                                            class="px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">

                                                            Cancel

                                                        </button>

                                                        <button type="submit"
                                                            class="px-5 py-3 rounded-xl bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white font-semibold shadow-lg transition-all duration-300">

                                                            Yes, Delete

                                                        </button>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">

                            <div class="max-w-md mx-auto">

                                <h3 class="text-lg font-bold text-gray-800">
                                    No journal screened yet
                                </h3>

                                <p class="text-gray-500 mt-2">
                                    Start by adding a new journal and completing the screening sections.
                                </p>

                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>
            </table>
        </div>
    </div>

</x-app-layout>