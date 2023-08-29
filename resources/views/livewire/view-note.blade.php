     <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('View Note') }}
         </h2>
     </x-slot>

     <div class="py-12">
         <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
                 <div class="p-6">
                     <a href="{{ route('edit_note', ['note' => $note->id]) }}"
                         class="font-medium
                                 text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                     |
                     <a wire:click="delete({{ $note->id }})"
                         class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>

                 </div>
                 <div
                     class="max-w-sm p-6 bg-white  border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                     <a href="#">
                         <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                             {{ $note->title ?? '' }}</h5>
                         <h6 class="mb-2 font-medium tracking-tight text-gray-400 dark:text-white">
                             {{ $note->user->name }}</h5>
                     </a>
                     <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                         {{ $note->body }}</p>

             </div>


         </div>
     </div>
     </div>
