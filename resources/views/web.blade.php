@extends('dasboard')

@section('title', 'Web Registrations')

@section('section')

    <div class="sm:p-5 p-2">

        <!-- Header -->
        <div class="mb-5">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                Web Game Registrations
            </h1>
            <p class="text-sm text-gray-500">
                All registrations received from website
            </p>
        </div>

        <!-- TABLE -->
        <table class="w-full text-left mt-4">
            <thead>
                <tr class="text-gray-400">
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                        Game
                    </th>
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                        Category
                    </th>
                    <th
                        class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                        Amount
                    </th>
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                        Name
                    </th>
                    <th
                        class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                        Phone
                    </th>
                    <th
                        class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                        Email
                    </th>
                    <th
                        class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden lg:table-cell">
                        College
                    </th>
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                        Transaction
                    </th>
                    <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">
                        Status
                    </th>
                </tr>
            </thead>

            <tbody class="text-gray-600 dark:text-gray-100">
                @forelse($registrations as $reg)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 font-semibold">
                            {{ $reg->game }}
                        </td>

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                            {{ $reg->category }}
                        </td>

                        <td
                            class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell text-green-500 font-semibold">
                            ₹{{ $reg->amount }}
                        </td>

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                            {{ $reg->full_name }}
                        </td>

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                            {{ $reg->phone }}
                        </td>

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">
                            {{ $reg->email }}
                        </td>

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 hidden lg:table-cell">
                            {{ $reg->college_name }}
                        </td>

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 font-mono text-xs">
                            {{ $reg->transaction_id }}
                        </td>

                        <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800">
                            @if($reg->verified)
                                <span
                                    class="px-3 py-1 text-xs rounded-full bg-green-100 text-black dark:bg-green-900 dark:text-black">
                                    Verified
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-black dark:bg-yellow-900 dark:text-black">
                                    Pending
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9"
                            class="sm:p-3 py-6 px-1 text-center text-gray-500 border-b border-gray-200 dark:border-gray-800">
                            No registrations found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection