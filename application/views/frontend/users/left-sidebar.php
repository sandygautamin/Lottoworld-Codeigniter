  <div id="user-info-box" style="display:none;">
            <div class="part ">
                <i class="avatar"></i>
                <p class="box_name"><?php echo isset($user['fname'])?$user['fname']:''?> <?php echo isset($user['lname'])?$user['lname']:''?></p>
                <p class="box_viplvl"></p>
            </div>
            <div class="part">
                <i class="realmoney-pic"></i>
                <p class="box_name">Real money:</p>
                <p class="box_text">€ 20.00</p>
            </div>
            <div class="part">
                <i class="accpig-pic"></i>
                <p class="box_name">Bonus money</p>
                <p class="box_text">€ 20</p>
            </div>
            <div class="part">
                <p class="text_holder">My points<span style="color: rgb(29, 50, 101);" class="text_right green">0</span></p>
                <div class="meter nostripes">
                    <span style="width: 0px; background-color: rgb(0, 172, 117);"></span>
                </div>
                <p class="text_holder">Points to next level<span style="color: rgb(29, 50, 101);" class="text_right green">0</span></p>
            </div>
            <div class="btns_box clearfix">
                <a href="<?php echo base_url()?>/my-account/deposit" class="btn btn_deposit-green right">Deposit</a>
                <a href="<?php echo base_url()?>/withdraw-money" class="btn btn_light-blue right">Withdraw</a>
            </div>

            <!--<div class="points_box">
                not used in DommLotto
                            </div>-->
        </div><!-- /.user-info-box -->

<div id="horizontalTab" class="r-tabs">
<?php 
$segment=$this->uri->segment(2);

?>
	<ul class="clearfix r-tabs-nav">
		<li class="r-tabs-tab  <?php if($segment=='account'):?> r-tabs-state-active <?php else: ?>  r-tabs-state-default <?php endif;?> " ><a href="<?php echo base_url('users/account');?>"class="r-tabs-anchor"><i class="ico-tabs ico-details">&nbsp;</i>My Details</a></li>
		
		<li class="r-tabs-tab <?php if($segment=='transactions'):?> r-tabs-state-active <?php else: ?>  r-tabs-state-default <?php endif;?>"><a href="<?php echo base_url('users/transactions');?>" id="mytransactions" class="r-tabs-anchor"><i class="ico-tabs ico-transactions">&nbsp;</i>Transactions</a></li>
		<li class="r-tabs-tab <?php if($segment=='tickets'):?> r-tabs-state-active <?php else: ?>  r-tabs-state-default <?php endif;?>"><a href="<?php echo base_url('users/tickets');?>"  id="my_tickets" class="r-tabs-anchor"><i class="ico-tabs ico-tickets">&nbsp;</i>My Tickets</a></li>
		
	</ul>
</div>