@if(!is_null($Solution_function))
<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>Solution Function</h2>
        <div class="projectList text-center communication_rel">
            <div class="imgWrp">
            <img class="mx-auto" src=" {{ asset('assets-new/solFunction/'.$Solution_function->file)}}" width="100%"height="128px">
            </div>
            <p class="redText mt-3" style="color:#00A14C">{{ $Solution_function->name }}</p>
            <p class="date">{{ date('d/m/Y', strtotime($Solution_function->created_at))}}</p>
        </div>
    </div>
</div>
@endif