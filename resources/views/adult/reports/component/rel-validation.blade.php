
@php
    
    $config = config('relationship.' . $type);
    $ans =  json_decode(\App\Models\Relationship::getValidationAns($project_id , $data['problem']['id'] , $data['userID'], $type));
    
    $yes = preg_replace('/^Yes,\s*/', '', $config['ans_1_1']);
    $no = preg_replace('/^No,\s*/', '', $config['ans_1_2']);

@endphp
    <p><strong>{{ $config['que_1'] }}</strong></p>
@if(@$ans == 1)
    <div class="answer"><span class="yes"><i class="fa-solid fa-check"></i> Yes</span>, {{ $yes }}</div>
@elseif(@$ans == 0)
    <div class="answer"><span class="no"><i class="fa-solid fa-check"></i> No</span>, {{ $no }}</div>
@endif