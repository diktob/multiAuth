@extends('layouts.manager')
 
@section('title', 'List User')
 
@section('contents')
<div>
    <h1 class="font-bold text-2xl ml-3">List User</h1>
    <hr />
    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
 
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Role</th>
            </tr>
        </thead>
        <tbody>
            @if($listUser->count() > 0)
            @foreach($listUser as $rs)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $loop->iteration }}
                </th>
                <td>
                    {{ $rs->name }}
                </td>
                <td>
                    {{ $rs->email }}
                </td>
                <td>
                    {{ $rs->role }}
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="text-center" colspan="5">User not found</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection