@extends('admin.layouts.master')
@section('title', 'Home | Admin')

@section('content')
<div class="container">
<div class="row spl-row">
        <h4>View User</h4>
    </div>
    <div class="row p-5">
        <div class="col-md-4">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <img src="{{ asset("assets/vendors/images/avatar/" . $user -> avatar ) }}" id="changeAvatarImg" alt="" class="avatar-photo">
                   
                </div>
                <h5 class="text-center h5 mb-0">test</h5>
                <p class="text-center text-muted font-14">I am an Adult.</p>
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                        <ul class="list-style-none">
                            <li>
                                <span>Full Name</span>
                                <p>{{ $user->name }}</p>
                            </li>
                            <li>
                                <span>Email Address</span>
                                <p>{{ $user->email }}</p>
                            </li>
                            <li>
                                <span>DOB</span>
                                <p>{{ $user->email }}</p>
                            </li>
                            <li>
                                <span>Phone Number</span>
                                <p>{{ $user->email }}</p>
                            </li>                            
                    </ul>
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab list-style-none" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Tasks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Timeline Tab start -->
                            <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                                <div class="pd-20">
                                    <div class="profile-timeline">
                                        <div class="timeline-month">
                                            <h5>August, 2020</h5>
                                        </div>
                                        <div class="profile-timeline-list">
                                            <ul>
                                                <li>
                                                    <div class="date">12 Aug</div>
                                                    <div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                                <li>
                                                    <div class="date">10 Aug</div>
                                                    <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                                <li>
                                                    <div class="date">10 Aug</div>
                                                    <div class="task-name"><i class="ion-ios-clock"></i>
                                                        Event Added</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                                <li>
                                                    <div class="date">10 Aug</div>
                                                    <div class="task-name"><i class="ion-ios-clock"></i>
                                                        Event Added</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="timeline-month">
                                            <h5>July, 2020</h5>
                                        </div>
                                        <div class="profile-timeline-list">
                                            <ul>
                                                <li>
                                                    <div class="date">12 July</div>
                                                    <div class="task-name"><i class="ion-android-alarm-clock"></i> Task
                                                        Added</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                                <li>
                                                    <div class="date">10 July</div>
                                                    <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="timeline-month">
                                            <h5>June, 2020</h5>
                                        </div>
                                        <div class="profile-timeline-list">
                                            <ul class="list-style-none">
                                                <li>
                                                    <div class="date">12 June</div>
                                                    <div class="task-name"><i class="ion-android-alarm-clock"></i> Task
                                                        Added</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                                <li>
                                                    <div class="date">10 June</div>
                                                    <div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                                <li>
                                                    <div class="date">10 June</div>
                                                    <div class="task-name"><i class="ion-ios-clock"></i>
                                                        Event Added</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit.</p>
                                                    <div class="task-time">09:30 am</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Timeline Tab End -->
                            <!-- Tasks Tab start -->
                            <div class="tab-pane fade" id="tasks" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    <div class="container pd-0">
                                        <!-- Open Task start -->
                                        <div class="task-title row align-items-center">
                                            <div class="col-md-8 col-sm-12">
                                                <h5>Open Tasks (4 Left)</h5>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-right">
                                                <a href="task-add" data-toggle="modal" class="btn btn-success" data-target="#task-add"><i class="fa fa-add"></i>Add</a>
                                            </div>
                                        </div>
                                        <div class="profile-task-list pb-30">
                                            <ul class="list-style-none">
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input" id="task-1">
                                                        <label class="custom-control-label" for="task-1"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                                    elit. Id ea earum.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2019</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input" id="task-2">
                                                        <label class="custom-control-label" for="task-2"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2019</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input" id="task-3">
                                                        <label class="custom-control-label" for="task-3"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                                    elit.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2019</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input" id="task-4">
                                                        <label class="custom-control-label" for="task-4"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet. Id ea earum.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2019</span></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Open Task End -->
                                        <!-- Close Task start -->
                                        <div class="task-title row align-items-center">
                                            <div class="col-md-12 col-sm-12">
                                                <h5>Closed Tasks</h5>
                                            </div>
                                        </div>
                                        <div class="profile-task-list close-tasks">
                                            <ul class="list-style-none">
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="task-close-1" checked="" disabled="">
                                                        <label class="custom-control-label" for="task-close-1"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                                    elit. Id ea earum.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2018</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="task-close-2" checked="" disabled="">
                                                        <label class="custom-control-label" for="task-close-2"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2018</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="task-close-3" checked="" disabled="">
                                                        <label class="custom-control-label" for="task-close-3"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                                    elit.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2018</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="task-close-4" checked="" disabled="">
                                                        <label class="custom-control-label" for="task-close-4"></label>
                                                    </div>
                                                    <div class="task-type">Email</div>
                                                    Lorem ipsum dolor sit amet. Id ea earum.
                                                    <div class="task-assign">Assigned to Ferdinand M.
                                                        <div class="due-date">due date <span>22 February
                                                                2018</span></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Close Task start -->
                                        <!-- add task popup start -->
                                        <div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Tasks Add
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close" data-toggle="tooltip"
                                                            data-placement="bottom" title=""
                                                            data-original-title="Close Modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body pd-0">
                                                        <div class="task-list-form">
                                                            <ul class="list-style-none">
                                                                <li>
                                                                    <form>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Task
                                                                                Type</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Task
                                                                                Message</label>
                                                                            <div class="col-md-8">
                                                                                <textarea
                                                                                    class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Assigned
                                                                                to</label>
                                                                            <div class="col-md-8">
                                                                                <select
                                                                                    class="selectpicker form-control"
                                                                                    data-style="btn-outline-primary"
                                                                                    title="Not Chosen" multiple=""
                                                                                    data-selected-text-format="count"
                                                                                    data-count-selected-text="{0} people selected">
                                                                                    <option>Ferdinand M.
                                                                                    </option>
                                                                                    <option>Don H. Rabon
                                                                                    </option>
                                                                                    <option>Ann P.
                                                                                        Harris</option>
                                                                                    <option>Katie D.
                                                                                        Verdin</option>
                                                                                    <option>Christopher
                                                                                        S. Fulghum
                                                                                    </option>
                                                                                    <option>Matthew C.
                                                                                        Porter</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-0">
                                                                            <label class="col-md-4">Due
                                                                                Date</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control date-picker">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;" class="remove-task"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="" data-original-title="Remove Task"><i
                                                                            class="ion-minus-circled"></i></a>
                                                                    <form>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Task
                                                                                Type</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Task
                                                                                Message</label>
                                                                            <div class="col-md-8">
                                                                                <textarea
                                                                                    class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4">Assigned
                                                                                to</label>
                                                                            <div class="col-md-8">
                                                                                <select
                                                                                    class="selectpicker form-control"
                                                                                    data-style="btn-outline-primary"
                                                                                    title="Not Chosen" multiple=""
                                                                                    data-selected-text-format="count"
                                                                                    data-count-selected-text="{0} people selected">
                                                                                    <option>Ferdinand M.
                                                                                    </option>
                                                                                    <option>Don H. Rabon
                                                                                    </option>
                                                                                    <option>Ann P.
                                                                                        Harris</option>
                                                                                    <option>Katie D.
                                                                                        Verdin</option>
                                                                                    <option>Christopher
                                                                                        S. Fulghum
                                                                                    </option>
                                                                                    <option>Matthew C.
                                                                                        Porter</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mb-0">
                                                                            <label class="col-md-4">Due
                                                                                Date</label>
                                                                            <div class="col-md-8">
                                                                                <input type="text"
                                                                                    class="form-control date-picker">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="add-more-task">
                                                            <a href="#" data-toggle="tooltip" data-placement="bottom"
                                                                title="" data-original-title="Add Task"><i
                                                                    class="ion-plus-circled"></i> Add
                                                                More Task</a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary">Add</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- add task popup End -->
                                    </div>
                                </div>
                            </div>
                            <!-- Tasks Tab End -->
                            <!-- Setting Tab start -->
                            <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                <div class="profile-setting">
                                    <form method="post" id="personal_info_form">
                                        <ul class="profile-edit-list row">
                                            <li class="weight-500 col-md-6">
                                                <h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control form-control-lg" value="{{ @$user->name }}" name="name" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input class="form-control form-control-lg"  value="{{ @$user->personal_info->title }}" name="title" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control form-control-lg"  value="{{ @$user->email }}" name="email" type="email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Date of birth</label>
                                                    <input class="form-control form-control-lg date-picker" value="{{ @$user->personal_info->date_of_birth }}"  name="date_of_birth" type="date">
                                                </div>
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <div class="d-flex">
                                                        <div class="custom-control custom-radio mb-5 mr-20">
                                                            <input type="radio" id="customRadio4" name="gender" {{ (@$user->personal_info->gender == 'male') ? 'checked':'' }} value="male" class="custom-control-input">
                                                            <label class="custom-control-label weight-400"
                                                                for="customRadio4">Male</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" id="customRadio5"  name="gender" {{ (@$user->personal_info->gender == 'female') ? 'checked':'' }} value="female" class="custom-control-input">
                                                            <label class="custom-control-label weight-400"
                                                                for="customRadio5">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="selectpicker form-control form-control-lg"  name="country" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
                                                        <option value='US' value="{{ (isset($user->personal_info->country ) && $user->personal_info->country == 'US') ? 'selected':'' }}">United States</option>
                                                        <option valeu='IN' value="{{ (isset($user->personal_info->country ) && $user->personal_info->country == 'IN') ? 'selected':'' }}">India</option>
                                                        <option value='UK' value="{{ (isset($user->personal_info->country ) && $user->personal_info->country == 'UK') ? 'selected':'' }}">United Kingdom</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>State/Province/Region</label>
                                                    <input class="form-control form-control-lg" value="{{ @$user->personal_info->state }}"  name="state" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <input class="form-control form-control-lg" name="postal_code" value="{{ @$user->personal_info->postal_code }}"  type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input class="form-control form-control-lg" value="{{ @$user->phone_number }}" name="phone_number" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control"  name="address" >{{ @$user->personal_info->address }}</textarea>
                                                </div>
                                               
                                                
                                               
                                                <div class="form-group mb-0">
                                                    <button type="button" class="btn btn-success" id="personal_info" value="Update Information">Update Information</button>
                                                </div>
                                            </form>
                                            </li>

                                            <li class="weight-500 col-md-6">
                                            <form method="post" id="social_links_form">
                                                <h4 class="text-blue h5 mb-20">Edit Social Media links
                                                </h4>
                                                <div class="form-group">
                                                    <label>Facebook URL:</label>
                                                    <input class="form-control form-control-lg" value="{{ @$user->social_media_links->fb_url }}" type="text" name="fb_url" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Twitter URL:</label>
                                                    <input class="form-control form-control-lg" value="{{ @$user->social_media_links->twitter_url }}" type="text" name="twitter_url" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Linkedin URL:</label>
                                                    <input class="form-control form-control-lg" type="text" value="{{ @$user->social_media_links->linked_url }}" name="linked_url" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Instagram URL:</label>
                                                    <input class="form-control form-control-lg" type="text" name="instagram_url" value="{{ @$user->social_media_links->instagram_url }}" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Dribbble URL:</label>
                                                    <input class="form-control form-control-lg" type="text" name="dribble_url" value="{{ @$user->social_media_links->dribble_url }}" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Dropbox URL:</label>
                                                    <input class="form-control form-control-lg" type="text" name="dropbox_url" value="{{ @$user->social_media_links->dropbox_url }}" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Google-plus URL:</label>
                                                    <input class="form-control form-control-lg" type="text" name="google_plus_url" value="{{ @$user->social_media_links->google_plus_url }}" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pinterest URL:</label>
                                                    <input class="form-control form-control-lg" type="text" name="pinterest_url" value="{{ @$user->social_media_links->pinterest_url }}" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Skype URL:</label>
                                                    <input class="form-control form-control-lg" type="text" name="skype_url" value="{{ @$user->social_media_links->skype_url }}" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group">
                                                    <label>Vine URL:</label>
                                                    <input class="form-control form-control-lg" type="text" name="vine_url" value="{{ @$user->social_media_links->vine_url }}" placeholder="Paste your link here">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="button" class="btn btn-success" id="social_links" value="">Save & Update</button>
                                                </div>
                                            </li>
                                            </form>
                                        </ul>
                                    
                                </div>
                            </div>
                            <!-- Setting Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets-new/css/style-geo.css') }}">

