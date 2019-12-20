@extends('layouts.layout')


@section('content')
<!--Page Content-->

    <div class="container general">
        <h4 class="topheading">Checkout</h4>
        <hr class="light">

        <div class="container general-items rounded bg-warning">
            <div class="del-pickup ">
                <div class="form-check form-check-inline rounded-content">
                    <input class="form-check-input" type="radio" id="inlineRadio1" name="del-method" value="delivery"
                        checked>
                    <label class="form-check-label" for="inlineRadio1">Delivery</label>
                </div>
                <div class="form-check form-check-inline rounded-content">
                    <input class="form-check-input" type="radio" id="inlineRadio2" name="del-method" value="pickup">
                    <label class="form-check-label" for="inlineRadio2">Pickup</label>
                </div>
            </div>
        </div>



if ((isset($_SESSION['email'])) && ($_SESSION['email'] !=""))
	{
	//If already logged-in
	//Autofill using SESSION customer data
	
	//Directly as Form 2 (Delivery details & Payment)
  <form action="../php/payment_method_router.php" method="post">
	
  <div class="container general-items">
    <h5 class="text-secondary">We have fetched your delivery details for you</h5>
            
  //if hidden existingCustomer id is YES, payment.js will not validate these address data
  //and only validates credit card info.
  //Also, reCaptcha will not be shown and Place the order button will be enabled.
  <input type="hidden" id = "existingCustomer" name="existingCustomer" value="YES">
  
  <h5 class="mt-4">'.$_SESSION["cust_name"].'</h5><p>'
          .$_SESSION["street_address"].'<br>'
          .$_SESSION["suburb"].'<br>'
          .$_SESSION["postcode"].'<br>'
          .$_SESSION["state"].'<br>'
          .$_SESSION["phone"].'<br>'
          .'</p>
  
  <button type='button' class='btn btn-outline-warning mt-1 ml-1' onclick=\"window.location.href='../php/member_account.php'\"><i class='fas fa-chevron-right'></i> Edit</button>
  </div>
	} 
