

            <div class="title">
                <h4>
                    <i class="icon-eye-open"></i>
                    <span><?php if($this->uri->segment(4)) echo 'Edit Project';else echo 'Create New Project';?></span>
                </h4>
            </div>
            <!-- End .title -->




                        <div class="content">
                            <form onsubmit="return validateforma();" id="validateForm"  class="form-horizontal cmxform" autocomplete="off"  action="<?php echo site_url("projects/save"); ?>" method="post" enctype="multipart/form-data">


                                <div class="form-row control-group row-fluid">
                             





                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="company_name">Project Name</label>
                                    <div class="controls span7">
                                        <input  type="text" id="project_name" name="project_name" value="<?php echo $val['project_name'];?>" class="row-fluid">
                                    </div>
                                </div>
                                    <div class="form-row control-group row-fluid">
                                      <label class="control-label span3" for="company_id">Company</label>
                                    <div class="controls span7">
                                        <select   name="company_id" class="chzn-select" id="company_id">
                                            <option value="">Select  Company</option>
                                            <?php
                                            foreach($select as $value)
                                            {
                                                ?>

                                                <option <?php if($val['company_id']==$value->id) echo "selected='selected'";?> value="<?php echo $value->id;?>"><?php echo $value->company_name;?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>




                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="location">Location</label>
                                    <div class="controls span7">
                                        <input  type="text" id="location" value="<?php  echo $val['location'];?>" name="location" class="row-fluid">
                                    </div>
                                </div>


                               <div class="form-row control-group row-fluid">
                                <label class="control-label span3">From Date</label>
                                <div class="controls span7">
                                  <div class="input-append date row-fluid"   style="width:50%;" id="datepicker2" data-date="<?php echo date("Y-m-d");?>"  data-date-format="yyyy-mm-dd">
                                    <input type="text" value="<?php  echo $val['from_date'];?>" class="row-fluid" name="from_date" id="from_date" />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                  </div>
                                </div>
                              </div>
                         
								  <div class="form-row control-group row-fluid" >
                                <label class="control-label span3">To Date</label>
                                <div class="controls span7"  >
                                  <div class="input-append date row-fluid"   style="width:50%;" id="datepicker3" data-date="<?php echo date("Y-m-d");?>" data-date-format="yyyy-mm-dd">
                                    <input type="text" value="<?php  echo $val['to_date'];?>" class="row-fluid" name="to_date" id="to_date" />
                                    <span class="add-on"><i class="icon-th"></i></span>
                                  </div>
                                </div>
                              </div>



										 <div class="form-row control-group row-fluid">
                                        <label class="control-label span3" for="default-textarea">Description</label>
                                        <div class="controls span7">
                                          <textarea rows="3" class="row-fluid" id="description" name="description"><?php  echo $val['description'];?></textarea>
                                        </div>
                                      </div>



                             

                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3">Status </label>
                                    <div class="controls span7">

                                        <label class="inline radio">
                                            <input type="radio" name="status" value="1" <?php if($val['status']==1) echo 'checked="CHECKED"';?> /> Active </label>
                                        <label class="inline radio">
                                            <input type="radio" name="status" value="2" <?php if($val['status']==2) echo 'checked="CHECKED"';?>/> Inactive </label>

                                        <label class="inline radio">
                                            <input type="radio" name="status" value="3" <?php if($val['status']==3) echo 'checked="CHECKED"';?>/> Completed </label>
                                    </div>
                                </div>






                                </div>
                                <div class="form-actions row-fluid">
                                    <div class="span7 offset3">
                                        <input  type="hidden" id="id" name="id" value="<?php echo $val['id'];?>" class="row-fluid">
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

                    if($('#project_name').val()=='')
                    {
                        $('#project_name').parent().find('label').remove();

                        $('#project_name').parent().append('<label for="project_name" generated="true" style="display: block" class="error" >This field is required.</label>');
                        // return false;

                        valdisc=false;
                    }
                     if($('#company_id').val()=='')
                    {
                        $('#company_id').parent().find('label').remove();

                        $('#company_id').parent().append('<label for="company_id" generated="true" style="display: block" class="error" >This field is required.</label>');
                        // return false;

                        valdisc=false;
                    }


                    if(new Date($('#from_date').val())>new Date($('#to_date').val()))
                    {
                        $('#to_date').parent().find('label').remove();

                        $('#to_date').parent().append('<label for="to_date" generated="true" style="display: block" class="error" >To Date should not be before from Date.</label>');
                        // return false;

                        valdisc=false;
                    }









                    return  valdisc;


                }

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
					$('#datepicker3').datepicker();


                    $('.colorpicker').colorpicker()
                    $('#colorpicker3').colorpicker();
                    // data-toggle
                    // $("#iButton").iButton({
                    //    labelOn: "Test",
                    //    labelOff: "OFF",
                    // });
                });
            </script>


