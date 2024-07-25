<div class="container">
    <div class="row">
        @if($verificationType->id == 27)

        <div class="col-sm-12">
            <h1>{{ @$verificationType->page_main_title }}</h1>
            <p>{{ @$verificationType->explanation }}</p>
                <div class="relationImage text-center">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="imgWrp carousel-inner" role="listbox">
                                <div class="carousel-item active"  >
                                    <img  src="{{ asset('assets-new/verification_types/mn/mn1.png')}}" alt="Chania" width="100%">
                                </div>
                                <div class="carousel-item "  >
                                    <img  src="{{ asset('assets-new/verification_types/mn/mn2.png')}}" alt="Chania" width="100%">
                                </div>
                                <div class="carousel-item "  >
                                    <img  src="{{ asset('assets-new/verification_types/mn/mn3.png')}}" alt="Chania" width="100%">
                                </div>
                                <div class="carousel-item "  >
                                    <img  src="{{ asset('assets-new/verification_types/mn/mn4.png')}}" alt="Chania" width="100%">
                                </div>
                            </div>
                            <ol class="carousel-indicators custom">
                                <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                                <li data-target="#myCarousel" data-slide-to="4" class=""></li>
                            </ol>
                    </div>
                </div>
        </div>
        

        @elseif($verificationType->id == 31)
        <div class="col-sm-12">
            <h1>{{ @$verificationType->page_main_title }}</h1>
            <div class="relationImage text-center">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">

                    <div class="imgWrp carousel-inner" role="listbox">

                        <div class="carousel-item active">
                            <img src="{{ asset('assets-new/verification_types/problem_at_location/slide_one.png')}}" alt="Chania"
                                width="100%">
                        </div>
                        <div class="carousel-item ">
                            <img src="{{ asset('assets-new/verification_types/problem_at_location/slide_two.png')}}" alt="Chania"
                                width="100%">
                        </div>
                    </div>
                    <ol class="carousel-indicators custom">
                        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                        
                    </ol>
                </div>

            </div>
            <p>{{ @$verificationType->explanation }}</p>
            
        </div>
        @else
        <div class="col-sm-12">
            <h1>{{ @$verificationType->page_main_title }}</h1>

            <div class="relationImage text-center">
                <img src="{{asset('assets-new/verification_types/'.$verificationType->banner)}}" alt="relationImage" />
            </div>
            <p>{{ @$verificationType->explanation }}</p>
        </div>
        @endif
    </div>
</div>