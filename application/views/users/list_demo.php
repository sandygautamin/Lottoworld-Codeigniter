
<!--========Body content start here=====-->
<section class="bodybg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-7 col-md-8 col-xs-12">							
                        <h1 class="margintop-less">Hantera konton</h1>
                        <p>Sök eller flitrera i listan efter larm. Klicka på larmet för att få detlajerad information om larmet</p>
                    </div><!--.col-sm-8-->

                    <div class="col-sm-5 col-md-4 col-xs-12 text-right btn-section signuptop-button">
                        <a href="" class="btn btn-transparent btn-flat btn-xs-block no-pointer">Antal Konton: <span id="total_account" class="text-orange">0</span></a> <button class="btn btn-long btn-flat btn-orange btn-xs-block" data-toggle="modal" data-target=".bs-example-modal-sm">Skapa konto</button>
                    </div><!--.col-sm-8-->
                </div><!--.row-->
                <hr class="logindark">
                <div class="whitebgDiv">
                    <div class="row">
                        <div class="col-sm-12 searchpanel">
                            <div class="row marginbot15">
                                <div class="col-sm-6 col-xs-12">
                                    <p><i class="fa fa-search" aria-hidden="true"></i> <input id="myInput" type="text" class="form-control input-flat" placeholder="Sök efter företag, org.nr, telefonnummer eller serienummer"></p>
                                </div><!--col-sm-3 col-xs-12-->
                                <div class="col-sm-2 col-xs-12">
                                    <p><button class="btn btn-block btn-flat btn-orange">Sök</button></p>
                                </div><!--col-sm-3 col-xs-12-->
                                <div class="col-sm-4 col-xs-12">
                                    <p style="padding-top:6px;">Antal sökresultat: <strong><span id="user_count"></span></strong></p>
                                </div><!--col-sm-3 col-xs-12-->
                            </div><!--.row-->

                        </div><!--.col-sm-9 col-xs-12-->
                    </div><!--.row-->


                    <div class="row margintop25">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped table-colborder"> 
                                    <thead> 
                                        <tr> 
                                            <th>Datum</th> 
                                            <th>Kund</th> 
                                            <th>Epostadress</th> 
                                            <th>Telefonnummer</th> 
                                            <th>Behörighet</th> 
                                            <th>&nbsp;</th> 
                                        </tr>
                                    </thead> 
                                    <tfoot> 
                                        <tr> 
                                            <th>Datum</th> 
                                            <th>Kund</th> 
                                            <th>Epostadress</th> 
                                            <th>Telefonnummer</th> 
                                            <th>Behörighet</th> 
                                            <th>&nbsp;</th> 
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($users as $user) {
                                            $date = date_create($user['created']);
                                            ?>
                                            <tr> 
                                                <td><?php echo date_format($date, DATE_FORMAT); ?></td> 
                                                <td><?php echo $user['name']; ?></td> 
                                                <td><?php echo $user['email']; ?></td> 
                                                <td><?php echo $user['phone']; ?></td> 
                                                <td><?php echo $user['account_type']; ?></td> 
                                                <td class="text-center"><a href="javascript:editRow( <?php echo $user['id'] ?> );" class="arrowbg editbg"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                            </tr> 

                                        <?php } ?>  

                                    </tbody> 
                                </table>
                                <div class="pull-left">
                                </div>
                            </div><!--.table-responsive-->
                        </div><!--------.col-sm-12----->
                    </div><!--------.row----->


                </div><!-----.whitebgDiv----->
            </div><!--/.col-sm-12-->
        </div><!--/.row-->
    </div><!--/.container-->
