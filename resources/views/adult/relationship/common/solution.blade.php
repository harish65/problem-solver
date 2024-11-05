
<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>Solution</h2>
        <div class="projectList text-center communication_rel">
            <div class="imgWrp">
            <img class="mx-auto" src=" {{ asset('assets-new/solution/'.$Solution->file)}}" width="100%"height="128px">
            </div>
            <p class="redText mt-3" style="color:#00A14C">{{ $Solution->name }}</p>
            <p class="date">{{ date('d/m/Y', strtotime($Solution->created_at))}}</p>
        </div>
    </div>
</div>
