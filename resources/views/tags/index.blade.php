<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
            <a href="{{route('tags.create')}}" class="float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add Tag</a>
        </h2>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
             
                    @include('layouts.partials')
                    
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    
                    @if($tags->count() > 0)
                    <table class="w-full text-sm text-left text-black-500 dark:text-black-400">
                        <thead class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-white-300 dark:text-black-400">
                            <tr>
                                <th scope="col" class="px-2 py-2">ID  </th>
                                <th scope="col" class="px-2 py-2">Name</th>
                                <th scope="col" class="px-2 py-2">Post Count</th>
                                <th scope="col" class="px-2 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                            <tr class="bg-white border-b dark:bg-white-400 dark:border-gray-300">
                                <td class="px-2 py-1">{{$tag->id}}</td>
                                <td class="px-2 py-1">{{$tag->name}}</td>
                                <td class="px-2 py-1">{{$tag->posts->count() }}
                                </td>
                                <td class="px-2 py-1">

                                    <a href="{{ route('tags.edit', $tag->id) }}" type="button" class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg px-3 py-2 text-xs text-center mr-2 mb-2">Edit</a>
                                   
                                    <form action="{{route('tags.destroy', $tag->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center mr-2">
                                            Delete
                                        </button>
                                    </form>
                                    
                                    {{-- <button data-modal-target="deletetag{{$tag->id}}" data-modal-toggle="deletetag{{$tag->id}}" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg px-3 py-2 text-xs text-center mr-2 mb-2">Delete</button> --}}
                                
                                </td>
  
                            </tr>

                            {{-- @include('layouts.modal') --}}

                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-300 dark:text-gray-250" role="alert">
                        <span class="font-medium">No tags Added!</span> 
                    </div>
                    @endif
                </div>
                </div>
            </div>

        </div>
    </div>

            </div>
        </div>
    </div>

</x-app-layout>


