<!--==== EDIT modal start====-->
<div class="modal fade edit-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="userloginmodal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content box-flat konto-popup">
            <h3 class="text-center text-orange">Skapa konto</h3>
            <div class="whitebgDiv popupwhitebg">
                <form id="edit-user" action=""  method="post">
				<?php $userType = $this->session->userdata('userType');?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">grundläggande information</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Förnamn</label>
                                                <input type="hidden"  name="user_id"  id="edit_user_id" value="<?php echo $id; ?>" >
                                                <input type="text"  name="fname" class="form-control" id="fname" placeholder="Förnamn" value="<?php echo $fname; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Efternamn</label>
                                                <input type="text"  name="lname" class="form-control" id="lname" placeholder="Efternamn" value="<?php echo $lname; ?>">
                                            </div>
                                            <div class="form-group ">
                                                <label for="">Telefonnummer</label>
                                                <input type="text" class="form-control" name="phone" id="edit_phone" placeholder="Tele. nr" value="<?php echo $phone; ?>">
                                            </div>
											
											<div class="form-group ">
												<span class="squaredTwo">
												<input type="checkbox" value="1" name="enable_otp_auth" id="enable_otp_auth" 
												<?php if($enable_otp_auth==1){?> checked="checked" <?php } ?>>
												<label for="enable_otp_auth"></label></span>
												 <label for="enable_otp_auth1">One-Time Password (OTP) Pre-Authentication </label>
                                            </div>	
																			
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <?php
                                            /** kund-avdelning View * */
                                            $viewData = [
                                                '$customers' => $customers,
                                                'hasMultiple' => "yes",
                                                'dropDownParent' => '#userloginmodal',
                                                "defaultCustomer" => $customers_id,
                                                "defaultDept" => $departments_id
                                            ];
                                            $this->load->view("templates/kund-avdelning", $viewData);
                                            /** END * */
                                            if ($userType != 'delagare'){
												unset($account_types[0]); // unset 
												unset($account_types[1]);
												unset($account_types[4]);
												unset($account_types[5]);
											}
											?>											
                                            <div class="form-group">
                                                <label for="">Välj behöringhet för konto</label>
                                                <select name="account_type" id="edit_account_type" class="form-control">							
                                                    <?php if ($account_types): ?>
                                                        <?php foreach ($account_types as $account): ?>
                                                            <option value="<?php echo $account['slug'] ?>" <?php echo ($account_type == $account['slug']) ? 'selected="selected"' : ''; ?>><?php echo $account['title'] ?></option>
                                                        <?php endforeach; ?> 														
                                                    <?php endif; ?>
                                                </select>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#edit_account_type").select2({
                                                            minimumResultsForSearch: -1,
                                                            width: "100%"
                                                        });
                                                    });
                                                </script>
                                            </div>
											<div class="form-group ">
											<button type="button" class="btn btn-flat btn-orange" data-id="<?php echo $id; ?>" name="reset_quota" id="reset_quota" >Återställ maxlängd <span id="status-prgress"></span></button>
                                            </div>				
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Byt lösenord (lämna tomt, om du inte vill)</div>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Lösenord</label>
                                                <input type="password"  name="password" class="form-control" id="edit_password" placeholder="Ange nytt lösenord">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group ">
                                                <label for="">Bekräfta lösenord</label>
                                                <input type="password" class="form-control" name="cpassword" id="edit_cpassword" placeholder="Skriv in lösenord igen">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editSubmit" class="btn btn-update-user btn-flat btn-orange" value="Skapa konto">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

