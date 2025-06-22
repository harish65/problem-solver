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
    <h3 class="mb-0">Add New Quiz</h3>
    <a href="{{route('quiz' , $projectID)}}" class="btn btn-success mb-0"><i class="fa fa-arrow-left"></i>  Back</a>
</div>
  </div>
  <div class="row mb-4">
    <form  class="quizSection" action="{{route('store-quiz')}}" method="post" id="form-quiz">
      @csrf
      <div class="card p-4 border border-success quizformborder">
        <input  name="project_id" value="{{$projectID}}" hidden>
        <input  name="page_type" id ="page_type" value="" type="hidden">
        <!-- Page Selection -->
        <div class="mb-3">
          <label class="form-label" for="pages">Select Page to Add Quiz</label>
          <select class="form-select" name="page_id" id="pages">
            <option selected disabled>Select Page..</option>
            <optgroup label="Default Pages">
              <option data-page-type='problem' value="1001">Problem</option>
              <option data-page-type='solution' value="1002">Solution</option>
              <option data-page-type='solution-function' value="1003">Solution Function</option>
            </optgroup>
              @foreach($categories as $cat)
                @php
                  $filteredTypes = $types->where('category', $cat->id);
                @endphp
                @if($filteredTypes->isNotEmpty())
                  <optgroup label="Verifications - {{ $cat->name }}">
                    @foreach($filteredTypes as $type)
                      <option data-page-type='verification' value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                  </optgroup>
                @endif
              @endforeach
          </select>
        </div>

        <!-- Quiz Title -->
        <div class="mb-3">
          <label for="quizTitle" class="form-label">Quiz Title</label>
          <input type="text" id="quizTitle" name="quiz_title" class="form-control" placeholder="Enter quiz title">
        </div>

        <!-- Quiz Type -->
        <div class="mb-3">
          <label for="quizType" class="form-label">Quiz Type</label>
          <select id="quizType" name="quiz_type" class="form-select">
            <option selected disabled>Select quiz type</option>
            @foreach($quizTypes as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
          </select>
        </div>
        <div id="quizContentArea">
          @include('quiz.components.mcq')
          <div class="text-end mb-3">
  
</div>

        </div>
        <!-- Submit Button -->
        <div class="text-end mt-4">
          <button type="submit" class="btn btn-success"  id="btnSave" disabled>
            <i class="bi bi-plus-circle me-1"></i> Submit Quiz
          </button>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection

@section('css')
<style>
  .question-block { display: none; }
  .question-block.active { display: block; }
</style>
@endsection

@section('css')
<style>
    .question-block { display: none; }
    .question-block.active { display: block; }
  </style>
@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
<script>
let maxQuestions = 1;
let currentQuestionIndex = 0;
let questions = [];

function createQuestionBlock(index) {
  const questionHTML = `
    <div class="question-block card p-4 mb-4 quizformborder"  data-index="${index}">
      <h5 class="mb-3">Question ${index + 1}</h5>

      <div class="mb-3">
        <label class="form-label">Question Title</label>
        <input type="text" class="form-control question-title" name="quiz_data[mcq][question_${index}]" placeholder="Enter question" required/>
      </div>

      <div class="options mb-3">
        ${[1,2,3,4].map(i => `
          <div class="input-group mb-2 option-input">
            <div class="input-group-text">
              <input type="radio" name="quiz_data[mcq][correct-${index}]" value="${i - 1}" required/>
            </div>
            <input type="text" class="form-control option-text" name="quiz_data[mcq][${index}_mcq_${i}]" placeholder="Option ${i}" required/>
          </div>
        `).join('')}
        <button type="button" class="btn btn-sm btn-outline-primary add-option">+ Add Option</button>
      </div>
    </div>
  `;
  return $(questionHTML);
}

function showQuestion(index) {
  $(".question-block").removeClass("active");
  $(`.question-block[data-index="${index}"]`).addClass("active");
}


function saveCurrentQuestion(index) {
  
  const block = $(`.question-block[data-index="${index}"]`);
  const question = block.find('.question-title').val();
  const options = [];
  
  block.find('.option-text').each(function () {
    options.push($(this).val());
  });
  const answer = block.find(`input[type="radio"]:checked`).val();
  questions[index] = { question, options, answer };
  console.log(questions);
}

function restoreQuestion(index) {
  if (!questions[index]) return;
  const block = $(`.question-block[data-index="${index}"]`);
  const data = questions[index];
  block.find('.question-title').val(data.question);
  block.find('.option-text').each((i, el) => {
    if (data.options[i]) $(el).val(data.options[i]);
  });
  block.find(`input[type="radio"][value="${data.answer}"]`).prop("checked", true);
}

function init() { 
  // for (let i = 0; i < maxQuestions; i++) {
    const block = createQuestionBlock(0);
    $("#quizForm").append(block);
  // }
  showQuestion(currentQuestionIndex);
  restoreQuestion(currentQuestionIndex);
}

$(document).ready(function () {
  init();

  $('#addQuestionBtn').click(function () {
    maxQuestions++;
    
    const block = createQuestionBlock(maxQuestions - 1);
    $("#quizForm").append(block);
    $('#btnSave').prop('disabled', true);
    $("#nextBtnMcq").trigger('click');

  });
  $("#nextBtnMcq").click(function () {


    const block = $(`.question-block[data-index="${currentQuestionIndex}"]`);
    
    const questionInput = block.find('.question-title');
    if (!questionInput.val().trim()) {
        questionInput.focus();
        questionInput[0].setCustomValidity("Please enter the question title.");
        questionInput[0].reportValidity();
        return;
    } else {
        questionInput[0].setCustomValidity("");
    }

    const options = block.find('.option-text');
    let validOptions = 0;
    let emptyOption = false;
    options.each(function () {
        if ($(this).val().trim() !== '') {
            validOptions++;
        } else {
            emptyOption = true;
        }
    });

    if (validOptions < 4 || emptyOption) {
        alert('Please enter valid options and make sure none are empty.');
        return;
    }

    const selectedRadio = block.find(`input[type="radio"]:checked`).length;
    if (selectedRadio === 0) {
        alert('Please select the correct answer.');
        return;
    }



    saveCurrentQuestion(currentQuestionIndex);
    if (currentQuestionIndex < maxQuestions - 1) {
      currentQuestionIndex++;
      showQuestion(currentQuestionIndex);
      restoreQuestion(currentQuestionIndex);
    }
    if (currentQuestionIndex === maxQuestions - 1) {
            $('#btnSave').prop('disabled', false);
        } else {
            $('#btnSave').prop('disabled', true);
        }
  });

  $("#prevBtnMcq").click(function () {
    saveCurrentQuestion(currentQuestionIndex);
    if (currentQuestionIndex > 0) {
      currentQuestionIndex--;
      showQuestion(currentQuestionIndex);
      restoreQuestion(currentQuestionIndex);
    }
    if (currentQuestionIndex === maxQuestions - 1) {
            $('#btnSave').prop('disabled', false);
        } else {
            $('#btnSave').prop('disabled', true);
        }
  });

  $(document).on('click', '.add-option', function () {
    const optionsDiv = $(this).closest('.options');
    const index = $(this).closest('.question-block').data('index');
    const count = optionsDiv.find('.option-input').length;
    if (count >= 5) return;

    const newOption = `
      <div class="input-group mb-2 option-input">
        <div class="input-group-text">
          <input type="radio" name="quiz_data[mcq][correct-${index}]" value="${count}" />
        </div>
        <input type="text" class="form-control option-text" placeholder="Option ${count + 1}" />
      </div>
    `;
    $(newOption).insertBefore($(this));
  });
});

// Handle quiz submission


</script>
<script>
$(document).ready(function () {
    const maxEditors = 5;
    const editorIDs = [];

    // Generate 5 editors
    for (let i = 1; i <= maxEditors; i++) {
        const id = `editor_exp_${i}`;
        editorIDs.push(id);
        $('#multiEditorContainer').append(`
            <div class="mb-4">
                <label for="${id}" class="form-label">Question ${i}</label>
                <textarea id="${id}" name="quiz_data[exptoexp][]" class="form-control tinymce-editor"></textarea>
            </div>
        `);
    }

    // Init all 5 TinyMCE editors
    tinymce.init({
        selector: 'textarea[id^="editor_exp_"]',
        height: 250,
        menubar: false,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat'
    });

    // Show the qtype3 container if quizType is 3
    $('#quizType').on('change', function () {
        if ($(this).val() == 3) {
            $('#qtype3').removeClass('d-none');
        } else {
            $('#qtype3').addClass('d-none');
        }
    });
});

$(document).ready(function() {
        $('#quizType').change(function() {
            questions.length = 0;
            $('#quizForm').empty();
            currentQuestionIndex = 0;
            init();
            tinyMCE.activeEditor.setContent('');
          $('.tinymce-editor').each(function() {
            var editorId = $(this).attr('id');
            tinymce.get(editorId).setContent('');
          });
            var selectedValue = $(this).val();
            if (selectedValue == 1) {
                $('#qtype1').removeClass('d-none');
                $('#qtype2').addClass('d-none');
                $('#qtype3').addClass('d-none');
                
            } else if (selectedValue == 2) {
                $('#qtype1').addClass('d-none');
                $('#qtype2').removeClass('d-none');
                $('#qtype3').addClass('d-none');
            } else if (selectedValue == 3) {
                $('#qtype1').addClass('d-none');
                $('#qtype2').addClass('d-none');
                $('#qtype3').removeClass('d-none');
            }
        });
    });

    $('#pages').change(function() {
        var selectedValue = $(this).find(':selected').data('page-type');
        $('#page_type').val(selectedValue);
    });
</script>
@endsection