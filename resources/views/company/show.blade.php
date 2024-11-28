<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('企業詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('company.update', $company->id )}}" method="POST" enctype="multipart/form-data" id="company-form">
                @csrf
                @method('patch')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- 企業名 --}}
                    <div class="p-6 text-gray-900">
                        <h1 class="font-bold text-center text-2xl text-gray-800 leading-tight mb-1">
                            {{ $company->name }}
                        </h1>
                    </div>
                    {{-- ステータス --}}
                    <div>
                        <h2 class="text-center text-muted mb-4 ">
                            <select name="status" class="border border-gray-200 min-w-full text-center dynamic-color">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        class="{{ $status->color() }}"
                                        {{ $company->status->value === $status->value ? 'selected' : '' }}>
                                        {{ $status->text() }}
                                    </option>
                                @endforeach
                            </select>
                        </h2>
                    </div>
                    {{-- url --}}
                    <div class="mb-4 flex gap-4">
                        <div class="font-semibold">URL:</div>
                        <div>
                            <a href="{{ $company->url }}" target="_blank" class="text-blue-500 hover:underline">
                                {{ $company->url }}
                            </a>
                        </div>
                    </div>
                    {{-- 住所 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">住所</label>
                        <input type="text" name="address" value="{{ old('address', $company->address) }}" class="border w-full">
                    </div>
                    {{-- 電話番号 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">電話番号</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $company->phone_number) }}" class="border w-full">
                    </div>
                    {{-- メールアドレス --}}
                    <div class="mb-4">
                        <label class="block font-semibold">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email', $company->email) }}" class="border w-full">
                    </div>
                    {{-- 企業理念 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">企業理念</label>
                        <textarea name="corporate_philosophy" class="border w-full">{{ old('corporate_philosophy', $company->corporate_philosophy) }}</textarea>
                    </div>
                    {{-- 代表者の言葉 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">代表者の言葉</label>
                        <textarea name="ceo_message" class="border w-full">{{ $company->ceo_message }}</textarea>
                    </div>
                    {{-- 職種 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">職種</label>
                        <input type="text" name="job_type" value="{{ old('job_type', $company->job_type) }}" class="border w-full">
                    </div>
                    {{-- 給料 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">給料</label>
                        <input type="text" name="salary" value="{{ old('salary', $company->salary) }}" class="border w-full">
                    </div>
                    {{-- 勤務時間 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">勤務時間</label>
                        <input type="text" name="work_hours" value="{{ old('work_hours', $company->work_hours) }}" class="border w-full">
                    </div>
                    {{-- 勤務地 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">勤務地</label>
                        <input type="text" name="work_location" value="{{ old('work_location', $company->work_location) }}" class="border w-full">
                    </div>
                    {{-- 入社後の業務内容 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">入社後の業務内容</label>
                        <textarea name="first_assignment" class="border w-full">{{ $company->first_assignment }}</textarea>
                    </div>
                    {{-- 履歴書 --}}
                    <div class="mb-4 flex items-center gap-4">
                        <label class="block font-semibold">履歴書:</label>
                        <select name="resume_status" class="border border-gray-200 w-min dynamic-color">
                            {{-- applicationStatuses 配列から resume ステータスを取得 --}}
                            @foreach ($applicationStatuses['resume'] as $status)
                                <option value="{{ $status->value }}"
                                class="{{ $status->color()}}"
                                {{ $company->application->resume_status->value === $status->value ? 'selected' : '' }}>
                                    {{ $status->text() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- 職務経歴書 --}}
                    <div class="mb-4 flex items-center gap-4">
                        <label class="block font-semibold">職務経歴書:</label>
                        <select name="work_history_status" class="border border-gray-200 w-min dynamic-color">
                            {{-- applicationStatuses 配列から resume ステータスを取得 --}}
                            @foreach ($applicationStatuses['work_history'] as $status)
                                <option value="{{ $status->value }}"
                                class="{{ $status->color() }}"
                                {{ $company->application->work_history_status->value === $status->value ? 'selected' : '' }}>
                                        {{ $status->text() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- エントリーフォーム --}}
                    <div class="mb-4 flex items-center gap-4">
                        <label class="block font-semibold">エントリーフォーム:</label>
                        <select name="entry_form_status" class="border border-gray-200 w-min dynamic-color">
                            {{-- applicationStatuses 配列から resume ステータスを取得 --}}
                            @foreach ($applicationStatuses['entry_form'] as $status)
                                <option value="{{ $status->value }}"
                                class="{{ $status->color() }}"
                                {{ $company->application->entry_form_status->value === $status->value ? 'selected' : '' }}>
                                        {{ $status->text() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- 応募状況 --}}
                    <div class="mb-4 flex items-center gap-4">
                        <label class="block font-semibold">応募状況:</label>
                        <select name="application_status" class="border border-gray-200 w-min dynamic-color">
                            {{-- applicationStatuses 配列から resume ステータスを取得 --}}
                            @foreach ($applicationStatuses['application'] as $status)
                                <option value="{{ $status->value }}"
                                class="{{ $status->color() }}"
                                {{ $company->application->application_status->value === $status->value ? 'selected' : '' }}>
                                        {{ $status->text() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- カジュアル面談 --}}
                    <div class="mb-4 flex items-center gap-4">
                        <a href="{{ route('interview.show', ['company' => $company->id, 'interview' => 'casual'] )}}"
                        class='font-semibold text-blue-500 hover:underline'>
                            カジュアル面談:
                        </a>
                        <div class="font-semibold text-red-500">
                            未定
                        </div>
                    </div>
                </div>
                <div class="p-6 flex justify-between">
                    {{-- 更新ボタン --}}
                    <button type="submit">更新</button>
                </form>
                {{-- 削除ボタン --}}
                <form action="{{ route('company.destroy', $company->id) }}" method="POST" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="delete-button" onclick="confirmDelete()" aria-label="この企業を削除します。">
                        削除
                    </button>
                </div>
            </form>
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
    <script>
        function confirmDelete() {
            if (confirm('本当にこの企業を削除しますか？この操作は元に戻せません。')) {
                const button =document.getElementById('delete-button');
                button.disabled = true; //二重送信防止
                button.textContent = '処理中・・・';//処理中メッセージ
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>
