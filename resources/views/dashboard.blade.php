<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <nav class="bg-gray-800 p-4">
                <div class="container mx-auto flex justify-between items-center">
                    <a class="text-white text-xl font-bold"> Task Schedule </a>
                    <ul class="flex space-x-3">
                        <li></li>
                        <li><a href="{{ route('tasks.index') }}" class="text-gray-300 hover:text-white">المهام</a></li>
                        <li><a href="{{ route('tasks.create') }}" class="text-gray-300 hover:text-white">اضافة مهمة </a>
                        </li>
                        <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a></li>
                    </ul>
                </div>
            </nav>
        </h2>
    </x-slot>

</x-app-layout>