<x-app-layout>
    <x-slot name="header">
        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('企業詳細') }}
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:underline">
                {{ __('進捗状況にもどる')}}
            </a>
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('company.update', $company->id )}}" method="POST" enctype="multipart/form-data" id="company-form">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- 企業名 --}}
                    <div class="p-6 text-gray-900">
                        <h1 class="font-bold text-center text-2xl text-gray-800 leading-tight">
                            {{ $company->name }}
                        </h1>
                        {{-- url --}}
                        <div class="text-center">
                            <a href="{{ $company->url }}" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">
                                {{ $company->url }}
                            </a>
                        </div>
                    </div>
                    {{-- ステータス --}}
                    <div>
                        <h2 class="text-center text-muted mb-4 ">
                            <select name="status" class="border border-gray-200 min-w-min text-center dynamic-color">
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
                    {{-- 面接セクター --}}
                    <div class="mb-4">
                        <table class="w-full border-collapse text-center">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="text-center font-semibold px-4 py-2 border">面接</th>
                                    <th class="text-center font-semibold px-4 py-2 border">面接日</th>
                                    <th class="text-center font-semibold px-4 py-2 border">ステータス</th>
                                    <th class="text-center font-semibold px-4 py-2 border">対策状況</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($interviews->isNotEmpty())
                                    @foreach ($interviews as $interview)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white'}} hover:bg-gray-100 transition-colors">
                                            <td class="px-4 py-2 border">
                                                <a href="{{ route('interview.edit', ['company' => $company->id, 'interview' => $interview->id] )}}"
                                                    class="mb-4 font-semibold text-gray-400 hover:text-gray-900 hover:underline">
                                                        {{ $interview['interview_round']->text() }}
                                                </a>
                                            </td>
                                            <td class="px-4 py-2 border">{{ $interview['interview_date']}}</td>
                                            <td class="px-4 py-2 border {{ $interview['interview_status']->color() }}">
                                                {{ $interview['interview_status']->text() }}
                                            </td>
                                            <td class="px-4 py-2 border {{ $interview['preparation_status']->color() }}">
                                                {{ $interview['preparation_status']->text() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 text-center py-4">面接情報はありません。</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    {{-- 更新ボタン --}}
                    <button type="submit"class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">更新</button>
                </form>
                {{-- 面接ボタン --}}
                <div>
                    @if ($interviews->isEmpty())
                        {{-- 面接へ --}}
                        <form action="{{ route('interview.create') }}" method="GET">
                            @csrf
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                            <input type="hidden" name="interview_round" value="0">
                            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                                面接へ
                            </button>
                        </form>
                    @else
                        {{-- 次の面接へ --}}
                        <form action="{{ route('interview.create') }}" method="GET">
                            @csrf
                            @php
                                $interviews = $company->application->interviews;
                                $latestRound = $interviews->max('interview_round');
                                $nextRound = $latestRound ? $latestRound->value + 1 : 0;
                            @endphp
                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                            <input type="hidden" name="interview_round" value="{{ $nextRound }}">
                            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                                次の面接へ
                            </button>
                        </form>
                    @endif
                </div>
                <div class="p-6 flex justify-between">
                    {{-- 削除ボタン, --}}
                    <form action="{{ route('company.destroy', $company->id) }}" method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" id="delete-button" onclick="confirmDelete()" aria-label="この企業を削除します。" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                            削除
                        </button>
                    </form>
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
    <script>
        function confirmDelete() {
            if (confirm('本当にこの企業を削除しますか？この操作は元に戻せません。')) {
                const button =document.getElementById('delete-button');
                button.disabled = true; // 二重送信防止
                button.textContent = '処理中・・・';// 処理中メッセージ
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>
