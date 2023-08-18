<div class="bg-inner"></div><div class="wrap">


    <div class="wrap-my-account clearfix">

         <div class="hadding inner-hadding" >
            <h1>My Transactions</h1>
        </div>
 
      
     <?php $this->load->view('frontend/users/left-sidebar.php');?>

        <div id="user-details">
                
               

                <div id="tabs-3" class="r_tabs table_style_1" style="display:block;">
                    <div class="table_style_1">
                        <table cellspacing="1" cellpadding="0">
                            <thead class="btn_dark-blue">
                            <tr>
                                <th height="30" align="center" valign="middle" ><?php _e('Transactions','loto') ?></th>
                                <th align="center" valign="middle" ><?php _e('Date','loto') ?></th>
                                <th align="center" valign="middle"><?php _e('Amount','loto') ?></th>
                                <th align="center" valign="middle" ><?php _e('Lottery','loto') ?></th>
                               
                            </tr>
                            </thead>
                            <tbody id="mytransaction">
                            <?php
                                if($transations):
                                    foreach($transations as $transaction):
                                       $cart_data=json_decode($transaction['cart_data']);
                                       $lotteryname=[];
                                       foreach($cart_data as $cartinfo){
                                        $lotteryname[]=ucfirst($cartinfo->type);
                                       }
                                    ?>
                                <tr>
                                    <td><?php echo $transaction['pspid']?></td>
                                    <td><?php echo $transaction['created']?></td>
                                    <td><?php echo number_format($transaction['amount'],2)?></td>
                                    <td><?php echo implode( ", ",$lotteryname);?></td>
                                </tr>
                                <?php endforeach;
                                else:?>
                                 <tr><td colspan="4">Records not available.</td></tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- An empty div which will be populated using jQuery -->
                    <input type='hidden' class='current_page'/>
                    <input type='hidden' class='show_per_page'/>
                    <div class="paging_part"></div>
                </div><!-- /.tab-3/.My Transactions -->
                
                
        </div><!-- /.user-details -->
    </div><!-- /.wrap-my-account -->
</div>