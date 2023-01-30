<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
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
                                <th class="py-3 px-6 text-left" wire:click="sortBy('title')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Claim Number</span>
                                        @include('partials.sort-icon', ['field' => 'title'])
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-left" wire:click="sortBy('title')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Title</span>
                                        @include('partials.sort-icon', ['field' => 'title'])
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-left" wire:click="sortBy('title')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Department</span>
                                        @include('partials.sort-icon', ['field' => 'title'])
                                    </div>
                                </th>
                                {{-- <th class="py-3 px-6 text-left" wire:click="sortBy('title')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Problem Statement</span>
                                        @include('partials.sort-icon', ['field' => 'title'])
                                    </div>
                                </th> --}}
                                <th class="py-3 px-6 text-left" wire:click="sortBy('title')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Attachment</span>
                                        @include('partials.sort-icon', ['field' => 'title'])
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-left" wire:click="sortBy('title')" style="cursor: pointer;">
                                    <div class="flex items-center">
                                        <span class="font-semibold">Target Date</span>
                                        @include('partials.sort-icon', ['field' => 'target_date'])
                                    </div>
                                </th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($tickets as $ticket)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">
                                                
                                                <a href="{{ route('tickets.show', $ticket->id) }}"
                                                    class="text-green-600 hover:text-blue-600 underline">
                                                    {{ $ticket->claim_number }}
                                                </a>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $ticket->title }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $ticket->department->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">
                                                <a href="{{ asset('storage/' . $ticket->attachment) }}"
                                                    target="_blank">Download</a>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $ticket->target_date }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <x-jet-button wire:click="editTicket({{ $ticket->id }})">
                                                {{ __('Edit') }}
                                            </x-jet-button>
                                            {{-- <x-jet-danger-button class="ml-2"
                                                wire:click="delete({{ $ticket->id }})">
                                                {{ __('Delete') }}
                                            </x-jet-danger-button> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-3 px-6 text-center">
                                        No tickets found!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="px-6 py-4">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <x-jet-dialog-modal wire:model="showModal" maxWidth="7xl">
            <x-slot name="title">
                {{ __('Add Ticket') }}
            </x-slot>
            <x-slot name="content">
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text"
                            wire:model.debounce.500ms="title" name="title" required autofocus />
                        @error('title')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-jet-label for="target_date" value="{{ __('Target Date') }}" />
                        <x-jet-input id="target_date" class="block mt-1 w-full" type="date"
                            wire:model.debounce.500ms="target_date" name="target_date" required autofocus />
                        @error('target_date')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-jet-label for="department" value="{{ __('Department') }}" />
                        <select wire:model="department_id" name="department_id" id="department_id"
                            class="form-input w-full mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">Select</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-jet-label for="is_notified" value="{{ __('Requestor Notification') }}" />
                        <x-jet-input id="is_notified" class="block mt-1 w-sm" type="checkbox"
                            wire:model.debounce.500ms="is_notified" name="is_notified" required autofocus />
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-jet-label for="plan" value="{{ __('Plans Affected') }}" />
                        <select wire:model="plan_id" name="plan_id" id="plan_id"
                            class="form-input w-full mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">Select</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                            @endforeach
                        </select>
                        @error('plan')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <x-jet-label for="category" value="{{ __('Category') }}" />
                        <select wire:model="category_id" name="category_id" id="category_id"
                            class="form-input w-full mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">Select</option>
                            @foreach ($categories as $catagory)
                                <option value="{{ $catagory->id }}">{{ $catagory->name }}</option>
                            @endforeach
                        </select>
                        @error('catagory')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="claim_number" value="{{ __('Claim Number') }}" />
                    <x-jet-input id="claim_number" class="block mt-1 w-full" type="text"
                        wire:model.debounce.500ms="claim_number" name="claim_number" required autofocus />
                    @error('claim_number')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="problem_statement" value="{{ __('Problem Statement') }}" />
                    <x-textarea id="problem_statement" class="block mt-1 w-full" type="text"
                        wire:model.debounce.500ms="problem_statement" name="problem_statement" required autofocus
                        rows="4"></x-textarea>
                    @error('problem_statement')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="attachment" value="{{ __('Attachment') }}" />
                    <x-jet-input id="attachment" class="block mt-1 w-full" type="file"
                        wire:model.debounce.500ms="attachment" name="attachment" required autofocus />
                    @error('attachment')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                @if ($ticketId)
                    <x-jet-button class="ml-2" wire:click="updateTicket" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                @else
                    <x-jet-button class="ml-2" wire:click="storeTicket" wire:loading.attr="disabled">
                        {{ __('Create') }}
                    </x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>
    </div>

    <!-- Delete Modal -->
    <div>
        <x-jet-dialog-modal wire:model="showDeleteModal">
            <x-slot name="title">
                {{ __('Delete Ticket') }}
            </x-slot>
            <x-slot name="content">
                {{ __('Are you sure you want to delete this ticket?') }}
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
</div>
