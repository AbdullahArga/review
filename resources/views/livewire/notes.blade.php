<x-slot name="header">
    <h2 classfont-semibold text-xl text-gray-800 leading-tight">
        {{ __('Notes') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white  overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="flex">
                        {{-- New Notes --}}
                <a class="mb-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    href="{{ route('create_note') }}">New
                    Note</a>

        </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <div class="bg-white dark:bg-gray-900 items-center md:gap-6 md:grid md:grid-cols-3 pb-4">
                    @foreach ($notes as $note)
                        @include('livewire.parts-notes.note-card')
                    @endforeach

                </div>
                {{-- paginattion --}}
              <div class="mt-10">
                {{ $notes->links() }}
              </div>
            </div>
        </div>
    </div>
