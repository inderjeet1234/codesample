
<style type="text/css">
    .vendselect{display: none;}
</style>
            <div class="title">
                <h4>
                    <i class="icon-eye-open"></i>
                    <span>Edit Assigned Project</span>
                </h4>
            </div>
            <!-- End .title -->




                        <div class="content">
                            <form onsubmit="return validateforma()" id="validateForm"  class="form-horizontal cmxform" autocomplete="off"  action="<?php echo site_url("assignprojects/update"); ?>" method="post" enctype="multipart/form-data">


                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="company_name">Company Name</label>
                                    <div class="controls span7">
                                        <input required type="text" id="name" name="name" value="<?php echo $company_name;?>" class="row-fluid">
                                    </div>
                                </div>

                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="company_name">Project Name</label>
                                    <div class="controls span7">
                                        <input required type="text" id="name" name="name" value="<?php echo $project_name;?>" class="row-fluid">
                                    </div>
                                </div>


                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3">Add Vendors to Project </label>
                                    <div class="controls span7">

                                        <label class="inline radio">

                                            <input type="radio" <?php if($val['add_vendors_to_project']==1) echo 'checked="CHECKED"';?>  name="add_vendors_to_project" value="1"  /> Yes </label>
                                        <label class="inline radio">
                                            <input type="radio" name="add_vendors_to_project" value="2" <?php if($val['add_vendors_to_project']==2) echo 'checked="CHECKED"';?> /> No </label>
                                    </div>
                                </div>

                                <div class="form-row control-group row-fluid" id="select_vendors">
                                <label class="control-label span3" for="inputEmail">Select Vendors</label>
                                <div class="controls span7">
                                <select name="vendors[]" id="vendors" data-placeholder="Select Vendors" class="chzn-select" multiple="" tabindex="3">

                                    <?php
                                    foreach($select as $value)
                                    {
                                        ?>

                                        <option <?php $vendoarr=explode(',',$val['vendors']);if(in_array($value->id,$vendoarr)) echo 'selected="SELECTED"';?>  value="<?php echo $value->id;?>"><?php echo $value->company_name;?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                    <label for="vendors" generated="true" class="error" style="display: none;">This field is required.</label>
                                </div>
                                </div>


                                <div class="form-row control-group row-fluid" id="select_vendors">
                                    <label class="control-label span3" for="inputEmail">Select WBS Employee</label>
                                    <div class="controls span7">
                                        <select name="wbsemp[]" id="wbsemp" data-placeholder="Select employee" class="chzn-select" multiple="" tabindex="3">

                                            <?php
                                            foreach($wbsemp as $value)
                                            {
                                                ?>

                                                <option <?php if(in_array($value->username,$employees)) echo 'selected="SELECTED"';?> value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                        <label for="wbsemp" generated="true" class="error" style="display: none;">This field is required.</label>
                                    </div>
                                </div>


                                <div class="form-row control-group row-fluid" id="select_vendors">
                                    <label class="control-label span3" for="inputEmail">Select Client Employee</label>
                                    <div class="controls span7">
                                        <select name="clientemp[]" id="clientemp" data-placeholder="Select employee" class="chzn-select" multiple="" tabindex="3">

                                            <?php
                                            foreach($clientemp as $value)
                                            {
                                                ?>

                                                <option <?php if(in_array($value->username,$employees)) echo 'selected="SELECTED"';?>  value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                        <label for="clientemp" generated="true" class="error" style="display: none;">This field is required.</label>
                                    </div>
                                </div>

                                <div id="noofvendors">

                                    <?php

                                    if($val['add_vendors_to_project']==1)
                                    {

                                    $i=0;
                                    $ppost=explode(",",$val['vendors']);

                                    foreach($ppost as $vall)
                                    {
                                        $this->load->model('assignprojectsmodel','',true);
                                        $vdemp=$this->assignprojectsmodel->getclientemp($vall);

                                        ?>
                                        <div class="form-row control-group row-fluid" id="select_vendors">
                                            <label class="control-label span3" for="inputEmail">Select <?php echo $this->assignprojectsmodel->getcompanyname($vall);?> Employee</label>
                                            <div class="controls span7">
                                                <select name="vdemp<?php echo $i;?>[]" id="vdemp<?php echo $i;?>" rel="vdemp_<?php echo $i;?>" data-placeholder="Select employee" class="chzn-select vedoemp"  multiple="" tabindex="3">

                                                    <?php
                                                    foreach($vdemp as $value)
                                                    {
                                                        ?>

                                                        <option <?php if(in_array($value->username,$employees)) echo 'selected="SELECTED"';?> value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <?php

                                        $i++;
                                    }
                                    }
                                    ?>

                                </div>


                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3">Approval required for WBS</label>
                                    <div class="controls span7">

                                        <label class="inline radio">
                                            <input type="radio" name="app_for_wbs" value="1" <?php if($val['app_for_wbs']==1) echo 'checked="CHECKED"';?>  /> Yes </label>
                                        <label class="inline radio">
                                            <input type="radio" name="app_for_wbs" value="2" <?php if($val['app_for_wbs']==2) echo 'checked="CHECKED"';?> /> No </label>
                                    </div>
                                </div>
                                <div id="appwbsddv">
                                <div class="form-row control-group row-fluid" id="wbs_approverdiv">
                                    <label class="control-label span3" for="wbs_approver">Select Approver</label>
                                    <div class="controls span7">
                                        <select data-placeholder="Select" class="chzn-select" id="wbs_approver" name="wbs_approver">

                                            <?php
                                            foreach($wbsemp as $value)
                                            {
                                                 if(!in_array($value->username,$employees))
                                                     continue;
                                                $d=$this->db->query("select * from assign_emp where project_id=".$this->uri->segment(4)."  and username='".$value->username."' and 	is_approver=1")->num_rows();
                                                ?>

                                                <option <?php if($d>0) echo 'selected="SELECTED"';?> value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                    </div>


                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3">Approval required for Client</label>
                                    <div class="controls span7">

                                        <label class="inline radio">
                                            <input type="radio" name="app_for_client" value="1" <?php if($val['app_for_client']==1) echo 'checked="CHECKED"';?>  /> Yes </label>
                                        <label class="inline radio">
                                            <input type="radio" name="app_for_client" value="2" <?php if($val['app_for_client']==2) echo 'checked="CHECKED"';?> /> No </label>
                                    </div>
                                </div>
                                <div id="appclientddv">
                                <div class="form-row control-group row-fluid" id="client_approverdiv">
                                    <label class="control-label span3" for="client_approver">Select Approver</label>
                                    <div class="controls span7">
                                        <select data-placeholder="Select" class="chzn-select" id="client_approver" name="client_approver">
                                            <?php
                                            foreach($clientemp as $value)
                                            {
                                                if(!in_array($value->username,$employees))
                                                    continue;
                                                $d=$this->db->query("select * from assign_emp where project_id=".$this->uri->segment(4)."  and username='".$value->username."' and 	is_approver=1")->num_rows();
                                                ?>

                                                <option <?php if($d>0) echo 'selected="SELECTED"';?> value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div id="approvalvendors">
                                    <?php

                                    if($val['add_vendors_to_project']==1)
                                    {

                                        $i=0;
                                        $tost=explode(",",$val['vendors']);

                                        $dost=explode(",",$val['app_for_vendor']);



                                        foreach($tost as $tal)
                                        {
                                        $this->load->model('assignprojectsmodel','',true);
                                        $vdemp=$this->assignprojectsmodel->getclientemp($tal);

                                        ?>

                                        <div class="form-row control-group row-fluid">
                                            <label class="control-label span3">Approval required for <?php echo $this->assignprojectsmodel->getcompanyname($tal);?></label>
                                            <div class="controls span7">

                                                <label class="inline radio">

                                                    <input class="appvendor" <?php  if($dost[$i]==1) echo 'checked="CHECKED"';?> alt="uniform-vendor_approver<?php echo $i;?>" rel="vendor_approverdiv<?php echo $i;?>" type="radio" name="app_for_vendor<?php echo $i;?>" value="1"  /> Yes </label>
                                                <label class="inline radio">
                                                    <input class="appvendor" <?php if($dost[$i]==2) echo 'checked="CHECKED"';?> alt="uniform-vendor_approver<?php echo $i;?>" rel="vendor_approverdiv<?php echo $i;?>" type="radio" name="app_for_vendor<?php echo $i;?>" value="2" /> No </label>
                                            </div>
                                        </div>

                                    <div id="appddvvend_<?php echo $i;?>">
                                        <div  <?php if($dost[$i]==2) echo 'style="display:none"';?>  class="form-row control-group row-fluid vendselect" id="vendor_approverdiv<?php echo $i;?>">
                                            <label class="control-label span3" for="client_approver">Select Approver</label>
                                            <div class="controls span7">
                                                <select data-placeholder="Select" class="chzn-select" id="vendor_approver<?php echo $i;?>" name="vendor_approver<?php echo $i;?>">
                                                    <?php
                                                    foreach($vdemp as $value)
                                                    {
                                                        if(!in_array($value->username,$employees))
                                                            continue;
                                                        $d=$this->db->query("select * from assign_emp where project_id=".$this->uri->segment(4)."  and username='".$value->username."' and 	is_approver=1")->num_rows();
                                                        ?>

                                                        <option <?php if($d>0) echo 'selected="SELECTED"';?> value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                        <?php
                                        $i++;
                                    }
                                    }
                                    ?>

                                </div>
                             <!--   <div class="form-row control-group row-fluid">
                                    <label class="control-label span3">Status </label>
                                    <div class="controls span7">

                                        <label class="inline radio">
                                            <input type="radio" name="status" value="1" <?php if($val['status']==1) echo 'checked="CHECKED"';?> /> Active </label>
                                        <label class="inline radio">
                                            <input type="radio" name="status" value="2" <?php if($val['status']==2) echo 'checked="CHECKED"';?>/> Inactive </label>
                                    </div>
                                </div>-->





                                </div>
                                <div class="form-actions row-fluid">
                                    <div class="span7 offset3">
                                        <input  type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(4);?>" class="row-fluid">
                                        <input  type="hidden" id="company_id" name="company_id" value="<?php echo $this->uri->segment(6);?>" class="row-fluid">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" onclick="window.location='<?php echo site_url("projects");?>'" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>

            <!-- End .content -->


            <!-- Validation plugin -->
            <script src="<?php echo base_url();?>js/jquery.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.sparkline.min.js"></script>
            <script src="<?php echo base_url();?>js/plugins/excanvas.compiled.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-transition.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-alert.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-modal.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-dropdown.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-scrollspy.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-tab.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-tooltip.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-popover.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-button.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-collapse.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-carousel.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap-typeahead.js"></script>
            <script src="<?php echo base_url();?>js/fileinput.jquery.js"></script>
            <script src="<?php echo base_url();?>js/jquery-ui-1.8.23.custom.min.js"></script>
            <script src="<?php echo base_url();?>js/jquery.touchdown.js"></script>


            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/wysihtml5-0.3.0.min.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.peity.min.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/textarea-autogrow.js"></script>
            <!--  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/character-limit.js"></script>-->
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.maskedinput-1.3.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/chosen/chosen/chosen.jquery.min.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/bootstrap-datepicker.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/bootstrap-colorpicker.js"></script>

           <!-- <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.stack.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.pie.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.resize.js"></script>-->




            <script src="<?php echo base_url();?>js/plugins/validation/dist/jquery.validate.min.js" type="text/javascript"></script>


           <script src="<?php echo base_url();?>js/scripts.js"></script>


            <script type="text/javascript">
                function  validateforma(){
                    var valdisc=true;

                    $('.error').hide();






                    if($('#wbsemp').val()==null)

                    {

                        $('label[for=wbsemp]').css('display','block');
                        // return false;
                        valdisc=false;
                    }
                    else if($('#clientemp').val()==null)

                    {

                        $('label[for=clientemp]').css('display','block');
                        // return false;
                        valdisc=false;
                    }


                    else if($('input[name=add_vendors_to_project]:checked').val()==1)

                    {
                        if($('#vendors').val()==null)

                        {

                            $('label[for=vendors]').css('display','block');
                            // return false;
                            valdisc=false;
                        }
                        var ty=0;
                        $('.vdempvalidate').each(function(){



                            if($('#vdemp'+ty).val()==null)

                            {
                                $('#vdemp'+ty).parent().find('label').remove();
                                $('#vdemp'+ty).parent().append('<label for="vdemp" generated="true" style="display: block" class="error" >This field is required.</label>');
                                // return false;

                                valdisc=false;

                            }

                            if($('input[name=app_for_vendor'+ty+']:checked').val()==1)
                            {
                                if($('#vendor_approver'+ty).val()=='' || $('#vendor_approver'+ty).val()==null)

                                {

                                    $('#vendor_approver'+ty).parent().find('label').remove();
                                    $('#vendor_approver'+ty).parent().append('<label for="vendor_approver" generated="true" style="display: block" class="error" >This field is required.</label>');
                                    // return false;

                                    valdisc=false;

                                }
                            }
                            ty++;

                        });
                    }






                    return  valdisc;


                }

            </script>




            <script type="text/javascript">
                $(function(){

            <?php if($val['add_vendors_to_project']!=1){?>
                    $('#select_vendors').hide();
                    <?php } ?>



                  //  $('#vendors').trigger('change');

                    <?php if($val['app_for_client']!=1){?>
                    $('#client_approverdiv').hide();
                    <?php } ?>

                    <?php if($val['app_for_wbs']!=1){?>
                    $('#wbs_approverdiv').hide();
                    <?php } ?>



                    $('input[name=add_vendors_to_project]').change(function(){

                        if($(this).val()==1)
                        {
                            $('#select_vendors').show();
                        }
                        else
                        {
                            $('#select_vendors').hide();
                            $('#noofvendors').empty();
                            $('#approvalvendors').empty();
                        }


                    });





                    $('select[id=wbsemp]').change(function(){


                        var val=$(this).val();
                        var tagp=$('input[name=app_for_wbs]:checked').val();


                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("assignprojects/appwbs"); ?>',
                            data:{'val':val,'appp':tagp},

                            success:function(data){
                                // alert(data);
                                $('#appwbsddv').html(data);
                            },
                            error: function(data) { // if error occured
                                alert("Error occured.please try again");
                                alert(data);
                            },

                            dataType:'html'
                        });



                    });


                    $('select[id=clientemp]').change(function(){


                        var val=$(this).val();
                        var tagp=$('input[name=app_for_client]:checked').val();
                        var cid=<?php echo $this->uri->segment(6);?>;

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("assignprojects/appclient"); ?>',
                            data:{'val':val,'appp':tagp,'cid':cid},

                            success:function(data){
                                // alert(data);
                                $('#appclientddv').html(data);
                            },
                            error: function(data) { // if error occured
                                alert("Error occured.please try again");
                                alert(data);
                            },

                            dataType:'html'
                        });



                    });




                    $('.vedoemp').live('change',function(){


                        var val=$(this).val();
                        var weldd=Array();
                        weldd=$(this).attr('rel').split('_');
                        var reld=weldd[1];
                        var tagp=$('input[name=app_for_vendor'+reld+']:checked').val();


                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("assignprojects/appvendor"); ?>',
                            data:{'val':val,'appp':tagp,'reld':reld},

                            success:function(data){
                                // alert(data);
                                //  $('input[name=app_for_vendor'+reld+']').val('2');
                                $('#appddvvend_'+reld).html(data);


                                $('input[name=app_for_vendor'+reld+'][value=2]').prop("checked",true);

                                $('input[name=app_for_vendor'+reld+'][value=1]').parent().attr('class',"");
                                $('input[name=app_for_vendor'+reld+'][value=2]').parent().attr('class',"checked");

                            },
                            error: function(data) { // if error occured
                                alert("Error occured.please try again");
                                alert(data);
                            },

                            dataType:'html'
                        });



                    });











                    $('input[name=app_for_client]').change(function(){

                        if($(this).val()==1)
                        {
                            $('#client_approverdiv').show();
                            $('#uniform-client_approver').show();
                        }
                        else
                        {
                            $('#client_approverdiv').hide();
                        }


                    });

                    $('input[name=app_for_wbs]').change(function(){

                        if($(this).val()==1)
                        {
                            $('#wbs_approverdiv').show();
                            $('#uniform-wbs_approver').show();

                        }
                        else
                        {
                            $('#wbs_approverdiv').hide();
                        }


                    });

                    $('.appvendor').live('change',function(){
                           var id='#'+$(this).attr('rel');
                            var cid='#'+$(this).attr('alt');

                        if($(this).val()==1)
                        {
                            $(id).show();
                            $(cid).show();
                            //$('#uniform-wbs_approver').show();

                        }
                        else
                        {
                            $(id).hide();
                        }


                    });

                    $('#vendors').change(function(){
                        var val=$(this).val();
                      if(val==null)
                      {
                          $('#noofvendors').empty();
                          $('#approvalvendors').empty();
                          return false;
                      }
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("assignprojects/ajaxvendors"); ?>',
                            data:{'val':val},

                            success:function(data){
                                // alert(data);
                                $('#noofvendors').html(data);
                            },
                            error: function(data) { // if error occured
                                alert("Error occured.please try again");
                                alert(data);
                            },

                            dataType:'html'
                        });


                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("assignprojects/ajaxappvendors"); ?>',
                            data:{'val':val},

                            success:function(data){
                                // alert(data);
                                $('#approvalvendors').html(data);
                            },
                            error: function(data) { // if error occured
                                alert("Error occured.please try again");
                                alert(data);
                            },

                            dataType:'html'
                        });



                    });





                });


            </script>



            <script type="text/javascript">
                $(document).ready(function () {
                    $("[rel=popover]").popover();
                    $("select, input:checkbox, input:radio, input:file").uniform();
                    $('textarea.autogrow').autogrow();
                    var elem = $("#chars");
                   // $("#text").limiter(100, elem);
                    // Mask plugin http://digitalbush.com/projects/masked-input-plugin/
                    $("#mask-phone").mask("(999) 999-9999");
                    $("#mask-date").mask("99-99-9999");
                    $("#mask-int-phone").mask("+33 999 999 999");
                    $("#mask-tax-id").mask("99-9999999");
                    $("#mask-percent").mask("99%");
                    // Editor plugin https://github.com/jhollingworth/bootstrap-wysihtml5/
                    $('#editor1').wysihtml5({
                        "image": false,
                        "link": false
                    });
                    // Chosen select plugin
                    $(".chzn-select").chosen({
                        disable_search_threshold: 10
                    });
                    // Datepicker
                    $('#datepicker1').datepicker({
                        format: 'mm-dd-yyyy'
                    });
                    $('#datepicker2').datepicker();
                    $('.colorpicker').colorpicker()
                    $('#colorpicker3').colorpicker();
                    // data-toggle
                    // $("#iButton").iButton({
                    //    labelOn: "Test",
                    //    labelOff: "OFF",
                    // });
                });
            </script>


