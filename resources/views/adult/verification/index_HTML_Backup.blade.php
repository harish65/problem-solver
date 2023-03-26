@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')

@section('content')

<div class='relationshipPage'>
      <div class="container">
        <div class="mainTitle">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center">
                        <h2>Verification</h2>
                        <select class="form-control custom-select" id="sel1">
                            <option value=''>Select Verification Type..</option>
                            @foreach($types as $type)
                                <option value='{{ $type->id }}'>{{ $type->name }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Vocabulary Verification</h1>
                    <div class="relationImage text-center">
                        <img src="./images/relationship.png" alt="relationImage"/>
                    </div>
                    <p>The solution of a problem is given for that problem. In terms of communication, the solution of a problem has its own vocabulary and that vocabulary is natural to that solution. All words that enable the solution for that problem or enables us to solve that problem belong to that vocabulary. It is not possible to add extra words or extra vocabulary. Therefore, the solution of Problem Name has a single vocabulary.</p>
                </div>
                <div class="principleRelation">
                    <div class="principleRelationInner">
                        <div class="principleRelationWrap">
                            <div class="principleRelationWrapper">
                            <div class="principleSelector">
                                <div class="principleSelectorInner text-center">
                                    <label>Principles</label>
                                    <ul>
                                        <li><a href="#">Principle 1</a></li>
                                        <li><a href="#">Principle 1</a></li>
                                        <li><a href="#">Principle 1</a></li>
                                        <li><a href="#">Principle 1</a></li>
                                        <li><a href="#">Principle 1</a></li>
                                        <li><a href="#">Principle 1</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="principleSelector">
                                <div class="principleSelectorInner  text-center">
                                    <label>Communication</label>
                                    <ul class="d-flex align-items-center communicate justify-content-center">
                                        <li>Communication text here</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                            <img src="./images/relation.png" alt="relationImage"/>
                        </div>
                    </div>
                    <div class="questionWrap">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                        <h2>Validation Question</h2>
                        <h3>Do you understand the relationship between communication and principle in a project?   </h3>
                        <ul>
                            <li>Yes, I do understand the relationship between communication and principle in a project.</li>
                            <li>No, I do not understand the relationship between communication and principle in a project. </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Section End -->
  </div>

@endsection


