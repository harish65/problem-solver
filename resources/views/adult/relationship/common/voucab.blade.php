<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>Vacabulary</h2>
        <div class="projectList text-center communication_rel">
               <div class="imgwrp">
                <ul style="display:block !important;list-style:circle;list-style-position: inside;text-align:left;">
                    @foreach($words as $word)
                    <li>{{ $word->verification_key}}</li>
                    @endforeach
                </ul>
               </div>
        </div>
    </div>
</div>
