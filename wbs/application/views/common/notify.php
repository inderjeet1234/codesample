<style type="text/css">
    .info .time .checker span{ margin-top: 7px;}
    #uniform-checknotall span{margin-top: 16px;}
    #uniform-checknotall span input{margin-top: -19px;}
    .text{cursor: pointer;}

</style>




          <div class="row-fluid">
            <div class="title">
              <h4>
              <i class="icon-eye-open"></i>
              <span>Latest Notifications</span>
              </h4>
            </div>
            <!-- End .title -->
            <div class="content">
                <form id="validateForm"  class="form-horizontal cmxform" autocomplete="off"  action="<?php echo site_url("home/notify"); ?>" method="post" enctype="multipart/form-data">

                <h4 style="padding-left: 10px;">
                    <input type="checkbox" id="checknotall" name="checknotall"  value="1"  />
                    <span> <button id="stoapp" type="submit" class="btn btn-primary" name="b1">Mark as read</button></span>
                </h4>


              <ul class="messages_layout">
                  <?php
                  $ii=0;
                  if($totalcount>0)
                  {
                  foreach($data as $val)
                  {
                  $ii++;


                  ?>
                <li class="from_user left" style="padding-left:0">

                <div class="message_wrap">

                      <div class="info">

                        <span class="time" style="margin-top:-4px"><input type="checkbox"  name="checknot[]"  value="<?php echo $val->id;?>" ><?php echo $val->created_at; ?></span><br/>


                      </div>
                        <div  <?php if($val->status==1)echo 'style="font-weight:bold;"' ?>  class="text" onclick="notifystatus(<?php echo $val->id;?>,'<?php $dolu=1; if(!empty($val->link_fld)){ echo site_url($val->link_fld);}else echo $dolu;?>',this)"  >







                          <?php echo $val->msg; ?>

                      </div>





                </div>
                </li>
                  <?php

                  }
                  }
                  else{
                      echo "No Notification yet...";
                  }
                  ?>

              </ul>
                    </form>
            </div>
            <!-- End .content -->
          </div>

        <!-- End .span6 -->


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





          <script type='text/javascript'>
















              $(document).ready(function() {






                $('input[name=checknotall]').click(function(){

                    if ($('input[name=checknotall]').is(':checked')) {
                        $("input[name=checknot\\[\\]]").attr('Checked','Checked');
                        $("input[name=checknot\\[\\]]").parent().addClass('checked');
                    } else {
                        $("input[name=checknot\\[\\]]").removeAttr('Checked');
                        $("input[name=checknot\\[\\]]").parent().removeClass('checked');
                    }

                });









              });


          </script>








