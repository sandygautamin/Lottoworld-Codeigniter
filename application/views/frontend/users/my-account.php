<div class="bg-inner"></div>
<div class="wrap">
   <div class="wrap-my-account clearfix">
      <div class="hadding inner-hadding" >
         <h1>My Account</h1>
      </div>
      <?php $this->load->view('frontend/users/left-sidebar.php' ,['user'=>$user]);?>
      <div id="user-details">
         <img src="<?php echo base_url();?>images/loading.gif" class="macloader" style="display: none;">
         <div id="tabs-1" class="r_tabs" style="display: block;">
                 <?php 
					$notify_msg=$this->session->flashdata('notify_msg');
                 
					if(isset($notify_msg['error']) && $notify_msg['error']==0):?>
					<div class="alert alert-success" role="alert">
					 <?php echo $notify_msg['message']?>
                     </div><?php endif;

                    if(isset($notify_msg['error']) && $notify_msg['error']==1):?>
                        <div class="alert alert-danger" role="alert">
                        <?php echo $notify_msg['message']?>
                        </div><?php endif;?>

            <form name="myaccount_detail" id="myaccount_detail" class="ng-pristine ng-valid" action="<?php echo base_url('users/processDetails');?>" method="POST">
               <div class="myaccount_detail_error"></div>
               <div class="account_form">
                  <div class="field left">
                     <i class="ico-fname"></i>
                     <input name="first_name" id="first_name" type="text" onkeypress="return isNameValid(event)" class="account_field" value="<?php echo isset($user['fname'])?$user['fname']:''?>">
                     <label for="first_name">First Name</label>
                  </div>
                  <div class="field right">
                     <input name="last_name" id="last_name" type="text" onkeypress="return isNameValid(event)" class="account_field" value="<?php echo isset($user['fname'])?$user['lname']:''?>">
                     <label for="last_name">Last Name</label>
                  </div>
                  <div class="cl"></div>
                  <div class="field left">
                     <i class="ico-email"></i>
                     <input name="email" id="email" readonly="readonly" type="text" class="account_field" value="<?php echo isset($user['email'])?$user['email']:''?>">
                     <label for="email">Your Email</label>
                  </div>
                  <hr>
                  <div class="field left">
                     <i class="ico-country"></i>
                     <select name="country_code" id="country_code">
                     <option value="aa" title="Select country">Select country</option>
                    <?php  
                   if($countries):
                    foreach($countries as $country){?>
                    <option value="<?php echo strtolower($country->code)?>" <?php if(strtolower($country->code)==strtolower($user['country_code'])){?> selected='selected' <?php } ?> ><?php echo $country->name?></option>

                    <?php } endif;?>
                        
                     </select>
                     <label for="country">Country</label>
                  </div>
                  <div class="field right">
                     <input name="city" id="city" type="text" onkeypress="return isAlphaKey(event)" class="account_field" value="<?php echo isset($user['city'])?$user['city']:''?>">
                     <label for="city">City</label>
                  </div>
                  <div class="cl"></div>
                  <div class="field left">
                     <input name="address" id="address" type="text" class="account_field" value="<?php echo isset($user['address'])?$user['address']:''?>">
                     <label for="address">Address</label>
                  </div>
                  <div class="field right">
                     <input name="zipcode" id="zipcode" type="text" onkeypress="return isNumberKey(event)" class="account_field" value="<?php echo isset($user['zipcode'])?$user['zipcode']:''?>" maxlength="6">
                     <label for="zipcode">Zip Code</label>
                  </div>
                  <hr>
                  <div class="cl"></div>
                  <div class="field left">
                     <i class="ico-phone"></i>
                     <input name="phone" id="phone" type="text" onkeypress="return isNumberAddBrackets(event)" class="account_field" value="<?php echo isset($user['phone'])?$user['phone']:''?>" maxlength="25">
                     <label for="phone">Phone 1</label>
                  </div>
                  <div class="field right">
                     <input name="mobno" id="mobno" type="text" onkeypress="return isNumberAddBrackets(event)" class="account_field" value="<?php echo isset($user['mobno'])?$user['mobno']:''?>" maxlength="25">
                     <label for="mobno">Phone 2</label>
                  </div>
                  <hr>
                  <div class="cl"></div>
                  
                  <input type="submit" class="btn btn_dark-blue right" name="submit" value="Save Changes">
                  <a href="#tab-6" class="u_changepassword dark-blue-font"><i class="ico-changepassword"></i>Change Password</a>
                  <div class="cl"></div>
               </div>
               
            </form>
            <form id="change-password" action="<?php echo base_url("users/change_password");?>" method="post">
             <div class="account_form change_pass">
                  <div class="field left">
                     <input name="oldpassword" id="oldpassword" type="password" class="account_field" required>
                     <label for="oldpassword">Old Password</label>
                  </div>
                  <div class="cl"></div>
                  <div class="field left">
                     <input name="newpassword" id="newpassword" type="password" class="account_field" required>
                     <label for="newpassword">New Password</label>
                  </div>
                  <div class="cl"></div>
                  <div class="field left">
                     <input name="retypepassword" id="retypepassword" type="password" class="account_field" required>
                     <label for="retypepassword">Retype Password</label>
                  </div>
                  <div class="cl"></div>
                 
                  <input type="submit" class="btn btn_dark-blue right" name="chnagePasswordSubmit" value="Save Password">
               </div>
            </form>
         </div>
         <!-- /.tab-1/.My Details -->
         <?php /*?><div id="tabs-2" class="r_tabs table_style_1" style="display: none;">
            <div class="payment_method">
               <table cellspacing="1" cellpadding="0">
                  <thead class="btn_dark-blue">
                     <tr>
                        <th height="30" align="center" valign="middle" class="small-arrow">Payment Method</th>
                        <th align="center" valign="middle" class="small-arrow">Status</th>
                        <th align="center" valign="middle" class="small-arrow">Default</th>
                        <th align="center" valign="middle">Update</th>
                        <th align="center" valign="middle">Delete</th>
                     </tr>
                  </thead>
                  <tbody id="mypayment_method"></tbody>
               </table>
            </div>
            <input type="button" class="btn btn_dark-blue right" id="addmethod" value="Add Payment Method">
            <div id="app-payment-method-block"></div>
         </div>
         <!-- /.tab-2/.Payment Methods -->
         <div id="tabs-3" class="r_tabs table_style_1" style="display: none;">
            <div class="table_style_1">
               <table cellspacing="1" cellpadding="0">
                  <thead class="btn_dark-blue">
                     <tr>
                        <th height="30" align="center" valign="middle" class="small-arrow">Transactions</th>
                        <th align="center" valign="middle" class="small-arrow">ID</th>
                        <th align="center" valign="middle" class="small-arrow">Date</th>
                        <th align="center" valign="middle" class="small-arrow">Amount</th>
                        <th align="center" valign="middle" class="small-arrow">Lottery</th>
                        <th align="center" valign="middle" class="small-arrow">Product</th>
                        <th align="center" valign="middle" class="small-arrow">Method</th>
                     </tr>
                  </thead>
                  <tbody id="mytransaction"></tbody>
               </table>
            </div>
            <!-- An empty div which will be populated using jQuery -->
            <input type="hidden" class="current_page">
            <input type="hidden" class="show_per_page">
            <div class="paging_part"></div>
         </div>
        <div id="tabs-4" class="r_tabs" style="display: none;">
            <div class="my_table_main">
               <div class="table_style_1">
                  <table cellspacing="1" cellpadding="0" border="0">
                     <thead class="btn_dark-blue">
                        <tr>
                           <th height="30" align="center" class="small-arrow" valign="middle">Country</th>
                           <th align="center" class="small-arrow" valign="middle">Lottery</th>
                           <th align="center" class="small-arrow" valign="middle">Date</th>
                           <th align="center" class="small-arrow" valign="middle">Status</th>
                           <th align="center" class="small-arrow" valign="middle">Winnings</th>
                           <th align="center" valign="middle">Details</th>
                        </tr>
                     </thead>
                  </table>
               </div>
               <div id="my_tickets_data"></div>
            </div>
            <!-- An empty div which will be populated using jQuery -->
            <input type="hidden" class="current_page">
            <input type="hidden" class="show_per_page">
            <div class="paging_part"></div>
         </div>
         <!-- /.tab-4/.My Tickets -->
         <!-- /.tab-3/.My Transactions -->
           <div id="tabs-5" class="r_tabs" style="display: none;">
            <div class="my_table_main">
               <div class="table_style_1">
                  <table cellspacing="1" cellpadding="0" border="0">
                     <thead class="btn_dark-blue">
                        <tr>
                           <th height="30" align="center" valign="middle">Product</th>
                           <th align="center" valign="middle">Lottery</th>
                           <th align="center" valign="middle">Group Shares</th>
                           <th align="center" valign="middle">Draws Left</th>
                           <th align="center" valign="middle">Total Lines</th>
                           <th align="center" valign="middle" style="font-size: 11px">Purchased On</th>
                           <th align="center" valign="middle">End Date</th>
                           <th align="center" valign="middle">Status</th>
                        </tr>
                     </thead>
                  </table>
               </div>
               <div class="drawer-item myproductdrawer" id="myproduct"></div>
            </div><?php */?>
            <!-- An empty div which will be populated using jQuery -->
            <input type="hidden" class="current_page">
            <input type="hidden" class="show_per_page">
            <div class="paging_part"></div>
         </div>
         <!-- /.horizontalTab -->
      </div>
      <!-- /.user-details -->
   </div>
   <!-- /.wrap-my-account -->
</div>