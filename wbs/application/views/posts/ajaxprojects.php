
<div class="form-row control-group row-fluid">
    <label class="control-label span3" for="project_id">Project</label>
    <div class="controls span7">
        <select   name="project_id" class="chzn-select" id="project_id">
            <option value="">Select  Project</option>
            <?php
            foreach($projects as $value)
            {
                ?>

                <option  value="<?php echo $value->id;?>"><?php echo $value->project_name;?></option>
            <?php
            }
            ?>

        </select>
    </div>
</div>

            <script type="text/javascript">
                $(document).ready(function () {

                    $("select").uniform();


                });
            </script>


