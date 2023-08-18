<?php if(!$this->session->userdata('isUserLoggedIn')):?>
<div class="content ani" >
  
  
     <!-- ngInclude: undefined -->
     
        <div class="label-container ">
           <div class="label-top-part"></div>
        </div>
        <div class="clubform paymentnotloggedinmain paymentnotloggedinmainhtmlform wrap ">
           <!-- left form -->
           <div id="rightformpart1" class="formpart rightformpart">
              <h1>Sign in</h1>
            <?php 
            $message_name=$this->session->flashdata('message_name');
            if($message_name):?>
                  <div class="alert alert-danger" role="alert">
            <?php echo $message_name?>
            </div><?php endif;?>
			   <form id="signinform2" action="<?php echo base_url("home/process_login")?>" method="post">
              <div id="formbluearea1" class="formbluearea">
                 <div id="innercontainerbluearea1" class="innercontainerbluearea" enter-submit="">
                    <div id="inputemaildiv1" class="inputemaildiv">
                    <input type="hidden" name="redirect_link" value="<?php echo isset($redirect_link)?$redirect_link:'/cart'?>">
                       <input id="email" name="email" type="text" class="emailinputtext emailinputtextlogin " placeholder="Email" >
                    </div>
                    <div id="inputpwddiv1" class="inputemaildiv  inputpwddiv">
                       <input id="password" name="password" type="password" class="emailinputtext emailinputtextlogin" placeholder="Password" >
                    </div>
                    
                    <div id="placeforsigninbutton1" class="inputemaildiv placeforsigninbutton">
                       <input type="submit" class="signinbtnitslef" id="loginButton" value="Sign In"  ng-hide="showForgotPassFields">
                    </div>
                  
                    <div class="clear"></div>
                 </div>
                 <div class="clear"></div>
              </div>
			   </form>
              <div class="clear"></div>
           </div>
           <!--End login form-->
           <!-- promo middle -->
           <div class="signuproundpart">
              <div class="lable-content">
                 <p class="joinandget ng-binding">Join now and get</p>
                 <p class="welcomebonusnumber">100%</p>
                 <p class="welcomebonustext ng-binding">Welcome Bonus</p>
                 <p class="bonuseqw">
                    Your Bonus<br>
                    <span class="bonuseqwnumber ng-binding">€19.5</span>
                 </p>
              </div>
           </div>
           <!-- right form -->
           <form id="signupform1" action="<?php echo base_url("home/process_signup")?>" method="post">
           <input type="hidden" name="redirect_link" value="/cart">
           <div id="leftformpart1" class="formpart leftformpart">
              <h1>Sign up</h1>
                  <?php 
                  $message_signup=$this->session->flashdata('message_signup');
                  if($message_signup):?>
                        <div class="alert alert-danger" role="alert">
                  <?php echo $message_signup?>
                  </div><?php endif;?>
              <div id="sigformcontainer1" class="loginformcontainer">
                 <div id="innercontainersignarea1" class="innercontainerbluearea innercontainerwhitearea">
                    <div id="names" class="inputemaildiv countryandphonediv realphonenum">
                       <div class="fnamediv">
                        
                          <input type="text" id="fname" name="fname" class="emailinputtext emailinputtextsignup fnameinputtext" placeholder="First Name" >
                       </div>
                       <div class="lanemdiv">
                          <input type="text"  id="lname" name="lname" class="emailinputtext emailinputtextsignup lnameinputtext" placeholder="Last Name"  >
                       </div>
                    </div>
                    <div id="inputpwddiv3" class="inputemaildiv">
                       <input type="email"  id="email" name="email" class="emailinputtext emailinputtextsignup " placeholder="Email" >
                    </div>
                    <div id="inputemaildivsignup1" class="inputemaildiv inputpwddiv inputpwddivsignup">
                       <input type="password"  id="password1" name="password" class="emailinputtext emailinputtextsignup  " placeholder="Password"  >
                    </div>
                    <div id="inputemaildivsignup1" class="inputemaildiv inputpwddiv inputpwddivsignup">
                       
                       <input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password"  class="emailinputtext emailinputtextsignup  " required>
                    </div>
                    <div id="countryandphonediv1" class="inputemaildiv countryandphonediv realphonenum">
                       <div id="countrydiv1" class="countrydiv">
                          <select  id="country_code" name="country_code"   class=" ">
                             <option value="" class="label ng-binding" selected="selected">Country</option>
                             <option value="AF" label="Afghanistan">Afghanistan</option>
                             <option value="AX" label="Åland Islands">Åland Islands</option>
                             <option value="AL" label="Albania">Albania</option>
                             <option value="DZ" label="Algeria">Algeria</option>
                             <option value="AS" label="American Samoa">American Samoa</option>
                             <option value="AD" label="AndorrA">AndorrA</option>
                             <option value="AO" label="Angola">Angola</option>
                             <option value="AI" label="Anguilla">Anguilla</option>
                             <option value="AQ" label="Antarctica">Antarctica</option>
                             <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                             <option value="AR" label="Argentina">Argentina</option>
                             <option value="AM" label="Armenia">Armenia</option>
                             <option value="AW" label="Aruba">Aruba</option>
                             <option value="AU" label="Australia">Australia</option>
                             <option value="AT" label="Austria">Austria</option>
                             <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                             <option value="BS" label="Bahamas">Bahamas</option>
                             <option value="BH" label="Bahrain">Bahrain</option>
                             <option value="BD" label="Bangladesh">Bangladesh</option>
                             <option value="BB" label="Barbados">Barbados</option>
                             <option value="BY" label="Belarus">Belarus</option>
                             <option value="BE" label="Belgium">Belgium</option>
                             <option value="BZ" label="Belize">Belize</option>
                             <option value="BJ" label="Benin">Benin</option>
                             <option value="BM" label="Bermuda">Bermuda</option>
                             <option value="BT" label="Bhutan">Bhutan</option>
                             <option value="BO" label="Bolivia">Bolivia</option>
                             <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                             <option value="BW" label="Botswana">Botswana</option>
                             <option value="BV" label="Bouvet Island">Bouvet Island</option>
                             <option value="BR" label="Brazil">Brazil</option>
                             <option value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                             <option value="BN" label="Brunei Darussalam">Brunei Darussalam</option>
                             <option value="BG" label="Bulgaria">Bulgaria</option>
                             <option value="BF" label="Burkina Faso">Burkina Faso</option>
                             <option value="BI" label="Burundi">Burundi</option>
                             <option value="KH" label="Cambodia">Cambodia</option>
                             <option value="CM" label="Cameroon">Cameroon</option>
                             <option value="CA" label="Canada">Canada</option>
                             <option value="CV" label="Cape Verde">Cape Verde</option>
                             <option value="KY" label="Cayman Islands">Cayman Islands</option>
                             <option value="CF" label="Central African Republic">Central African Republic</option>
                             <option value="TD" label="Chad">Chad</option>
                             <option value="CL" label="Chile">Chile</option>
                             <option value="CN" label="China">China</option>
                             <option value="CX" label="Christmas Island">Christmas Island</option>
                             <option value="CC" label="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                             <option value="CO" label="Colombia">Colombia</option>
                             <option value="KM" label="Comoros">Comoros</option>
                             <option value="CG" label="Congo">Congo</option>
                             <option value="CD" label="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                             <option value="CK" label="Cook Islands">Cook Islands</option>
                             <option value="CR" label="Costa Rica">Costa Rica</option>
                             <option value="CI" label="Cote D'Ivoire">Cote D'Ivoire</option>
                             <option value="HR" label="Croatia">Croatia</option>
                             <option value="CU" label="Cuba">Cuba</option>
                             <option value="CY" label="Cyprus">Cyprus</option>
                             <option value="CZ" label="Czech Republic">Czech Republic</option>
                             <option value="DK" label="Denmark">Denmark</option>
                             <option value="DJ" label="Djibouti">Djibouti</option>
                             <option value="DM" label="Dominica">Dominica</option>
                             <option value="DO" label="Dominican Republic">Dominican Republic</option>
                             <option value="EC" label="Ecuador">Ecuador</option>
                             <option value="EG" label="Egypt">Egypt</option>
                             <option value="SV" label="El Salvador">El Salvador</option>
                             <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                             <option value="ER" label="Eritrea">Eritrea</option>
                             <option value="EE" label="Estonia">Estonia</option>
                             <option value="ET" label="Ethiopia">Ethiopia</option>
                             <option value="FK" label="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                             <option value="FO" label="Faroe Islands">Faroe Islands</option>
                             <option value="FJ" label="Fiji">Fiji</option>
                             <option value="FI" label="Finland">Finland</option>
                             <option value="FR" label="France">France</option>
                             <option value="GF" label="French Guiana">French Guiana</option>
                             <option value="PF" label="French Polynesia">French Polynesia</option>
                             <option value="TF" label="French Southern Territories">French Southern Territories</option>
                             <option value="GA" label="Gabon">Gabon</option>
                             <option value="GM" label="Gambia">Gambia</option>
                             <option value="GE" label="Georgia">Georgia</option>
                             <option value="DE" label="Germany">Germany</option>
                             <option value="GH" label="Ghana">Ghana</option>
                             <option value="GI" label="Gibraltar">Gibraltar</option>
                             <option value="GR" label="Greece">Greece</option>
                             <option value="GL" label="Greenland">Greenland</option>
                             <option value="GD" label="Grenada">Grenada</option>
                             <option value="GP" label="Guadeloupe">Guadeloupe</option>
                             <option value="GU" label="Guam">Guam</option>
                             <option value="GT" label="Guatemala">Guatemala</option>
                             <option value="GG" label="Guernsey">Guernsey</option>
                             <option value="GN" label="Guinea">Guinea</option>
                             <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                             <option value="GY" label="Guyana">Guyana</option>
                             <option value="HT" label="Haiti">Haiti</option>
                             <option value="HM" label="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                             <option value="VA" label="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                             <option value="HN" label="Honduras">Honduras</option>
                             <option value="HK" label="Hong Kong">Hong Kong</option>
                             <option value="HU" label="Hungary">Hungary</option>
                             <option value="IS" label="Iceland">Iceland</option>
                             <option value="IN" label="India">India</option>
                             <option value="ID" label="Indonesia">Indonesia</option>
                             <option value="IR" label="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option>
                             <option value="IQ" label="Iraq">Iraq</option>
                             <option value="IE" label="Ireland">Ireland</option>
                             <option value="IM" label="Isle of Man">Isle of Man</option>
                             <option value="IL" label="Israel">Israel</option>
                             <option value="IT" label="Italy">Italy</option>
                             <option value="JM" label="Jamaica">Jamaica</option>
                             <option value="JP" label="Japan">Japan</option>
                             <option value="JE" label="Jersey">Jersey</option>
                             <option value="JO" label="Jordan">Jordan</option>
                             <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                             <option value="KE" label="Kenya">Kenya</option>
                             <option value="KI" label="Kiribati">Kiribati</option>
                             <option value="KP" label="Korea, Democratic People'S Republic of">Korea, Democratic People'S Republic of</option>
                             <option value="KR" label="Korea, Republic of">Korea, Republic of</option>
                             <option value="KW" label="Kuwait">Kuwait</option>
                             <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                             <option value="LA" label="Lao People'S Democratic Republic">Lao People'S Democratic Republic</option>
                             <option value="LV" label="Latvia">Latvia</option>
                             <option value="LB" label="Lebanon">Lebanon</option>
                             <option value="LS" label="Lesotho">Lesotho</option>
                             <option value="LR" label="Liberia">Liberia</option>
                             <option value="LY" label="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                             <option value="LI" label="Liechtenstein">Liechtenstein</option>
                             <option value="LT" label="Lithuania">Lithuania</option>
                             <option value="LU" label="Luxembourg">Luxembourg</option>
                             <option value="MO" label="Macao">Macao</option>
                             <option value="MK" label="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                             <option value="MG" label="Madagascar">Madagascar</option>
                             <option value="MW" label="Malawi">Malawi</option>
                             <option value="MY" label="Malaysia">Malaysia</option>
                             <option value="MV" label="Maldives">Maldives</option>
                             <option value="ML" label="Mali">Mali</option>
                             <option value="MT" label="Malta">Malta</option>
                             <option value="MH" label="Marshall Islands">Marshall Islands</option>
                             <option value="MQ" label="Martinique">Martinique</option>
                             <option value="MR" label="Mauritania">Mauritania</option>
                             <option value="MU" label="Mauritius">Mauritius</option>
                             <option value="YT" label="Mayotte">Mayotte</option>
                             <option value="MX" label="Mexico">Mexico</option>
                             <option value="FM" label="Micronesia, Federated States of">Micronesia, Federated States of</option>
                             <option value="MD" label="Moldova, Republic of">Moldova, Republic of</option>
                             <option value="MC" label="Monaco">Monaco</option>
                             <option value="MN" label="Mongolia">Mongolia</option>
                             <option value="MS" label="Montserrat">Montserrat</option>
                             <option value="MA" label="Morocco">Morocco</option>
                             <option value="MZ" label="Mozambique">Mozambique</option>
                             <option value="MM" label="Myanmar">Myanmar</option>
                             <option value="NA" label="Namibia">Namibia</option>
                             <option value="NR" label="Nauru">Nauru</option>
                             <option value="NP" label="Nepal">Nepal</option>
                             <option value="NL" label="Netherlands">Netherlands</option>
                             <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                             <option value="NC" label="New Caledonia">New Caledonia</option>
                             <option value="NZ" label="New Zealand">New Zealand</option>
                             <option value="NI" label="Nicaragua">Nicaragua</option>
                             <option value="NE" label="Niger">Niger</option>
                             <option value="NG" label="Nigeria">Nigeria</option>
                             <option value="NU" label="Niue">Niue</option>
                             <option value="NF" label="Norfolk Island">Norfolk Island</option>
                             <option value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                             <option value="NO" label="Norway">Norway</option>
                             <option value="OM" label="Oman">Oman</option>
                             <option value="PK" label="Pakistan">Pakistan</option>
                             <option value="PW" label="Palau">Palau</option>
                             <option value="PS" label="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                             <option value="PA" label="Panama">Panama</option>
                             <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                             <option value="PY" label="Paraguay">Paraguay</option>
                             <option value="PE" label="Peru">Peru</option>
                             <option value="PH" label="Philippines">Philippines</option>
                             <option value="PN" label="Pitcairn">Pitcairn</option>
                             <option value="PL" label="Poland">Poland</option>
                             <option value="PT" label="Portugal">Portugal</option>
                             <option value="PR" label="Puerto Rico">Puerto Rico</option>
                             <option value="QA" label="Qatar">Qatar</option>
                             <option value="RE" label="Reunion">Reunion</option>
                             <option value="RO" label="Romania">Romania</option>
                             <option value="RU" label="Russian Federation">Russian Federation</option>
                             <option value="RW" label="RWANDA">RWANDA</option>
                             <option value="SH" label="Saint Helena">Saint Helena</option>
                             <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                             <option value="LC" label="Saint Lucia">Saint Lucia</option>
                             <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                             <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                             <option value="WS" label="Samoa">Samoa</option>
                             <option value="SM" label="San Marino">San Marino</option>
                             <option value="ST" label="Sao Tome and Principe">Sao Tome and Principe</option>
                             <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                             <option value="SN" label="Senegal">Senegal</option>
                             <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                             <option value="SC" label="Seychelles">Seychelles</option>
                             <option value="SL" label="Sierra Leone">Sierra Leone</option>
                             <option value="SG" label="Singapore">Singapore</option>
                             <option value="SK" label="Slovakia">Slovakia</option>
                             <option value="SI" label="Slovenia">Slovenia</option>
                             <option value="SB" label="Solomon Islands">Solomon Islands</option>
                             <option value="SO" label="Somalia">Somalia</option>
                             <option value="ZA" label="South Africa">South Africa</option>
                             <option value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                             <option value="ES" label="Spain">Spain</option>
                             <option value="LK" label="Sri Lanka">Sri Lanka</option>
                             <option value="SD" label="Sudan">Sudan</option>
                             <option value="SR" label="Suriname">Suriname</option>
                             <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                             <option value="SZ" label="Swaziland">Swaziland</option>
                             <option value="SE" label="Sweden">Sweden</option>
                             <option value="CH" label="Switzerland">Switzerland</option>
                             <option value="SY" label="Syrian Arab Republic">Syrian Arab Republic</option>
                             <option value="TW" label="Taiwan, Province of China">Taiwan, Province of China</option>
                             <option value="TJ" label="Tajikistan">Tajikistan</option>
                             <option value="TZ" label="Tanzania, United Republic of">Tanzania, United Republic of</option>
                             <option value="TH" label="Thailand">Thailand</option>
                             <option value="TL" label="Timor-Leste">Timor-Leste</option>
                             <option value="TG" label="Togo">Togo</option>
                             <option value="TK" label="Tokelau">Tokelau</option>
                             <option value="TO" label="Tonga">Tonga</option>
                             <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                             <option value="TN" label="Tunisia">Tunisia</option>
                             <option value="TR" label="Turkey">Turkey</option>
                             <option value="TM" label="Turkmenistan">Turkmenistan</option>
                             <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                             <option value="TV" label="Tuvalu">Tuvalu</option>
                             <option value="UG" label="Uganda">Uganda</option>
                             <option value="UA" label="Ukraine">Ukraine</option>
                             <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                             <option value="GB" label="United Kingdom">United Kingdom</option>
                             <option value="US" label="United States">United States</option>
                             <option value="UM" label="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                             <option value="UY" label="Uruguay">Uruguay</option>
                             <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                             <option value="VU" label="Vanuatu">Vanuatu</option>
                             <option value="VE" label="Venezuela">Venezuela</option>
                             <option value="VN" label="Viet Nam">Viet Nam</option>
                             <option value="VG" label="Virgin Islands, British">Virgin Islands, British</option>
                             <option value="VI" label="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                             <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                             <option value="EH" label="Western Sahara">Western Sahara</option>
                             <option value="YE" label="Yemen">Yemen</option>
                             <option value="ZM" label="Zambia">Zambia</option>
                             <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                          </select>
                       </div>
                       <div id="phonediv1" class="phonediv">
                          <input type="text" id="phone" name="phone" class="emailinputtext emailinputtextsignup phonedivinputtext  " placeholder="Phone"  >
                       </div>
                    </div>
                    <!--End country-phone div-->
                    <div class="clear"></div>
                    <div id="welcomebonusandbutton1" class="inputemaildiv countryandphonediv welcomebonusandbutton">
                       <div id="placeforsigninbutton2" class="inputemaildiv placeforsigninbutton placeforsignupbutton">
                          <input type="submit" class="signinbtnitslef" id="signupButton" value="Sign Up" >
                       </div>
                    </div>
                    <div class="clear"></div>
                    <!-- ngRepeat: error in signupErrorText | translate track by $index -->
                 </div>
                 <div class="clear"></div>
              </div>
              <div class="clear"></div>
           </div>
           </form>
           <!--End signup form-->
           <div class="clear"></div>
        </div>
        <br class=""><br class="">
     
 
  
</div>
<?php endif;?>