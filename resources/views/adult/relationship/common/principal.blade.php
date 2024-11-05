<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>Principal</h2>
        <div class="projectList text-center communication_rel">
                @if($principal->principle_type == 0)
                    <ol style='display:grid;font-size:0.7rem;text-align: left;'>
                        <li>The Given Set of Communication Principle</li>
                        <li>The Given Set of Information Principle</li>
                        <li>The Given Set of Instrumentation Principle</li>
                        <li>The Given Set of Education Principle</li>
                        <li>The Given Set of Power Principle</li>
                        <li>The Given Set of Marketing Principle</li>
                        <li>The Given Set of Exchange Principle</li>
                        <li>The Given Set of Gaming Principle</li>
                        <li>The Give Set of Work Principle</li>
                        <li>The Given Set of Reproduction Principle</li>
                    </ol>
                @else
                        <p style='font-size:0.7rem;text-align: left;'>{{ strip_tags($principal->content) }}</p>
                @endif
        </div>
    </div>
    
</div>
