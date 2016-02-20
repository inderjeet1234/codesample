            <div class="title">
                <h4>
                    <i class="icon-eye-open"></i>
                    <span><?php if($this->uri->segment(4)) echo 'Edit Post';else echo 'Create New Post';?></span>
                </h4>
            </div>
            <!-- End .title -->




                        <div class="content">
                            <form id="validateForm"  class="form-horizontal cmxform" autocomplete="off"  action="<?php echo site_url("posts/save"); ?>" method="post" enctype="multipart/form-data">


                                <?php
                                if($val['status']==4 && $val['user_id']!=$this->session->userdata('user_id'))
                                {
                                $udata=$this->postsmodel->getuserdeatils($val['user_id']);
                                $userdata=$udata[0];

                                ?>
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="title">Posted By</label>
                                    <div class="controls span7">
                                        <input  type="text" readonly="readonly" value="<?php echo $userdata->name;?>" class="row-fluid">
                                    </div>
                                </div>
                                <?php
                                }
                                    ?>

                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="title">Title</label>
                                    <div class="controls span7">
                                        <input required type="text" id="title" name="title" value="<?php echo $val['title'];?>" class="row-fluid">
                                    </div>
                                </div>


                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="description">Description</label>
                                    <div class="controls span7">
                                        <textarea rows="3" class="row-fluid" id="description" name="description"><?php  echo $val['description'];?></textarea>
                                    </div>
                                </div>



                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="attachments">Attachments</label>
                                    <div class="controls span7">
                                        <!--    <div class="input-append row-fluid">-->
                                               <!-- <input  type="file" class="spa1n6 fileinput" id="attachment" name="attachment" />-->
                                            <input  type="file" class="spa1n6   multi" id="attachment" name="attachment[]" />

                                            <?php if(!empty($val['attachments'])){
                                            $allimg=explode(",",$val['attachments']);
                                            foreach ($allimg as $allttimg) {

                                                $extensiond=array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
                                                $diskjota=explode(".",$allttimg);
                                                if(isset($diskjota[1]))
                                                {
                                                if(in_array($diskjota[1],$extensiond))
                                                {

                                            ?>






                                                            <a rel="lightbox"  href="<?php echo base_url();?>img/posts/<?php echo $allttimg;?>" >  <img src="<?php echo base_url();?>img/posts/<?php echo $allttimg;?>" style="width:150px;height:150px;"    /></a>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url();?>img/posts/<?php echo $allttimg;?>" target="_blank">  <img src="<?php echo base_url();?>/img/doc.png"    style="width:50px;border:1px solid #eee;padding:5px;"/></a>
                                                        <?php

                                                        }
                                                }

                                                ?>








                                               <!-- <a rel="lightbox" href="<?php echo base_url();?>img/posts/<?php echo $allttimg;?>"> <img  class="thumbnail small" style="clear: both" src="<?php echo base_url();?>img/posts/<?php echo $allttimg;?>"/></a>-->
                                            <?php
                                            }
                                            }
                                        ?>


                                        <!--    </div>-->
                                    </div>
                                </div>




                                    <div class="form-row control-group row-fluid" style="display: none">
                                        <label class="control-label span3" for="title">Title</label>
                                        <div class="controls span7">
                                            <input  type="text" id="company_id" name="company_id" value="<?php echo $this->session->userdata('company_id');?>" class="row-fluid">
                                        </div>
                                    </div>


                                <div id="projectdiv">
                                             <?php
                                             if($this->uri->segment(4))
                                             {?>

                                                 <div class="form-row control-group row-fluid">
                                                     <label class="control-label span3" for="project_id">Project</label>
                                                     <div class="controls span7">
                                                         <select   name="project_id" class="chzn-select" id="project_id">
                                                             <option value="">Select  Project</option>
                                                             <?php
                                                             foreach($projects as $value)
                                                             {
                                                                 ?>

                                                                 <option  <?php if($val['project_id']==$value->id)echo 'selected="selected"';?>  value="<?php echo $value->id;?>"><?php echo $value->project_name;?></option>
                                                             <?php
                                                             }
                                                             ?>

                                                         </select>
                                                     </div>
                                                 </div>

                                             <?php
                                             }
                                    ?>
                                    <?php
                                    if($val['id']==0)
                                    {?>

                                        <div class="form-row control-group row-fluid">
                                            <label class="control-label span3" for="project_id">Project</label>
                                            <div class="controls span7">
                                                <select   name="project_id" class="chzn-select" id="project_id">
                                                    <option value="">Select  Project</option>
                                                    <?php
                                                    foreach($projects as $value)
                                                    {
                                                        ?>

                                                        <option   value="<?php echo $value->id;?>"><?php echo $value->project_name;?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>


                                    <?php if($val['id']>0)
                                            {
                                            //    $num = $this->db->query("select * from assign_emp where username='".$this->session->userdata("username")."' and is_approver=1 and project_id=".$id)->num_rows();
                                     ?>
                                                <div class="form-row control-group row-fluid" id="sharewith">
                                                    <label class="control-label span3">Share With</label>
                                                    <div class="controls span7">
                                                        <label class="checkbox inline">
                                                            <input type="checkbox" <?php if($val['wbs_visible']==1 && $this->session->userdata('company_type')!=1)echo "checked='checked'";?>   <?php if($this->session->userdata('company_type')==1)echo ' disabled="disabled"';?>  <?php if($this->session->userdata('company_type')==1)echo " checked='checked'";?>  value="1" name="wbs_visible"><?php if($this->session->userdata('company_type')==1)echo "With in Group";else echo "To WBS";?></label>
                                                        <label class="checkbox inline" <?php if($this->session->userdata('company_type')==3)echo "style='display:none'";?>>
                                                            <input type="checkbox" <?php if($val['client_visible']==1 && $this->session->userdata('company_type')!=2)echo "checked='checked'";?> value="1" name="client_visible"  <?php if($this->session->userdata('company_type')==2)echo ' disabled="disabled"';?>  <?php if($this->session->userdata('company_type')==2)echo " checked='checked'";?>  ><?php if($this->session->userdata('company_type')==2)echo "With in Group";else echo "To Client";?></label>
                                                        <?php

                                                        $tum=$this->db->query("select * from assignprojects where add_vendors_to_project=1 and id=".$val['project_id'])->num_rows();
                                                        if($tum>0)
                                                        {
                                                       ?>
                                                        <label class="checkbox inline" <?php if($this->session->userdata('company_type')==2)echo "style='display:none'";?>>
                                                            <input type="checkbox" <?php if($val['vendor_visible']==1 && $this->session->userdata('company_type')!=3)echo "checked='checked'";?> value="1" name="vendor_visible"  <?php if($this->session->userdata('company_type')==3)echo ' disabled="disabled"';?>  <?php if($this->session->userdata('company_type')==3)echo " checked='checked'";?>  ><?php if($this->session->userdata('company_type')==3)echo "With in Group";else echo "To Vendor";?></label>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                    <?php
                                            }
                                else
                                {
                                      ?>
                                <div class="form-row control-group row-fluid" id="sharewith">
                                    <label class="control-label span3">Share With</label>
                                    <div class="controls span7">
                                        <label class="checkbox inline">
                                            <input type="checkbox"  value="1" name="wbs_visible"   <?php if($this->session->userdata('company_type')==1)echo ' disabled="disabled"';?>  <?php if($this->session->userdata('company_type')==1)echo " checked='checked'";?>  ><?php if($this->session->userdata('company_type')==1)echo "With in Group";else echo "To WBS";?></label>
                                        <label class="checkbox inline" <?php if($this->session->userdata('company_type')==3)echo "style='display:none'";?>>
                                            <input type="checkbox" value="1" name="client_visible"    <?php if($this->session->userdata('company_type')==2)echo ' disabled="disabled"';?>  <?php if($this->session->userdata('company_type')==2)echo " checked='checked'";?>  ><?php if($this->session->userdata('company_type')==2)echo "With in Group";else echo "To Client";?></label>
                                        <label class="checkbox inline" <?php if($this->session->userdata('company_type')==2)echo "style='display:none'";?>>
                                            <input type="checkbox" value="1" name="vendor_visible"   <?php if($this->session->userdata('company_type')==3)echo ' disabled="disabled"';?>  <?php if($this->session->userdata('company_type')==3)echo " checked='checked'";?>  ><?php if($this->session->userdata('company_type')==3)echo "With in Group";else echo "To Vendor";?></label>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>

                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="title">Status</label>
                                    <div class="controls span7">
                                        <input  type="text" readonly="readonly" id="status" name="status" value="<?php if($val['status']==1)echo 'Published';elseif($val['status']==2)echo 'Draft';elseif($val['status']==3)echo 'Rejected';elseif($val['status']==4)echo 'Sent for Approval';?>" class="row-fluid">
                                    </div>
                                </div>

                                <?php if($val['id']!=0 && $val['status']==3) {?>
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="description">Reason For Rejection</label>
                                    <div class="controls span7">
                                        <textarea readonly="readonly" rows="3" class="row-fluid" id="rejected_reason" name="rejected_reason"><?php echo $val['rejected_reason'];?></textarea>
                                    </div>
                                </div>
                                <?php }  ?>




                                </div>
                                <div class="form-actions row-fluid">
                                    <div class="span7 offset3">
                                        <input  type="hidden" id="id" name="id" value="<?php echo $val['id'];?>" class="row-fluid">
                                        <button type="submit" class="btn btn-primary" name="b1" value="2">Save as Draft</button>
                                        <button id="shre" type="submit" class="btn btn-primary" name="b1"  value="1">Publish</button>
                                        <button id="rejected" type="button" class="btn btn-primary" name="b1" onclick="window.location='<?php echo site_url("posts/reject/id/".$val['id']);?>'"  value="3">Reject Post</button>
                                        <button id="stoapp" type="submit" class="btn btn-primary" name="b1"  value="4">Send For Approval</button>

                                        <button type="button" onclick="window.location='<?php echo site_url("posts/drafts");?>'" class="btn btn-secondary">Cancel</button>
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



            <script src="<?php echo base_url();?>js/jquery.MultiFile.js"></script>
            <script src="<?php echo base_url();?>js/lightbox.js"></script>

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
               /* $.validator.setDefaults({
                    submitHandler: function() { return  true; }
                });*/
                $().ready(function() {
                    // validate the comment form when it is submitted
                    // validate signup form on keyup and submit
                    $("#validateForm").validate({
                        rules: {
                            name: {
                                required: true
                            },
                            company_id:{
                                required: true
                            },


                            email: {
                                required: true,
                                email: true
                            },
                            <?php if(!$this->uri->segment(4)) {?>
                            password: {
                                required: true,
                                minlength: 5
                            },
                            confirm_password: {
                                required: true,
                                minlength: 5,
                                equalTo: "#password"
                            }
                            <?php }
                            else
                            {
                            ?>
                            password: {

                                minlength: 5
                            },
                            confirm_password: {

                                minlength: 5,
                                equalTo: "#password"
                            }

                            <?php

                            }
                            ?>

                        },
                        messages: {

                            <?php if(!$this->uri->segment(4)) {?>
                            password: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 5 characters long"
                            },
                            confirm_password: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 5 characters long",
                                equalTo: "Please enter the same password as above"
                            },
                            <?php }
                            else
                            {
                            ?>
                            password: {

                                minlength: "Your password must be at least 5 characters long"
                            },
                            confirm_password: {

                                minlength: "Your password must be at least 5 characters long",
                                equalTo: "Please enter the same password as above"
                            },
                            <?php
                            }
                            ?>


                            email: "Please enter a valid email address"

                        }
                    });


                });
            </script>



            <script type="text/javascript">
                $(function(){
                    <?php if($val['id']>0)
                       {
                         $num = $this->db->query("select * from assign_emp where username='".$this->session->userdata("username")."' and is_approver=1 and project_id=".$val['project_id'])->num_rows();
                               if($num==0)
                               {
                    ?>
                                $('#shre').hide();
                                $('#rejected').hide();

                                $('#sharewith').hide();
								
                                <?php
                                 }
                                 else{
                                ?>

                                $('#stoapp').hide();
                    <?php

                            }
                       }
                       else{
                    ?>
                    $('#shre').hide();
                    $('#rejected').hide();
                    $('#stoapp').hide();
                    $('#sharewith').hide();
                    <?php
                        }
                         ?>
                    $('#company_id').change(function(){
                        var val=$(this).val();

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("posts/ajaxprojects"); ?>',
                            data:{'val':val},

                            success:function(data){
                                // alert(data);
                                $('#projectdiv').html(data);
                            },
                            error: function(data) { // if error occured
                                alert("Error occured.please try again");
                                alert(data);
                            },

                            dataType:'html'
                        });

                    });

						
					if($('select[name=project_id]').val()=='')
					  $('#stoapp').hide();



                    $('select[name=project_id]').live('change',function(){
                        var val=$(this).val();

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo site_url("posts/approvers"); ?>',
                            data:{'val':val},

                            success:function(data){
                                // alert(data);
                                if(data=='1'){
                                    $('#stoapp').hide();
                                $('#shre').show();

                                    <?php if($val['id']>0)
                                           {

                                    ?>
                                    $('#rejected').show();
                                    <?php
                                    }
                                        ?>

                                    $('.checker').show();
                                    $('#sharewith').show();

                                  
                                }
                                else if(data=='11'){
                                    $('#stoapp').hide();
                                    $('#shre').show();

                                    <?php if($val['id']>0)
                                           {

                                    ?>
                                    $('#rejected').show();
                                    <?php
                                    }
                                        ?>

                                    $('.checker').show();
                                    $('#sharewith').show();

                                    $('input[name=vendor_visible]').hide();
                                    $('input[name=vendor_visible]').parent().hide();
                                    $('input[name=vendor_visible]').parents('label').hide();
                                }
                                else
                                {
                                    $('#rejected').hide();
                                    $('#shre').hide();
                                    $('#stoapp').show();
                                    $('#sharewith').hide();
                                }
								
								 if($('select[name=project_id]').val()=='')
                                    $('#stoapp').hide();

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
                    $("select, input:checkbox, input:radio,input:file").uniform();
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

                    $('.multi').css('opacity','1');
                    $('span.filename').hide();
                    $('span.action').hide();
                });
            </script>
