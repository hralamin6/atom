<div class=" rounded-xl mt-4" x-data="{openTable: $persist(true), modal: false, editMode: false}"
     x-init="
     $wire.on('openModal', (e) => {modal = true})
     $wire.on('openEditModal', (e) => {modal = true, editMode=true})
     $wire.on('closeModal', (e) => {modal = false, editMode=false})
     $wire.on('dataAdded', (e) => {
            modal = false
            editMode = false
            element = document.getElementById(e.dataId)
            console.log(element)
            element.scrollIntoView({behavior: 'smooth'})
            element.classList.add('bg-green-50')
            element.classList.add('dark:bg-gray-500')
            element.classList.add('animate-pulse')
            setTimeout(() => {
            element.classList.remove('bg-green-50')
            element.classList.remove('dark:bg-gray-500')
            element.classList.remove('animate-pulse')
            }, 5000)
            })
@if (session('scrollToComment'))
         const commentToScrollTo = document.getElementById({{session('scrollToComment')}})
            commentToScrollTo.scrollIntoView({ behavior: 'smooth'})
            commentToScrollTo.classList.add('bg-green-50')
            setTimeout(() => {
                commentToScrollTo.classList.remove('bg-green-50')
            }, 5000)
        @endif"
     @open-delete-modal.window="
     model = event.detail.model
     eventName = event.detail.eventName
Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit(eventName, model )
                }
            })