else
	{
	//Not logged-in
  
  //Form 1 (Option to log-in now)
  //If this form is used to log-in at this point, flow goes through member_payment.php
  //where it validates the log-in details and SENDS BACK to payment.php
	
  <div class="container general-items">
    <h5 class="subheading">Member Checkout</h5>
    
    <form action="../php/member_payment_backend.php" method="post">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
        <span id="emailError" style="color: red; font-weight: normal;"></span>
      </div>
      <div class="form-group">
        <label for="psw">Password</label>
        <input type="password" class="form-control" id="psw" placeholder="Password" name="psw">
        <span id="pswError" style="color: red; font-weight: normal;"></span>
      </div>
  
//if email/password wrong and returning here, display alert
if ((isset($_SESSION['login_error'])) && ($_SESSION['login_error'] !="")) 
{
	//alert email, password error
  <div class="alert alert-danger my-5" role="alert">
          Check your email, password and try again.
        </div>
  
//clear error
  unset($_SESSION['login_error']);
}
  
  <!--For Google reCAPTCHA v2-->
     <div id ="firstCaptcha" class="g-recaptcha" data-sitekey="6Ld9qpYUAAAAAHanqkRTfGt9_9xrXOGaBR9BRGnW" data-callback="enableBtn1"></div>';
  
      echo'<button id ="captchaBtn1" type="submit" class="btn btn-primary mt-3" onclick="return validateMemberForm()" disabled>Log in</button>
    </form>
  </div>
  

	<hr class="light-75">
	
	//Form 2 (Delivery details & Payment)
  <form action="../php/payment_method_router.php" method="post">
	
     <div class="container general-items">
      <h5 class="subheading">Guest Checkout</h5>
     
     //if hidden existingCustomer id is NO, payment.js will validate both these 
     //address data and credit card info.
     //Also, reCaptcha will be left shown and Place the order button will be left disabled.
     <input type="hidden" id = "existingCustomer" name="existingCustomer" value="NO">
       
          <div class="form-group">
            <label for="guestEmail">Email address</label>
            <input type="email" class="form-control" id="guestEmail" aria-describedby="emailHelpGuest" placeholder="your-name@example.com" name="guestEmail">
            <small id="emailHelpGuest" class="form-text text-muted">We will never share your email with anyone else.</small>
            <span id="guestEmailError" style="color: red; font-weight: normal;"></span>
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="cust_name" placeholder="John Citizen" name="cust_name">
            <span id="nameError" style="color: red; font-weight: normal;"></span>
          </div>
          <div class="form-group">
            <label for="street">Street address</label>
            <input type="text" class="form-control" id="street" placeholder="1000 Model Street" name="street">
            <span id="streetError" style="color: red; font-weight: normal;"></span>
          </div>
          <div class="form-group">
            <label for="suburb">Suburb</label>
            <input type="text" class="form-control" id="suburb" placeholder="Moana" name="suburb">
            <span id="suburbError" style="color: red; font-weight: normal;"></span>
          </div>
          <div class="form-group">
            <label for="postcode">Postcode</label>
            <input type="text" class="form-control" id="postcode" placeholder="5000" name="postcode">
            <span id="postcodeError" style="color: red; font-weight: normal;"></span>
          </div>         
          <div class="form-group">
            <label for="state">State</label>
            <select class="form-control" name="state" id="state">
              <option value="SA">South Australia</option>
              <option value="NSW">New South Wales</option>
              <option value="VIC">Victoria</option>
              <option value="QLD">Queensland</option>
              <option value="NT">Northern Territory</option>
              <option value="WA">Western Australia</option>
              <option value="CAN">Canberra</option>
              <option value="TAS">Tasmania</option>
            </select>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" placeholder="0444 222 000" name="phone">
            <span id="phoneError" style="color: red; font-weight: normal;"></span>
          </div>

          </div>
  }


        <!--     <hr class="light-75">-->
        <div class="container general-items rounded border border-dark bg-light">

	  <h5 class='rounded-content text-secondary'>Total Amount ${{ Cart::total() }}</h5>
        </div>

        <div class="container general-items">
            <h5 class="subheading">Payment</h5>

            Accepted payment methods

  {{-- need csrf for payment method ajax to work --}}
  <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- for payment method change ajax --}}



            <div class="container-fluid payment mt-2 mb-4 px-0">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="payment-method" value="visa" checked
                            onchange="handlePaymentChange(this.value)">
                        <i class="fab fa-cc-visa fa-3x" style="color:#03a9f4;"></i>
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="payment-method" value="mastercard"
                            onchange="handlePaymentChange(this.value)">
                        <i class="fab fa-cc-mastercard fa-3x" style="color:#ef5350;"></i>
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="payment-method" value="paypal"
                            onchange="handlePaymentChange(this.value)">
                        <i class="fab fa-paypal fa-3x" style="color:#673ab7;"></i>
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="payment-method" value="cash"
                            onchange="handlePaymentChange(this.value)">
                        <i class="fas fa-dollar-sign fa-3x" style="color:#616161;"></i>
                    </label>
                </div>
            </div>



            <div id="paymentContent">

                <div class="form-group">
                    <label for="ccname">Name on Visa Card</label>
                    <input type="text" class="form-control" id="ccname" placeholder="John Citizen" name="ccname">
                    <span id="ccnameError" style="color: red; font-weight: normal;"></span>
                </div>
                <div class="form-group">
                    <label for="ccnum">Card number</label>
                    <input type="text" class="form-control" id="ccnum" placeholder="1111-2222-3333-4444"
                        name="cardnumber">
                    <span id="ccnumError" style="color: red; font-weight: normal;"></span>
                </div>
                <div class="form-group">
                    <label for="expmonth">Expiry month</label>
                    <input type="text" class="form-control" id="expmonth" placeholder="11" name="expmonth">
                    <span id="expmonthError" style="color: red; font-weight: normal;"></span>
                </div>
                <div class="form-group">
                    <label for="expyear">Expiry year</label>
                    <input type="text" class="form-control" id="expyear" placeholder="24" name="expyear">
                    <span id="expyearError" style="color: red; font-weight: normal;"></span>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" placeholder="352" name="cvv">
                    <span id="cvvError" style="color: red; font-weight: normal;"></span>
                </div>

            </div>

            <!--For Google reCAPTCHA v2-->
            {{-- <div id="secondCaptcha" class="g-recaptcha" data-sitekey="6Ld9qpYUAAAAAHanqkRTfGt9_9xrXOGaBR9BRGnW"
                data-callback="enableBtn2"></div> --}}

        </div>

        <button id="captchaBtn2" type="submit" class="btn btn-success btn-block btn-xl"
            onclick="return validateOrderForm()" ><i class="fas fa-lock"></i>&emsp;Place the Order</button>
        <small id="emailHelp" class="form-text text-danger">*Try placing an order. This is a demo web app. Check out the
            T&C.</small>


        </form>
    </div>




@endsection

@section('extra-js')
<script>
function handlePaymentChange(paymentSelection) //this surely loads the payment content dynamically WITHOUT loading the whole page
    {
        //alert (paymentSelection);

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/paymentAjax/'+paymentSelection,
            data: '_token = csrf-token, radioBtnSelection: payment1Selection',
            success: function (data) {
                $("#paymentContent").html(data.paymentContentHtmls);
            }
        });
        

    }

</script>

@endsection




