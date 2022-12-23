@extends('layouts.app')
@section('content')

    <div class="main__table ">
        <h2 class="mb-4 text-3xl text-center mb-12 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl dark:text-white">
            Deals</h2>
        <a href="{{ route('deals.create') }}"
           class="inline-flex items-center mb-8 py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-800 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Add new deal
        </a>
        @if(session('successful'))
            <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Success alert!</span> {{ session('successful') }}
                </div>
            </div>
        @endif
        <div class="mb-10 overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="  w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Deal Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Closing Date
                    </th>

                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>

                @forelse($deals as $deal)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $deal->Deal_Name }}
                        </th>
                        <td class="py-4 px-6">
                            {{ $deal->Closing_Date }}
                        </td>

                        <td class="py-4 px-6">
                            <form method="POST" action="{{ route('deals.destroy', $deal->id) }}">
                                @csrf
                                @method('DELETE')
                            <button type="submit" class="font-medium text-blue-600 dark:text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <div class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-red-800">Deal list is empty, try add new deal</div>
                @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('welcome') }}"

           class="inline-block ml-2 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Back</a>

    </div>

@endsection
