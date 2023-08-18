


<div class="bg-inner"></div><div class="wrap">


    <div class="wrap-my-account clearfix">

         <div class="hadding inner-hadding" >
            <h1>My Tickets</h1>
        </div>
 
      
     <?php $this->load->view('frontend/users/left-sidebar.php');?>

        <div id="user-details">
                

               

                <div id="tabs-4" class="r_tabs" style="display:block">
                    <div class="my_table_main">
                        <div class="table_style_1" >
                            <table cellspacing="1" cellpadding="0" border="0">
                                <thead class="btn_dark-blue">
                                <tr>
                                    <th align="center" valign="middle"><?php _e('Lottery','loto') ?></th>
                                    <th align="center" valign="middle"><?php _e('Date','loto') ?></th>
                                    <th align="center"  valign="middle"><?php _e('Status','loto') ?></th>
                                    <th align="center" valign="middle"><?php _e('Details','loto') ?></th>
                                </tr>
                                </thead>
                                <tbody id="mytransaction">
                                <?php
                                if($tickets):
                                    foreach($tickets as $ticket):
                                       
                                    ?>
                                <tr>
                                    
                                    <td><?php echo ucfirst($ticket['lottery_type']);?></td>
                                    <td><?php echo $ticket['created']?></td>
                                    <td><?php echo !empty($ticket['ticket_id'])?'Completed':'Failed';?></td>
                                    <td><a href="<?php echo base_url('users/tickets/').$ticket['id']; ?>">View Details</a></td>
                                </tr>
                                <?php endforeach;
                                else:?>
                                <tr><td colspan="5">Records not available.</td></tr>
                                <?php endif;?>
                            </tbody>
                            </table>
                        </div>
                        <div id="my_tickets_data"></div>
                    </div>
                    <!-- An empty div which will be populated using jQuery -->
                    <input type='hidden' class='current_page'/>
                    <input type='hidden' class='show_per_page'/>
                    <div class="paging_part"></div>
                </div><!-- /.tab-4/.My Tickets -->

                
                
        </div><!-- /.user-details -->
    </div><!-- /.wrap-my-account -->
</div>