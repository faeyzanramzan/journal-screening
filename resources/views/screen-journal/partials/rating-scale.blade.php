<div class="bg-white rounded-2xl shadow-md p-6">
    <label class="block text-sm font-semibold text-gray-800 mb-5">
        {{ $question }} <span class="text-red-500">*</span>
    </label>

    <div class="grid grid-cols-5 md:grid-cols-10 gap-3">
        @for($i = 1; $i <= $max; $i++)
            <label class="cursor-pointer">
                <input
                    type="radio"
                    name="{{ $name }}"
                    value="{{ $i }}"
                    required
                    class="hidden peer"
                    x-model="form.{{ $name }}">

                <div class="h-12 rounded-xl border border-gray-300 bg-gray-50
                    flex items-center justify-center text-sm font-bold text-gray-600
                    hover:border-indigo-500 hover:bg-indigo-50 hover:text-indigo-700
                    peer-checked:bg-gradient-to-r peer-checked:from-indigo-600 peer-checked:to-blue-500
                    peer-checked:text-white peer-checked:border-indigo-600
                    peer-checked:shadow-md transition-all duration-200">
                    {{ $i }}
                </div>
            </label>
        @endfor
    </div>

    <div class="flex justify-between mt-4 text-xs text-gray-500 font-medium">
        <span>Suspected Predatory</span>
        <span>Questionable</span>
        <span>Legitimate</span>
    </div>
</div>