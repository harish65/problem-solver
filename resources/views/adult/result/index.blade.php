@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
<div class="container result  border border-success mt-5 border-10 bg-white  shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
        <div class="col-12">
            @if($users && $project->user_id == Auth::user()->id)
            <div class="form-group d-flex align-items-center">
                <label for="project_users" class="col-3">Select User:</label>

                <select class="form-control form-select" id="project_users">
                    <option selected="true" disabled="disabled">Select User..</option>
                    @foreach($users as $user)
                        <option  value='{{ Crypt::encrypt($user->id) }}' {{ ($userId == $user->id)  ?  'selected': '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
    </div>
    {{-- @dd($userQuiz, $project) --}}
    @if(isset($userQuiz) )
        <div class="row spl-row">
            <h4>Result: <span class="badge bg-success">{{$project->name}}</span></h4>
        </div>
        <div class="mb-3">
            <div>
                <div><b>User Name:</b> {{ $users->where('id', $userId)->pluck('name')->first() }}</div>
                <div><b>Project Name:</b> {{ $project->name }}</div>
            </div>
        </div>
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
            
            
            @endforeach

        </div>

        
    @endif

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
    $('#project_users').on('change', function () {
        const userId = $(this).val();
        const form = $('<form>', {
            method: 'POST',
            action: window.location.href
        });
        form.append($('<input>', {
            type: 'hidden',
            name: '_token',
            value: '{{ csrf_token() }}'
        }));
        form.append($('<input>', {
            type: 'hidden',
            name: 'id',
            value: userId
        }));
        $('body').append(form);
        form.submit();
    });


</script>
@endpush