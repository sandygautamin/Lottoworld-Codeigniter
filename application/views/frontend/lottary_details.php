<?php
		$usersession = [];//$_SESSION['user_data']['Result']['UserSessionId'];
		$otherdata = ["Navidad",'Navidad'];
		
		//explode("|", $_POST['otherdata']);
		$draws = 1;//$_POST['single_drawop'];
		 $tickets=1;
		 $totalprice=0;
		 $isGroup=0;
		//echo "<pre>";print_r($_POST);die;
        ?>

      
        <div id="hidden_clicker" style="display: none">
            <a id="hiddenclicker" href="#" class="fancybox fancybox.iframe"></a>
        </div>
        <!-- #main-content -->
        
        

        <div id="middle" class="innerbg paymentpage">
            <div class="wrap">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="<?php base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/homeicon.png"/></a></li>
                        <li>››</li>
                        <li class="pagename"><?php _e('Registration','lotto') ?></li>
                    </ul>
                </div>
                <div class="innerpage">
				<h1><?php _e('Your Order','lotto') ?></h1>
                    <div class="innerpage_right">

                       <div id="payment-right-side">
						<h1 class="pay1"><?php _e('LWG protects your security','lotto') ?></h1>
						<p style="border-bottom: 1px solid #acb8c9; padding: 0px 15px 15px 95px; margin-top: 0px;"><?php _e('LWG uses the highest security levels to ensure the safety of our users.','lotto') ?>
						</p>

						<h1 class="pay2"><?php _e('Your privacy is assured!','lotto') ?></h1>
						<p style="border-bottom: 1px solid #acb8c9; padding: 0px 15px 15px 95px; margin-top: 0px;"><?php _e('We use secured servers - EV SSL issued by GeoTrust which affirms and validates the trustworthiness of our site. Your personal data is safe with us and will not be used by any third-party. All payment processing is done via a secure channel. Your Credit Card will be debited with the following Descriptor:<strong> LWG +44-20-33182913</strong>','lotto') ?>.</p>
						<p style="padding:15px;"><?php _e('lottoworldgroup.com is certified with a TrueBusinessID ® ensuring your protection and safe browsing.','lotto') ?></p>
					</div>

                    </div>
                    <div class="innerpage_left">
                        <div class="comman">
                            <div class="drawer">
                                <div class="drawer_hadding">
                                    <div class="call_full_dh"><span>1</span><?php _e(' Step One: Review Your Order','lotto') ?></div>
                                </div>
                                <!-- First Item -->
                                <div class="drawer-item">
                                    <div class="drawer-header">
                                        <div class="call1_reg_dd"><img
                                                src="<?php echo base_url(); ?>assets/images/<?php echo strtolower($otherdata[1]); ?>.png" width="50"
                                                height="50"/></div>
                                        <div class="call2_reg_dd">
                                            <?php
											$paymentnav = "";
											if ($otherdata[1] === "Navidad") {
												$paymentnav = '<strong>Loteria De Navidad 2015 ' . _e('Ticket','lotto') . '</strong><br />
												'. $tickets .'<br />1 Draw';

											}else {
											$paymentnav = '<strong>' . $otherdata[1] . ' ' . _e('Ticket','lotto') . '</strong><br />
											'. $lines .'<br />
											'. $draws .' '. __('Draws','lotto') . '';

										}?>
										<?php echo $paymentnav; 
										$totalprice= isset($_POST['totalprice'])?$_POST['totalprice']:0;
										?>
                                        </div>
                                        <div class="call3_reg_dd">€ <?php echo floatval(number_format($totalprice , 2)); ?></div>
										<?php if ($otherdata[1] === "Navidad") { ?>
										<div></div>
									<?php } else { ?>
										<?php } ?>
                                    </div>
									<?php if ($otherdata[1] === "Navidad") { ?>
										<div></div>
									<?php } else { ?>
                                    <div class="drawer-content">
                                        <?php
                                        $selno = (isset($_POST['selno']) && $_POST['selno']) != "" ? explode("|", $_POST['selno']) : "";

                                        // if Group selected
                                        if ($selno == "") {
                                            ?>
                                            <div class="drawer-content-left">
                                                <div>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="10%">&nbsp;</td>
                                                            <td width="70%" align="center" class="parantesestext_reg_text">
                                                                <?php echo $lines; ?>
                                                            </td>
                                                            <td width="10%" class="parantesestext_reg_page hidden-xs">{</td>
                                                            <td width="10%" align="center"><img src="<?php echo base_url(); ?>assets/images/winner.png"></td>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>
                                            <div class="drawer-content-right">
                                                <div class="parantesestext_reg_page hidden-xs">}</div>
                                                <div class="parantesestext_reg_text"><?php echo $draws; ?> <?php _e('Draws','lotto') ?></div>
                                            </div>
                                            <?php
                                        } else {
                                            if (is_array($selno) && count($selno) <= 5) {
                                                ?>
                                                <div class="drawer-content-left single">
                                                    <div>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <?php
                                                            $tr = $main = $extra = "";
                                                            $i = 1;
                                                            foreach ($selno as $key => $value) {
                                                                if ($value !== "") {
                                                                    $num = explode("#", $value);
                                                                    $temp1 = explode(",", $num[0]);
                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                    if ($temp2 != "") {
                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                $temp2) . '</span>' : "";
                                                                    }
                                                                    $tr .= '<tr>
                                                            <td width="30%" align="right">&nbsp;</td>
                                                            <td width="5%" align="left">' . $i . '</td>
                                                            <td width="65%" align="left">
                                                                <div class="lt_numbers_reg">
                                                                    ' . $main . '
                                                                    ' . $extra . '
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                                    $i++;
                                                                }
                                                            }

                                                            echo $tr;
                                                            ?>

                                                        </table>
                                                    </div>

                                                </div>
                                                <div class="drawer-content-right single">
                                                    <div class="parantesestext_reg_page">}</div>
                                                    <div class="parantesestext_reg_text"><?php echo $draws; ?> <?php _e('Draws','lotto') ?></div>
                                                </div>
                                            <?php } else {
                                                ?>
                                                <div class="drawer-content-left double" style="">&nbsp;</div>
                                                <div class="drawer-content-right double" style="">
                                                    <table class="hidden-xs" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tbody>
                                                        <tr>
                                                            <td align="left" width="35%" valign="middle">
                                                                <div class="call1_reg_detail">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                        <?php
                                                                        $tr = $main = $extra = "";
                                                                        $i = 1;
                                                                        foreach ($selno as $key => $value) {
                                                                            if ($key <= 4) {
                                                                                if ($value !== "") {
                                                                                    $num = explode("#", $value);
                                                                                    $temp1 = explode(",", $num[0]);
                                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                                    if ($temp2 != "") {
                                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                                $temp2) . '</span>' : "";
                                                                                    }
                                                                                    $tr .= '<tr>
                                                                                        <td align = "left" width = "10%">' . $i . '</td>
                                                                                        <td align = "left" width = "90%">
                                                                                            <div class="lt_numbers_reg">
                                                                                                ' . $main . '
                                                                                                ' . $extra . '
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>';
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        }

                                                                        echo $tr;
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td align="left" width="35%" valign="middle">
                                                                <div class="call1_reg_detail">
                                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                        <?php
                                                                        $tr = $main = $extra = "";
                                                                        $i = 6;
                                                                        foreach ($selno as $key => $value) {
                                                                            if ($key >= 5) {
                                                                                if ($value !== "") {
                                                                                    $num = explode("#", $value);
                                                                                    $temp1 = explode(",", $num[0]);
                                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                                    if ($temp2 != "") {
                                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                                $temp2) . '</span>' : "";
                                                                                    }
                                                                                    $tr .= '<tr>
                                                                                        <td align = "left" width = "10%">' . $i . '</td>
                                                                                        <td align = "left" width = "90%">
                                                                                            <div class="lt_numbers_reg">
                                                                                                ' . $main . '
                                                                                                ' . $extra . '
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>';
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        }

                                                                        echo $tr;
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td align="left" width="30%" valign="middle" class="extra-info">
                                                                <div class="call3_reg_detail">
                                                                    <div class="parantesestext_reg_page1">
                                                                        <div class="parantesestext_reg_text1"><?php echo $draws; ?><br><?php _e('Draws','lotto') ?></div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="drawer-content-left single">
                                                    <div>
                                                        <table class="visible-xs" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <?php
                                                            $tr = $main = $extra = "";
                                                            $i = 1;
                                                            foreach ($selno as $key => $value) {
                                                                if ($value !== "") {
                                                                    $num = explode("#", $value);
                                                                    $temp1 = explode(",", $num[0]);
                                                                    $temp2 = (strlen($num[1]) > 0) ? explode(",", $num[1]) : "";

                                                                    $main = '<span>' . implode("</span><span>", $temp1) . '</span>';
                                                                    if ($temp2 != "") {
                                                                        $extra = (count($temp2) > 0) ? '<span class="select">' . implode('</span><span class="select">',
                                                                                $temp2) . '</span>' : "";
                                                                    }
                                                                    $tr .= '<tr>
                                                            <td width="20%" align="right">&nbsp;</td>
                                                            <td width="7%" align="left">' . $i . '</td>
                                                            <td width="65%" align="left">
                                                                <div class="lt_numbers_reg">
                                                                    ' . $main . '
                                                                    ' . $extra . '
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                                    $i++;
                                                                }
                                                            }

                                                            echo $tr;
                                                            ?>

                                                        </table>
                                                    </div>

                                                </div>


                                                </div>
                                            <?php }
                                        }
                                        ?>
                                    </div>
									<?php } ?>
                                </div>
                                <!-- Second Item -->
								<div class="drawer-item">
                            <div class="drawer-header">
                                <div class="call1_reg_dd"><img src="<?php echo base_url(); ?>assets/images/megamillions.png" width="50" height="50" /></div>
                                <div class="call2_reg_dd">
                                    <strong>Free Group Ticket MegaMillions</strong>
                                    1 Line<br />
                                    1 Draw
                                </div>
                                <div class="call3_reg_dd">free</div>
                                
                            </div>
                            <div class="drawer-content">
                                <div class="drawer-content-left">
                                    <div>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="30%" align="right"><img src="<?php echo base_url(); ?>assets/images/winner.png"></td>
                                                <td width="5%" align="left">&nbsp;</td>
                                                <td width="65%" align="left">
                                                    <div class="lt_numbers_reg">
                                                        <span>2</span><span>7</span><span>19</span><span>27</span><span>42</span>
                                                        <span class="select">5</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="drawer-content-right">
                                    <div class="parantesestext_reg_page"></div>
                                    <div class="parantesestext_reg_text">1 Draw</div>
                                </div>
                            </div>
                        </div>
                        <!-- Second Item -->
                            </div>
                        </div>
                        <div class="clear_inner">&nbsp;</div>
                        <div class="comman">
                            <div class="drawer">
                                <div class="drawer_hadding">
                                    <div class="call_full_dh">
                                        <div class="left"><span>2</span><?php _e(' Step Two: Proceed To Checkout','lotto') ?></div>
                                        <div class="right"><?php _e('Total :','lotto') ?> <strong>€ <?php echo isset($_POST['totalprice'])?$_POST['totalprice']:0; ?></strong></div>
                                    </div>
                                </div>
                                <div class="register_area">
                                    <div class="login_left">
                                        <h4><?php _e('Already a Member? Sign In Here','lotto') ?></h4>

                                        <form name="selectedData" action="" method="post" id="selectedData">
											<?php 
											$message_name=$this->session->flashdata('message_name');
											if($message_name):?>
                                            <div class="alert alert-danger" role="alert">
											 <?php echo $message_name?>
											</div><?php endif;?>
                                        </form>

										<p class="error"><?php //echo $this->session->flashdata('message_name');?></p>
                                        <form id="signinform" name="signinform" action="<?php echo base_url("home/process_login");?>" method="post">
                                            <input type="hidden" id="isGroup" value="<?php echo $isGroup; ?>"/>
											<div class="form">
												<ul>
													<li><input name="email" type="text" placeholder="<?php _e('Email','lotto') ?>" value="" class="u_field" /></li>
													<li><input name="password" type="password" placeholder="<?php _e('Password','lotto') ?>" value="" class="u_field" /></li>
													<li><a href="#" class="link13_grn" id="sigininformForgetPassword">Forget password?</a><input name="singIn" type="submit" value="<?php _e('Sign in','lotto') ?>" class="u_button p_signin right" /></li>
													<li><input name="forgotemail" type="text" placeholder="e-mail address" value="" class="u_field" style="display:none" /></li>
													<li><input name="submitForgotPass" type="button" value="Submit" class="u_button" style="display:none" /></li>
													<!-- <li><input name="singIn" type="button" value="Sign In" class="u_button p_signin" /></li> -->
													<li><img src="<?php echo base_url() ?>assets/images/loading.gif" class="hidesigninloader"/></li>
													<li><span class="signin_error"></span></li>
												</ul>
											</div>
                                        </form>
                                    </div>
                                    <div class="register_right">
                                        <h4><?php _e('Not a Member Yet? Sign Up Now','lotto') ?></h4>
										<?php 
											$message_signup=$this->session->flashdata('message_signup');
											if($message_signup):?>
                                            <div class="alert alert-danger" role="alert">
											 <?php echo $message_signup?>
											</div><?php endif;?>
                                        <form id="signupform" name="signupform" action="<?php echo base_url("home/process_signup")?>" method="post">
                                            <div class="form">
                                                <ul>
                                                    <li><input name="fname" id="fname" type="text" placeholder="<?php _e('First Name','lotto') ?>" value="" class="u_field" /></li>
                                                    <li><input name="lname" id="lname" type="text" placeholder="<?php _e('Last Name',';lotto') ?>" value="" class="u_field" /></li>
                                                    <li><input name="phone" id="phone" type="text" placeholder="<?php _e('Phone','lotto') ?>" value="" class="u_field" /></li>
                                                    <li><input name="email" id="email" type="text" placeholder="<?php _e('Email','lotto') ?>" value="" class="u_field" /> <?php echo form_error('email','<p class="help-block alert-danger">','</p>'); ?></li>
                                                    <li><input name="password" id="password" type="password" placeholder="<?php _e('Password','lotto') ?>" value="" class="u_field" /></li>
													<li>
														<input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password"  class="form-control" required>
													</li>
                                                    <li><input type="checkbox" name="terms"/> <?php _e('I accept the <u><a href="/terms-and-conditions/">Terms and Conditions</a></u>','lotto') ?> </a></u></li>
                                                    <li><input name="" type="submit" value="<?php _e('Sign Up','lotto') ?>" class="u_button p_signup"  /></li>

                                                    <li><img src="<?php echo base_url(); ?>assets/images/loading.gif" class="hidesignuploader"/></li>
                                                    <li><span class="signup_error regerror"></span></li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>