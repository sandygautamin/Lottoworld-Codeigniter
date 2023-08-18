<!--========Body content start here=====-->
<section class="bodybg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-7 col-md-8 col-xs-12">							
                        <h1 class="margintop-less">Hantera konton</h1>
                        <p>Sök eller flitrera i listan efter larm. Klicka på larmet för att få detlajerad information om larmet</p>
                    </div><!--.col-sm-8-->
                    <div class="col-sm-5 col-md-4 col-xs-12 text-right btn-section signuptop-button">
                        <a href="" class="btn btn-transparent btn-flat btn-xs-block no-pointer">Antal Konton: <span id="total_account" class="text-orange">0</span></a> <button class="btn btn-long btn-flat btn-orange btn-xs-block" data-toggle="modal" data-target=".bs-example-modal-sm">Skapa konto</button>
                    </div><!--.col-sm-8-->
                </div><!--.row-->
				<div class="row">
                </div><!--.row-->
                <hr class="logindark">
                <div class="whitebgDiv">
                    <div class="row">
                        <div class="col-sm-12 searchpanel">
                            <div class="row marginbot15">
                                <div class="col-sm-6 col-xs-12">
                                    <p><i class="fa fa-search" aria-hidden="true"></i> <input id="myInput" type="text" class="form-control input-flat" placeholder="Sök efter företag, org.nr, telefonnummer eller serienummer"></p>
                                </div><!--col-sm-3 col-xs-12-->
                                <div class="col-sm-2 col-xs-12">
                                    <p><button class="btn btn-block btn-flat btn-orange">Sök</button></p>
                                </div><!--col-sm-3 col-xs-12-->
                                <div class="col-sm-4 col-xs-12">
                                    <p style="padding-top:6px;">Antal sökresultat: <strong><span id="user_count"></span></strong></p>
                                </div><!--col-sm-3 col-xs-12-->
                            </div><!--.row-->
                        </div><!--.col-sm-9 col-xs-12-->
                    </div><!--.row-->
                    <div class="row margintop25">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped table-colborder"> 
                                    <thead> 
                                        <tr> 
                                            <th>Datum</th> 
                                            <th>Förnamn </th>
                                            <th>Efternamn</th>
                                            <th>Epostadress</th> 
                                            <th>Telefonnummer</th> 
                                            <th>Behörighet</th> 
                                            <th>&nbsp;</th> 
                                        </tr>
                                    </thead> 
                                    <tfoot> 
                                        <tr> 
                                            <th>Datum</th> 
                                            <th>Förnamn </th>
                                            <td>Efternamn</td>
                                            <th>Epostadress</th> 
                                            <th>Telefonnummer</th> 
                                            <th>Behörighet</th> 
                                            <th>&nbsp;</th> 
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
										
                                        foreach ($users as $user) {
                                            $date = date_create($user['created']);										
                                            ?>
                                            <tr> 
                                                <td><?php echo date_format($date, DATE_FORMAT); ?></td> 
                                                <td><?php echo $user['fname']; ?></td>
                                                <td><?php echo $user['lname']; ?></td> 
                                                <td><?php echo $user['email']; ?></td> 
                                                <td><?php echo $user['phone']; ?></td> 
                                                <td><?php echo $user['account_type']; ?></td> 
                                                <td class="text-center">
                                                    <a href="javascript:editRow( <?php echo $user['id'] ?> );" class="arrowbg editbg"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
													<?php if($this->session->userdata('userId')!=$user['id']){?>
                                                    <a  href="javascript:RemoveUser(<?php echo $user['id']; ?>,this)" class="arrowbg editbg remove-<?php echo $user['id']; ?>"><span class="glyphicon glyphicon-remove" area-hidden="true"></span></a>
													<?php } else{ ?>
													<button  type="buttn" class="arrowbg editbg btn btn-transparent btn-flat btn-xs-block no-pointer" style="padding: 4px 29px;" ><span class="glyphicon glyphicon-remove" area-hidden="true"></span></button>
													<?php } ?>
													<label class="switch">
													  <input type="checkbox" name="is_active" value="1" data-id="<?php echo $user['id']?>" <?php echo ($user['status']==1)?'checked':'';?>>
													  <span class="slider"></span>
													</label>
													 
													
													
                                                </td>
                                            </tr> 
                                        <?php } ?>  
                                    </tbody> 
                                </table>
                                <div class="pull-left"></div>
                            </div><!--.table-responsive-->
                        </div><!--------.col-sm-12----->
                    </div><!--------.row----->
                </div><!-----.whitebgDiv----->
            </div><!--/.col-sm-12-->
        </div><!--/.row-->
    </div><!--/.container-->
