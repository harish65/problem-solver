@extends('adult.layouts.adult')
@section('title', 'Problem | Adult')

@section('content')
<div class="container">
  <div class="bannerSection">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="bannerLeftSide">
          <h1>Welcome to The Speak Logic</h1>
          <h1><span>Problem Solver</span></h1>
          <h5>Think logically to solve problems </h5>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bannerImg">
          <img src="{{ url('/') }}/assets-new/images/banner-adult-dashboard.png" alt="Banner Image" />
        </div>
      </div>
    </div>
    <div class="row">
      
     
    </div>
  </div>
  <div class="row bannerSection">
    <div class="col">
      <div class="text-left">
        <div class="form-check">
          <h3>Project Name :{{  $data->projectDetails->name }}</h3>
          
        </div>
      </div>
      <div class="text-rght">
        <div class="form-check">
          <h3>User Name :{{  $data->shareduser->name }}</h3>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table slp-tbl text-center">
        <thead>
            <tr>
                <th>Module Name</th>
                <th>Read</th>
                <th>Write</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->toArray() as $key => $value)
                @if (!in_array($key, ['id', 'project_id', 'shared_with', 'timestamps', 'wasRecentlyCreated', 'exists', 'preventsLazyLoading', 'incrementing']))
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                        <td>
                            <span>
                                {{ ($value == 1) ? 'Write' : 'Read' }}
                            </span>
                        </td>
                        <td>
                            <span class="{{ ($value == 1) ? 'btn btn-success' : 'btn btn-danger' }}">
                                {{ ($value == 1) ? 'Yes' : 'No' }}
                            </span>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
</div>


@endsection