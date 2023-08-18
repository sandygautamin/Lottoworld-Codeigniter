<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Customers Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addNew"><i class="fa fa-plus"></i> Add New</a>
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
                    <h3 class="box-title">Customers List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>admin/userListing" method="POST" id="searchList">
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
                        <th>Customer Id </th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Country Code</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Zipcode</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    // echo "<pre>";
                    // print_r($userRecords);
                    // echo "</pre>";
                    $key=1;
                    if(!empty($userRecords))
                    {
                      
                        foreach($userRecords as  $record)
                        {
                    ?>
                    <tr>
                    <td><?php echo $key++; ?></td>
                        <td><?php echo $record->fname." ".$record->lname ?></td>
                        <td><?php echo $record->email ?></td>
                        <td><?php echo $record->mobno ?></td>
                        <td><?php echo $record->country ?></td>
                        <td><?php echo $record->address ?></td>
                        <td><?php echo $record->city ?></td>
                        <td><?php echo $record->zipcode ?></td>
                        <!--td><?php //echo date("d-m-Y", strtotime($record->createdDtm)) ?></td-->
                        <td class="text-center">
                          
                           <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/editOld/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'admin/deleteUser/'.$record->id; ?>" data-userid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                <p><?php echo $links; ?></p>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

