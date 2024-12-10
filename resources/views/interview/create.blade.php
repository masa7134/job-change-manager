<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('面接詳細作成') }}
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
                <form action="{{ route('interview.store', ['company' => $company->id]) }}" method="POST">
                    @csrf
                    <div class="flex justify-center items-center">
                        {{-- 企業名 --}}
                        <div class="p-6 text-gray-900">
                            <h1 class="font-bold text-center text-2xl text-gray-800 leading-tight mb-1">
                                {{ $company->name }}

                            </h1>
                        </div>
                        {{-- 面接ラウンド --}}
                        <div class="p-6 text-gray-900">
                            <h1 class="font-bold text-center ztext-2xl text-gray-800 leading-tight mb-1">
                                <select name="interview_round" class="border border-gray-200 w-min" required>
                                    @foreach ($interviewStatuses['interview_round'] as $status)
                                        <option value="{{ $status->value }}"
                                            {{ $interview->interview_round->value == $status->value ? 'selected' : '' }}>
                                            {{ $status->text() }}
                                        </option>
                                    @endforeach
                                </select>
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
                        'formAction' => route('interview.store', ['company' => $company->id]),
                        'submitButtonText' => '作成',
                        'showDeleteButton' =>false,
                        'interviewStatuses' => $interviewStatuses,
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
                button.disabled = true; // 二重送信防止
                button.textContent = '処理中・・・';// 処理中メッセージ
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>

