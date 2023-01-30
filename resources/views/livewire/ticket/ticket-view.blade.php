<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket View') }}
        </h2>
    </x-slot>
    <div class="py-2 space-y-2">
        <x-notification />
        <div class="container mx-auto">
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Title:</p>
                <p>{{ $ticket->title }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Requestor Name:</p>
                <p>{{ $ticket->requestor_name }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Department:</p>
                <p>{{ $ticket->department->name }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Plan:</p>
                <p>{{ $ticket->plan->name }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Category:</p>
                <p>{{ $ticket->category->name }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Claim Number:</p>
                <p>{{ $ticket->claim_number }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Target Date:</p>
                <p>{{ $ticket->target_date }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Attachment:</p>
                <p><a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">View Attachment</a></p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Status:</p>
                <p>{{ $ticket->status }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Created At:</p>
                <p>{{ $ticket->created_at }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Problem Statement:</p>
                <p>{{ $ticket->problem_statement }}</p>
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Comments:</p>
                @foreach ($ticketComments as $comment)
                    <div class="flex flex-col mb-2">
                        <p class="text-gray-600 mb-2">{{ $comment->comment }}</p>
                        <p class="text-gray-600 mb-2 font-italic text-green-600">By: {{ $comment->user->name }} at
                            {{ $comment->created_at->format('d-m-Y H:i:s') }}
                            <strong
                                style="text-gray-600 mb-2 font-italic text-green-500">{{ $comment->created_at->diffForHumans() }}</strong>
                            @if ($comment->user_id == Auth::user()->id)
                                <a href="#" wire:click="editTicketComment({{ $comment->id }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                        <path
                                            d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                    </svg>
                                </a>
                                <a href="#" wire:click="deleteTicketComment({{ $comment->id }})"><svg
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
                    </div>
                @endforeach
            </div>
            <div class="mb-6">
                <p class="text-gray-600 mb-2">Add Comment:</p>
                <x-textarea wire:model="comment" class="w-full h-32"></x-textarea>
                <div class="flex flex-row justify-end">
                    <x-jet-button wire:click="storeTicketComment">Add Comment</x-jet-button>
                </div>
            </div>
        </div>
    </div>
</div>
