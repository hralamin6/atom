<div class="container mx-auto grid" x-data="{rows: @entangle('selectedRows').defer, selectPage: @entangle('selectPageRows')}">
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto text-[12px] md:text-sm">
            <div class="w-24 flex justify-between gap-2 mb-2">
                <div class="mt-1 rounded-md shadow-sm">
                    <input placeholder="per page" wire:model.debounce.1000ms="itemPerPage" type="number"  class="input border border-indigo-400 dark:placeholder-white input-sm dark:text-white dark:bg-gray-600" />
                </div>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input  placeholder="search" wire:model.debounce="search"  class="input input-sm  border border-indigo-400 dark:placeholder-white dark:text-white dark:bg-gray-600"/>
                    </div>
                <div class="mt-1 rounded-md shadow-sm">
                    <select wire:model="searchBy" class="select dark:text-white dark:bg-gray-600 text-xs border border-indigo-400 select-sm text-xs select-sm max-w-xs">
                        @foreach(\Illuminate\Support\Facades\Schema::getColumnListing('atoms') as $i=> $col)
                            @if($col!='summary' && $col!='discovered_by' && $col!='source' && $col!='created_at' && $col!='updated_at')
                                <option value="{{$col}}">{{$col}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @error('itemPerPage')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
{{--                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'id'"> Sl </x-field>--}}
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'number'"> number </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'symbol'"> symbol </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'name'"> name </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'xpos'"> group </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'ypos'"> period </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'phase'"> phase </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'phase'"> shells </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'category'"> category </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'atomic_mass'"> mass </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'atomic_mass'"> density </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'atomic_mass'"> molar heat </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'atomic_mass'"> affinity </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'atomic_mass'"> configuration </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'atomic_mass'"> boiling point </x-field>
                    <x-field :OB="$orderBy" :OD="$orderDirection" :field="'atomic_mass'"> melting point </x-field>
                </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                @foreach($atoms as $i => $atom)

                    <tr id="atom-id-{{$atom->id}}" class="text-gray-700 dark:text-gray-300 capitalize" :class="{'bg-gray-200 dark:bg-gray-600': rows.includes('{{$atom->id}}') }">
{{--                        <td class="px-4 py-3">{{$atoms->firstItem() + $i}}</td>--}}
                        <td class="p-2">{{$atom->number}}</td>
                        <td class="p-2">{{$atom->symbol}}</td>
                        <td class="p-2">{{$atom->name}}</td>
                        <td class="p-2">{{$atom->group}}</td>
                        <td class="p-2">{{$atom->period}}</td>
                        <td class="p-2">{{$atom->phase}}</td>
                        <td class="p-2">{{$atom->shells}}</td>
                        <td class="p-2 {{$atom->gettype()}} ">{{$atom->category}}</td>
                        <td class="p-2">{{number_format($atom->mass, 2)}}</td>
                        <td class="p-2">{{number_format($atom->density, 2)}}</td>
                        <td class="p-2">{{number_format($atom->molar_heat, 2)}}</td>
                        <td class="p-2">{{number_format($atom->electron_affinity, 2)}}</td>
                        <td class="p-2">{{$atom->electron_configuration}}</td>
                        <td class="p-2">{{$atom->boiling_point}}</td>
                        <td class="p-2">{{$atom->melting_point}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="items-center text-center mx-auto my-8">
            {{ $atoms->links() }}
        </div>
    </div>
</div>
