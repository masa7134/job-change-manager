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
                        {{-- 項目 --}}
                        <table class="w-full border-collapse text-center">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="text-center font-semibold px-4 py-2 border">企業名</th>
                                    <th class="text-center font-semibold px-4 py-2 border">エントリーフォーム</th>
                                    <th class="text-center font-semibold px-4 py-2 border">履歴書</th>
                                    <th class="text-center font-semibold px-4 py-2 border">職務経歴書</th>
                                    <th class="text-center font-semibold px-4 py-2 border">応募状況</th>
                                    <th class="text-center font-semibold px-4 py-2 border">面接</th>
                                </tr>
                            </thead>
                            {{-- 各レコード --}}
                            <tbody>
                                @if ($companies->isNotEmpty())
                                    @foreach ($companies as $company)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white'}} hover:bg-gray-100 transition-colors">
                                            {{-- 企業名 --}}
                                            <td class="px-4 py-2 border">
                                                <a href="{{ route('company.edit', ['company' => $company->id, 'company' => $company->id] )}}"
                                                    class="mb-4 font-semibold text-gray-400 hover:text-gray-900 hover:underline">
                                                        {{ $company->name }}
                                                </a>
                                            </td>
                                            {{-- エントリーフォーム --}}
                                            <td class="px-4 py-2 border {{ $company->application->entry_form_status->color() }}">
                                                {{ $company->application->entry_form_status->text()  }}
                                            </td>
                                            {{-- 履歴書 --}}
                                            <td class="px-4 py-2 border {{ $company->application->resume_status->color() }}">
                                                {{ $company->application->resume_status->text() }}
                                            </td>
                                            {{-- 職務経歴書 --}}
                                            <td class="px-4 py-2 border {{ $company->application->work_history_status->color() }}">
                                                {{ $company->application->work_history_status->text()  }}
                                            </td>
                                            {{-- 応募状況 --}}
                                            <td class="px-4 py-2 border {{ $company->application->application_status->color() }}">
                                                {{ $company->application->application_status->text()  }}
                                            </td>
                                            {{-- 面接 --}}
                                            <td class="px-4 py-2 border">
                                                @if ($company->application->interviews->isNotEmpty())
                                                @php
                                                    $interview = $company->application->interviews->first();
                                                @endphp
                                                    <div class="{{ $interview->interview_status->color() }}">
                                                        {{ \Carbon\Carbon::parse($interview->interview_datetime)->format('m/d' )}}
                                                        ({{ $interview->interview_round->text() }})
                                                    </div>
                                                @else
                                                        <span class="text-gray-400">未定</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 text-center py-4">該当企業はありません。</p>
                                @endif
                            </tbody>
                        </table>
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