<style>
    .list-style-none{
        list-style: none;
    }
    .list-style-none li span{
        color: #00A14C;
    }
    .nav nav-tabs .customtab .list-style-none{
        border-bottom: 1px solid #000;
        border-radius: 30px;
    }
    
</style>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $("#chageAvatarBtn").click(function () {
            $("#changeAvatarInput").trigger("click")
        });

        $('#changeAvatarInput').change(function (e) {
            var tmppath = URL.createObjectURL(e.target.files[0]);
            $("#changeAvatarImg").attr("src", tmppath)
        })
    })
</script>
<script>
     $(document).on('click','#personal_info',function(e){
        e.preventDefault();
        var fd = new FormData($('#personal_info_form')[0]);
        $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
        $.ajax({
            url: "{{route('user.updateInfo' , @$user->id)}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function(){
              $('#personal_info').attr('disabled',true);
              $('#personal_info').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#personal_info').attr('disabled',false);
                $('#personal_info').html('Upadte Information');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
              if(response.success == false)
              {
                  $('#personal_info').attr('disabled',false);
                  $('#personal_info').html('Login');
                  var errors = response.data;
                  $.each( errors, function( key, value ) {
                      toastr.error(value)
                  });
              } else {
                    toastr.success('Problem updated successfully!');
                    window.location.reload(true)

              }
            }
        });
    });


    $(document).on('click','#social_links',function(e){
        e.preventDefault();
        var fd = new FormData($('#social_links_form')[0]);
        $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
        $.ajax({
            url: "{{route('user.updateUserSocialInfo' , @$user->id)}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function(){
              $('#social_links').attr('disabled',true);
              $('#social_links').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#social_links').attr('disabled',false);
                $('#social_links').html('Save & Update');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
              if(response.success == false)
              {
                  $('#social_links').attr('disabled',false);
                  $('#social_links').html('Save & Update');
                  var errors = response.data;
                  $.each( errors, function( key, value ) {
                      toastr.error(value)
                  });
              } else {
                  toastr.success('Record updated successfully!');
                  window.location.reload(true)
              }
            }
        });
    });
</script>
@endsection