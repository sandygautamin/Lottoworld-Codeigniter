
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Lotteries Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addLottery"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
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
                    <h3 class="box-title">Lotteries List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>admin/lotteries" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="customers"  class="table table-hover">
                    <tr>
                    <th> Action </th>
                        <th> Id </th>
                        <th>LotteryTypeId</th>
                        <th>Lottery Name</th>
                        <th>Minimum Lines</th>
                        <th>Maximum Lines</th>
                        <th>Number Of Main Numbers</th>
                        <th>Min Select Number</th>
                        <th>Amount Of Main Numbers To Match</th>
                        <th>Amount Of Extra Numbers To Match</th>
                        <th>NUmber of Extra Numbers</th>
                        <th>Max Extra Numbers</th>
                        <th>Min Extra Numbers</th>
                        <th>Draws Per Week</th>
                        <th>Draw Days Weekly</th>
                        <th>JackPot</th>
                        <th>DrawId</th>
                        <th>DrawDate</th>
                        <th>IsMainPic</th>
                        <th>EvenLinesOnly</th>
                        <th>Lottery Currency</th>
                        <th>Lottery Currency 2</th>
                        <th>Country Code</th>
                        <th>Country Name</th>
                        <th>PricePerShare</th>
                        <th>PricePerLine</th>
                        <th>BrandId</th>
                        <th>Discount</th>
                        <th>Discount2</th>
                        <th>Price</th>
                        <th>VipPrice</th>
                        <th>NumberOfDraws</th>
                        <th>NumberOfLines</th>
                        
                        
                    </tr>
                    <?php
                    $key=1;

                        // echo "<pre>";
                        // print_r($userRecords);
                        // echo "</pre>";

                    if(!empty($userRecords))
                    {
                      
                        foreach($userRecords as  $record)
                        {
                    ?>
                    <tr><td class="text-center">
                          
                         
                           <?php //if($record->LotteryTypeId==1 OR $record->LotteryTypeId==2 OR $record->LotteryTypeId==3) {
                               //echo "NOt Authorized";
                               
                           //}
                           //else{ ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/editLottery/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'admin/deleteLottery/'.$record->id; ?>" data-userid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                           <?php

                           //}
                           
                           ?></td>
                     
                            <td><?php echo $key++  ?></td>
                        <td><?php echo $record->LotteryTypeId ?></td>
                        <td><?php echo $record->LotteryName ?></td>
                        <td><?php echo $record->MinLines ?></td>
                        <td><?php echo $record->MaxLines ?></td>
                        <td><?php echo $record->NumberOfMainNumbers ?></td>
                        <td><?php echo $record->MinSelectNumber ?></td>
                        <td><?php echo $record->AmountOfMainNumbersToMatch ?></td>
                        <td><?php echo $record->AmountOfExtraNumbersToMatch ?></td>
                        <td><?php echo $record->NumberOfExtraNumbers ?></td>
                        <td><?php echo $record->MaxExtraNumbers ?></td>
                        <td><?php echo $record->MinExtraNumber ?></td>
                        <td><?php echo $record->DrawsPerWeek ?></td>
                        <td><?php echo $record->DrawDaysWeekly ?></td>
                        
                        <td><?php echo $record->Jackpot ?></td>
                        <td><?php echo $record->DrawId ?></td>
                        <td><?php echo $record->DrawDate ?></td>
                        <td><?php echo $record->IsMainPic ?></td>
                        <td><?php echo $record->EvenLinesOnly ?></td>
                        <td><?php echo $record->LotteryCurrency ?></td>
                        <td><?php echo $record->LotteryCurrency2 ?></td>
                        <td><?php echo $record->CountryCode ?></td>
                        <td><?php echo $record->CountryName ?></td>
                        <td><?php echo $record->PricePerShare ?></td>
                        <td><?php echo $record->PricePerLine ?></td>
                        <td><?php echo $record->BrandId ?></td>
                        <td><?php echo $record->Discount ?></td>
                        <td><?php echo $record->Discount2 ?></td>
                        <td><?php echo $record->Price ?></td>
                        <td><?php echo $record->VipPrice ?></td>
                        <td><?php echo $record->NumberOfDraws ?></td>
                        <td><?php echo $record->NumberOfLines ?></td>
                       
                       
                        
                        <!--td><?php //echo date("d-m-Y", strtotime($record->createdDtm)) ?></td-->
                        
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
               
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;
            console.log(link);            
            var value = link.substring(link.lastIndexOf('/') + 1);
            console.log(value); 
            jQuery("#searchList").attr("action", baseURL + "admin/" + "userListing/" + value);
            jQuery("#searchList").submit();
        });
        
    });
</script>
