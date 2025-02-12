{{-- フォーム部分の共通テンプレート --}}
<form action="{{ $formAction }}" method="POST" id="interview-form">
    @csrf
    {{-- HiddenフィールドでIDを送信 --}}
    <input type="hidden" name="company_id" value="{{ $company->id }}">
    <input type="hidden" name="application_id" value="{{ $interview->application->id }}">

    <div class="flex justify-center">
        {{-- 面接日 --}}
        <div class="p-6 text-gray-900">
            <input type="text" id="interview_datetime" name="interview_datetime" autocomplete="off" value="{{ old('interview_datetime', $interview->interview_datetime) }}" class="border border-transparent hover:border-gray-300 transition-all duration-200" placeholder="面接日を選択">
        </div>
        {{-- インタビューステータス --}}
        <div class="p-6 text-gray-900">
            <select name="interview_status" class="border border-transparent w-min dynamic-color hover:border-gray-300 transition-all duration-200">
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
        <select name="preparation_status" class="border border-transparent border-gray-200 w-min dynamic-color hover:border-gray-300 transition-all duration-200">
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
    <div class="px-4 py-2">
        <label class="block font-semibold">内容</label>
        <textarea name="content" class="border w-full h-40">{{ $interview->content }}</textarea>
    </div>
    <div class="p-6 flex justify-between">
        {{-- 更新ボタン --}}
        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
            {{ $submitButtonText }}
        </button>
</form>
        {{-- 次の面接作成ボタン --}}
        @if (!$interview->nextInterview() && $interview->interview_status->value === \App\Enums\InterviewStatus::Implemented)
            <form action="{{ route('interview.create') }}" method="GET">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}">
                <input type="hidden" name="interview_round" value="{{ $interview->interview_round->nextRound()->value }}">
                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                    次の面接へ
                </button>
            </form>
        @endif
        {{-- 削除ボタン --}}
        @if ($interview->exists)
            <form action="{{ route('interview.destroy', ['company' => $company->id, 'interview' => $interview->id]) }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <button type="button" id="delete-button" onclick="confirmDelete()" aria-label="この面接を削除します。" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                    削除
                </button>
            </form>
        @endif
    </div>

