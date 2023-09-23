@push('body-class', 'template-collection belle')
@push('body-header-class', 'animated')
@extends('layouts.app')
@section('content')
<!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Checkout</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="customer-box returning-customer">
                    <h3><i class="icon anm anm-user-al"></i> Returning customer? <a href="#customer-login" id="customer" class="text-white text-decoration-underline" data-toggle="collapse">Click here to login</a></h3>
                    <div id="customer-login" class="collapse customer-content">
                        <div class="customer-info">
                            <p class="coupon-text">If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                            {{-- <form action="" method="POST">
                                <div class="row">
                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="exampleInputEmail1">Email address <span class="required-f">*</span></label>
                                        <input type="text" class="no-margin" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="exampleInputPassword1">Password <span class="required-f">*</span></label>
                                        <input type="password" id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check width-100 margin-20px-bottom">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value=""> Remember me!
                                            </label>
                                            <a href="#" class="float-right">Forgot your password?</a>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="customer-box customer-coupon">
                    <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i> Have a coupon? <a href="#have-coupon" class="text-white text-decoration-underline" data-toggle="collapse">Click here to enter your code</a></h3>
                    <div id="have-coupon" class="collapse coupon-checkout-content">
                        <div class="discount-coupon" id="mycoupon">
                            <div id="coupon" class="coupon-dec tab-pane active">
                                <p class="margin-10px-bottom">Enter your coupon code if you have one.</p>
                                <label class="required get" for="coupon-code"><span class="required-f">*</span> Coupon</label>
                                <input id="coupon-code" required="" type="text" class="mb-3">
                                <p class="error"><p>
                                <p class="success"><p>
                                <button class="coupon-btn btn" type="button">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="" method="POST" id="checkoutForm">
        @csrf
        <div class="row billing-fields">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                <div class="create-ac-content bg-light-gray padding-20px-all">
                    {{-- <form action="{{ route('processOrder') }}" method="POST"> --}}
                        {{-- @csrf --}}
                        <fieldset>
                            <h2 class="login-title mb-3">Shipping details</h2>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-firstname">First Name <span class="required-f">*</span></label>
                                    <input name="firstname" id="input-firstname" type="text" value="{{ old('firstname') }}" data-error="Please enter your first name!">
                                    @error('firstname')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-lastname">Last Name <span class="required-f">*</span></label>
                                    <input name="lastname" id="input-lastname" type="text" value="{{ old('lastname') }}" data-error="Please enter your last name!">
                                    @error('lastname')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-email">E-Mail <span class="required-f">*</span></label>
                                    <input name="email" id="input-email" type="text" value="{{ old('email') }}" data-error="Please enter a valid email id!">
                                    @error('email')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-telephone">Telephone <span class="required-f">*</span></label>
                                    <input name="telephone" maxlength="10" id="input-telephone" type="tel"  value="{{ old('telephone') }}" data-error="Please enter a valid contact number!">
                                    @error('telephone')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-company">Company <span class="required-f">*</span></label>
                                    <input name="company" value="" id="input-company" type="text" value="{{ old('company') }}" data-error="Please enter your company name!">
                                    @error('company')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-address-1">Address <span class="required-f">*</span></label>
                                    <input name="address_1" value="" id="input-address-1" type="text" value="{{ old('address_1') }}" data-error="Please enter your address!">
                                    @error('address_1')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                    <label for="input-address-2">Apartment</label>
                                    <input name="address_2" value="" id="input-address-2" type="text" value="{{ old('address_2') }}">
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-city">City <span class="required-f">*</span></label>
                                    <input name="city" id="input-city" type="text" data-error="Please enter your city!">
                                    @error('city')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-postcode">Post Code <span class="required-f">*</span></label>
                                    <input type="tel" name="postcode" pattern="^([0-9]*)$" id="input-postcode" value="{{ old('postcode') }}" data-error="Please enter a valid zip code!" onkeyup="javascript: this.value = this.value.replace(/[^0-9]/g,'');" maxlength="5">
                                    @error('postcode')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-country">Country <span class="required-f">*</span></label>
                                    <select name="country_id" id="country_id" data-error="Please select country!">
                                        <option value=""> --- Please Select --- </option>
                                        @foreach ($country as $key => $item)
                                        <option value="{{ $item['iso2'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-zone">Region / State <span class="required-f">*</span></label>
                                    <select name="zone_id" id="states_id" data-error="Please select your state!">
                                    </select>
                                    @error('zone_id')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group form-check col-md-12 col-lg-12 col-xl-12">
                                    <label class="form-check-label padding-15px-left">
                                        <input type="checkbox" class="form-check-input" value=""><strong>Create an account ?</strong>
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-company">Order Notes <span class="required-f">*</span></label>
                                    <textarea class="form-control resize-both" rows="3" name="notes"> {{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </fieldset>
                    {{-- </form> --}}
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="your-order-payment">
                    <div class="your-order">
                        <h2 class="order-title mb-4">Your Order</h2>

                        <div class="table-responsive-sm order-table"> 
                            <table class="bg-white table table-bordered table-hover text-center" id="checkout-table">
                                <thead>
                                    <tr>
                                        <th class="text-left">Product Name</th>
                                        <th>Price</th>
                                        <th>Size</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $qty = 0;
                                        $price = 0;
                                        $subtotals = 0;
                                    @endphp
                                    @if (!empty(session()->get('cart')))
                                    @foreach (session()->get('cart') as $item)
                                    <tr>
                                        <td class="text-left">{{ $item['name'] }}</td>
                                        <td>${{ number_format($item['price'],2) }}</td>
                                        <td>S</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>${{ number_format($item['qty']*$item['price']) }}</td>
                                    </tr>
                                    @php
                                        $qty = $item['qty'];
                                        $price = $item['price'];
                                        $subtotals += (int)$qty * (float)$price;
                                    @endphp
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot class="font-weight-600">
                                    <tr>
                                        <td colspan="4" class="text-right">Shipping</td>
                                        <td>$0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right">Subtotal</td>
                                        <td>${{ number_format($subtotals,2) ?? '0.00' }}</td>
                                    </tr>
                                    @php
                                        $sesvalue = session()->get('coupon.discountamount');
                                        if($sesvalue){
                                            $subtotals = $subtotals - $sesvalue;
                                        }
                                    @endphp
                                    @if (session()->get('coupon'))
                                    <tr>
                                        <td colspan="4" class="text-right">Coupon</td>
                                        <td>${{ number_format($sesvalue,2) ?? '0.00' }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4" class="text-right">Total</td>
                                        <td>${{ number_format($subtotals,2) ?? '0.00' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                    <hr />

                    <div class="your-payment">
                        <h2 class="payment-title mb-3">payment method</h2>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion" class="payment-section">
                                    {{-- <input type="hidden" name="cashondelivery" value="0"> --}}
                                    {{-- <input type="checkbox" name="cashondelivery" value="1">
                                    Cash on delivery --}}
                                    {{-- <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#collapseOne" id="cashondelivery">Cash on delivery</a>
                                        </div>
                                        <input type="hidden" name="cashondelivery">
                                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Make your payment directly at doorstep.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">Cheque Payment</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="card margin-15px-bottom border-radius-none">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree"> PayPal </a>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="card mb-2">
                                        {{-- <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour"> Payment Information </a>
                                        </div> --}}
                                        {{-- <div id="collapseFour" class="collapse" data-parent="#accordion"> --}}
                                            <div class="card-body">
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-cardno">Credit Card Number  <span class="required-f">*</span></label>
                                                            <input name="cardno" placeholder="Credit Card Number" id="input-cardno" class="form-control" type="tel" maxlength="16" onkeyup="javascript: this.value = this.value.replace(/[^0-9]/g,'');" data-error="Please enter a valid credit card number!">
                                                            @error('cardno')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-country">Credit Card Type <span class="required-f">*</span></label>
                                                            <select name="cardtype" class="form-control" id="input-cardtype" data-error="Please select a cardtype!">
                                                                <option value=""> --- Please Select --- </option>
                                                                <option value="AMEX">American Express</option>
                                                                <option value="VISA">Visa Card</option>
                                                                <option value="MASTER">Master Card</option>
                                                                <option value="DISCOVER">Discover Card</option>
                                                            </select>
                                                            @error('cardtype')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            @php
                                                                $month = [];
                                                                for ($m=1; $m<=12; $m++) {
                                                                    $month[] = date('M', mktime(0,0,0,$m, 1, date('Y')));
                                                                }
                                                            @endphp
                                                            <label for="input-cardno">Month  <span class="required-f">*</span></label>
                                                            <select name="month" class="form-control" id="input-month" data-error="Please select a valid expiry month!">
                                                                <option value="">Select option</option>
                                                                @foreach ($month as $key => $value)
                                                                <option value="{{ sprintf("%02d", $key+1) }}">{{ $value }}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                            @error('month')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-year">Year <span class="required-f">*</span></label>
                                                            <select name="year" class="form-control" id="input-year" data-error="Please select a valid expiry year!">
                                                                <option value="">Select option</option>
                                                                @foreach (range((int)date("Y"), 2039) as $year)
                                                                <option value="{{ $year }}">{{ $year }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('year')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <label for="input-cvv">CVV Code <span class="required-f">*</span></label>
                                                            <input name="cvv" placeholder="Card Verification Number" id="input-cvv" class="form-control" type="tel"  onkeyup="javascript: this.value = this.value.replace(/[^0-9]/g,'');" maxlength="3" data-error="Please enter a valid CVV code!">
                                                            @error('cvv')
                                                            <p class="error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                            <img class="padding-25px-top xs-padding-5px-top" src="assets/images/payment-img.jpg" alt="card" title="card" />
                                                        </div>
                                                    </div>
                                                </fieldset>

                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="order-button-payment">
                                <button class="btn" value="Place order" type="button" id="chckBtn">Place order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header" style="border-bottom:none!important; padding:0em!important">
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" style="padding-left:2rem!important">
        </div>
      </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function () {
        $("#my-loader").css("display",'none');
    });
    $("select[name='country_id']").on('change', function() {
        var cid = $(this).val();
        if(cid){
            $.ajax({
            type: "POST",
            url: "getStatesByCountry/"+cid,
            data: {
                "id":cid,
                "_token": "{{ csrf_token() }}",
            },
            dataType: 'Json',
            success: function (data) {
                if(data){
                    $('select[name="zone_id"]').empty();
                    $("#states_id").append(`<option value="">Select State</option>`);
                    $.each(data, function(key, value) {
                        $('select[name="zone_id"]').append('<option value="' + value.iso2 + '">' + value.name + '</option>');
                    });
                }else{
                    //$("#states_id").append(`<option value="">No State</option>`);
                    $("#states_id").empty()
                }
            }
        });
        }else{
            $('select[name="zone_id"]').empty();
        }
        
    })
</script>
<script>
$(".coupon-btn").on('click',function(e){
        e.preventDefault()
        var name = $("#coupon-code").val();
        $.ajax({
            type: "post",
            url: "{{ route('applyCoupon') }}",
            data: {
                "name":name,
                "_token": "{{ csrf_token() }}"
            },
            dataType: "Json",
            success: function (response) {
                $(".error").html(response.error)
                if(response.success){
                    $(".error").empty();
                    $("#coupon-code").val(null);
                    $(".success").html(response.success)
                    $("#checkout-table").load(location.href + " #checkout-table");
                    $("#have-coupon").load(location.href + " #have-coupon");
                }
            },
            error: function(response){
                var errors = response.responseJSON;
                  $.each(errors.error,function (k,v) {
                        $(".error").html(v)
                  });
            }
        });
})
$("#chckBtn").on('click', function(e){
    e.preventDefault()
    $("#myModal").modal('show');
    var errorMesage = [];
    var fname = $("#input-firstname").val();
    var lastname = $("#input-lastname").val();
    var email = $("#input-email").val();
    var emailReg = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var telephone = $("#input-telephone").val();
    var company = $("#input-company").val();
    var address = $("#input-address-1").val();
    var city = $("#input-city").val();
    var postcode = $("#input-postcode").val();
    var country = $("#country_id").val();
    var state = $("#states_id").val();
    var cardno = $("#input-cardno").val();
    var cardtype = $("#input-cardtype").val();
    var month = $("#input-month").val();
    var year = $("#input-year").val();
    var cvv = $("#input-cvv").val();
    var today = new Date();
    var expDate = new Date($("#input-year").val(),($("#input-month").val()-1)); // JS Date Month is 0-11 not 1-12 replace parameters with year and month
    if(fname == ''){
        $("#input-firstname").addClass('invalid-feedback');
        errorMesage.push($("#input-firstname").attr("data-error"))
    }else{
        $("#input-firstname").removeClass('invalid-feedback');
    }
    if(lastname == ''){errorMesage.push($("#input-lastname").attr("data-error"))
        $("#input-lastname").addClass('invalid-feedback');
    }else{
        $("#input-lastname").removeClass('invalid-feedback');
    }
    if(email == ''){
        errorMesage.push($("#input-email").attr("data-error"))
        $("#input-email").addClass('invalid-feedback');
    }else if(emailReg.test(email) == false){
        errorMesage.push("Please enter a valid email");
    }else{
        $("#input-email").removeClass('invalid-feedback');
    }
    if(telephone == ''){errorMesage.push($("#input-telephone").attr("data-error"))
        $("#input-telephone").addClass('invalid-feedback');
    }else{
        $("#input-telephone").removeClass('invalid-feedback');
    }
    if(company == ''){errorMesage.push($("#input-company").attr("data-error"))
        $("#input-company").addClass('invalid-feedback');
    }else{
        $("#input-company").removeClass('invalid-feedback');
    }
    if(address == ''){errorMesage.push($("#input-address-1").attr("data-error"))
        $("#input-address-1").addClass('invalid-feedback');
    }else{
        $("#input-address-1").removeClass('invalid-feedback');
    }
    if(city == ''){errorMesage.push($("#input-city").attr("data-error"))
        $("#input-city").addClass('invalid-feedback');
    }else{
        $("#input-city").removeClass('invalid-feedback');
    }
    if(postcode == ''){errorMesage.push($("#input-postcode").attr("data-error"))
        $("#input-postcode").addClass('invalid-feedback');
    }else{
        $("#input-postcode").removeClass('invalid-feedback');
    }    
    if(country == ''){errorMesage.push($("#country_id").attr("data-error"))
        $("#input-country_id").addClass('invalid-feedback');
    }else{
        $("#input-country_id").removeClass('invalid-feedback');
    }
    if(state == ''){errorMesage.push($("#states_id").attr("data-error"))
        $("#input-states_id").addClass('invalid-feedback');
    }else{
        $("#input-states_id").removeClass('invalid-feedback');
    }
    if(cardno == ''){errorMesage.push($("#input-cardno").attr("data-error"))
        $("#input-cardno").addClass('invalid-feedback');
    }else{
        $("#input-cardno").removeClass('invalid-feedback');
    }
    if(cardtype == ''){errorMesage.push($("#input-cardtype").attr("data-error"))
        $("#input-cardtype").addClass('invalid-feedback');
    }else{
        $("#input-cardtype").removeClass('invalid-feedback');
    }
    if(month == ''){errorMesage.push($("#input-month").attr("data-error"))
        $("#input-month").addClass('invalid-feedback');
    }else{
        $("#input-month").removeClass('invalid-feedback');
    }
    if(year == ''){errorMesage.push($("#input-year").attr("data-error"))
        $("#input-year").addClass('invalid-feedback');
    }else{
        $("#input-year").removeClass('invalid-feedback');
    }
    if(cvv == ''){errorMesage.push($("#input-cvv").attr("data-error"))
        $("#input-cvv").addClass('invalid-feedback');
    }else{
        $("#input-cvv").removeClass('invalid-feedback');
    }
    if(today.getTime() > expDate.getTime()) {
        errorMesage.push("Your Card is expired. Please check expiry date.");
    }
    let ul = `<ul type="none">${errorMesage.map(data =>
                `<li>${data}</li>`).join('')}
              </ul>`;
    $(".modal-body").html(ul);
    if(errorMesage.length == 0){
        $("#myModal").modal('hide');
        $("#my-loader").css('display','block');
        console.log("Good");
        $.ajax({
            type: "post",
            url: "{{ route('processOrder') }}",
            data: $("#checkoutForm").serializeArray(),
            success: function (response) {
                if(response.success){
                    $("#my-loader").css('display','none');
                    window.location.href = "{{ route('thank-you') }}"
                }                
            },
            error: function(xhr, status, errorThrown){
                console.log("Status!" + xhr.status);
                console.log("Response!" + xhr.responseText);
            },
        }).done(function(data){
            $("#my-loader").css('display','none');
            window.location.href = "{{ route('thank-you') }}"
        });
    }
    //console.log(errorMesage);
})
</script>
<script>
$("#input-cardno").focusout(function () {

var regVisa = /^4[0-9]{12}(?:[0-9]{3})?$/;
var regMasterCard = /^5[1-5][0-9]{14}$/;
var regAmex = /^3[47][0-9]{13}$/;
var regDiscover = /^6(?:011|5[0-9]{2})[0-9]{12}$/;

if (regVisa.test($(this).val())) {
    $("#input-cardtype").val("VISA").attr("selected", "selected");
    console.log("Visa");
}

else if (regMasterCard.test($(this).val())) {
    $("#input-cardtype").val("MASTER").attr("selected", "selected");
    console.log("Master");
}

else if (regAmex.test($(this).val())) {
    $("#input-cardtype").val("AMEX").attr("selected", "selected");
    console.log("Amex");
}
 else if (regDiscover.test($(this).val())) {
    $("#input-cardtype").val("DISCOVER").attr("selected", "selected");
    console.log("Discover");
}
else {
    $("#input-cardtype").val();
    console.log("NA");
}
});
</script>
@endpush
@endsection