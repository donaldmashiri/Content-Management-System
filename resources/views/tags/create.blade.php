<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($tag) ? 'Edit Tag': 'Create Tag'}}
            <a href="{{route('tags.index')}}" class="float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Back</a>
        </h2>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @include('layouts.partials')
                     
                    <form method="POST" action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}">
                        @if(isset($tag))
                            @method('PUT')
                        @endif
                        @csrf
                        <!-- Name -->
                        <div class="p-2">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name"  class="block mt-1 w-full" type="text" name="name" :value="old('name')" value="{{ isset($tag) ? $tag->name : ''}}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                           
                            <x-primary-button class="ml-4">
                                {{ isset($tag) ? 'Update Tag': 'Add Tag' }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        
        </div>
    </div>

            </div>
        </div>
    </div>
</x-app-layout>
