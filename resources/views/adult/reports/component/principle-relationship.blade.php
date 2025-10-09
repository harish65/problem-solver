<?php
            $principleUsage = $data['verification'][27]['principle_identification_usage'];
            $principle_identification = $data['verification'][27]['principle_identification']
         ?>
<table>
        <thead>
        <th>Principle Count 12</th>
        <th>Actual Principle</th>
        <th>Usage</th>
        
        </thead>
        <tbody>
            @foreach($principle_identification as $key=> $value)
                    @php
                        
                    $applicable = \App\Models\PrincipleIdentificationMain::getApplicable($project_id , @$principleUsage->principle_type ,  $value->id);
                    

                    @endphp
                    
                    @if(isset($principleUsage->principle_type) &&  $principleUsage->principle_type == 0 && ($value->id == 4 || $value->id == 5 || $value->id == 10) ) 
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->text }}</td>
                        <td>{{ ($applicable == 1) ? 'Yes':'No' }}</td>
                        
                    </tr>
                    @else
                    <tr> 
                        @if($value->id != 4 && $value->id != 5 && $value->id != 10)
                            <td>{{ ++$key }}</td>
                            <td>{{ $value->text }}</td>
                            <td>{{ ($applicable == 1) ? 'Yes':'No'  }}</td>
                            
                        @endif
                    </tr>
                    @endif
            @endforeach
        </tbody>
</table>