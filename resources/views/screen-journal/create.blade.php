
<x-app-layout>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
    <div
        x-data="{
        section: 1,
        confirmSubmit: false,

        form: {
            name: '',
            website: '',
            publisher: '',
            issn: '',
            country: '',
            section_2a: '',
            section_2b: '',
            section_2c: '',
            section_2d: '',
            section_2e: '',

            section_3a: '',
            section_3b: '',
            section_3c: '',
            section_3d: '',

            section_4a: '',
            section_4b: '',
        }
    }"
        class="space-y-6"
    >

        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 rounded-2xl shadow-lg p-8 text-white">
            <h1 class="text-3xl font-bold">Screen Journal</h1>
            <p class="mt-2 text-indigo-100">
                Complete each section step by step to calculate journal trust score.
            </p>
        </div>

        <!-- Progress -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                <button type="button"
                    @click="section = 1"
                    :class="section === 1 ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600'"
                    class="rounded-xl px-4 py-3 text-sm font-semibold">
                    1. Journal Info
                </button>

                <button type="button"
                    @click="section = 2"
                    :class="section === 2 ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600'"
                    class="rounded-xl px-4 py-3 text-sm font-semibold">
                    2. Credibility
                </button>

                <button type="button"
                    @click="section = 3"
                    :class="section === 3 ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600'"
                    class="rounded-xl px-4 py-3 text-sm font-semibold">
                    3. Behaviour
                </button>

                <button type="button"
                    @click="section = 4"
                    :class="section === 4 ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600'"
                    class="rounded-xl px-4 py-3 text-sm font-semibold">
                    4. Ethics
                </button>

                <button type="button"
                    @click="section = 5"
                    :class="section === 5 ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600'"
                    class="rounded-xl px-4 py-3 text-sm font-semibold">
                    5. Review
                </button>

            </div>
        </div>

        <form id="screeningForm" action="{{ route('screen-journal.store') }}" method="POST">
            @csrf

            <!-- SECTION 1 -->
            <div x-show="section === 1" class="space-y-6">

                <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-indigo-500">
                    <h2 class="text-xl font-bold text-gray-800">
                        SECTION 1 — JOURNAL INFORMATION
                    </h2>

                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                        Provide the core journal and publisher information to support
                        the credibility screening and trust evaluation process.

                        <br><br>

                        The information entered in this section will be used as the
                        foundational reference for assessing indexing status,
                        publisher transparency, publication practices,
                        and overall journal legitimacy.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Journal Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" required x-model="form.name"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Journal Website URL <span class="text-red-500">*</span>
                    </label>
                    <input type="url" name="website" required x-model="form.website"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Publisher Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="publisher" required x-model="form.publisher"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        ISSN <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="issn" required x-model="form.issn"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-4">
                        Country of Publisher <span class="text-red-500">*</span>
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($countries as $country)
                            <label class="flex items-center gap-3 bg-gray-50 rounded-xl px-4 py-3 border hover:border-indigo-400 cursor-pointer">
                                <input type="radio"
                                    name="country_id"
                                    value="{{ $country->id }}"
                                    x-model="form.country_id"
                                    @change="form.country = '{{ $country->name }}'"
                                    required
                                    class="text-indigo-600 focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">{{ $country->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button"
                        @click="section = 2"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-md">
                        Next: Credibility
                    </button>
                </div>

            </div>

            <!-- SECTION 2 -->
            <div x-show="section === 2" class="space-y-6">

                <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500">
                    <h2 class="text-xl font-bold text-gray-800">
                        SECTION 2 — INDEXING & CREDIBILITY
                    </h2>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                        Rate each criterion based on the journal's transparency,
                        indexing recognition, peer review quality, and publication credibility.

                        <br><br>

                        <span class="font-semibold text-red-500">1–4</span>
                        indicates weak credibility or possible predatory characteristics.

                        <br>

                        <span class="font-semibold text-yellow-500">5–7</span>
                        indicates moderate reliability requiring further verification.

                        <br>

                        <span class="font-semibold text-green-600">8–10</span>
                        indicates strong credibility and legitimate scholarly practices.
                    </p>
                </div>

                @php
                    $section2 = [
                        'section_2a' => 'Is the journal indexed in Scopus or Web of Science?',
                        'section_2b' => 'Does the journal clearly explain its peer review process?',
                        'section_2c' => 'Is the editorial board verifiable?',
                        'section_2d' => 'Does the journal provide transparent APC/publication fee information?',
                        'section_2e' => 'Does the journal provide publication ethics guidelines?',
                    ];
                @endphp

                @foreach($section2 as $name => $question)
                    @include('screen-journal.partials.rating-scale', [
                        'name' => $name,
                        'question' => $question,
                        'max' => 10
                    ])
                @endforeach

                <div class="flex justify-between">
                    <button type="button"
                        @click="section = 1"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-xl">
                        Back
                    </button>

                    <button type="button"
                        @click="section = 3"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-md">
                        Next: Behaviour
                    </button>
                </div>

            </div>

            <!-- SECTION 3 -->
            <div x-show="section === 3" class="space-y-6">

                <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500">
                    <h2 class="text-xl font-bold text-gray-800">
                        SECTION 3 — BEHAVIOURAL SIGNALS
                    </h2>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                        Evaluate the journal's behavioural patterns and publishing practices.

                        <br><br>

                        Lower scores reflect suspicious or unethical publishing behaviour,
                        while higher scores reflect trustworthy and professional conduct.

                        <br><br>

                        <span class="font-semibold text-red-500">1–4</span>
                        High predatory risk behaviour

                        <br>

                        <span class="font-semibold text-yellow-500">5–7</span>
                        Moderate concern indicators

                        <br>

                        <span class="font-semibold text-green-600">8–10</span>
                        Ethical and professional publishing behaviour
                    </p>
                </div>

                @php
                    $section3 = [
                        'section_3a' => 'Did you receive spam or mass invitation emails from this journal?',
                        'section_3b' => 'Does the journal promise extremely rapid publication?',
                        'section_3c' => 'Are there suspicious indexing or fake impact factor claims?',
                        'section_3d' => 'Does the journal website contain suspicious or misleading information?',
                    ];
                @endphp

                @foreach($section3 as $name => $question)
                    @include('screen-journal.partials.rating-scale', [
                        'name' => $name,
                        'question' => $question,
                        'max' => 10
                    ])
                @endforeach

                <div class="flex justify-between">
                    <button type="button"
                        @click="section = 2"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-xl">
                        Back
                    </button>

                    <button type="button"
                        @click="section = 4"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-md">
                        Next: Ethics
                    </button>
                </div>

            </div>

            <!-- SECTION 4 -->
            <div x-show="section === 4" class="space-y-6">

                <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">
                    <h2 class="text-xl font-bold text-gray-800">
                        SECTION 4 — MAQASID ETHICAL FILTER
                    </h2>
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                    Assess the journal's ethical responsibility, integrity,
                    and alignment with responsible scholarly publishing principles.

                    <br><br>

                    <span class="font-semibold text-red-500">1–4</span>
                    Serious ethical concerns detected

                    <br>

                    <span class="font-semibold text-yellow-500">5–7</span>
                    Partial ethical compliance

                    <br>

                    <span class="font-semibold text-green-600">8–10</span>
                    Strong ethical and responsible publishing standards
                </p>
                </div>

                @php
                    $section4 = [
                        'section_4a' => 'Does the journal demonstrate ethical and responsible publishing practices?',
                        'section_4b' => 'Does the journal potentially threaten research integrity?',
                    ];
                @endphp

                @foreach($section4 as $name => $question)
                    @include('screen-journal.partials.rating-scale', [
                        'name' => $name,
                        'question' => $question,
                        'max' => 10
                    ])
                @endforeach

                <div class="flex justify-between">
                    <button type="button"
                        @click="section = 3"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-xl">
                        Back
                    </button>

                    <button type="button"
                        @click="section = 5"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-md">
                        Next: Review
                    </button>
                </div>

            </div>

            <!-- SECTION 5 -->
            <div x-show="section === 5" class="space-y-6">

                <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">
                    <h2 class="text-xl font-bold text-gray-800">
                        SECTION 5 — REVIEW & SUBMIT
                    </h2>

                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                        Review the journal information and screening scores before submitting.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">
                        Journal Information Summary
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">Journal Name</p>
                            <p class="font-semibold text-gray-800" x-text="form.name || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">Website</p>
                            <p class="font-semibold text-gray-800" x-text="form.website || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">Publisher</p>
                            <p class="font-semibold text-gray-800" x-text="form.publisher || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">ISSN</p>
                            <p class="font-semibold text-gray-800" x-text="form.issn || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">Country</p>
                            <p class="font-semibold text-gray-800" x-text="form.country || '-'"></p>
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6">

                <h3 class="text-lg font-bold text-gray-800 mb-6">
                    Screening Score Summary
                </h3>

                <!-- SECTION 2 -->
                <div class="mb-8">

                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-blue-700">
                            SECTION 2 — INDEXING & CREDIBILITY
                        </h4>

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                            Credibility
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Indexed in Scopus / WoS
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_2a || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Peer Review Process
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_2b || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Editorial Board
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_2c || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                APC Transparency
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_2d || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Ethics Guidelines
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_2e || '-'"></p>
                        </div>

                    </div>

                </div>

                <!-- SECTION 3 -->
                <div class="mb-8">

                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-yellow-700">
                            SECTION 3 — BEHAVIOURAL SIGNALS
                        </h4>

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                            Behaviour
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Spam Invitation Emails
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_3a || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Rapid Publication
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_3b || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Fake Impact Claims
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_3c || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Misleading Website Info
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_3d || '-'"></p>
                        </div>

                    </div>

                </div>

                <!-- SECTION 4 -->
                <div>

                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-green-700">
                            SECTION 4 — MAQASID ETHICAL FILTER
                        </h4>

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                            Ethics
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Ethical Publishing Practice
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_4a || '-'"></p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-gray-500">
                                Research Integrity Risk
                            </p>

                            <p class="font-bold text-gray-800 mt-1"
                            x-text="form.section_4b || '-'"></p>
                        </div>

                    </div>

                </div>

            </div>

                <div class="flex justify-between">
    <button type="button"
        @click="section = 4"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-xl">
        Back
    </button>

    <button type="button"
        @click="confirmSubmit = true"
        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl shadow-md">
        Submit Screening
    </button>
</div>

<!-- Popup -->
<div x-show="confirmSubmit"
     x-cloak
     class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full mx-4">
        <h2 class="text-2xl font-bold text-gray-800">
            Confirm Submission
        </h2>

        <p class="text-gray-600 mt-3">
            Are you sure you want to submit this journal screening?
        </p>

        <div class="flex justify-end gap-3 mt-8">
            <button type="button"
                @click="confirmSubmit = false"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-xl">
                Cancel
            </button>

            <button type="button"
                onclick="document.getElementById('screeningForm').submit()"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow-md">
                Yes, Submit
            </button>
        </div>
    </div>
</div>

        </form>

    </div>

</x-app-layout>