</section>
<!--==== Registratoin modal start====-->
<div class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content box-flat konto-popup">
            <div class="modal-body" style="overflow:hidden;">
                <h3 class="text-center text-orange">Skapa konto</h3>
                <div class="whitebgDiv popupwhitebg">
                    <?php
                    $message = "";
                    $notify_msg = $this->session->flashdata('notify_msg');
                    if ($notify_msg) {
                        if ($notify_msg['error'] == 0) {
                            $message = "success";
                        } else {
                            $message = "error";
                        }
                    }
                    /* echo "<pre>";
                      print_r($companies_list);
                      echo "<pre>"; */
                    ?>
                    <form id="create-user" class="result-popup <?php echo $message ?>" action="" method="post">
                        <div class="form-group">
                            <label for="">Kund</label>
                            <input type="hidden"  name="user_id"  id="user_id" >
                            <input type="text"  name="username" class="form-control" id="username" placeholder="Namn">
                        </div>

                        <div class="form-group">
                            <label for="">Kommun</label>



                            <select id="kommun" name="kommun" style="width:100%">
                                <option></option>
                                <?php
                                for ($i = 0; $i < count($companies_list); $i++) {
                                    //for($i=0;$i<10;$i++){
                                    ?>
                                    <option value="<?php echo $companies_list[$i]['company_name']; ?>"><?php echo $companies_list[$i]['company_name'] ?></option>
                                <?php } ?>

                            </select>
                        </div>


                        <div class="form-group">                    	
                            <select id="avdelning" name="avdelning[]" style="width:100%" multiple="multiple">
                                <option>Select Avdelning</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Epostadress</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Epost">
                        </div>
                        <div class="form-group ">
                            <label for="">Telefonnummer</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Tele. nr">
                        </div>
                        <div class="form-group password-field">
                            <label for="">Välj lösenord</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="">
                        </div>
                        <div class="form-group password-field">
                            <label for="">Bekräfta lösenord</label>
                            <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="">
                        </div>
                        <div class="form-group relativediv">
                            <label for="">Välj behöringhet för konto</label>
                            <select name="account_type" id="account_type">
                                <?php
                                if ($account_type) {
                                    foreach ($account_type as $account) {
                                        ?>
                                        <option value="<?php echo $account['slug'] ?>"><?php echo $account['title'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="regisSubmit" class="btn btn-block btn-flat btn-orange" value="Skapa konto">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!--.modal-->

<!--==== EDIT modal start====-->
<div class="modal fade edit-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content box-flat konto-popup">
            <h3 class="text-center text-orange">Skapa konto</h3>
            <div class="whitebgDiv popupwhitebg">

                <form id="edit-user" action="" method="post">
                    <div class="form-group">
                        <label for="">Kund</label>
                        <input type="hidden"  name="user_id"  id="edit_user_id" >
                        <input type="text"  name="username" class="form-control" id="edit_username" placeholder="Namn">
                    </div>                  
                    <div class="form-group ">
                        <label for="">Telefonnummer</label>
                        <input type="text" class="form-control" name="phone" id="edit_phone" placeholder="Tele. nr">
                    </div>					
                    <div class="form-group relativediv">
                        <label for="">Välj behöringhet för konto</label>
                        <select name="account_type" id="edit_account_type">							
                            <?php
                            if ($account_type) {
                                foreach ($account_type as $account) {
                                    ?>
                                    <option value="<?php echo $account['slug'] ?>"><?php echo $account['title'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editSubmit" class="btn btn-block btn-flat btn-orange" value="Skapa konto">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--.modal-->
<!--<div class="ui-widget">
        <label for="birds">Birds: </label>
        <input id="birds">
</div>

<div class="ui-widget" style="margin-top:2em; font-family:Arial">
Result:
<div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="<?php echo base_url("assets/js/select2.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.validate.min.js"); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/css/select2.css"); ?>">

<script>

    function editRow(id) {
        if ('undefined' != typeof id) {
            $.getJSON('<?php echo base_url("users/edit_user") ?>?edit=' + id, function (obj) {
                $('#edit_user_id').val(obj.id);
                $('#edit_username').val(obj.name);
                $('#edit_phone').val(obj.phone);
                $('#edit_account_type').val(obj.account_type);
                $('.edit-example-modal-sm').modal('show')

            }).fail(function () {
                alert('Unable to fetch data, please try again later.')
            });
        } else
            alert('Unknown row id.');
    }

    $(document).ready(function () {
        var table = jQuery('#example').DataTable({
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "infoCallback": function (settings, start, end, max, total, pre) {
                $("#user_count").text(total);
                /* return "Showing " + start + " to " + end + " of " + total + " entries"
                 + ((total !== max) ? " (filtered from " + max + " total entries)" : ""); */
            }
        });
        $("#user_count").text(table.rows().count());
        $("#total_account").text(table.rows().count());
        $('#myInput').on('keyup', function () {
            table.search(this.value).draw();
            //$("#user_count").text(table.data().count() );


        });



        $("#create-user").validate({
            //var  company_name = jQuery('#company_name').val();
            rules: {
                username: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo base_url("users/email_check/") ?>",
                        type: "post"
                    }
                },
                password: {required: true, },
                cpassword: {equalTo: "#password"},
                phone_num: {
                    required: true,
                },
                account_type: {
                    required: true,
                }

            },
            messages: {
                username: "This field is required.",
                email: {
                    required: "Vänligen ange din e-postadress.",
                    email: "Vänligen ange en giltig e-postadress.",
                    remote: "Email already Exist."
                },

                password: {
                    required: "This field is required.",
                },
                cpassword: "Lösenordet matchar inte.",
                phone: {
                    required: "This field is required.",
                },
                account_type: {
                    required: "This field is required.",
                },

                submitHandler: function (form) {
                    form.submit();
                }
            },
        });
        /*********** AUTOCOMPLETE for Company ************/

        /* $( "#kommun" ).autocomplete({
         source: site_url+"users/companies_list",
         minLength: 2,
         select: function( event, ui ) {
         //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
         $(this).val(ui.item.value);
         }
         });  */


        $('select#kommun').select2({
            placeholder: "Kommun",
            minimumInputLength: 3,
            dropdownParent: ".edit-example-modal-sm",
            formatInputTooShort: function () {
                return "Enter 3 Character";
            },

        });

        /* $('#kommun').on("select2:selecting", function(e) { 
         var company_name=$(this).val()
         alert(company_name)
         }); */

        $('#kommun').on('change', function () {
            var company_name = $(this).val()
            $.post(site_url + "/users/unique_avdelning_list", {company_name: company_name})
                    .done(function (data) {
                        $("#avdelning").html(data);
                        /* alert(data) */
                    });

        })

        $('select#avdelning').select2({
            placeholder: "Avdelning",
            /*  minimumInputLength: 2,	 */
            dropdownParent: ".edit-example-modal-sm",
            maximumSelectionLength: 3,
            /* formatSelectionTooBig: function (limit) {
             // Callback
             alert(limit)
             return 'Too many selected items';
             } */
            /* formatInputTooShort: function () {
             return "Enter 2 Character";
             }, */

        });

        /*   $("select#kommun").select2({
         minimumInputLength: 2,
         tags: [],
         ajax: {
         url: site_url,
         dataType: 'json',
         type: "GET",
         quietMillis: 50,
         data: function (term) {
         return {
         term: term
         };
         },
         results: function (data) {
         return {
         results: $.map(data, function (item) {
         return {
         text: item.completeName,
         slug: item.slug,
         id: item.id
         }
         })
         };
         }
         }
         });
         */
        // $("#select2insidemodal").select2({
        // dropdownParent: $("#myModal")
        // });

    });

</script>