<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>Information</h2>
        <div class="projectList text-center communication_rel">
            <div class="imgWrp">
                @if($verification->file == 1)
                    <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/default-001.jpg')}}" width="100%" height="128px">
                @else
                    <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/default-002.jpg')}}" width="100%" height="128px">
                @endif
                <p class="redText">Information</p>   
                <p class="date">{{ date('d/m/Y' , strtotime($verification->created_at)) }}</p>      
            </div>
           
        </div>
    </div>
</div>