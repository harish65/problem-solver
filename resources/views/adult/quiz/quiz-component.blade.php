@php
    $quiz = \App\Models\Quiz::getQuiz($project->id , $pageId , $pageType);
    $submitted = true;
    if(!$quiz){
        $quiz = \App\Models\Quiz::where(['project_id'=>$project->id , 'page_id'=>$pageId , 'page_type'=> $pageType])->first();
        $submitted = false;
        
    }
    
    $isPermitted = \App\Models\Quiz::isProjectQuizEditable($project->id);
    $isProjectOwner = $project->user_id == auth()->user()->id;
    $questionIndex = 0;
@endphp 
    {{-- <div class="alert alert-primary" role="alert">No Quiz available for this page!</div> --}}
@if($project->user_id == Auth::user()->id)
    <div class="row mb-4">
        <div class="col-12 d-flex">
            <h3 class="mb-0">Quiz Users</h3>
            <div class="col-auto">
                @php 
                    $users = \App\Models\Quiz::getQuisUsers($project->id, $quiz->id);
                @endphp
                <select class="form-select form-select-lg mb-3" id="view_quiz_users" >
                    <option selected="true" disabled="disabled">Please Select...</option>
                    @foreach ($users as $user)
                        <option value="{{ Crypt::encrypt($user->user_id) }}" {{ ($user->id === $quiz?->user_id) ?  'selected':''}}>{{ $user->user_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endif
<div id="quizContent" class="mb-5">
    <div class="alert alert-info" role="alert">
        @if(isset($users) && is_null($users) && ($project->user_id == Auth::user()->id))
            Users didn't Submitted the Quiz
        @elseif(isset($users))
            No user selected
        @endif
    </div>
</div>


@push('sub_scripts')
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const projectId = '{{ Crypt::encrypt($project->id )}}';
    const submitted = '{{ $submitted }}';
    const isProjectOwner = '{{ $isProjectOwner }}';
    const isPermitted = '{{ $isPermitted }}';
    const pageId = '{{$pageId}}';
    const pageType = '{{$pageType}}';
    const quizAvailable = '{{isset($quiz)}}';
    console.log(quizAvailable);
    @if($project->user_id == Auth::user()->id)

        document.getElementById('view_quiz_users').addEventListener('change', function() {
            const userId = this.value;

            if(quizAvailable){
                loadQuizContent(userId, projectId, submitted, isProjectOwner, isPermitted);
            }
            
        });
    @endif

    if(!isProjectOwner && quizAvailable){
        loadQuizContent(null, projectId, submitted, isProjectOwner, isPermitted);

    }

    function loadQuizContent(userId, projectId, submitted, isProjectOwner, isPermitted) {
    fetch("{{ route('get-quiz') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ user_id: userId, project_id: projectId, submitted: submitted, is_owner: isProjectOwner, is_permitted: isPermitted, page_type: pageType, page_id: pageId })
        })
        .then(response => response.json())  
        .then(data => {
            if (data.success) {
                document.getElementById('quizContent').innerHTML = data.html;
                if(!submitted && quizAvailable)
                    updateQuestionIndex(0);
                // Init all 5 TinyMCE editors
                tinymce.init({
                    selector: 'textarea',
                    height: 250,
                    menubar: false,
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat'
                });
            } else {
                document.getElementById('quizContent').innerHTML =`<div class="alert alert-danger" role="alert">${data.error}</div>`;
            }
        })
        .catch(error => {
                document.getElementById('quizContent').innerHTML =`<div class="alert alert-danger" role="alert">${error}</div>`;

        });
    }


              
                
    
</script>
@endpush('sub_scripts')
