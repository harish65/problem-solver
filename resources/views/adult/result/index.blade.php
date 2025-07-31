@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
<div class="container result bg-white p-5">
    <div class="row spl-row">
        <h4>Project Report: <span class="badge bg-success">{{$project->name}}</span></h4>
    </div>
    <div class="mb-3">
        <div>
            <div><b>User Name:</b> User1</div>
            <div><b>Project Name:</b> Project 1</div>
            <div><b>Quiz Type:</b>Explanation only</div>
        </div>
    </div>
   

    {{--
    <hr /> --}}
    <div>
        @foreach($userQuiz as $quiz)
            <div class="mb-3">
                <div><strong>Project Page:</strong> {{ $quiz->page_type }}</div>
                @if($quiz->page_id == 1001 && isset($problem))
                    <div><strong>Problem Type:</strong> <span class="text-danger">{{ $problem->name }}</span></div>
                @endif
                <div><strong>Quiz Type:</strong> 
                    @if($quiz->quiz_type == 1)
                        Multiple Choice
                    @elseif($quiz->quiz_type == 2)
                        Explanation
                    @elseif($quiz->quiz_type == 3)
                        Explanation and Explanation
                    @endif
                </div>
            </div>
            @if($quiz->page_id == 1001)
                <div class="fs-3 font-weight-bold">Additional Explanation</div>
                <p>This issue highlights improper filtration and possible contamination in the lubrication system. Such problems can
                    reduce machinery efficiency and accelerate wear.</p>
            @endif
            <h3 class="font-weight-bold">Explanation and Explanation</h3>
            <div class="mt-2 mb-2">
                <div class="fs-5 font-weight-bold">Question</div>
                <div>What could be the root cause of dirty oil in this mechanical system?</div>
            </div>
            <div class="mt-2 mb-2">
                <div class="fs-5 font-weight-bold">Answer</div>
                <div>The root cause could be a clogged oil filter or neglected maintenance schedule that led to dirt buildup
                    in the system.</div>
            </div>
            <h3 class="font-weight-bold">Instructor Remark</h3>
            <div>Your analysis is on the right track. Next time, also consider external contamination sources like leaky
                seals or dusty environments.</div>

            <div class="bg-light p-4 border-left border-success rounded  my-3">
            
            @if($quiz->quiz_type == 1)
                {{-- <h4 class="font-weight-bold">Multiple Choice</h4> --}}
                @php
                    $quizData = json_decode($quiz->quiz_data, true)['mcq'] ?? [];
                    $ownerQuizData = json_decode($quiz->owner_quiz_data, true)['mcq'] ?? [];
                    $questionIndex = 1;
                @endphp

                <div class="mt-3">
                    <div class="mcq fs-5">
                        @php
                            $count_correct = 0;
                            $count_incorrect = 0; 
                        @endphp
                        @foreach($quizData as $key => $option)
                            @if(Str::endsWith($key, '_mcq_1'))
                                @php
                                    $qId = explode('_', $key)[0];
                                    $question = $quizData["question_{$qId}"] ?? '';
                                    $userAnswer = $quizData["correct-{$qId}"] ?? '';
                                    $correctAnswer = $ownerQuizData["correct-{$qId}"] ?? '';
                                    $count_correct += ($userAnswer === $correctAnswer) ? 1 : 0;
                                    $count_incorrect += ($userAnswer !== $correctAnswer) ? 1 : 0;
                                @endphp

                                <div><strong>{{ $questionIndex }}. {{ $question }}?</strong></div>
                                <ol type="a">
                                    @for($i = 1; $i <= 4; $i++) 
                                        @php 
                                            $optKey="{$qId}_mcq_{$i}" ;
                                        @endphp 
                                        <li>{{ $quizData[$optKey] ?? '' }}</li>
                                    @endfor
                                </ol>
                                <p class="answer-line">
                                    <span class="fw-bold">Answer:</span>
                                    You answered
                                    <span class="{{ $userAnswer === $correctAnswer ? 'text-success' : 'text-danger' }}">
                                        {{ chr(97 + $userAnswer) }}
                                    </span>
                                    and
                                    <span class="text-success">{{ chr(97 + $correctAnswer) }} </span> is the correct answer.
                                </p>

                                @php $questionIndex++; @endphp
                            @endif

                        @endforeach
                    </div>
                </div>

            @elseif($quiz->quiz_type == 2)
                {{-- <h4 class="font-weight-bold ">Explain the following</h4> --}}
                @php
                    $quizData = json_decode($quiz->quiz_data, true)['exp'] ?? [];
                @endphp
                <div class="h4 text-danger">{!! $quizData['question'] !!}</div>
                <div class="jumbotron">{!! $quizData['answer'] !!}</div>
            @elseif($quiz->quiz_type == 3)
                {{-- <h4 class="font-weight-bold">Explanation And Explanation</h4> --}}
                @php
                    $quizData = json_decode($quiz->quiz_data, true)['exptoexp'] ?? [];
                @endphp
                @foreach($quizData as $key => $value)
                    <div class="h4 text-danger">{!! $value['exptoexp_question'] !!}</div>
                    <div class="jumbotron">{!! $value['exptoexp_answer'] !!}</div>
                @endforeach
            @endif
        </div>
        @if($quiz->quiz_type == 1)
            <div class="font-weight-bold my-3">You have <span class="text-success">{{$count_correct}} correct </span> answers and <span class="text-danger">{{$count_incorrect}} incorrect </span>answers </div>
        @endif
        <h4 class="font-weight-bold">
            Instructor Remark 
            <button class="btn btn-sm btn-primary" 
                data-toggle="modal" 
                data-target="#remarksModal"
                data-id="{{ $quiz->id }}"
                data-remarks="{{ $quiz->remarks }}">
                Update Remarks
            </button>

        </h4>
        <div>{{$quiz->remarks}}</div>
        <hr class="bg-success border-3" />
        @endforeach

    </div>

    <!-- Modal -->
    <div class="modal fade" id="remarksModal" tabindex="-1" role="dialog" aria-labelledby="remarksModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('quiz-update-remarks') }}">
        @csrf
        <input type="hidden" name="quiz_id" id="quizId">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="remarksModalLabel">Update Remarks</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea class="form-control" name="remarks" id="remarks" rows="3" required></textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </form>
    </div>
    </div>


</div>
@endsection

@push('sub_scripts')
<script>
    $('#remarksModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const quizId = button.data('id');
        const remarks = button.data('remarks');

        $('#quizId').val(quizId);
        $('#remarks').val(remarks);
    });
</script>
@endpush