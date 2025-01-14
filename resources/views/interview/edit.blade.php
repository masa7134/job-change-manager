<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('面接詳細編集') }}
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            <a href="{{ route('company.edit', $company->id) }}" class="text-gray-500 hover:underline">
                {{ __('企業詳細にもどる')}}
            </a>
        </p>
    </x-slot>
    {{-- main --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('interview.update', ['interview' => $interview->id ])}}" method="POST">
                    @csrf
                    <div class="flex items-center justify-between w-full">
                        {{-- 前の面接へのリンク --}}
                        @if ($interview->previousInterview())
                            <div class="flex justify-start w-full">
                                <a href="{{ route('interview.edit', $interview->previousInterview()->id) }}"
                                    class="text-gray-500 hover:text-gray-700 transition-colors duration-200 flex items-center">
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                        前の面接へ
                                    </span>
                                </a>
                            </div>
                        @endif
                        {{-- 次の面接へのリンク --}}
                        @if ($interview->nextInterview())
                            <div class="flex justify-end w-full">
                                <a href="{{ route('interview.edit', $interview->nextInterview()->id) }}"
                                    class="text-gray-500 hover:text-gray-700 transition-colors duration-200 flex items-center">
                                    <span class="inline-flex items-center">
                                        次の面接へ
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </div>
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
                    {{-- 共通フォームをインクルード --}}
                    @include('interview._form', [
                        'formAction' => route('interview.update', ['company' => $company->id, 'interview' => $interview->id]),
                        'submitButtonText' => '更新',
                        'showDeleteButton' => true
                    ])
                </form>
            </div>
        </div>
    </div>
    <!-- FlatpickrのCSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- FlatpickrのJavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 今日の日付の9:00に設定する
            const today = new Date();
            today.setHours(9, 0, 0, 0);  // 9:00:00に設定

            flatpickr("#interview_datetime", {
                dateFormat: "Y-m-d H:i",  // 時間も表示されるようにフォーマットを修正
                enableTime: true,
                time_24hr: true,
                minuteIncrement: 10,
                allowInput: true,
                locale: "ja",
                minDate: new Date(),
                minTime: "09:00",    // 選択可能な最早時間
                maxTime: "18:00",    // 選択可能な最遅時間
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
                button.disabled = true; // 二重送信防止
                button.textContent = '処理中・・・';// 処理中メッセージ
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>

