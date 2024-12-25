<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>Communications</h2>
        <div class="projectList text-center communication_rel">
            <div class="imgWrp">
                <div id="myCarousel_com" class="carousel slide " data-ride="carousel" data-interval="2000">
                    <div class="carousel-inner" role="listbox">
                        @php $index = 1; @endphp
                        @foreach($communications as $entity)
                            <div class="carousel-item {{ ($index == 1) ? 'active':'' }} ">
                                <p>

                                </p>                                                                        
                                <div class="carousel-caption custom">
                                    <ul style="display:block">
                                        <li>{{ $entity->title }}</li>
                                        <li>{{ strip_tags($entity->comment) }}</li>
                                        <li></li>
                                    </ul>
                                </div>
                            </div>                                                                  
                        @php $index++; @endphp
                        @endforeach 
                    </div>
                    <ol class="carousel-indicators custom">
                        @php $index = 0; @endphp
                        
                            @foreach($communications as $entity)
                           
                                    <li data-target="#myCarousel_com" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                            @php $index++; @endphp
                        @endforeach 
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>