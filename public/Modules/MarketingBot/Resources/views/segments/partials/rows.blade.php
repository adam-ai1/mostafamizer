@foreach($segments as $segment)
<tr
        data-segment-id="{{ $segment->id }}"
        class="border-t border-color-89/10 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-purple-50/50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20"
>
    <td class="px-6 py-3 text-color-89 font-semibold whitespace-nowrap">
        {{ $segment->id }}
    </td>
    <td class="px-6 py-3 whitespace-nowrap text-color-14 dark:text-white">
        {{ $segment->name }}
    </td>
    <td class="px-6 py-3 text-right">
        <div class="flex items-center justify-end gap-2">
            <button
                    data-target="editModal-{{ $segment->id }}"
                    aria-label="{{ __('Edit segment') }} {{ $segment->name }}" title="{{ __('Edit segment') }}"
                    class="openModalBtn p-2 h-8 w-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center hover:from-blue-600 hover:to-blue-700 shadow-sm hover:shadow-blue-200 dark:hover:shadow-blue-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.862 4.487l1.651 1.651a2.121 2.121 0 010 3.001l-9.193 9.193a2.121 2.121 0 01-1.061.577l-3.388.678a.75.75 0 01-.887-.887l.678-3.388a2.121 2.121 0 01.577-1.061l9.193-9.193a2.121 2.121 0 013.001 0z" />
                </svg>
            </button>

            <button
                    data-target="deleteModal-{{ $segment->id }}"
                    aria-label="{{ __('Delete segment') }} {{ $segment->name }}" title="{{ __('Delete segment') }}"
                    class="openModalBtn p-2 h-8 w-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white flex items-center justify-center hover:from-red-600 hover:to-red-700 shadow-sm hover:shadow-red-200 dark:hover:shadow-red-900/50 transform hover:scale-105 transition duration-200 ease-in-out"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
        </div>
    </td>
</tr>
@endforeach