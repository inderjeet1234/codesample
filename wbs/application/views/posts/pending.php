


<div class="title">

    <h2>
        <i class=" icon-bar-chart"></i> <span>Pending Posts</span>
    </h2>

</div><!-- End .title -->

<div class="content top">
    <div class="row-fluid control-group">
        <div class="pull-left span6" action="#">



        </div>


    </div><!-- End .content -->
    <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
        <thead>
        <tr>
            <!--<th class="jv no_sort"><label class="checkbox "><input type="checkbox"></label></th>-->
            <th class="jv no_sort">S.No</th>
            <th class="no_sort">Post Title</th>
            <th class="to_hide_phone ue no_sort">Status</th>
            <th class="to_hide_phone ue no_sort">Posted By</th>
            <th class="no_sort">Created Date</th>


            <th class="ms no_sort ">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $ii=$startlimit;
        if($total_rows>0)
        {
            foreach($data as $val)
            {
                $ii++;
                ?>
                <tr>
                    <!-- <td><label class="checkbox "><input type="checkbox"></label></td>-->
                    <td><?php echo $ii;?></td>
                    <td><?php echo $val->title;?></td>
                    <td><?php if($val->status==1)echo 'Published';elseif($val->status==2)echo 'Save as Draft';elseif($val->status==3)echo 'Rejected';elseif($val->status==4)echo 'Sent For Approval';?></td>

                    <td> <?php
                        $udata=$this->postsmodel->getuserdeatils($val->user_id);
                        $userdata=$udata[0];
                            echo $userdata->name;
                            ?></td>

                    <td><?php echo $val->created_date;?></td>

                    <td class="ms"><div class="btn-group1">
                            <a href="<?php echo site_url('posts/create/id/'.$val->id);?>" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>



                    </td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
    <div class="row-fluid control-group">
        <div class="pull-left span6" action="#">

            <div class=" ">

                <div class="controls inline input-large pull-left">

                </div>


            </div>

        </div>
        <div class="span6">
            <div class="pagination pull-right ">
                <ul>
                    <?php
                    $prev=$limit -1;
                    $next=$limit +1;
                    ?>
                    <?php
                    if($limit>1)
                    {
                        ?>

                        <li><a href="<?php echo site_url('posts/pending/limit/'.$prev);?>">Prev</a></li>
                    <?php
                    }

                    ?>




                    <?php
                    for($k=1;$k<=$no_of_page;$k++)
                    {
                        ?>
                        <li><a href="<?php echo site_url('posts/pending/limit/'.$k);?>" <?php if($limit==$k) echo "style='font-weight:bold;'";?>><?php echo $k;?></a></li>
                    <?php
                    }
                    ?>

                    <?php
                    if($ii==10 && $next<=$no_of_page)
                    {
                        ?>
                        <li><a href="<?php echo site_url('posts/pending/limit/'.$next);?>">Next</a></li>
                    <?php
                    }

                    ?>
                </ul>

            </div>
        </div>

    </div><!-- End .content -->
</div> <!-- End box -->

<script type="text/javascript">

    function deleteUser(){var r=confirm('Are You Sure You want To Delete this User.')
        if (r==true)
        {
            alert('You pressed OK!');
        }
        else
        {
            alert('You pressed Cancel!');
        }}
</script>


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


<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/full-calendar/fullcalendar.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.peity.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/plugins/datatables/js/jquery.dataTables.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/chosen/chosen/chosen.jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>









<script src="<?php echo base_url();?>js/scripts.js"></script>


