<div class="wrap">
  <div class="wrap-my-account clearfix">
    <div class="hadding inner-hadding" style="margin-top:0px;">
      <h1>My Account</h1>
    </div>
    <?php $this->load__frontend_template('users/account-sidebar');?>
    <div id="user-details"> <img src="<?php echo base_url()?>/wp-content/themes/lotto_theme/images/loading.gif" class="macloader" style="display: none;">
      <div id="tabs-1" class="r_tabs" style="display: block;">
        <form name="myaccount_detail" id="myaccount_detail" class="ng-pristine ng-valid" action="" method="POST">
          <div class="myaccount_detail_error"></div>
          <div class="account_form">
            <div class="field left"> <i class="ico-fname"></i>
              <input name="first_name" id="first_name" type="text" onkeypress="return isNameValid(event)" class="account_field" value="Sandeep">
              <label for="first_name">First Name</label>
            </div>
            <div class="field right">
              <input name="last_name" id="last_name" type="text" onkeypress="return isNameValid(event)" class="account_field" value="Kumar">
              <label for="last_name">Last Name</label>
            </div>
            <div class="cl"></div>
            <div class="field left"> <i class="ico-email"></i>
              <input name="email" id="email" readonly="readonly" type="text" class="account_field" value="sandy.gautam.in+1@gmail.com">
              <label for="email">Your Email</label>
            </div>
            <hr>
            <div class="field left"> <i class="ico-country"></i>
              <select name="country" id="country">
                <option value="AA" title="Select country">Select country</option>
                <option value="AF" title="Afghanistan">Afghanistan</option>
                <option value="AX" title="Åland Islands">Åland Islands</option>
                <option value="AL" title="Albania">Albania</option>
                <option value="DZ" title="Algeria">Algeria</option>
                <option value="AS" title="American Samoa">American Samoa</option>
                <option value="AD" title="Andorra">Andorra</option>
                <option value="AO" title="Angola">Angola</option>
                <option value="AI" title="Anguilla">Anguilla</option>
                <option value="AQ" title="Antarctica">Antarctica</option>
                <option value="AG" title="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="AR" title="Argentina">Argentina</option>
                <option value="AM" title="Armenia">Armenia</option>
                <option value="AW" title="Aruba">Aruba</option>
                <option value="AU" title="Australia">Australia</option>
                <option value="AT" title="Austria">Austria</option>
                <option value="AZ" title="Azerbaijan">Azerbaijan</option>
                <option value="BS" title="Bahamas">Bahamas</option>
                <option value="BH" title="Bahrain">Bahrain</option>
                <option value="BD" title="Bangladesh">Bangladesh</option>
                <option value="BB" title="Barbados">Barbados</option>
                <option value="BY" title="Belarus">Belarus</option>
                <option value="BE" title="Belgium">Belgium</option>
                <option value="BZ" title="Belize">Belize</option>
                <option value="BJ" title="Benin">Benin</option>
                <option value="BM" title="Bermuda">Bermuda</option>
                <option value="BT" title="Bhutan">Bhutan</option>
                <option value="BO" title="Bolivia">Bolivia</option>
                <option value="BA" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="BW" title="Botswana">Botswana</option>
                <option value="BV" title="Bouvet Island">Bouvet Island</option>
                <option value="BR" title="Brazil">Brazil</option>
                <option value="IO" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="BN" title="Brunei Darussalam">Brunei Darussalam</option>
                <option value="BG" title="Bulgaria">Bulgaria</option>
                <option value="BF" title="Burkina Faso">Burkina Faso</option>
                <option value="BI" title="Burundi">Burundi</option>
                <option value="KH" title="Cambodia">Cambodia</option>
                <option value="CM" title="Cameroon">Cameroon</option>
                <option value="CA" title="Canada">Canada</option>
                <option value="CV" title="Cape Verde">Cape Verde</option>
                <option value="KY" title="Cayman Islands">Cayman Islands</option>
                <option value="CF" title="Central African Republic">Central African Republic</option>
                <option value="TD" title="Chad">Chad</option>
                <option value="CL" title="Chile">Chile</option>
                <option value="CN" title="China">China</option>
                <option value="CX" title="Christmas Island">Christmas Island</option>
                <option value="CC" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="CO" title="Colombia">Colombia</option>
                <option value="KM" title="Comoros">Comoros</option>
                <option value="CG" title="Congo">Congo</option>
                <option value="CD" title="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="CK" title="Cook Islands">Cook Islands</option>
                <option value="CR" title="Costa Rica">Costa Rica</option>
                <option value="CI" title="Cote D'ivoire">Cote D'ivoire</option>
                <option value="HR" title="Croatia">Croatia</option>
                <option value="CU" title="Cuba">Cuba</option>
                <option value="CY" title="Cyprus">Cyprus</option>
                <option value="CZ" title="Czech Republic">Czech Republic</option>
                <option value="DK" title="Denmark">Denmark</option>
                <option value="DJ" title="Djibouti">Djibouti</option>
                <option value="DM" title="Dominica">Dominica</option>
                <option value="DO" title="Dominican Republic">Dominican Republic</option>
                <option value="EC" title="Ecuador">Ecuador</option>
                <option value="EG" title="Egypt">Egypt</option>
                <option value="SV" title="El Salvador">El Salvador</option>
                <option value="GQ" title="Equatorial Guinea">Equatorial Guinea</option>
                <option value="ER" title="Eritrea">Eritrea</option>
                <option value="EE" title="Estonia">Estonia</option>
                <option value="ET" title="Ethiopia">Ethiopia</option>
                <option value="FK" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="FO" title="Faroe Islands">Faroe Islands</option>
                <option value="FJ" title="Fiji">Fiji</option>
                <option value="FI" title="Finland">Finland</option>
                <option value="FR" title="France">France</option>
                <option value="GF" title="French Guiana">French Guiana</option>
                <option value="PF" title="French Polynesia">French Polynesia</option>
                <option value="TF" title="French Southern Territories">French Southern Territories</option>
                <option value="GA" title="Gabon">Gabon</option>
                <option value="GM" title="Gambia">Gambia</option>
                <option value="GE" title="Georgia">Georgia</option>
                <option value="DE" title="Germany">Germany</option>
                <option value="GH" title="Ghana">Ghana</option>
                <option value="GI" title="Gibraltar">Gibraltar</option>
                <option value="GR" title="Greece">Greece</option>
                <option value="GL" title="Greenland">Greenland</option>
                <option value="GD" title="Grenada">Grenada</option>
                <option value="GP" title="Guadeloupe">Guadeloupe</option>
                <option value="GU" title="Guam">Guam</option>
                <option value="GT" title="Guatemala">Guatemala</option>
                <option value="GG" title="Guernsey">Guernsey</option>
                <option value="GN" title="Guinea">Guinea</option>
                <option value="GW" title="Guinea-bissau">Guinea-bissau</option>
                <option value="GY" title="Guyana">Guyana</option>
                <option value="HT" title="Haiti">Haiti</option>
                <option value="HM" title="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="VA" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="HN" title="Honduras">Honduras</option>
                <option value="HK" title="Hong Kong">Hong Kong</option>
                <option value="HU" title="Hungary">Hungary</option>
                <option value="IS" title="Iceland">Iceland</option>
                <option value="IN" selected="selected" title="India">India</option>
                <option value="ID" title="Indonesia">Indonesia</option>
                <option value="IR" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="IQ" title="Iraq">Iraq</option>
                <option value="IE" title="Ireland">Ireland</option>
                <option value="IM" title="Isle of Man">Isle of Man</option>
                <option value="IL" title="Israel">Israel</option>
                <option value="IT" title="Italy">Italy</option>
                <option value="JM" title="Jamaica">Jamaica</option>
                <option value="JP" title="Japan">Japan</option>
                <option value="JE" title="Jersey">Jersey</option>
                <option value="JO" title="Jordan">Jordan</option>
                <option value="KZ" title="Kazakhstan">Kazakhstan</option>
                <option value="KE" title="Kenya">Kenya</option>
                <option value="KI" title="Kiribati">Kiribati</option>
                <option value="KP" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="KR" title="Korea, Republic of">Korea, Republic of</option>
                <option value="KW" title="Kuwait">Kuwait</option>
                <option value="KG" title="Kyrgyzstan">Kyrgyzstan</option>
                <option value="LA" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="LV" title="Latvia">Latvia</option>
                <option value="LB" title="Lebanon">Lebanon</option>
                <option value="LS" title="Lesotho">Lesotho</option>
                <option value="LR" title="Liberia">Liberia</option>
                <option value="LY" title="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="LI" title="Liechtenstein">Liechtenstein</option>
                <option value="LT" title="Lithuania">Lithuania</option>
                <option value="LU" title="Luxembourg">Luxembourg</option>
                <option value="MO" title="Macao">Macao</option>
                <option value="MK" title="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="MG" title="Madagascar">Madagascar</option>
                <option value="MW" title="Malawi">Malawi</option>
                <option value="MY" title="Malaysia">Malaysia</option>
                <option value="MV" title="Maldives">Maldives</option>
                <option value="ML" title="Mali">Mali</option>
                <option value="MT" title="Malta">Malta</option>
                <option value="MH" title="Marshall Islands">Marshall Islands</option>
                <option value="MQ" title="Martinique">Martinique</option>
                <option value="MR" title="Mauritania">Mauritania</option>
                <option value="MU" title="Mauritius">Mauritius</option>
                <option value="YT" title="Mayotte">Mayotte</option>
                <option value="MX" title="Mexico">Mexico</option>
                <option value="FM" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="MD" title="Moldova, Republic of">Moldova, Republic of</option>
                <option value="MC" title="Monaco">Monaco</option>
                <option value="MN" title="Mongolia">Mongolia</option>
                <option value="ME" title="Montenegro">Montenegro</option>
                <option value="MS" title="Montserrat">Montserrat</option>
                <option value="MA" title="Morocco">Morocco</option>
                <option value="MZ" title="Mozambique">Mozambique</option>
                <option value="MM" title="Myanmar">Myanmar</option>
                <option value="NA" title="Namibia">Namibia</option>
                <option value="NR" title="Nauru">Nauru</option>
                <option value="NP" title="Nepal">Nepal</option>
                <option value="NL" title="Netherlands">Netherlands</option>
                <option value="AN" title="Netherlands Antilles">Netherlands Antilles</option>
                <option value="NC" title="New Caledonia">New Caledonia</option>
                <option value="NZ" title="New Zealand">New Zealand</option>
                <option value="NI" title="Nicaragua">Nicaragua</option>
                <option value="NE" title="Niger">Niger</option>
                <option value="NG" title="Nigeria">Nigeria</option>
                <option value="NU" title="Niue">Niue</option>
                <option value="NF" title="Norfolk Island">Norfolk Island</option>
                <option value="MP" title="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="NO" title="Norway">Norway</option>
                <option value="OM" title="Oman">Oman</option>
                <option value="PK" title="Pakistan">Pakistan</option>
                <option value="PW" title="Palau">Palau</option>
                <option value="PS" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="PA" title="Panama">Panama</option>
                <option value="PG" title="Papua New Guinea">Papua New Guinea</option>
                <option value="PY" title="Paraguay">Paraguay</option>
                <option value="PE" title="Peru">Peru</option>
                <option value="PH" title="Philippines">Philippines</option>
                <option value="PN" title="Pitcairn">Pitcairn</option>
                <option value="PL" title="Poland">Poland</option>
                <option value="PT" title="Portugal">Portugal</option>
                <option value="PR" title="Puerto Rico">Puerto Rico</option>
                <option value="QA" title="Qatar">Qatar</option>
                <option value="RE" title="Reunion">Reunion</option>
                <option value="RO" title="Romania">Romania</option>
                <option value="RU" title="Russian Federation">Russian Federation</option>
                <option value="RW" title="Rwanda">Rwanda</option>
                <option value="SH" title="Saint Helena">Saint Helena</option>
                <option value="KN" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="LC" title="Saint Lucia">Saint Lucia</option>
                <option value="PM" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="VC" title="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="WS" title="Samoa">Samoa</option>
                <option value="SM" title="San Marino">San Marino</option>
                <option value="ST" title="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="SA" title="Saudi Arabia">Saudi Arabia</option>
                <option value="SN" title="Senegal">Senegal</option>
                <option value="RS" title="Serbia">Serbia</option>
                <option value="SC" title="Seychelles">Seychelles</option>
                <option value="SL" title="Sierra Leone">Sierra Leone</option>
                <option value="SG" title="Singapore">Singapore</option>
                <option value="SK" title="Slovakia">Slovakia</option>
                <option value="SI" title="Slovenia">Slovenia</option>
                <option value="SB" title="Solomon Islands">Solomon Islands</option>
                <option value="SO" title="Somalia">Somalia</option>
                <option value="ZA" title="South Africa">South Africa</option>
                <option value="GS" title="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="ES" title="Spain">Spain</option>
                <option value="LK" title="Sri Lanka">Sri Lanka</option>
                <option value="SD" title="Sudan">Sudan</option>
                <option value="SR" title="Suriname">Suriname</option>
                <option value="SJ" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="SZ" title="Swaziland">Swaziland</option>
                <option value="SE" title="Sweden">Sweden</option>
                <option value="CH" title="Switzerland">Switzerland</option>
                <option value="SY" title="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="TW" title="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="TJ" title="Tajikistan">Tajikistan</option>
                <option value="TZ" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="TH" title="Thailand">Thailand</option>
                <option value="TL" title="Timor-leste">Timor-leste</option>
                <option value="TG" title="Togo">Togo</option>
                <option value="TK" title="Tokelau">Tokelau</option>
                <option value="TO" title="Tonga">Tonga</option>
                <option value="TT" title="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="TN" title="Tunisia">Tunisia</option>
                <option value="TR" title="Turkey">Turkey</option>
                <option value="TM" title="Turkmenistan">Turkmenistan</option>
                <option value="TC" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="TV" title="Tuvalu">Tuvalu</option>
                <option value="UG" title="Uganda">Uganda</option>
                <option value="UA" title="Ukraine">Ukraine</option>
                <option value="AE" title="United Arab Emirates">United Arab Emirates</option>
                <option value="GB" title="United Kingdom">United Kingdom</option>
                <option value="US" title="United States">United States</option>
                <option value="UM" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="UY" title="Uruguay">Uruguay</option>
                <option value="UZ" title="Uzbekistan">Uzbekistan</option>
                <option value="VU" title="Vanuatu">Vanuatu</option>
                <option value="VE" title="Venezuela">Venezuela</option>
                <option value="VN" title="Viet Nam">Viet Nam</option>
                <option value="VG" title="Virgin Islands, British">Virgin Islands, British</option>
                <option value="VI" title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="WF" title="Wallis and Futuna">Wallis and Futuna</option>
                <option value="EH" title="Western Sahara">Western Sahara</option>
                <option value="YE" title="Yemen">Yemen</option>
                <option value="ZM" title="Zambia">Zambia</option>
                <option value="ZW" title="Zimbabwe">Zimbabwe</option>
              </select>
              <label for="country">Country</label>
            </div>
            <div class="field right">
              <input name="city" id="city" type="text" onkeypress="return isAlphaKey(event)" class="account_field" value="">
              <label for="city">City</label>
            </div>
            <div class="cl"></div>
            <div class="field left">
              <input name="address" id="address" type="text" class="account_field" value="">
              <label for="address">Address</label>
            </div>
            <div class="field right">
              <input name="zipcode" id="zipcode" type="text" onkeypress="return isNumberKey(event)" class="account_field" value="" maxlength="6">
              <label for="zipcode">Zip Code</label>
            </div>
            <hr>
            <div class="cl"></div>
            <div class="field left"> <i class="ico-phone"></i>
              <input name="phone" id="phone" type="text" onkeypress="return isNumberAddBrackets(event)" class="account_field" value="7814111988" maxlength="25">
              <label for="phone">Phone 1</label>
            </div>
            <div class="field right">
              <input name="mobno" id="mobno" type="text" onkeypress="return isNumberAddBrackets(event)" class="account_field" value="" maxlength="25">
              <label for="mobno">Phone 2</label>
            </div>
            <hr>
            <div class="cl"></div>
            <a class="btn btn_dark-blue right" id="myaccount_update">Save Changes</a> <a href="#tab-6" class="u_changepassword dark-blue-font"><i class="ico-changepassword"></i>Change Password</a>
            <div class="cl"></div>
          </div>
          <div class="account_form change_pass">
            <div class="field left">
              <input name="oldpassword" id="oldpassword" type="password" class="account_field">
              <label for="oldpassword">Old Password</label>
            </div>
            <div class="cl"></div>
            <div class="field left">
              <input name="newpassword" id="newpassword" type="password" class="account_field">
              <label for="newpassword">New Password</label>
            </div>
            <div class="cl"></div>
            <div class="field left">
              <input name="retypepassword" id="retypepassword" type="password" class="account_field">
              <label for="retypepassword">Retype Password</label>
            </div>
            <div class="cl"></div>
            <a id="change_password" class="btn btn_dark-blue right">Save Password</a> </div>
        </form>
      </div>
      <!-- /.tab-1/.My Details -->
      
      <div id="tabs-2" class="r_tabs table_style_1" style="display: none;">
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
            <tbody id="mypayment_method">
            </tbody>
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
            <tbody id="mytransaction">
            </tbody>
          </table>
        </div>
        <!-- An empty div which will be populated using jQuery -->
        <input type="hidden" class="current_page">
        <input type="hidden" class="show_per_page">
        <div class="paging_part"></div>
      </div>
      <!-- /.tab-3/.My Transactions -->
      
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
        </div>
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
