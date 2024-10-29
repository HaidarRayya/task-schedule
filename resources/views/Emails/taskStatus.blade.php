@extends('myLayouts.app')

@section('title', 'المهام المعلقة')

@section('content')

<div class="container mt-5 text-white">
    <h1 class="mb-4">المهام المعلقة </h1>
    <p>مرحبا {{ $user->name }} هذه المهام لديك لم تقم ببدء العمل عليها بعد يرجى الانتباه</p>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">عنوان المهمة</th>
                <th scope="col">وقت الانتهاء</th>
            </tr>
        </thead>
        <tbody>
            @php
            $x=1
            @endphp
            @foreach ($tasks as $task )
            <tr>
                <th scope="row">{{$x++ }}</th>
                <td>{{ $task['title'] }}</td>
                <td>{{ $task['due_date'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection