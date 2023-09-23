@push('body-class', 'contact-template page-template belle')
@push('body-header-class', 'animated')
@extends('layouts.app')
@section('content')
    <!--Page Title-->
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
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Contact Us</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    <div class="map-section map">
        <iframe src="https://www.google.com/maps/embed?pb=" height="350" allowfullscreen></iframe>
        <div class="container">
            <div class="row">
                <div class="map-section__overlay-wrapper">
                    <div class="map-section__overlay">
                        <h3 class="h4">Our store</h3>
                        <div class="rte-setting">
                            <p>123 Fake St.<br>Toronto, Canada</p>
                            <p>Mon - Fri, 10am - 9pm<br>Saturday, 11am - 9pm<br>Sunday, 11am - 5pm</p>
                        </div>
                        <p><a href="https://maps.google.com/?daddr=80%20Spadina%20Ave,%20Toronto" class="btn btn--secondary btn--small" target="_blank">Get directions</a></p>
                    </div>
                   </div>
            </div>
        </div>
    </div>
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="index.html" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Contact Us</span>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
                <h2>Drop Us A Line</h2>
                <p>Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500 </p>
                <div class="formFeilds contact-form form-vertical">
                  <form action="" method="post" id="contact_form" class="contact-form">
                  @csrf
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <input type="text" id="ContactFirstName" name="firstname" placeholder="First Name" data-error="Enter your first name">
                          @error('firstname')
                          <p class="error">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <input type="text" id="ContactLastName" name="lastname" placeholder="Last Name" data-error="Enter your last name">
                          @error('lastname')
                          <p class="error">{{ $message }}</p>
                          @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                        <input type="email" id="ContactFormEmail" name="email" placeholder="Email" data-error="Enter your email">
                        @error('email')
                          <p class="error">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                      <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                          <input type="tel" id="ContactFormPhone" name="phone" pattern="[0-9\-]*" placeholder="Phone Number" maxlength="10" data-error="Enter your phone">
                          @error('phone')
                          <p class="error">{{ $message }}</p>
                          @enderror
                         </div>
                      </div>
                      {{-- <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                        <input required="" type="text" id="ContactSubject" name="subject" placeholder="Subject" value="">
                        </div>
                      </div> --}}
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                        <textarea rows="10" id="ContactFormMessage" name="message" placeholder="Your Message" data-error="Enter your message"></textarea>
                        @error('message')
                          <p class="error">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="button" class="btn btn-contact" value="Send Message">
                    </div>
                 </div>
                 </form>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="open-hours">
                    <strong>Opening Hours</strong><br>
                    Mon - Sat : 9am - 11pm<br>
                    Sunday: 11am - 5pm
                </div>
                <hr />
                <ul class="addressFooter">
                    <li><i class="icon anm anm-map-marker-al"></i><p>55 Gallaxy Enque, 2568 steet, 23568 NY</p></li>
                    <li class="phone"><i class="icon anm anm-phone-s"></i><p>(440) 000 000 0000</p></li>
                    <li class="email"><i class="icon anm anm-envelope-l"></i><p>sales@yousite.com</p></li>
                </ul>
                <hr />
                {{-- <ul class="list--inline site-footer__social-icons social-icons">
                    <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Facebook"><i class="icon icon-facebook"></i></a></li>
                    <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Twitter"><i class="icon icon-twitter"></i> <span class="icon__fallback-text">Twitter</span></a></li>
                    <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Pinterest"><i class="icon icon-pinterest"></i> <span class="icon__fallback-text">Pinterest</span></a></li>
                    <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Instagram"><i class="icon icon-instagram"></i> <span class="icon__fallback-text">Instagram</span></a></li>
                    <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Tumblr"><i class="icon icon-tumblr-alt"></i> <span class="icon__fallback-text">Tumblr</span></a></li>
                    <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on YouTube"><i class="icon icon-youtube"></i> <span class="icon__fallback-text">YouTube</span></a></li>
                    <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Vimeo"><i class="icon icon-vimeo-alt"></i> <span class="icon__fallback-text">Vimeo</span></a></li>
                </ul> --}}
            </div>
        </div>
  </div>
<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="border-bottom:none!important; padding:0em!important">
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="mymodal-body" style="padding-left:2rem!important">
      </div>
    </div>
  </div>
</div>
@push('script')
<script>
$(document).ready(function () {
  $("#my-loader").css("display",'none');
  $("#myModal1").modal('hide');
});
// function pre_loader(){
// 		$("#load").fadeOut();
// 		$('#pre-loader').delay(0).fadeOut('slow');
// 	}
// $(window).on('beforeunload', function(){
//     pre_loader();
// });
$('.btn-contact').click(function (e) { 
  e.preventDefault();   
   $("#myModal1").modal('show');
   var errorMesage = [];
   var firstname = $("#ContactFirstName").val();
   var lastname = $("#ContactLastName").val();
   var email = $("#ContactFormEmail").val();
   var emailReg = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   var phone = $("#ContactFormPhone").val();
   var message = $("#ContactFormMessage").val();
   if(firstname == ''){
        $("#ContactFirstName").addClass('invalid-feedback');
        errorMesage.push($("#ContactFirstName").attr("data-error"))
    }else{
        $("#ContactFirstName").removeClass('invalid-feedback');
    }
    if(lastname == ''){errorMesage.push($("#ContactLastName").attr("data-error"))
        $("#ContactLastName").addClass('invalid-feedback');
    }else{
        $("#ContactLastName").removeClass('invalid-feedback');
    }
    if(email == ''){
        errorMesage.push($("#ContactFormEmail").attr("data-error"))
        $("#ContactFormEmail").addClass('invalid-feedback');
    }else if(emailReg.test(email) == false){
        errorMesage.push("Please enter a valid email");
    }else{
        $("#ContactFormEmail").removeClass('invalid-feedback');
    }
    if(phone == ''){errorMesage.push($("#ContactFormPhone").attr("data-error"))
        $("#ContactFormPhone").addClass('invalid-feedback');
    }else{
        $("#ContactFormPhone").removeClass('invalid-feedback');
    }
    if(message == ''){errorMesage.push($("#ContactFormMessage").attr("data-error"))
        $("#ContactFormMessage").addClass('invalid-feedback');
    }else{
        $("#ContactFormMessage").removeClass('invalid-feedback');
    }
    let ul = `<ul type="none">${errorMesage.map(data =>
                `<li>${data}</li>`).join('')}
              </ul>`;
    $(".mymodal-body").html(ul);
    if(errorMesage.length == 0){
        $("#myModal1").modal('hide');
        $("#my-loader").css('display','block');
          $.ajax({
              type: "POST",
              url: "{{ route('contactstore') }}",
              data: $("#contact_form").serializeArray(),
                    "_token": "{{ csrf_token() }}",
              success: function (response) {
                if(response.success){
                    console.log(response);
                    $("#my-loader").css('display','none');
                    $("#contact_form")[0].reset();
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Thank you for contact us. we will contact you shortly!.',
                    })
                }
                if(response.error){
                  $("#my-loader").css('display','none');
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.errors,
                  })
                }
              },
              error: function(xhr){
                $("#my-loader").css('display','none');
                  $.each(xhr.responseJSON.errors, function(key,value) {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: value,
                    })
                  });
                
              }
          });
    }
  });
</script>
@endpush
@endsection