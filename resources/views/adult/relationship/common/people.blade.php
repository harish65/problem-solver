<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>People</h2>
        <div class="projectList text-center sepration-step">
            <div class="imgWrp">
                <div id="myCarousel_people" class="carousel slide" data-ride="carousel" data-interval="2000">
                    <div class="carousel-inner" role="listbox">
                        @php $index = 1; @endphp
                        @foreach($custommers as $entity)
                            <div class="carousel-item {{ ($index == 1) ? 'active':'' }} ">
                                <img src="{{ asset('assets-new/users/'.$entity->file)}}" alt="Chania" width="80%" height="128px">                                                                        
                                <div class="carousel-caption custom">
                                    <ul style="display:block">
                                        <li>{{ $entity->name }}</li>
                                        <li style="color:red">{{ $entity->type }}</li>
                                    </ul>
                                </div>
                            </div>                                                                  
                        @php $index++; @endphp
                        @endforeach 
                    </div>
                    <ol class="carousel-indicators custom">
                        @php $index = 0; @endphp
                            @foreach($custommers as $entity)
                                    <li data-target="#myCarousel_people" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                            @php $index++; @endphp
                        @endforeach 
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
</div>
