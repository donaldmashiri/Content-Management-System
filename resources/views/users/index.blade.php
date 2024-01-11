<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @include('layouts.partials')

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    @if($users->count() > 0)
                    <table class="w-full text-sm text-left text-black-500 dark:text-black-400">
                        <thead class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-white-300 dark:text-black-400">
                            <tr>
                                <th scope="col" class="px-2 py-2">Image</th>
                                <th scope="col" class="px-2 py-2">Name</th>
                                <th scope="col" class="px-2 py-2">Email</th>
                                <th scope="col" class="px-2 py-2"></th>
                                <th scope="col" class="px-2 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-white-400 dark:border-gray-300">
                                <td class="px-2 py-1"><img src="{{asset('images/prophet.png')}}" width="40" height="40" class="rounded" alt=""></td>
                                <td class="px-2 py-1">{{$user->name}}</td>
                                <td class="px-2 py-1">{{$user->email}}</td>
                                <td class="px-2 py-1">
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                        @csrf
                                        @if(!$user->isAdmin())
                                        <button type="submit" class="text-green-900 bg-gradient-to-r from-green-200 via-green-400 to-green-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg px-3 py-2 text-xs text-center mr-2 mb-2">Make Admin</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-300 dark:text-gray-250" role="alert">
                        <span class="font-medium">No users Added!</span>
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


