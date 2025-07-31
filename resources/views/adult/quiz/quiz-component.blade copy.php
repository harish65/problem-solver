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


@if($quiz)

    @if($project->user_id == Auth::user()->id || $isPermitted)
    <div class="container border border-success border-4 bg-white  shadow-lg p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center"> {{-- Center the content --}}
            <div class="col-md-12"> {{-- Main column --}}
                <div class="row mb-4">
                    @if($project->user_id == Auth::user()->id)
                    <div class="col-12">
                        <h5 class="mb-3">Quiz Users</h5>
                        @php
                            $users = \App\Models\Quiz::getQuisUsers($project->id, $quiz->id);
                        @endphp
                        <select class="form-select form-select-lg" id="view_quiz_users">
                            <option value="">Please Select...</option>
                            @foreach ($users as $user)
                                <option value="{{ Crypt::encrypt($user->user_id) }}">{{ $user->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>

                <div id="quizContent" class="mb-5"></div>
            </div> {{-- /col-md-8 --}}
        </div> {{-- /row --}}
    </div> {{-- /container --}}
    @endif
@endif




@push('sub_scripts')
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    var projectId = '{{ Crypt::encrypt($project->id )}}';
    var submitted = '{{ $submitted }}';
    var isProjectOwner = '{{ $isProjectOwner }}';
    var isPermitted = '{{ $isPermitted }}';
    var pageId = '{{$pageId}}';
    var pageType = '{{$pageType}}';
    var quizAvailable = '{{isset($quiz)}}';
    
    @if($project -> user_id == Auth::user() -> id)
        
    document.getElementById('view_quiz_users').addEventListener('change', function() {
        const userId = this.value;
        
        if (!userId) {
            document.getElementById('quizContent').innerHTML = '';
            return toastr.error('User must be selected')
        }
        if (quizAvailable) {
            loadQuizContent(userId, projectId, submitted, isProjectOwner, isPermitted);
        }

    });
    @endif

    if (!isProjectOwner && quizAvailable) {
        loadQuizContent(null, projectId, submitted, isProjectOwner, isPermitted);

    }

    function loadQuizContent(userId, projectId, submitted, isProjectOwner, isPermitted) {
        fetch("{{ route('get-quiz') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    user_id: userId,
                    project_id: projectId,
                    submitted: submitted,
                    is_owner: isProjectOwner,
                    is_permitted: isPermitted,
                    page_type: pageType,
                    page_id: pageId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('quizContent').innerHTML = data.html;
                    if (!submitted && quizAvailable)
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
                            toastr.error(data.error)
                    // document.getElementById('quizContent').innerHTML = `<div class="alert alert-danger" role="alert">${data.error}</div>`;
                }
            })
            .catch(error => {
                toastr.error(error)
                // document.getElementById('quizContent').innerHTML = `<div class="alert alert-danger" role="alert">${error}</div>`;

            });
    }
</script>
@endpush('sub_scripts')