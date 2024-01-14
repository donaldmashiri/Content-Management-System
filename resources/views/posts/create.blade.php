<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($post) ? 'Edit Post': 'Create Post'}}
            <a href="{{route('posts.index')}}" class="float-right text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Back</a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" enctype="multipart/form-data">
                        @if(isset($post))
                            @method('PUT')
                        @endif
                        @csrf
                        <!-- Name -->
                        <div class="p-2">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title"  class="block mt-1 w-full" type="text" name="title" :value="old('title')" value="{{ isset($post) ? $post->title : ''}}" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="p-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 p-2.5 w-full text-sm  rounded-lg border border-gray-300" placeholder="Description">{{ isset($post) ? $post->description : ''}}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="p-2">
                            <x-input-label for="contents" :value="__('Content')" />
                            <input id="contents" value="{{ isset($post) ? $post->contents : ''}}" type="hidden" name="contents">
                            <trix-editor input="contents"></trix-editor>
                            <x-input-error :messages="$errors->get('contents')" class="mt-2" />
                        </div>

                        <div class="p-2">
                            <x-input-label for="published_at" :value="__('Published At')" />
                            <x-text-input id="published_at"  class="block mt-1 w-full" type="text" name="published_at" :value="old('published_at')" value="{{ isset($post) ? $post->published_at : ''}}" />
                            <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                        </div>


                       <div class="p-2">
                         @if(isset($post))
                            <div>
                                <img class="w-20 h-20 rounded" src="{{asset('storage/'.$post->image)}}">
                            </div>
                        @endif
                            <x-input-label for="image" :value="__('Image')" />
                            <input name="image" class="block w-full text-lg  rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>


                        <div class="p-2">
                            <x-input-label for="category" :value="__('Category')" />
                            <select name="category_id" class="block mt-1 p-2.5 w-full text-sm  rounded-lg border border-gray-300">
                               @foreach ($categories as $category)
                                   <option value="{{$category->id}}"
                                      @if(isset($post))
                                        @if($category->id === $post->category_id)
                                            selected
                                        @endif
                                      @endif
                                    >
                                    {{$category->name}}</option>
                               @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        @if($tags->count()>0)
                        <div class="p-2">
                            <x-input-label for="tags" :value="__('Tags')" />
                            <select name="tags[]" class="js-example-basic-multiple block mt-1 p-2.5 w-full text-sm  rounded-lg border border-gray-300 tags-selector" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}"
                                        @if(isset($post))
                                         @if($post->hasTag($tag->id))
                                          selected
                                         @endif
                                        @endif
                                        >
                                    {{$tag->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                         </div>
                         @endif


                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ml-4">
                                {{ isset($post) ? 'Update Post': 'Add Post' }}
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

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 script after jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Your HTML code -->


    <script>
       $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>



    <script>

        flatpickr('#published_at', {
            // enableTime: true
        });

        $(document).ready(function() {
            $('.tags-selector').select2();
        })
    </script>

</x-app-layout>
