            <?php
                    $i=0;
                    foreach($post as $val)
                    {
                        $this->load->model('assignprojectsmodel','',true);
                        $vdemp=$this->assignprojectsmodel->getclientemp($val);

            ?>
                <div class="form-row control-group row-fluid vdempvalidate" id="select_vendors">
                                    <label class="control-label span3" for="inputEmail">Select <?php echo $this->assignprojectsmodel->getcompanyname($val);?> Employee</label>
                                    <div class="controls span7">
                                        <select name="vdemp<?php echo $i;?>[]" id="vdemp<?php echo $i;?>"  rel="vdemp_<?php echo $i;?>" data-placeholder="Select employee" class="chzn-select vedoemp" multiple="" tabindex="3">

                                            <?php
                                            foreach($vdemp as $value)
                                            {
                                                ?>

                                                <option value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
            <?php
                        $i++;
                    }
            ?>
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


