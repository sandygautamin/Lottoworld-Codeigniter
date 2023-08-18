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
                <form class="form-horizontal well" method="post" id="form" action="doforget">
                    <fieldset>
                        <legend>Reset password</legend>

                        <div class="control-group">
                            <label for="email"> Email</label>
                            <input class="box" type="text" id="email" name="email" />
                        </div>
                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" value="Reset" />
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

                    </fieldset>
                </form>

            </div>
        </div>
    </div>

</div><!--/.container-->


