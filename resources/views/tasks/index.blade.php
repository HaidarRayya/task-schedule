@extends('myLayouts.app')

@section('title', 'Tasks')

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
<div class="search-bar">
    <form class="container-xl mt-5 text-white" action="" method="get">
        <div>
            <label>عنوان المهمة</label>
            <input type="text" name="title" class="form-control bg-secondary">
            @error('title')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label> تاريخ انتهاء المهمة</label>
            <input type="date" name="due_date" class="form-control bg-secondary">
            @error('title')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label> حالة المهمة</label>
            <select name="status" class="form-select bg-secondary">
                <option></option>
                <option value="pinding">معلقة</option>
                <option value="in progress">يتم العمل عليها</option>
                <option value="completed">مكتملة</option>
            </select>
            @error('title')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label> ترتيب حسب</label>
            <select name="sort" class="form-select bg-secondary">
                <option></option>
                <option value="ASC">الاقدم</option>
                <option value="DESC"> الاحدث</option>
            </select>
            @error('title')
            <p class="error_message">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mt-3 mb-3">
            <input type="submit" class="btn btn-dark" value="بحث" />
            <a href="{{ route('tasks.index') }}" class="btn btn-dark">تهيئة</a>
        </div>
    </form>
</div>
<div class="container mt-5">
    <div class="row">
        @forelse ( $tasks as $task )
        <div class="col-md-4 mb-4">
            <div class="card bg-secondary text-white">
                <div class="card-header">
                    {{ $task->title }}
                </div>
                <div class="card-body">
                    <h5 class="card-title"> وقت انتهاء المهمة : {{ $task->due_date }} </h5>
                    <h5 class="card-title"> الحالة: {{ $task->status }} </h5>
                    <p class="card-text"> الوصف :
                        @if (Str::length($task->description) >30)
                        {{ Str::substr($task->description, 0, 30) }}.....
                        @else
                        {{ $task->description }}
                        @endif
                    </p>
                    <div class="d-flex justify-content-evenly">
                        <a href="{{ route('tasks.show',['task' => $task->id]) }}" class="btn btn-dark">عرض</a>
                        <a href="{{ route('tasks.edit',['task' => $task->id]) }}" class="btn btn-success">تعديل</a>
                        <form action="{{  route('tasks.destroy',['task' => $task->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">حذف</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-white fw-bold">
            <p>لا يوجد مهام</p>
        </div>
        @endforelse
        <div class="d-flex justify-content-center ">
            {{ $tasks->links('pagination::simple-tailwind') }}

        </div>

    </div>

</div>

@endsection