@php
$quiz = \App\Models\Quiz::getQuiz($project->id , 1001 , 'problem');
$submitted = true;
if(!$quiz){
$quiz = \App\Models\Quiz::where(['project_id'=>$project->id , 'page_id'=>1001 , 'page_type'=> 'problem'])->first();
$submitted = false;
}
$isPermitted = \App\Models\Quiz::isProjectQuizEditable($project->id);
$isProjectOwner = $project->user_id == auth()->user()->id;
$questionIndex = 0;
@endphp

@if($project->user_id == Auth::user()->id)
<div class="row mb-4">
    <div class="col-12 d-flex">
        <h3 class="mb-0">Quiz Users</h3>
        <div class="col-auto">
            @php $users = \App\Models\Quiz::getQuisUsers($project->id);@endphp
            <select class="form-select form-select-lg mb-3" id="view_quiz_users">
                <option selected="true" disabled="disabled">Please Select...</option>
                @foreach ($users as $user)
                <option value="{{ Crypt::encrypt($user->id) }}" {{ ($user->id === $quiz->user_id) ?  'selected':''}}>{{ $user->user_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endif
<div class="mb-5">
    @if($quiz && !$submitted)
    @if($quiz->quiz_type == 1)
    @php
    $quizData = json_decode($quiz->quiz_data, true)['mcq'] ?? [];

    @endphp
    <form id="quizForm" method="post" action="{{ route('add-quiz-data') }}" enctype="multipart/form-data">
        @csrf

        @if(!$isProjectOwner)
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        <input type="hidden" name="project_id" value="{{ $quiz->project_id }}">
        <input type="hidden" name="is_owner" value="0">
        @endif

        <div class="card p-3 quizformborder">
            <div class="card p-3 quizformborder" id="qtype1">
                <h5 class="text-center mb-3">Explanation and MCQ Questions</h5>
                <div id="quizForm">
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
                                $optKey="{$qIdx}_mcq_{$i}" ;
                                $isChecked=isset($correctAnswer) && $correctAnswer==$i - 1;
                                @endphp
                                <div class="input-group mb-2">
                                @if($isPermitted)
                                <div class="input-group-text">
                                    <input type="radio" name="quiz_data[mcq][correct-{{ $questionIndex }}]" value="{{ $i - 1 }}" {{ $isProjectOwner && $isChecked ? 'checked' : '' }}>
                                </div>
                                <input type="text" name="quiz_data[mcq][{{ $questionIndex }}_mcq_{{ $i }}]" readonly class="form-control" value="{{ $quizData[$optKey] ?? '' }}" placeholder="Option {{ $i }}">
                                @else
                                <div class="input-group-text {{ $isChecked ? 'border border-success bg-success' : '' }}">
                                    <input type="radio" name="" value="{{ $i - 1 }}" {{ $isChecked ? 'checked' : '' }} disabled>
                                </div>
                                <input type="text" name="quiz_data[mcq][{{ $questionIndex }}_mcq_{{ $i }}]" readonly class="form-control {{ $isChecked ? 'border border-success' : '' }}" value="{{ $quizData[$optKey] ?? '' }}" placeholder="Option {{ $i }}">
                                @endif
                        </div>
                        @endfor
                    </div>
                </div>
                @php $questionIndex++; @endphp
                @endif
                @endforeach
            </div> <!-- #quizForm -->

            <div class="d-flex justify-content-between mt-3">
                <button type="button" id="prevBtnMcq" class="btn btn-outline-secondary">Previous</button>
                <button type="button" id="nextBtnMcq" class="btn btn-outline-primary">Next</button>
            </div>
        </div> <!-- #qtype1 -->
</div> <!-- outer card -->

@if(!$isProjectOwner)
<div class="text-end mt-4">
    <button type="submit" class="btn btn-success" id="submitBtnMcq">
        <i class="bi bi-plus-circle me-1"></i> Submit Quiz
    </button>
</div>
@endif
</form>

@elseif($quiz->quiz_type == 2)
<div class="d-none" id="qtype2">
    <label for="editor" class="form-label">Explanation Only</label>
    <textarea class="form-control" name="quiz_data[exp]"></textarea>
</div>

@elseif($quiz->quiz_type == 3)
<div class="card p-3 quizformborder d-none" id="qtype3">
    <label class="form-label">Explanation And Explanation</label>
    <div id="multiEditorContainer"></div>
</div>
@endif


@endif
</div>