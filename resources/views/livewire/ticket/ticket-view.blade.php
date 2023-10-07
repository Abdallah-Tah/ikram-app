<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket View') }}
        </h2>
    </x-slot>
    <div class="py-12 px-4">
        <x-notification />
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-lg">
            <table
                class="w-full border-collapse bg-green-100 text-left text-sm text-gray-500 border
            border-gray-200 rounded-lg p-4 mb-4">
                <tbody>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Title:</td>
                        <td>{{ $ticket->title }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Requestor Name:</td>
                        <td>{{ $ticket->requestor_name }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Department:</td>
                        <td>{{ $ticket->department->name }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Plan:</td>
                        <td>{{ $ticket->plan->name }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Category:</td>
                        <td>{{ $ticket->category->name }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Claim Number:</td>
                        <td>{{ $ticket->claim_number }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Target Date:</td>
                        <td>{{ $ticket->target_date }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Attachment:</td>
                        <td>
                            <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">View Attachment</a>
                        </td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Status:</td>
                        <td>
                            <span
                                class="inline-flex items-center m-2 px-3 py-1 bg-blue-200 hover:bg-blue-300 rounded-full text-sm font-semibold text-blue-600">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z" />
                                </svg>
                                <span class="ml-1">
                                    {{ $ticket->status }}
                                </span>
                            </span>
                        </td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Created At:</td>
                        <td>{{ $ticket->created_at }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Problem Statement:</td>
                        <td>{{ $ticket->problem_statement }}</td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Comments:</td>
                        <td>
                            @foreach ($ticketComments as $comment)
                                <hr class="mt-2 mb-2 border-green-600">
                                <div class="flex flex-col mb-2">
                                    <p class="text-gray-600 mb-2">
                                        <strong class="text-gray-800 flex items-center">
                                            {{ $comment->user->name }} - {{ $comment->created_at }}
                                            @if ($comment->user_id == Auth::user()->id)
                                            <a href="#" wire:click="showEditTicketCommentModal({{ $comment->id }})"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="w-5 h-5">
                                                <path
                                                    d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                <path
                                                    d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                            </svg>
                                        </a>
                                        <a href="#" wire:click="showDeleteTicketCommentModal({{ $comment->id }})"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                            @endif
                                        </strong>
                                    </p>
                                    <p class="text-gray-600">
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Add Comment:</td>
                        <td class="px-6 mt-8">
                            <textarea wire:model="comment" class="w-full border border-gray-300 p-2 rounded" rows="5"></textarea>
                            @error('comment')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr class="mb-6 px-6">
                        <td class="text-gray-600 px-6 py-2 font-bold">Attachment:</td>
                        <td>
                            <input type="file" wire:model="attachment"
                                class="w-full border border-gray-300 p-2 rounded">
                            @error('attachment')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr class="mb-6 p-2 px-4">
                        <td class="text-gray-600 px-6 py-2 font-bold"></td>
                        <td class="px-6 py-2">
                            <div class="flex justify-end pt-2">
                                <x-jet-button wire:click="storeTicketComment">Add Comment</x-jet-button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div>
    <x-jet-dialog-modal wire:model="showEditTicketCommentModal">
        <x-slot name="title">
            Edit Comment
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="comment" value="{{ __('Comment') }}" />
                <x-jet-input id="comment" class="block mt-1 w-full" type="text" wire:model="comment" />
                @error('comment')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showEditTicketCommentModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateTicketComment" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    </div>

    {{-- delete ticket comment modal --}}
    <div>
        <x-jet-dialog-modal wire:model="showDeleteTicketCommentModal">
            <x-slot name="title">
                Delete Comment
            </x-slot>

            <x-slot name="content">
                Are you sure you want to delete this comment "<strong>{{ $comment->comment }}</strong>"?
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showDeleteTicketCommentModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteTicketComment" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>



</div>
