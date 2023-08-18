<!--========Body content start here=====-->
<div class="container-fluid headercontent">
    <div class="row headerbg">
        <div class="col-sm-12">
            <div class="headertext"><h1></h1>

            </div>
            <div class="loginbg">
                <p class="text-center"><img src="<?php echo base_url(); ?>/assets/images/logo-login.png" alt=""></p>
                <h4 class="text-center text-orange login-heading"><?php echo $title ?></h4>
                <?php
                $notify_msg = $this->session->flashdata('notify_msg');
                if ($notify_msg) {
                    if ($notify_msg['error'] == 0)
                        echo "<div class='success'>" . htmlentities($notify_msg['message']) . "</div>";
                    else
                        echo "<div class='error'>" . htmlentities($notify_msg['message']) . "</div>";
                }
                ?>
                <hr class="logindark">
                <form  method="post" id="channgepasswordform" action="">


                    <div class="form-group">
                        <input type="password" class="form-control inputPassword" name="password" placeholder="Lösenord" required="" id="edit_password">
                        <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control inputPassword" name="cpassword" placeholder="Bekräfta lösenord" required="" >
                        <?php echo form_error('cpassword', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="submit"  name="chnagePasswordSubmit" class="btn btn-orange btn-flat btn-login btn-block" value="Ändra"/>
                    </div>
                    <?php if (isset($info)): ?>
                        <div class="alert alert-success">
                            <?php echo($info) ?>
                        </div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-error">
                            <?php echo($error) ?>
                        </div>
                    <?php endif; ?>


                </form>

            </div>
        </div>
    </div>

</div><!--/.container-->
<script src="<?php echo base_url("assets/js/jquery.validate.min.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        /** Change Password Form validation */
        $("#channgepasswordform").validate({
            rules: {
                password: {
                    required: true
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
    });
</script>


