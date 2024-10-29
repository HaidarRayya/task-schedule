@extends('myLayouts.app')

@section('title', 'Show Task')

@section('success',session('message'))

@section('content')
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-white text-xl font-bold"> Task Schedule </a>
            <ul class="flex space-x-3">
                <li></li>
                <li><a href="{{ route('tasks.index') }}" class="text-gray-300 hover:text-white">المهام</a></li>
                <li><a href="{{ route('tasks.create') }}" class="text-gray-300 hover:text-white">اضافة مهمة </a></li>
                <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a></li>
            </ul>
        </div>
    </nav>
</h2>

<div class="container text-white">

    <div class="container mt-5">
        <div class="card bg-secondary text-white">
            <div class="card-header">
                {{ $task->title }}
            </div>
            <div class="card-body">
                <h5 class="card-title">موعد انتهاء المهمة : {{ $task->due_date }}
                </h5>
                <h5 class="card-title"> الحالة: {{ $task->status }} </h5>

                <p class="card-text"> الوصف: {{ $task->description }}
                </p>
            </div>
            <div class="d-flex justify-content-evenly">
                @if ($task->status == 'pinding')
                <form action="{{ route('tasks.start', ['task' => $task->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-dark" type="submit">بدء المهمة</button>
                </form>
                @elseif ($task->status == 'in progress')
                <form action="{{ route('tasks.end', ['task' => $task->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-dark" type="submit">انهاء المهمة</button>
                </form>
                @endif
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-success">تعديل</a>
                <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection