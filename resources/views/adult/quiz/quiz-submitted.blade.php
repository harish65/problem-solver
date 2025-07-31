
@if($quiz->quiz_type == 1)
    
@php
    $quizData = json_decode($quiz->quiz_data, true)['mcq'] ?? [];     
    $questionIndex = 0;
   
@endphp
<form id="quizForm" method="post" action="{{ route('add-quiz-data') }}" enctype="multipart/form-data">
            @csrf

            @if(!$isProjectOwner)
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                <input type="hidden" name="project_id" value="{{ $quiz->project_id }}">
                <input type="hidden" name="is_owner" value="0">
            @endif
                <div class="card p-3 quizformborder">
                        <div class="card-header">
                            <h4>{{ $quiz->quiz_title }}</h4>
                        </div>
                        <div class="card-body">
                       
                        @foreach($quizData as $key => $value)
                        @if(Str::contains($key, '_mcq_1'))
                                @php
                                    $qIdx = explode('_', $key)[0];
                                    $correctKey = "correct-{$qIdx}";
                                    $correctAnswer = $quizData[$correctKey] ?? null;
                                @endphp
                                <div class="question-block_student card p-4 mb-3 {{ $questionIndex == 0 ? 'active' : '' }}" data-index="{{ $questionIndex }}">
                                    <h6>Question {{ $questionIndex + 1 }}</h6>
                                    <input type="hidden" name="quiz_data[mcq][correct-{{ $questionIndex }}]" value="{{ $correctAnswer }}" />
                                    <div class="mb-2">
                                        <input type="text" name="quiz_data[mcq][question_{{ $questionIndex }}]" readonly class="form-control" value="{{ $quizData["question_{$qIdx}"] ?? '' }}">
                                    </div>
                                    <div class="options">
                                        @for($i = 1; $i <= 4; $i++)
                                            @php
                                                $optKey = "{$qIdx}_mcq_{$i}";
                                                $isChecked = isset($correctAnswer) && $correctAnswer == $i - 1;
                                            @endphp
                                            <div class="input-group mb-2">
                                                    <div class="input-group-text {{ $isChecked ? 'border border-success bg-success' : '' }}">
                                                        <input type="radio" name="quiz_data[mcq][correct-{{ $questionIndex }}]" disabled value="{{ $i - 1 }}" {{  $isChecked ? 'checked' : '' }}  >
                                                    </div>
                                            <input type="text" name="quiz_data[mcq][{{ $questionIndex }}_mcq_{{ $i }}]" readonly class="form-control" value="{{ $quizData[$optKey] ?? '' }}" placeholder="Option {{ $i }}">
                                               
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @php $questionIndex++; @endphp
                            @endif
                        @endforeach
                        </div>
                        <div class="card-footer d-flex justify-content-between mt-3">
                                    <button type="button" id="prevBtnMcq" class="btn btn-outline-secondary">Previous</button>
                                    <button type="button" id="nextBtnMcq" class="btn btn-outline-primary">Next</button>
                    </div>

            @if(!$isProjectOwner && !$submitted)
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success" id="submitBtnMcq">
                        <i class="bi bi-plus-circle me-1"></i> Submit Quiz 21
                    </button>
                </div>
            @endif
</form>
@endif