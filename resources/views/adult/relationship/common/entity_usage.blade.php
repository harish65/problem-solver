
<div class="blockProblem">
    <div class="projectBlock text-center">
        <h2>Entity usage</h2>
        <div class="projectList text-center communication_rel">
            <div class="imgWrp">
                @php
                    $entities = \App\Models\Relationship::getEntities($project_id);
                @endphp
                    @if($entities->count() > 0)
                    <div id="available_slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @php $index = 0; @endphp
                                @foreach($entities as $entity)
                                        <li data-target="#available_slider" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                @php $index++; @endphp
                            @endforeach 
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            @php $index = 1; @endphp
                                @foreach($entities as $entity)
                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} " data-entity_id="{{$entity->id}}" data-file="{{ $entity->media }}" data-name="{{ $entity->entity }}" data-actualname="{{ $entity->actual_entity }}">
                                        <img  src="{{ asset('assets-new/verification_types/entity-available/'.$entity->media)}}" alt="Chania" width="80%" height="128px">
                                    </div>
                                @php $index++; @endphp
                            @endforeach    
                                
                        </div>
                    </div>
                    @else
                    <p>No Entity Available</p>
                    @endif
                    <p class="redText" style="color:red">Available</p>
                </div>
            </div>
        </div>
    </div>

