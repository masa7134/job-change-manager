<x-app-layout>
    <x-slot name="header">
        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('新規企業登録') }}
        </h2>
        <p class="text-sm text-gray-400 mt-2">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:underline">
                {{ __('進捗状況一覧にもどる')}}
            </a>
        </p>
    </x-slot>

    {{-- セッションデータ --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success')}}
        </div>
    @endif
    {{-- バリデーションメッセージ --}}
    @if ($errors->any())
        <div class="alert alert-danger text-center text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('company.store') }}" method="POST">
        @csrf
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- 企業名 --}}
                    <div class="p-6 text-gray-900">
                        <label for="name" class="form-label font-semibold block mb-2">企業名</label>
                        <input type="text" name="name" id="name" class="w-full form-control" value="{{ old('name') }}" required>
                    </div>
                    {{-- url --}}
                    <div class="p-6 text-gray-900">
                        <label for="url" class="form-label font-semibold block mb-2">URL</label>
                        <input type="url" name="url" id="url" class="w-full form-control" value="{{ old('url') }}" required>
                    </div>
                </div>
                {{-- 更新ボタン --}}
            <div class="py-6">
                <button type="submit"class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                    新規登録
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
