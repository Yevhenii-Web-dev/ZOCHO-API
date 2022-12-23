@extends('layouts.app')
@section('content')

    <div class="main__form w-full max-w-2xl">
        <h2 class="mb-4 text-3xl text-center mb-12 font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl dark:text-white">
            Create Deal</h2>
        @if ($errors->any())

            @foreach ($errors->all() as $error)

                <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                     role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Danger alert!</span> {{ $error }}
                    </div>
                </div>
            @endforeach

        @endif
        <form method="POST" action="{{ route("deals.store") }}">
            @csrf
            <div class="mb-6">
                <label for="deal_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deal
                    Name</label>
                <input name="deal_name" type="text" id="deal_name" value="{{ old('deal_name') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Provide deal name in field">

            </div>
            <div class="mb-6">
                <label for="closing_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Closing
                    Date</label>
                <input name="closing_date" type="date" id="closing_date" value="{{ old('closing_date') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Provide deal closing date in field">

            </div>
            <div class="mb-6">
                <label for="stage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Stage</label>
                <select id="stage" name="stage"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="Qualification">Qualification</option>
                    <option value="Needs Analysis">Needs Analysis</option>
                    <option value="Value Proposition">Value Proposition</option>
                    <option value="Identify Decision Makers">Identify Decision Makers</option>
                </select>
            </div>
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Create
            </button>
            <a href="{{ route('deals.index') }}"
               class="inline-block ml-2 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Back</a>
        </form>


    </div>

@endsection
