@extends('adult.layouts.adult')
@section('title', 'Project | Adult')   

@section('content')
@php
$categories = \App\Models\VerificationType::verificationTypeCategories(); 
$types      = \App\Models\VerificationType::all();
@endphp

<div class="container my-4">
  <div class="row mb-4">
  <div class="col-12 d-flex justify-content-between align-items-center">
    <h3 class="mb-0">Edit {{ $quiz->quiz_title }} Quiz</h3>
    <a href="{{route('quiz' , Crypt::encrypt($quiz->project_id))}}" class="btn btn-success mb-0"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  </div>
  <div class="row mb-4">
    <form  class="quizSection" action="{{route('update-quiz', Crypt::encrypt($quiz->id))}}" method="post" id="form-quiz">
      @csrf
      <div class="card p-4 border border-success quizformborder">
        <input type="project_id" name="project_id" value="{{$quiz->project_id}}" hidden>
        
        <!-- Page Selection -->
        <div class="mb-3">
          <label class="form-label" for="pages">Select Page to Add Quiz</label>
          <select class="form-select" name="page_id" id="pages">
            <option selected disabled>Select Page..</option>
            <optgroup label="Default Pages">
              <option value="1001" {{ $quiz->page_id == 1001 ? 'selected' : '' }}>Problem</option>
              <option value="1002" {{ $quiz->page_id == 1002 ? 'selected' : '' }}>Solution</option>
              <option value="1003" {{ $quiz->page_id == 1003 ? 'selected' : '' }}>Solution Function</option>
            </optgroup>
              @foreach($categories as $cat)
                @php
                  $filteredTypes = $types->where('category', $cat->id);
                @endphp
                @if($filteredTypes->isNotEmpty())
                  <optgroup label="Verifications - {{ $cat->name }}">
                    @foreach($filteredTypes as $type)
                      <option value="{{ $type->id }}" {{ $quiz->page_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                  </optgroup>
                @endif
              @endforeach
          </select>
        </div>

        <!-- Quiz Title -->
        <div class="mb-3">
          <label for="quizTitle" class="form-label">Quiz Title</label>
          <input type="text" id="quizTitle" value="{{ $quiz->quiz_title }}" name="quiz_title" class="form-control" placeholder="Enter quiz title">
        </div>

        <!-- Quiz Type -->
        <div class="mb-3">
          <label for="quizType" class="form-label">Quiz Type</label>
          <select id="quizType" disabled name="quiz_type" class="form-select">
            <option selected disabled>Select quiz type</option>
            @foreach($quizTypes as $type)
              <option value="{{ $type->id }}"   {{ $quiz->quiz_type == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
            @endforeach
          </select>
        </div>
        <div id="quizContentArea">
            
                @include('quiz.components.edit_mcq')
                
        </div>
        <!-- Submit Button -->
        <div class="text-end mt-4">
          <button type="submit" class="btn btn-success"  id="btnSave">
            <i class="bi bi-plus-circle me-1"></i> Submit Quiz
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('css')

@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });

    $('.delete_question').on('click', function() {
        if (confirm('Are you sure you want to delete this question?')) {
        $(this).closest('.question-block').remove(); 
        }
       
    });
</script>

@endsection