</section>
<!--==== Registratoin modal start====-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="userregmodal">
    <div class="modal-dialog create-user-modal" role="document">
        <div class="modal-content box-flat konto-popup">
            <h3 class="text-center text-orange">Skapa konto</h3>
            <div class="whitebgDiv popupwhitebg">
                <?php
                $message = "";
                $notify_msg = $this->session->flashdata('notify_msg');
                if ($notify_msg) {
                    if ($notify_msg['error'] == 0) {
                        $message = "success";
                    } else {
                        $message = "error";
                    }
                }
				?>
				
					
                
                <form id="create-user" class="result-popup <?php echo $message ?>" action="" method="post">
				<?php   $userType = $this->session->userdata('userType');?>
                    <div class="form-group">
                        <label for="">Förnamn</label>
                        <input type="hidden"  name="user_id"  id="user_id" >
                        <input type="text"  name="fname" class="form-control" id="fname" placeholder="Förnamn">
                    </div>
                     <div class="form-group">
                        <label for="">Efternamn</label>
                        <input type="text"  name="lname" class="form-control" id="lname" placeholder="Efternamn">
                    </div>
                    <?php
                    /** kund-avdelning View * */
                    $viewData = [
                        '$customers' => $customers,
                        'hasMultiple' => "yes",
                        'dropDownParent' => '#userregmodal'
                    ];
                    $this->load->view("templates/kund-avdelning", $viewData);
					
					
                    /** END * */
                    ?>
                    <div class="form-group">
                        <label for="">Epostadress</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Epost">
                    </div>
                    <div class="form-group ">
                        <label for="">Telefonnummer</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Tele. nr">
                    </div>
                    <div class="form-group password-field">
                        <label for="">Välj lösenord</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="">
                    </div>
                    <div class="form-group password-field">
                        <label for="">Bekräfta lösenord</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="">
                    </div>
					<div class="form-group ">
						<span class="squaredTwo">
						<input type="checkbox" value="1" name="enable_otp_auth" id="squaredTwo" >						
						<label for="squaredTwo"></label></span>
						<label for="squaredTwo">OTP Pre-Authentication </label>
					</div>
                    <div class="form-group relativediv">behörighet
                        <label for="">Välj behörighet för konto</label>
						<?php 
						if ($userType != 'delagare'){
								unset($account_type[0]); // unset 
								unset($account_type[1]);
								unset($account_type[4]);
								unset($account_type[5]);
							}
						?>
                        <select name="account_type" id="account_type">
                            <?php
							
                            if ($account_type) {
                                foreach ($account_type as $account) {
                                    ?>
                                    <option value="<?php echo $account['slug'] ?>" <?php  if($account['slug']=='anvndare'){?> selected="selected" <?php } ?> ><?php echo $account['title'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="regisSubmit" class="btn btn-block btn-flat btn-orange" value="Spara konto">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--.modal-->
<!--.modal-->
<script src="<?php echo base_url("assets/js/jquery.validate.min.js"); ?>"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function editRow(id) {
        if ('undefined' != typeof id) {
            $.get('<?php echo base_url("users/edit_user") ?>?edit=' + id, function (data) {
                $(data).filter('.modal').modal('show');
                
            });
        } else
            alert('Unknown row id.');
		 
    }
    function RemoveUser(id) {
        if (confirm("Är du säker på att du vill ta bort den här användaren?")) {
            $.ajax({
                type: "GET",
                url: '<?php echo base_url("users/remove_user") ?>?id=' + id,
                dataType: "json",
                success: function (data) {
                    if (data.success == "yes") {
                        $(".remove-" + id).closest("tr").fadeOut("slow", function () {
                            $(".remove-" + id).closest("tr").remove();
                        });
                    } else {
                        alert("something happend wrong!!, Please try again");
                    }
                }
            });
        }
    }
	
	$('body').on('click','#reset_quota',function(){ 
		$("span#status-prgress").html('<i class="fa fa-spin fa-spinner"></i>');
		 $.post( "<?php echo site_url('users/reset_quota') ?>",{ user_id: $(this).attr("data-id")})
			.done(function( data ) {				
				$("#status-prgress").html('<i class="fa fa-loading-icon fa-check"></i>');		
		});		 
	});
    $(document).ready(function () {
		
		
		 $('input[name="is_active"]').click(function(){
			user_id= $(this).attr("data-id")
			var is_active=0;
			if($(this).prop("checked") == true){
               is_active=1;
            }
			
			 
			$.post("<?php echo base_url('users/is_active')?>", { is_active: is_active,user_id:user_id})
			.done(function( data ) {
			
			});
			 
           
        });
		
        /** Change Password Form validation */
        $("#edit-user").validate({
            rules: {
                password: {
                    required: false
                },
                cpassword: {
                    equalTo: "#edit_password"
                }
            },
            messages: {
                password: "Detta fält är obligatoriskt",
                cpassword: "lösenordet matchade inte"
            }
        });
        /** END */
        var table = jQuery('#example').DataTable({
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "infoCallback": function (settings, start, end, max, total, pre) {
                $("#user_count").text(total);
                /* return "Showing " + start + " to " + end + " of " + total + " entries"
                 + ((total !== max) ? " (filtered from " + max + " total entries)" : ""); */
            }
        });
        $("#user_count").text(table.rows().count());
        $("#total_account").text(table.rows().count());
        $('#myInput').on('keyup', function () {
            table.search(this.value).draw();
            //$("#user_count").text(table.data().count() );
        });
        $("#create-user").validate({
            //var  company_name = jQuery('#company_name').val();
            rules: {
                username: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo base_url("users/email_check/") ?>",
                        type: "post"
                    }
                },
                password: {required: true, },
                cpassword: {equalTo: "#password"},
                phone_num: {
                    required: true,
                },
                account_type: {
                    required: true,
                }
            },
            messages: {
                username: "This field is required.",
                email: {
                    required: "Detta fält är obligatoriskt",
                    email: "Ogiltig e-postadress",
                    remote: "Email adressen används redan. Vänligen använd annan email."
                },
                password: {
                    required: "This field is required.",
                },
                cpassword: "Lösenordet matchar inte.",
                phone: {
                    required: "This field is required.",
                },
                account_type: {
                    required: "This field is required.",
                },
                submitHandler: function (form) {
                    form.submit();
                }
            },
        });
        /*********** AUTOCOMPLETE for Company ************/
        $("#username").autocomplete({
            source: "search.php",
            minLength: 2,
            select: function (event, ui) {
                log("Selected: " + ui.item.value + " aka " + ui.item.id);
            }
        });
    });
</script>