<x-app-layout>
    <x-slot name="header">
        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('全企業一覧') }}
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:underline">
                {{ __('進捗状況にもどる')}}
            </a>
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- フィルターフォーム --}}
                    <div class="mb-6 flex justify-center">
                        <form method="GET" action="{{ route('company.all') }}" class="flex items-center gap-4">
                            <label for="status_filter" class="font-semibold">ステータスで絞り込み:</label>
                            <select name="status_filter" id="status_filter" class="border border-gray-200 dynamic-color" onchange="this.form.submit()">
                                {{-- 初期値(99を全件表示用の値として使用) --}}
                                <option value="99"
                                    class="text-gray-700"
                                    {{ $currentFilter == '99' ? 'selected' : '' }}>
                                    全て表示
                                </option>
                                {{-- 選択肢（ステータス） --}}
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        class="{{ $status->color()}}"
                                        {{-- 型の一貫性を保証するためstring型にキャスト --}}
                                        {{ (string)$currentFilter === (string)$status->value ? 'selected' : '' }}>
                                        {{ $status->text() }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    {{-- 全企業一覧表ー --}}
                    <div class="mb-4">
                        {{-- 項目 --}}
                        <table class="w-full border-collapse text-center">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="text-center font-semibold px-4 py-2 border">企業名</th>
                                    <th class="text-center font-semibold px-4 py-2 border">ステータス</th>
                                    <th class="text-center font-semibold px-4 py-2 border">勤務地</th>
                                    <th class="text-center font-semibold px-4 py-2 border">給料</th>
                                    <th class="text-center font-semibold px-4 py-2 border">最終更新日時</th>
                                </tr>
                            </thead>
                            {{-- 各レコード --}}
                            <tbody>
                                @if ($companies->isNotEmpty())
                                    @foreach ($companies as $company)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white'}} hover:bg-gray-100 transition-colors">
                                            <td class="px-4 py-2 border">
                                                <a href="{{ route('company.edit', ['company' => $company->id, 'company' => $company->id] )}}"
                                                    class="mb-4 font-semibold text-gray-400 hover:text-gray-900 hover:underline">
                                                        {{ $company->name }}
                                                </a>
                                            </td>
                                            <td class="px-4 py-2 border {{ $company['status']->color() }}">
                                                {{ $company['status']->text()}}
                                            </td>
                                            <td class="px-4 py-2 border">
                                                {{ $company->work_location }}
                                            </td>
                                            <td class="px-4 py-2 border">
                                                {{ $company->salary }}
                                            </td>
                                            <td class="px-4 py-2 border">
                                                {{ $company->updated_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 text-center py-4">該当企業はありません。</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateSelectColor(select) {
                // 選択されている <option> を取得
                const selectedOption = select.options[select.selectedIndex];
                // 既存のテキスト色クラスを削除
                select.classList.forEach(className => {
                    if (/^text-\w+-\d+$/.test(className)) {
                        select.classList.remove(className);
                    }
                });
                // 選択されたオプションのクラスを追加
                select.classList.add(selectedOption.className);
            }
            // 各 dynamic-color の select 要素を操作
            document.querySelectorAll('.dynamic-color').forEach(function (select){
                updateSelectColor(select);

                // 変更時のイベントリスナー設定
                select.addEventListener('change', function () {
                    updateSelectColor(select);
                });
            });
        });
    </script>
</x-app-layout>
