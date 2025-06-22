@php
    $quizData = json_decode($quiz->quiz_data, true);
    $questions = collect($quizData['mcq'] ?? [])
        ->filter(function ($value, $key) {
            return str_starts_with($key, 'question_');
        });
@endphp

@if($quiz->quiz_type == 1)
<div class="card p-3 quizformborder" id="qtype1">
    <h5 class="text-center mb-3">Add Explanation and MCQ Questions</h5>
    <div id="quizForm">
        @foreach ($questions as $questionKey => $questionTitle)
            @php
                $i = (int) str_replace('question_', '', $questionKey);
                $correctIndex = $quizData['mcq']["correct-{$i}"] ?? null;
            @endphp

            <div class="question-block card p-4 mb-4 quizformborder" data-index="{{ $i }}">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5 class="mb-3">Question {{ $i + 1 }}</h5>
                </div>

                <div class="mb-3">
                    <label class="form-label">Question Title</label>
                    <input type="text" class="form-control question-title" name="quiz_data[mcq][question_{{ $i }}]"
                           value="{{ $questionTitle }}" placeholder="Enter question">
                </div>

                <div class="options mb-3">
                    @for ($j = 1; $j <= 4; $j++)
                        @php
                            $optionKey = "{$i}_mcq_{$j}";
                            $optionValue = $quizData['mcq'][$optionKey] ?? '';
                        @endphp

                        <div class="input-group mb-2 option-input">
                            <div class="input-group-text">
                                <input type="radio" name="quiz_data[mcq][correct-{{ $i }}]" value="{{ $j - 1 }}"
                                    {{ $correctIndex == ($j - 1) ? 'checked' : '' }}>
                            </div>
                            <input type="text" class="form-control option-text" name="quiz_data[mcq][{{ $optionKey }}]"
                                   value="{{ $optionValue }}" placeholder="Option {{ $j }}">
                        </div>
                    @endfor

                    <button type="button" class="btn btn-sm btn-outline-primary add-option">+ Add Option</button>
                </div>
            </div>
        @endforeach
    </div>
</div>

@elseif($quiz->quiz_type == 2)
<div class="" id="qtype2">
    <label for="editor" class="form-label">Explanation Only</label>
    <textarea class="form-control" name="quiz_data[exp]" id="exponly">{{ $quizData['exp'] }}</textarea>
</div>

@elseif($quiz->quiz_type == 3)
<div class="card p-3 quizformborder" id="qtype3">
    <label class="form-label">Explanation And Explanation</label>
    <div id="multiEditorContainer"></div>
</div>
@endif
