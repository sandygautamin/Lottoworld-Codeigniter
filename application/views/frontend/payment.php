<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<div class="container">
<style>
@media (min-width: 1200px){
.container {
height:auto;	
}
}
</style>

<!-- Credit Card Payment Form - START -->

<div class="container" style="height:auto;">
    <div class="row">
        <div class="col-xs-12 col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-12 col-md-12"><h3 class="text-center">Payment Details</h3></div>
                        <img class="img-responsive cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                    </div>
                </div>
                <div class="panel-body">
					<?php 
					$message_name=$this->session->flashdata('notify_msg');
					if($message_name):?>
					<div class="alert alert-danger" role="alert">
					 <?php echo $message_name?>
					</div><?php endif;?>
                    <form role="form" action="" method="post">
					<input type="hidden" name="amount" value="12"/>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">                                    
                                    <div class="input-group">
                                        <input type="tel" name="card_number" class="form-control" placeholder="Valid Card Number" required/>
                                        <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
									<select name="card_expiry_month"  class="form-control" required>
									<option value="">Expiration months</option>
									<?php if($months):foreach($months as $key=>$month):?>
                                    <option value="<?php echo  $key;?>"><?php echo  $month;?></option>
									<?php endforeach;endif;?>
									</select>
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">                                    
									<select name="card_expiry_year"  class="form-control" required>
									<option value="">Select Year</option>
									<?php for($i=date("Y");$i<=date("Y")+10;$i++):?>
                                    <option value="<?php echo  substr($i,-2);?>"><?php echo  $i;?></option>
									<?php endfor;?>
									</select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">                                   
                                    <input type="text" name="card_cvv" class="form-control" placeholder="CVV" required/>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">                                  
                                    <input type="text" name="card_owner" class="form-control" placeholder="Card Owner Names" />
                                </div>
                            </div>
							<div class="col-xs-12">
								<button type="submit" name="submit" class="btn btn-warning btn-lg btn-block">Process payment</button>
							</div>
                        </div>
						
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cc-img {
        margin: 0 auto;
    }
</style>
<!-- Credit Card Payment Form - END -->

</div>