<?php  

// echo "<pre>";
// print_r($ticket);die;
// echo "</pre>";
?>
 <link rel='stylesheet' href="<?php echo base_url('assets/css/cart.css');?>" type="text/css" />



<?php $tickets_details=isset($ticket['tickets_details'])?json_decode($ticket['tickets_details']):'tickets_details';
           
           ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Tickets Details
       
      </h1>
    </section>
    <section class="content">
     
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ticket Details</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>admin/paymentList" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText"  class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="customers" class="table table-bordered table-hover ">
                    <tr class="shadow-sm">
                        
                       
                        <th >Lottery</th>
                        <th >Date</th>
                        <th >Status</th>
                        <th >Details</th>
                       
                       
                        
                    </tr>
                    
                    <tr >
                        
                        <td><?php echo $ticket['lottery_type'] ?></td>
                        <td><?php echo $ticket['created'] ?></td>
                        <td class="bg-success"><?php echo !empty($ticket['ticket_id'])?"Completed":"Failed"  ?></td>
                      
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
                                        if(isset($numbersKey[0])){
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
                  
                    </table>
                     
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                    
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>



