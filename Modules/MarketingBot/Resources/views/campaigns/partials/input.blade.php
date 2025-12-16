<div class="space-y-1.5 mt-4">
    <label class="flex items-center gap-2 text-sm text-color-14 dark:text-white">
        {{ __('Variable :x' , ['x' => $item + 1]) }}
        <svg
            class="w-4 h-4 text-color-89 mb-0.5"
            fill="currentColor"
            viewBox="0 0 20 20">
            <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                clip-rule="evenodd"
            />
        </svg>
    </label>

    <input
        value="{{ $value }}"
        required
        @isset($event) oninput="{{ $event }}" @endisset
        name="{{ $name }}"
        type="text"
        placeholder="{{ $value }}"
        class="form-control w-full p-4 bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-xl text-sm font-normal focus:outline-none active:outline-none hover:border-color-89 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 text-color-14 dark:text-white"
    />
</div>