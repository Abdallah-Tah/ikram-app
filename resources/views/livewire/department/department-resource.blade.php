<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department') }}
        </h2>
    </x-slot>
    <div class="py-2 space-y-2">
        <div class="flex flex-col">
            <div class="flex flex-row justify-between p-4">
                <input wire:model="search" type="text" placeholder="Search..." wire:model="search"
                    class="flex left-2 w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm" />

                <x-jet-button wire:click="showModal"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('Add New') }}
                </x-jet-button>
            </div>
            <x-notification />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg responsive-table">
                <div class="w-full overflow-x-auto">
                    <table class="min-w-max w-full table-auto">
                        <div class="flex justify-between px-6 py-3">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700">Showing</span>
                                    <select wire:model="perPage"
                                        class="mx-2 border rounded-md form-select form-select-sm text-gray-600 text-sm">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>15</option>
                                        <option>20</option>
                                        <option>25</option>
                                        <option>30</option>
                                    </select>
                                    <span class="text-sm text-gray-700">Entries</span>
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr class="bg-green-600 text-gray-200 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left" wire:click="sortBy('name')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Name</span>
                                        @include('partials.sort-icon', ['field' => 'name'])
                                    </div>
                                </th>
                                <th class="py-0 px-2 text-left" wire:click="sortBy('created_at')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Created At</span>
                                        @include('partials.sort-icon', ['field' => 'created_at'])
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-center justify-center">
                                    <span class="font-semibold">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($departments as $department)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $department->name }}</span>
                                        </div>
                                    </td>    
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $department->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </td>                                 
                                    <td class="py-3 px-6 text-left whitespace-nowrap flex justify-center">
                                        <div class="flex items-center">
                                            <x-jet-button wire:click="editDepartment({{ $department->id }})">
                                                {{ __('Edit') }}
                                            </x-jet-button>
                                            <x-jet-danger-button class="ml-2"
                                                wire:click="showDeleteModal({{ $department->id }})">
                                                {{ __('Delete') }}
                                            </x-jet-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-3 px-6 text-center">
                                        No records found!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-6 py-3">
                {{ $departments->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Department') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($departmentId)
                <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="storeDepartment" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Modal -->
    <x-jet-dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Delete Department') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this department?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
