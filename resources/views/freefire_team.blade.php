@extends('dasboard')

@section('title', 'Dashboard')

@section('section')

<div class="sm:p-5 p-2">
    <div class="flex gap-4 mb-5">
        <a href={{url('freefire_team')}}
            class="px-4 py-2 bg-red-500 text-white rounded-md shadow transition duration-200 mr-2">
            Team
        </a>
        <a href={{url('/freefire_duo')}}
            class="px-4 py-2 bg-red-500 text-white rounded-md shadow transition duration-200 mr-2">
            Duo
        </a>
        <a href={{url('/freefire_solo')}}
            class="px-4 py-2 bg-red-500 text-white rounded-md shadow transition duration-200">
            Solo
        </a>
    </div>

    <table class="w-full text-left mt-4">
        <thead>
            <tr class="text-gray-400">
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                    ID</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                    Name</th>
                <th
                    class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                    Phone No</th>
                <th
                    class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                    Email</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                    Amount</th>
                <th
                    class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 sm:text-gray-400 text-white">
                    PAY Mode</th>
                <th
                    class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 sm:text-gray-400 text-white">
                    Date</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 dark:text-gray-100">
            @foreach($teams as $team)
                <tr>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{'FFTE' . $team['id'] }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ $team['name'] }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ $team['phone_no'] }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ $team['email'] }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 text-green-500">
                        {{ $team['amount'] }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ $team['transaction_id'] }}
                    </td>
                    <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                        {{ $team['created_at'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection