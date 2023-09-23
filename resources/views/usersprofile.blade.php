@extends('layouts.app')
@section('content')
@push('style_css')
<style>
.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
</style>
@endpush
@if(Session::has('success'))
    <div class="alert alert-primary mt-2">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    {{Session::get('success')}}
    </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger mt-2">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        {{Session::get('error')}}
        </div>
    @endif
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Profile</h1></div>
        </div>
    </div>
        <br/>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <form action="{{ route('updateprofile') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    @if (!empty($userprofile->image))
                    <img class="img-account-profile rounded-circle mb-2" src="{{ asset('storage/images/users/'.$userprofile->image) }}" alt="">
                    @else
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    @endif
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <input type="file" class="btn btn-primary" name="image" id="exampleInputFile">
                    <!-- Profile picture upload button-->
                    {{-- <button class="btn btn-primary" type="button">Upload new image</button> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                            <input class="form-control" id="inputUsername" type="text" name="name" placeholder="Enter your username" value="{{ $userprofile->name ?? '' }}">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text" name="firstname" placeholder="Enter your first name" value="{{ $userprofile->firstname ?? '' }}">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" type="text" name="lastname" placeholder="Enter your last name" value="{{ $userprofile->lastname ?? ''}}">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Organization name</label>
                                <input class="form-control" id="inputOrgName" type="text" name="companyname" placeholder="Enter your organization name" value="{{ $userprofile->companyname ?? '' }}">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Location</label>
                                <input class="form-control" id="inputLocation" type="text" name="address" placeholder="Enter your location" value="{{ $userprofile->address ?? '' }}">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="email" placeholder="Enter your email address" value="{{ $userprofile->email ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Enter your password" value="{{ $userprofile->password ?? '' }}">
                        </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone" placeholder="Enter your phone number" value="{{ $userprofile->phone }}">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday" value="{{ $userprofile->birthdate }}">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $userprofile->id }}">
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    
                </div>
            </div>
        </div>
    </div>
</form>
</div>    
{{-- @push('script_src')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&libraries=places"></script>
@endpush
@push('script')
<script>
google.maps.event.addDomListener(window, 'load', initialize);
        
        function initialize() {
        var input = document.getElementById('inputLocation');
        var autocomplete = new google.maps.places.Autocomplete(input);
        
        autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        $('#latitude').val(place.geometry['location'].lat());
        $('#longitude').val(place.geometry['location'].lng());
        $("#latitudeArea").removeClass("d-none");
        $("#longtitudeArea").removeClass("d-none");
        });
        }
</script>
@endpush --}}
@endsection