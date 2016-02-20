s

            <div class="title">
                <h4>
                    <i class="icon-eye-open"></i>
                    <span>Reject Post</span>
                </h4>
            </div>
            <!-- End .title -->




                        <div class="content">
                            <form id="validateForm"  class="form-horizontal cmxform" autocomplete="off"  action="<?php echo site_url("posts/reject"); ?>" method="post" enctype="multipart/form-data">





                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="title">Title</label>
                                    <div class="controls span7">
                                        <input required readonly="readonly" type="text" id="title" name="title" value="<?php echo $val['title'];?>" class="row-fluid">
                                    </div>
                                </div>





                                <div class="form-row control-group row-fluid">
                                    <label class="control-label span3" for="description">Reason For Rejection</label>
                                    <div class="controls span7">
                                        <textarea rows="3" class="row-fluid" id="rejected_reason" name="rejected_reason"></textarea>
                                    </div>
                                </div>






                                </div>
                                <div class="form-actions row-fluid">
                                    <div class="span7 offset3">
                                        <input  type="hidden" id="id" name="id" value="<?php echo $val['id'];?>" class="row-fluid">

                                        <button id="rejected" type="submit" class="btn btn-primary" name="b1"  value="3">Reject Post</button>

                                        <button type="button" onclick="window.location='<?php echo site_url("posts/create/id/".$val['id']);?>'" class="btn btn-secondary">Cancel</button>
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


