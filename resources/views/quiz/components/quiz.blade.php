<div class="mb-5">
    {{-- @if($quiz && !$submitted) --}}
    @if($quiz && $isPermitted)
        @if($quiz->quiz_type == 1)
            @php
                if(!isset($userId)){
                    $quizData = json_decode($quiz->quiz_data, true)['mcq'] ?? [];
                }else if(isset($userQuiz)){
                    $quizData = json_decode($userQuiz->quiz_data, true)['mcq'] ?? [];
                }else{
                    $quizData = [];
                }
               
            @endphp
            @if(isset($quizData))
                <form id="quizForm1" method="post" action="{{ route('add-quiz-data') }}" enctype="multipart/form-data">
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

                                        <div class="question-block_student card p-4 mb-3 {{ $questionIndex == 0 ? 'active' : '' }}"
                                            data-index="{{ $questionIndex }}">
                                            <h6>Question {{ $questionIndex + 1 }}</h6>
                                            <input type="hidden" name="quiz_data[mcq][correct-{{ $questionIndex }}]"
                                                value="{{ $correctAnswer }}" />
                                            <div class="mb-2">
                                                <input type="text" name="quiz_data[mcq][question_{{ $questionIndex }}]" readonly
                                                    class="form-control" value="{{ $quizData["question_{$qIdx}"] ?? '' }}">
                                            </div>
                                            <div class="options">
                                                @for($i = 1; $i <= 4; $i++) 
                                                    @php 
                                                        $optKey="{$qIdx}_mcq_{$i}" ;
                                                        $isChecked=isset($correctAnswer) && $correctAnswer==$i - 1; 
                                                    @endphp 
                                                    <div class="input-group mb-2">
                                                        @if($isPermitted)
                                                            @if(isset($userQuiz))
                                                                <input type="hidden" name="id" value="{{ $userQuiz->id }}">
                                                            @endif
                                                                <div class="input-group-text">
                                                                    <input type="radio" name="quiz_data[mcq][correct-{{ $questionIndex }}]"
                                                                        value="{{ $i - 1 }}" {{ $isProjectOwner && $isChecked ? 'checked' : '' }} >
                                                                </div>
                                                                <input type="text" name="quiz_data[mcq][{{ $questionIndex }}_mcq_{{ $i }}]" readonly
                                                                    class="form-control" value="{{ $quizData[$optKey] ?? '' }}"
                                                                    placeholder="Option {{ $i }}">
                                                        @else
                                                            <div
                                                                class="input-group-text {{ $isChecked ? 'border border-success bg-success' : '' }}">
                                                                <input type="radio" name="" value="{{ $i - 1 }}" {{ $isChecked ? 'checked' : '' }}
                                                                    disabled>
                                                            </div>
                                                            <input type="text" name="quiz_data[mcq][{{ $questionIndex }}_mcq_{{ $i }}]" readonly
                                                                class="form-control {{ $isChecked ? 'border border-success' : '' }}"
                                                                value="{{ $quizData[$optKey] ?? '' }}" placeholder="Option {{ $i }}">
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
            @endif

        @elseif($quiz->quiz_type == 2)
            @php

                if(!isset($userId) && !isset($userQuiz)){
                    $quizData = json_decode($quiz->quiz_data, true)['exp'] ?? [];
                }else if(isset($userQuiz)){
                    $quizData = json_decode($userQuiz->quiz_data, true)['exp'] ?? [];
                }else{
                    $quizData = [];
                }

            @endphp
            @if(isset($quizData))
                <div class="" id="qtype2">
                    <h4>Explain the following</h4>
                    <hr/>
                    <form id="quizForm1" method="post" action="{{ route('add-quiz-data') }}" enctype="multipart/form-data">
                        @csrf

                        @if(!$isProjectOwner)
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                            <input type="hidden" name="project_id" value="{{ $quiz->project_id }}">
                            <input type="hidden" name="is_owner" value="0">
                        @endif
                        
                        @if($isProjectOwner)
                            <div class="h4 text-danger">{!! $quizData['question'] !!}</div>
                            <div class="jumbotron">{!! $quizData['answer'] !!}</div>
                            
                        @elseif(!$isProjectOwner && !isset($userQuiz))

                            <div class="jumbotron">{!! $quizData !!}</div>
                            <input type="hidden" name="quiz_data[exp][question]" value="{{ $quizData }}">
                            <textarea class="form-control" id="quiz_data_exp" name="quiz_data[exp][answer]" ></textarea>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success" id="submitBtnMcq">
                                    <i class="bi bi-plus-circle me-1"></i> Submit Quiz
                                </button>
                            </div>
                        @elseif(!$isProjectOwner && isset($userQuiz))
                            <div class="jumbotron">{!! $quizData['question'] !!}</div>
                            <input type="hidden" name="id" value="{{ $userQuiz->id }}">
                            <input type="hidden" name="quiz_data[exp][question]" value="{{ $quizData['question'] }}">
                            <textarea class="form-control" id="quiz_data_exp" name="quiz_data[exp][answer]" >
                                {{ $quizData['answer'] }}
                            </textarea>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success" id="submitBtnMcq">
                                    <i class="bi bi-plus-circle me-1"></i> Submit Quiz
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            @endif

          
        @elseif($quiz->quiz_type == 3)
            @php
                if(!isset($userId) && !isset($userQuiz)){
                    $quizData = json_decode($quiz->quiz_data, true)['exptoexp'] ?? [];
                }else if(isset($userQuiz)){
                    $quizData = json_decode($userQuiz->quiz_data, true)['exptoexp'] ?? [];
                }else{
                    $quizData = [];
                }

            @endphp
            <div class="card p-3 quizformborder" id="qtype3">
                <label class="form-label mb-5">Explanation And Explanation</label>
                
                <form id="quizForm1" name="quizForm1" method="post" action="{{ route('add-quiz-data') }}" enctype="multipart/form-data">
                        @csrf

                        @if(!$isProjectOwner)
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                            <input type="hidden" name="project_id" value="{{ $quiz->project_id }}">
                            <input type="hidden" name="is_owner" value="0">
                        @endif

                        @foreach($quizData as $key => $value)

                            @if($isProjectOwner)
                                <div class="h4 text-danger">{!! $value['exptoexp_question'] !!}</div>
                                <div class="jumbotron">{!! $value['exptoexp_answer'] !!}</div>
                            @elseif(!$isProjectOwner && !isset($userQuiz))
                                <div class="h4">{!! $value !!}</div>
                                <input type="hidden" name="quiz_data[exptoexp][{{$key}}][exptoexp_question]" value="{{$value }}">
                                <textarea class="form-control" id="quiz_data_exptoexp{{$key}}" name="quiz_data[exptoexp][{{$key}}][exptoexp_answer]" ></textarea>
                            @elseif(!$isProjectOwner && isset($userQuiz))
                            <input type="hidden" name="id" value="{{ $userQuiz->id }}">
                                <div class="h4">{!! $value['exptoexp_question'] !!}</div>
                                <input type="hidden" name="quiz_data[exptoexp][{{$key}}][exptoexp_question]" value="{{$value['exptoexp_question'] }}">
                                <textarea class="form-control" id="quiz_data_exptoexp{{$key}}" name="quiz_data[exptoexp][{{$key}}][exptoexp_answer]" >
                                    {{$value['exptoexp_answer'] }}
                                </textarea>
                            @endif
                        <hr class="mt-5 mb-5" />

                        @endforeach
                        @if(!$isProjectOwner)
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success" id="submitBtnMcq">
                                    <i class="bi bi-plus-circle me-1"></i> Submit Quiz
                                </button>
                            </div>
                        @endif
                    </form>
            </div>

            
            
        @endif
    @elseif($quiz && !$isPermitted)
        <div class="alert alert-success" role="alert">The Quiz is submitted!</div>
    @endif
</div>