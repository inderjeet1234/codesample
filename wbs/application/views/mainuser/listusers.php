

<div class="title">

    <h2>
        <i class=" icon-bar-chart"></i> <span>Manage Users</span>
    </h2>

</div><!-- End .title -->

<div class="content top">
<div class="row-fluid control-group">
    <div class="pull-left span6" action="#">

        <div class=" ">

            <div class="controls inline input-large pull-left" >
                <!--<select data-placeholder="Bulk actions: " class="chzn-select  " id="default-select" >
                    <option value=""></option>
                    <option value="Bender">Edit</option>
                    <option value="Zoidberg">Regenerate thumbnails</option>
                    <option value="Kif Kroker">Delete Permanently</option>

                </select>-->
            </div>
            <button type="button" class="btn inline" onclick="window.location='<?php echo site_url("mainuser/create");?>'">Create New  User</button>

        </div>



    </div>

    <div style="float:right;" class="dataTables_filter" id="datatable_example_filter">
        <form action="<?php echo site_url("mainuser/users"); ?>" method="post" id="search">
        <label>Search: <input type="text" aria-controls="datatable_example" name="searchfil" value="<?php echo $searchfill;?>"></label>
        </form>
    </div>
</div><!-- End .content -->
    <table  class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">

        <thead>
        <tr>
            <!--<th class="jv no_sort"><label class="checkbox "><input type="checkbox"></label></th>-->
            <th class="jv no_sort">Image</th>
            <th class="no_sort">Name</th>
            <th class="to_hide_phone ue no_sort">Designation</th>
            <th class="no_sort">Email</th>
            <th class="to_hide_phone span2 no_sort">Contact Number</th>

            <th class="ms no_sort ">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $ii=0;
        if($total_rows>0)
        {
        foreach($data as $val)
        {
            $ii++;
        ?>
        <tr>
           <!-- <td><label class="checkbox "><input type="checkbox"></label></td>-->
            <td><img class="thumbnail small" src="<?php echo base_url();?>img/admincompany/<?php if(!empty($val->pic))echo $val->pic;else echo "default.jpg"; ?>"></td>
            <td><?php echo $val->name;?></td>
            <td><?php echo $val->designation;?></td>
            <td><?php echo $val->email;?></td>
            <td class="to_hide_phone"><?php echo $val->contact_number;?></td>


            <td class="ms"><div class="btn-group1">
                    <a href="<?php echo site_url('mainuser/create/id/'.$val->id);?>" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>

                   
                </div>
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
        <?php
        if($paginationenable)
        {
            ?>

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

                       <li><a href="<?php echo site_url('mainuser/users/limit/'.$prev);?>">Prev</a></li>
                   <?php
                   }

                   ?>




                   <?php
                   for($k=1;$k<=$no_of_page;$k++)
                   {
                   ?>
                    <li><a href="<?php echo site_url('mainuser/users/limit/'.$k);?>" <?php if($limit==$k) echo "style='font-weight:bold;'";?>><?php echo $k;?></a></li>
                   <?php
                         }
                   ?>

                   <?php
                   if($ii==10 && $next<=$no_of_page)
                   {
                       ?>
                       <li><a href="<?php echo site_url('mainuser/users/limit/'.$next);?>">Next</a></li>
                   <?php
                   }

                   ?>
                </ul>

            </div>
                </div>
        <?php
        }
        ?>

    </div><!-- End .content -->
</div> <!-- End box -->




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

<script type="text/javascript" charset="utf-8">
    // Datatables
    $(document).ready(function() {
        var dontSort = [];
        $('#datatable_example thead th').each( function () {
            if ( $(this).hasClass( 'no_sort' )) {
                dontSort.push( { "bSortable": false } );
            } else {
                dontSort.push( null );
            }
        } );
        $('#datatable_example').dataTable( {
            "sDom": "<'row table_top_bar'<'row-fluid'>'<'to_hide_phone'>'f'<'>r>t<'row'>",
            "sDom": "<'row table_top_bar'<'row-fluid'<'to_hide_phone' f>>><'row'>",
            "aaSorting": [[ 1, "asc" ]],
            "bPaginate": false,
            "bJQueryUI": false,
            "aoColumns": dontSort

        } );
        $.extend( $.fn.dataTableExt.oStdClasses, {
            "s`": "dataTables_wrapper form-inline"
        } );
    } );
</script>

