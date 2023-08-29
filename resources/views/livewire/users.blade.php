<x-slot name="header">
    <h2 classfont-semibold text-xl text-gray-800 leading-tight">
        {{ __('Users') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
 @if(count($selectedUsers)>0)
                <div
                    class=" items-center justify-between pb-4 bg-white dark:bg-gray-900 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                    <div class="mb-12">
                        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            message</label>
                        <textarea id="body" rows="4" wire:model="message"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                    </div>

                    <button wire:click="notify" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        >Send Notification</button>


                </div>
    @endif
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
                    @include('livewire.parts-users.user-input-search')
                    @include('livewire.parts-users.user-actions')
                </div>
                @include('livewire.parts-users.user-table')

            </div>

        </div>
    </div>
</div>
