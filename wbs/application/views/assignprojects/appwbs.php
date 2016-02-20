<div class="form-row control-group row-fluid" id="wbs_approverdiv" <?php if($appt==2) echo 'style="display:none;"';?>>
    <label class="control-label span3" for="wbs_approver">Select Approver</label>
    <div class="controls span7">
        <select data-placeholder="Select" class="chzn-select" id="wbs_approver" name="wbs_approver">
            <option value="">Select Approver</option>
            <?php
            foreach($wbsemp as $value)
            {
                if(!in_array($value->username,$setwbs))
                    continue;
                ?>

                <option value="<?php echo $value->username;?>"><?php echo $value->name;?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>
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


