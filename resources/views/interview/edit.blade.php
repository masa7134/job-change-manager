<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('面接詳細') }}
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            <a href="{{ route('company.edit', $company->id) }}" class="text-gray-500 hover:underline">
                {{ __('企業詳細にもどる')}}
            </a>
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center">
                    {{-- 企業名 --}}
                    <div class="p-6 text-gray-900">
                        <h1 class="font-bold text-center text-2xl text-gray-800 leading-tight mb-1">
                            {{ $company->name }}
                        </h1>
                    </div>
                    {{-- 面接ラウンド --}}
                    <div class="p-6 text-gray-900">
                        <h1 class="font-bold text-center text-2xl text-gray-800 leading-tight mb-1">
                            {{ $interview['interview_round']->text() }}
                        </h1>
                    </div>
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
                {{-- 更新フォーム --}}
                <form action="{{ route('interview.update', ['company' => $company->id, 'interview' => $interview->id] )}}" method="POST" id="interview-form">
                    @csrf
                    {{-- HiddenフィールドでIDを送信 --}}
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <input type="hidden" name="interview_id" value="{{ $interview->id }}">

                    <div class="flex justify-center">
                        {{-- 面接日 --}}
                        <div class="p-6 text-gray-900">
                            <input type="text" id="interview_date" name="interview_date" value="{{ old('interview_date', $interview->interview_date) }}" class="border border-gray-200">
                        </div>
                        {{-- インタビューステータス --}}
                        <div class="p-6 text-gray-900">
                            <select name="interview_status" class="border border-gray-200 w-min dynamic-color">
                                @foreach ($interviewStatuses['interview_status'] as $status)
                                    <option value="{{ $status->value }}"
                                        class="{{ $status->color() }}"
                                        {{ $interview->interview_status->value === $status->value ? 'selected' : '' }}>
                                            {{ $status->text() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- 面接対策状況 --}}
                    <div class="mb-4 flex justify-center items-center gap-4">
                        <label class="block font-semibold">面接対策状況:</label>
                        <select name="preparation_status" class="border border-gray-200 w-min dynamic-color">
                            {{-- interviewStatuses配列から preparationステータスを取得 --}}
                            @foreach ($interviewStatuses['preparation_status'] as $status)
                                <option value="{{ $status->value }}"
                                    class="{{ $status->color() }}"
                                    {{ $interview->preparation_status->value === $status->value ? 'selected' : '' }}>
                                        {{ $status->text() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- 内容 --}}
                    <div class="mb-4">
                        <label class="block font-semibold">内容</label>
                        <textarea name="content" class="border w-full h-40">{{ $interview->content }}</textarea>
                    </div>
                    <div class="p-6 flex justify-between">
                        {{-- 更新ボタン --}}
                        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                            更新
                        </button>
                </form>
                        {{-- 次の面接作成ボタン --}}
                        <button type="button" id="" onclick="" aria-label="次の面接を作成します。" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                            @php
                                $interviews = $company->application->interviews;
                                $latestRound = $interviews->max('interview_round');
                                $nextRound = $latestRound ? $latestRound->value + 1 : 0;
                            @endphp
                            <a href="{{ route('interview.create', ['company' => $company->id, 'round' => $nextRound] )}}"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                                    次の面接へ
                            </a>
                        </button>
                        {{-- 削除ボタン --}}
                        <form action="{{ route('interview.destroy', ['company' => $company->id, 'interview' => $interview->id]) }}" method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="delete-button" onclick="confirmDelete()" aria-label="この面接を削除します。" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                                削除
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FlatpickrのCSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- FlatpickrのJavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#interview_date", {
                dateFormat: "Y-m-d",
                allowInput: true,
                locale:"ja"
            });
        });
    </script>
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
            if (confirm('本当にこの面接情報を削除しますか？この操作は元に戻せません。')) {
                const button =document.getElementById('delete-button');
                button.disabled = true; //二重送信防止
                button.textContent = '処理中・・・';//処理中メッセージ
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>

