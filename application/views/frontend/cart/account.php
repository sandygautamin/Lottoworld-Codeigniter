<?php if($this->session->userdata('isUserLoggedIn')):?>
<div class="content ani wrap" ng-switch="" on="section.selectionPaymentTemplate" ng-hide="ngCart.getTotalItems() === 0">
    <div ng-switch-when="new" class="ng-scope">
       <ng-include class="animate-switch ng-scope" src="'/wp-content/themes/lotto_theme/fragments/cart-partials/ngCart/paymentnew.html'">

<div class="clubform mainpaymenttabs mainpaymenttabsnewcart ng-scope">
    <div class="tabspart">
        <div class="tabsline">
            
           <div ng-class="'onetab tab' + payment.name"  id="cart-creditcard" class="ng-scope onetab tabcreditcard">
                <div class="onetabinner">
                    <img src="<?php echo base_url(); ?>assets/images/creditcards.png">
                    <p class="tabnameformobile ng-binding">creditcard</p>
                </div>
            </div><!-- end ngRepeat: payment in paymentSystems -->
            <div class="formpart formpartnew credit">
              
                <div class="row">
                    <div class="col-lg-1 text-right"><input type="radio" name="creditcard" checked></div>
                    <div class="col-lg-11">Credit Card </div> 
                  </div>
                <div class="row"> 
                    <div class="col-lg-1 text-right"> <input type="checkbox" name="term" id="term"></div>
                    <div class="col-lg-11">
                        <label class="agreesentence1 " for="term">
                            I Agree with the <a href="/terms-and-conditions/" target="_blank" > Terms &amp; Conditions</a>  and I am of legal age to play
                        </label> 
                    <div> 
                    
                </div>
                <div class="row v-align">
                    <div class="col-lg-2">Pay amount : </div>
                    <div class="col-lg-3 border-area">$<?php echo numberformat($total);?></div>
                    <div class="col-lg-3 submitbtn"><input type="button" id="submit_order" value="Submit Order"></div>
                </div>

                
                
                <div class="clear"></div>

            </div>
            <!--End credit card form -->
            
            
            
        </div>
    </div>
</div>
<?php endif;?>