


<div class="bg-inner"></div><div class="wrap">


<div class="wrap-my-account clearfix">

     <div class="hadding inner-hadding" >
        <h1>My Tickets</h1>
    </div>

  
 <?php $this->load->view('frontend/users/left-sidebar.php');?>

    <div id="user-details">
            <img src="https://www.lottoworldgroup.com/wp-content/themes/lotto_theme/images/loading.gif" class="macloader" style="display: none;">

           <?php $tickets_details=isset($ticket['tickets_details'])?json_decode($ticket['tickets_details']):'tickets_details';
          
         
           ?>

            <div id="tabs-4" class="r_tabs" style="display:block">
                <div class="my_table_main">
                    <div class="table_style_1" >
                        <table cellspacing="1" cellpadding="0" border="0">
                             <tbody id="mytransaction">
                            <tr>
                                <th align="center" class="small-arrow" valign="middle"><?php _e('Lottery','loto') ?></th>
                                <td><?php echo ucfirst($ticket['lottery_type']);?></td>
                            </tr>
                            <tr>
                                <th align="center" class="small-arrow" valign="middle"><?php _e('Date','loto') ?></th>
                                <td><?php echo $ticket['created']?></td>
                                </tr>
                            <tr>
                                <th align="center" class="small-arrow" valign="middle"><?php _e('Status','loto') ?></th>
                                <td><?php echo !empty($ticket['ticket_id'])?'Completed':'Failed';?></td>
                            </tr>
                            <tr>
                            <tr>
                                <th align="center" class="small-arrow" valign="middle"><?php _e('Line','loto') ?></th>
                                <td><?php 
                                 $wrapnumbers='';
                                if(isset($tickets_details->lines)){
                                    $numbersKey=getNumbersKey($tickets_details->type);
                                    
                                    foreach($tickets_details->lines as $line){
                                       
                                        $lotteryNumbers='';
                                        if(isset($numbersKey[0])){
                                            $mainKey=$numbersKey[0];
                                           
                                            $lotteryNumbers.= "<div class='number numberblue'>".implode("</div><div class='number numberblue'>",$line->numbers->$mainKey)."</div>";
                                            
                                        }
                                        if(isset($numbersKey[1])){
                                            $mainKey1=$numbersKey[1];
                                            $orangecircle=[];
                                            if(is_array($line->numbers->$mainKey1)){
                                                $lotteryNumbers.= "<div class='number numberorange'>".implode("</div><div class='number numberorange'>",$line->numbers->$mainKey1)."</div>";
                                            }
                                            else{
                                                $lotteryNumbers.= "<div class='number numberorange'>".$line->numbers->$mainKey1."</div>";
                                            }
                                        }
                                        $wrapnumbers.='<div class="lineofnumbers">'.$lotteryNumbers."</div>";
                                    }
                                }
                                echo "";
                                ?><div class="alloneline"><?php echo $wrapnumbers;?></div></td>
                            </tr>

                            
                            </tr>
                            <tr>
                            </tr>
                            </tbody>
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