<?php
$entitiesAvailable = $data['verification'][7]['entitiesAvailable'] ?? [];

$givenSet = $data['verification'][7]['givenSet'] ?? null;
$allVarifications = $data['verification'][7]['allVarifications'] ?? [];
$validation = $data['verification'][7]['validations']['validation_1'] 
?>
<section>
    <h2>Entity Available &amp; Entity Given Verification</h2>

    {{-- Entity Available Section --}}
    <h3>Entity Available</h3>
    <table>
        <thead>
            <tr>
                <th>Entity Count</th>
                <th>Entity Name</th>
                <th>Actual Entity</th>
                <th>Usage</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @foreach($entitiesAvailable as $entity)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $entity->entity }}</td>
                    <td>{{ $entity->actual_entity }}</td>
                    <td>
                        @if($entity->is_used ?? true) {{-- Adjust if you have a specific column for usage --}}
                            <span class="yes"><i class="fa-solid fa-check"></i> Yes</span>
                        @else
                            <span class="no">No</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Entity Given Section --}}
    <h3>Entity Given</h3>
    @if($givenSet)
        <table>
            <thead>
                <tr>
                    <th>Principle Count</th>
                    <th>Actual Principle</th>
                    <th>Usage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allVarifications as $key=>$data)
                    @php $applicable = \App\Models\PrincipleIdentificationMain::getApplicable($project_id , @$givenSet['principle_type'] ,  $data->id); 
                     
                    @endphp

                    @if($givenSet['principle_type'] == 0 && ($data->id == 4 || $data->id == 5 || $data->id == 10) ) 
                                <tr class="table-active">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->text }}</td>
                                    <td>{{ ($applicable == 1) ? 'Yes':'No' }}</td>
                                    
                                </tr>
                                @else
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->text }}</td>
                                    <td>{{ ($applicable == 1) ? 'Yes':'No'  }}</td>
                                </tr>
                                @endif

                    @endforeach
            </tbody>
        </table>

        {{-- Final Answer --}}
         <p><strong>Does the problem exist from past to present?</strong></p>
    @if($validation == 1)
        <div class="answer">
            <span class="yes">Yes</span>, I do understand the relationship between communication and principle in a project
        </div>
    @else
        <div class="answer">
            <span class="no">No</span>, I haven’t disregarded what is given to me to solve the underlying problem
        </div>
    @endif
@endif
</section>