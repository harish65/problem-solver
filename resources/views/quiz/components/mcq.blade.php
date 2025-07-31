<!-- Quiz Content Area (Dynamic) -->

<!-- MCQ Section -->
<div class="card p-3 quizformborder d-none " id="qtype1">
        <h5 class="text-center mb-3">Add Explantion and MCQ Questions</h5>
        <div id="quizForm"></div>

        <div class="d-flex justify-content-between mt-3">
            
            <button type="button" class="btn btn-primary" id="addQuestionBtn"><i class="fa fa-plus-circle"></i> Add Question </button>
            
        </div>
</div>

<!-- Explanation + MCQ -->
<div class="d-none" id="qtype2">
  <label for="editor" class="form-label">Explanation Only</label>
  <textarea class="form-control" name="quiz_data[exp]"></textarea>
</div>

<div class="card p-3 quizformborder d-none" id="qtype3">
    <label class="form-label">Explanation And Explanation</label>
    <div id="multiEditorContainer"></div>
    <div class="d-flex justify-content-between mt-3">
          <button type="button" id="addEditorBtn" class="btn btn-sm btn-outline-primary mb-3"><i class="fa fa-plus-circle"></i> Add Question</button>
      </div>
</div>


