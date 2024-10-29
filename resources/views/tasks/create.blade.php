@extends('myLayouts.app')

@section('title', 'Add Task')

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
    <form class method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">العنوان</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="قم بادخال العنوان"
                name="title" value="{{ old('title') }}">
            @error('title')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">الوصف</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description"
                placeholder="قم بادخال الوصف">{{ old('description') }}</textarea>
            @error('description')
            <p class="error_message">{{ $message }}</p>

            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">موعد انتهاء المهمة</label>
            <input type="date" class="form-control" id="date" name="due_date" value="{{ old('due_date') }}">

            @error('due_date')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <div class=" col-12">
            <button class="btn btn-primary" type="submit">ارسال </button>
        </div>
    </form>
</div>
@endsection