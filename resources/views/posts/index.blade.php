<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
            <a href="{{route('posts.create')}}" class="float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add post</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
             
              @include('layouts.partials')
                    
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    @if($posts->count() > 0)
                    <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-200 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Image </th>
                                <th scope="col" class="px-6 py-3">Title </th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Published At</th>
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($posts as $post)
                           <tr class="bg-white border-b dark:bg-white">
                            <th scope="row" class="flex items-center px-3 py-2 text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="w-10 h-10 rounded-full" src="{{asset('storage/'.$post->image)}}" alt="Jese image">
                                <div class="pl-3">
                                    <div class="font-normal text-gray-500">{{$post->title}}</div>
                                </div>  
                            </th>
                            <td class="px-3 py-2">
                                {{$post->title}}
                            </td>
                            <td class="px-3 py-2">
                               <a class="text-blue-400" href="{{route('categories.edit', $post->category->id)}}"> {{$post->category->name}}</a>
                            </td>
                            <td class="px-3 py-2">
                                {{$post->published_at}}
                            </td>
                          
                           @if(!$post->trashed())
                            <td class="px-3 py-2">
                                <a href="{{route('posts.edit', $post->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>   
                            </td>
                            @else
                            <td class="px-3 py-2">
                                <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-white bg-gradient-to-r from-green-400 via-regreend-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg px-3 py-2 text-xs text-center mr-2 mb-2">Restore</button>  
                                </form> 
                            </td>
                           @endif
                            <td class="px-3 py-2">
                                <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg px-3 py-2 text-xs text-center mr-2 mb-2">
                                        {{ $post->trashed() ? 'Delete': 'Trash' }}
                                        
                                    </button>
                                </form>

                            </td>
                            
                        </tr>
                        
                           @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-300 dark:text-gray-250" role="alert">
                        <span class="font-medium">No Posts Available..!</span> 
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


