

            <div class="title">
                <h4>
                    <i class="icon-eye-open"></i>
                    <span>Create Client Company</span>
                </h4>
            </div>
            <!-- End .title -->




                        <div class="content">


                            <div class="message row-fluid">
                                <h4><?php echo $this->session->flashdata('userexists'); ?></h4>

                            </div>

                            <form id="validateForm"  class="form-horizontal cmxform" autocomplete="off"  action="<?php echo site_url("clientcompany/save"); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="company_name">Company Name</label>
                                    <div class="controls span7">
                                        <input required type="text" id="company_name" name="company_name" class="row-fluid">
                                    </div>
                                </div>
                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="logo">Logo upload</label>
                                    <div class="controls span7">
                                        <div class="input-append row-fluid">
                                            <input required type="file" class="spa1n6 fileinput" id="logo" name="logo" />

                                        </div>
                                    </div>
                                </div>



                                   <!-- <div class="form-row control-group row-fluid">
                                        <label class="control-label span3">Color</label>
                                        <div class="controls span7">
                                            <input required type="text" id="color" name="color" class="colorpicker row-fluid" value="#e94522" >
                                        </div>
                                    </div>-->

                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3">Colorpicker with icon trigger</label>
                                    <div class="controls span7">
                                        <div class="input-append color row-fluid" data-color="#4a8cf7" data-color-format="hex" id="colorpicker3">
                                            <input required id="color" name="color" type="text" class="row-fluid">
                                            <span class="add-on"><i style="#4a8cf7; "></i></span>
                                        </div>
                                    </div>
                                </div>


                               <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="admin_name">Admin Name</label>
                                    <div class="controls span7">
                                        <input required type="text" id="admin_name" name="admin_name" class="row-fluid">
                                    </div>
                                </div> <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="admin_email">Admin Email</label>
                                    <div class="controls span7">
                                        <input required type="email" id="admin_email" name="admin_email" class="row-fluid">
                                    </div>
                                </div>
                                <div class="control-group row-fluid">
                                    <label class="control-label span3">Password</label>
                                    <div class="controls span7 input-prepend">
                                        <span class="add-on"><i class="icon-lock"></i></span>
                                        <input  type="password" id="password" name="password" placeholder="min 5 characters">
                                    </div>
                                </div>
                                <div class="control-group row-fluid">
                                    <label class="control-label span3">Confirm Password</label>
                                    <div class="controls span7 input-prepend">
                                        <span class="add-on"><i class="icon-lock"></i></span>
                                        <input  type="password" id="confirm_password" placeholder="confirm password" name="confirm_password">
                                    </div>
                                </div>

                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3">Status </label>
                                    <div class="controls span7">

                                        <label class="inline radio">
                                            <input type="radio" name="status" value="1" checked="CHECKED" /> Active </label>
                                        <label class="inline radio">
                                            <input type="radio" name="status" value="2"/> Inactive </label>
                                    </div>
                                </div>




                                </div>
                                <div class="form-actions row-fluid">
                                    <div class="span7 offset3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo site_url("clientcompany");?>'">Cancel</button>
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
               /* $.validator.setDefaults({
                    submitHandler: function() { return  true; }
                });*/
                $().ready(function() {
                    // validate the comment form when it is submitted
                    // validate signup form on keyup and submit
                    $("#validateForm").validate({
                        rules: {
                            company_name: {
                                required: true
                            },
                            color: {
                                required: true
                            },
                            admin_name: {
                                required: true
                            },
                            logo: {
                                required: true
                            },
                            admin_email: {
                                required: true,
                                email: true
                            },
                            password: {
                                required: true,
                                minlength: 5
                            },
                            confirm_password: {
                                required: true,
                                minlength: 5,
                                equalTo: "#password"
                            }

                        },
                        messages: {

                            password: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 5 characters long"
                            },
                            confirm_password: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 5 characters long",
                                equalTo: "Please enter the same password as above"
                            },
                            admin_email: "Please enter a valid email address"

                        }
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


