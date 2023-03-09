<div class="modal fade bd-example-modal-lg" id="addVerificationTypeModal" tabindex="-1" role="dialog"
    aria-labelledby="addVerificationTypeModal" aria-hidden="true">
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Verification type</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="containner modal-body">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="updateVerificationTypeName"
                                placeholder="Name">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="page_main_title" class="form-control" id="page_main_title"
                                placeholder="Title">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="banner" class="form-control" id="banner">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" name="explanation" id="explanation"
                                placeholder="Explanation Text....."></textarea>
                        </div>
                    </div>
                    <div class="after-add-more">
  
                        <div class="col-md-12">                                
                            <div class="form-group">                               
                                <input type="text" name="validation_questions" class="form-control"  id="validation_questions" placeholder="Validation Question">
                            </div>
                        </div>
                        <div class="col-md-12 form-row add-more-option-div">
                            <div class="col-md-10">
                                <div class="form-group">                               
                                    <input type="text" name="validation_questions" class="form-control" id="validation_questions" placeholder="Add Option">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group change"> 
                                    <a class="btn btn-success add-more-option">+</a>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <button type="button" class="btn btn-success add-more-option-question">Add Question</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="button" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>