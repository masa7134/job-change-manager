<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('進捗状況') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">企業一覧（進行中）</h3>

                    @if ($companies->isEmpty())
                        <p>現在進行中の企業はありません</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($companies as $company)
                                <li class="border-b pb-4">
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('company.edit', $company->id)}}" class="text-sm text-gray-600 hover:text-gray-900 hover:underline">{{ $company->name }}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="mt-6 flex space-x-4 justify-between">
                <a href="{{ route('company.register') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                    企業を登録する
                </a>
                <a href="{{ route('company.all') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                    全企業を表示する
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