">
    <aside class="border dark:border-gray-600 row-span-4 bg-white dark:bg-darkSidebar" x-data="{rows: @entangle('selectedRows').defer, selectPage: @entangle('selectPageRows')}">
        <div class="flex justify-between gap-3 bg-white border dark:border-gray-600 dark:bg-darkSidebar px-4 py-2">
            <p class="text-gray-600 dark:text-gray-200">Quiz Table</p>
            <div class="flex justify-center gap-4 text-gray-500 dark:text-gray-300 capitalize">
                @if(auth()->id()==1)

                <button @click="$wire.openModal()" class="px-1 mt-1 mb-0.5 text-white pb-0.5 font-semibold text-xs bg-pink-400 rounded-lg">@lang('add new')</button>
                <button class="" @click="openTable = !openTable">
                    <svg x-show="openTable" xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="!openTable" xmlns="http://www.w3.org/2000/svg" class="h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
                <div x-cloak x-show="rows.length > 0 " class="flex items-center justify-center" x-data="{bulk: false}">
                    <div class="relative inline-block">
                        <!-- Dropdown toggle button -->
                        <button @click="bulk=!bulk" class="relative z-10 block px-2 text-gray-700 border border-transparent rounded-md dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-800 dark:text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="bulk" class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800" @click.outside="bulk= false">
                            <a @click="$dispatch('open-delete-modal', { title: 'Hello World!', text: 'you cant revert', icon: 'error', eventName: 'deleteMultiple', model: '' })" class="cursor-pointer block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                your profile </a>
                            <a wire:click.prevent="" class="cursor-pointer block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                Your projects </a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
        <div x-cloak x-show="openTable" x-collapse>
            <div class="mb-1 overflow-y-scroll scrollbar-none">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-300 dark:bg-darkSidebar"
                        >
                            <th class="px-4 py-3">
                                <input class="ring-0 dark:bg-gray-400" x-model="selectPage" type="checkbox" value="" name="todo2" id="todoCheck2">
                            </th>
                            <th class="px-4 py-3">@lang('sl')</th>
                            <th class="px-4 py-3">@lang('name')</th>
                            <th class="px-4 py-3">@lang('total question')</th>
                            <th class="px-4 py-3">@lang('seconds per question')</th>
                            <th class="px-4 py-3">@lang('created at')</th>
                            <th class="px-4 py-3">@lang('date time')</th>
                            <th class="px-4 py-3">@lang('action')</th>
                        </tr>
                        </thead>
                        <tbody
                            class="bg-white divide-y dark:divide-gray-700 dark:bg-darkSidebar"
                        >
                        @forelse($items as $i => $item)
                            <tr id="item-id-{{$item->id}}" class="text-gray-700 dark:text-gray-300 capitalize" :class="{'bg-gray-200 dark:bg-gray-600': rows.includes('{{$item->id}}') }">
                                <td class="px-4 py-3">
                                    <input x-model="rows" class="ring-none dark:bg-gray-400" type="checkbox" value="{{ $item->id }}" name="todo2" id="{{ $item->id }}">
                                </td>
                                <td class="px-4 py-3">{{$items->firstItem() + $i}}</td>
                                <td class="px-4 py-3 text-sm">{{$item->name}}</td>
                                <td class="px-4 py-3 text-xs">{{$item->total_question}}</td>
                                <td class="px-4 py-3 text-xs">{{$item->seconds_per_item}}</td>

                                <td class="px-4 py-3 text-xs">{{$item->created_at->diffForHumans()}}</td>
                                <td class="px-4 py-3 text-xs">{{$item->date_time}}</td>
                                <td class="px-4 py-3 text-sm flex space-x-4">
                                    @auth
                                        @if(auth()->id()==1)
                                    <a href="{{route('admin.question.option.create', $item)}}">Create</a>
                                    <a href="{{route('admin.question.option.edit', $item)}}">Edit</a>
                                        @endif
                                    @endauth
                                    @if($item->date_time<=now())
                                        <a href="{{route('admin.question.option.exam', $item)}}"><x-h-o-arrows-expand class="w-5 text-indigo-600 cursor-pointer"/></a>
                                    @endif
                                    <a href="{{route('admin.question.option.result', $item)}}"><x-h-o-home class="w-5 text-indigo-600 cursor-pointer"/></a>
                                        @if(auth()->id()==1)
                                        <x-h-o-pencil-alt @click="$wire.loadData({{$item->id}})" class="w-5 text-purple-600 cursor-pointer"/>
                                    <x-h-o-trash @click.prevent="$dispatch('open-delete-modal', { title: 'Hello World!', text: 'you cant revert', icon: 'error', eventName: 'deleteSingle', model: {{$item->id}} })" class="w-5 text-pink-500 cursor-pointer"/>
                                        @endif
                                </td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mx-auto my-4 px-4">
                    {{--                    {{ $items->links('vendor.pagination.default') }}--}}
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </aside>

    <div x-cloak x-show="modal">
        <div class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
        <div  class="inset-0 py-4 rounded-2xl transition duration-150 ease-in-out z-50 absolute" id="modal">
            <div @click.outside="modal= false, editMode = false" class="container mx-auto w-11/12 md:w-2/3 max-w-lg ">
                <form @submit.prevent="editMode? $wire.editData(): $wire.saveData()" class="relative py-3 px-5 md:px-10 bg-white dark:bg-darkSidebar shadow-md rounded border border-gray-400 dark:border-gray-600 capitalize">
                    @auth
                        @if(auth()->id()==1)
                            <h1 x-cloak x-show="!editMode" class="text-gray-800 dark:text-gray-200 font-lg font-bold tracking-normal text-center leading-tight mb-4">@lang('add new data')</h1>
                            <h1 x-cloak x-show="editMode" class="text-gray-800 dark:text-gray-200 font-lg font-bold tracking-normal text-center leading-tight mb-4">@lang('edit this data')</h1>
                        @endif
                    @endauth


                    <label for="name" class="text-gray-800 dark:text-gray-200 text-sm font-bold leading-tight tracking-normal">@lang('name')</label>
                    <input wire:model.lazy="name" class="mb-1 mt-2 text-gray-600 dark:text-gray-300 focus:outline-none focus:border focus:border-indigo-700 font-normal dark:bg-darkBg w-full h-10 flex items-center pl-3 text-sm border-gray-300 dark:border-gray-600 rounded border"/>
                    @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    <label for="name" class="text-gray-800 dark:text-gray-200 text-sm font-bold leading-tight tracking-normal">@lang('data time')</label>
                    <input type="datetime-local" wire:model.lazy="date_time" class="mb-1 mt-2 text-gray-600 dark:text-gray-300 focus:outline-none focus:border focus:border-indigo-700 font-normal dark:bg-darkBg w-full h-10 flex items-center pl-3 text-sm border-gray-300 dark:border-gray-600 rounded border"/>
                    @error('date_time')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    <div class="w-full">
                        <div class="flex flex-2 gap-2">
                            <div>
                                <label for="name" class="text-gray-800 dark:text-gray-200 text-sm font-bold leading-tight tracking-normal">@lang('total question')</label>
                                <input type="number" wire:model.lazy="total_question" class="mb-1 mt-2 text-gray-600 dark:text-gray-300 focus:outline-none focus:border focus:border-indigo-700 font-normal dark:bg-darkBg w-full h-10 flex items-center pl-3 text-sm border-gray-300 dark:border-gray-600 rounded border"/>
                                @error('total_question')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="name" class="text-gray-800 dark:text-gray-200 text-sm font-bold leading-tight tracking-normal">@lang('seconds per question')</label>
                                <input wire:model.lazy="seconds_per_item" class="mb-1 mt-2 text-gray-600 dark:text-gray-300 focus:outline-none focus:border focus:border-indigo-700 font-normal dark:bg-darkBg w-full h-10 flex items-center pl-3 text-sm border-gray-300 dark:border-gray-600 rounded border"/>
                                @error('seconds_per_item')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center justify-between w-full mt-4">
                        <button type="button" @click="modal= false, editMode = false" class="bg-red-600 focus:ring-gray-400 transition duration-150 text-white ease-in-out hover:bg-red-300 rounded px-8 py-2 text-sm">Cancel</button>
                        <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

