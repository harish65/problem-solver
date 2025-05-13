@extends('adult.layouts.adult')
@section('title', 'Project | Adult')   
 
@section('content')
<div class="projectlist" id="table-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-end">
                <a class="btn btn-success add-project-btn" href="{{route('add-quiz' , Crypt::encrypt($projectID))}}"><i class="fa fa-plus"></i>Add Quiz</a>
            </div>
            <table class="table slp-tbl" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Quiz Date</th>
                        <th>Quiz Name</th>
                        <th>Page</th>
                        <th>Quiz Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($quizzes as $key=>$quiz)
                                <tr>
                                <td>{{ ++$key }}</td>
                                    <td>{{ date('d-m-Y', strtotime($quiz->created_at)) }}</td>
                                    <td>{{ $quiz->quiz_title }}</td>
                                    <td>{{ ucwords($quiz->page_type) }}</td>
                                    <td>
                                        @if($quiz->quiz_type == 1)
                                            MCQ
                                        @elseif($quiz->quiz_type == 2)
                                            Explanation
                                        @elseif($quiz->quiz_type == 3)
                                            MCQ + Explanation
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button  class="btn btn-info btn-sm">Share <i class="fa fa-share-alt" aria-hidden="true"></i></button>
                                        <a href="{{ route('edit-quiz' , Crypt::encrypt($quiz->id)) }}" class="btn btn-primary btn-sm">Edit <i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('delete-quiz' , Crypt::encrypt($quiz->id)) }}" method="POST" id="delete_quiz_form" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" id="delete_quiz">Delete <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                        @endforeach
                    
                  
                </tbody>
            </table>
            
        </div>
        
    </div>   
</div>    

@endsection
@section('scripts')
<script>
    $('#delete_quiz').on('click', function (e) {
    e.preventDefault(); 
    if (confirm('Are you sure you want to delete this question?')) {
        $('#delete_quiz_form').submit();
    }   
});
</script>


@endsection