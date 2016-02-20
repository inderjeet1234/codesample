


<div class="title">

    <h2>
        <i class=" icon-bar-chart"></i> <span>Completed Projects</span>
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
           
            <th class="no_sort">Project Name</th>
            <th class="no_sort">Company</th>
            <th class="no_sort">From Date</th>
             <th class="no_sort">To Date</th>
            <th class="no_sort">Status</th>
            <th class="no_sort">Completed Projects</th>

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
          
            <td><?php echo $val->project_name;?></td>
            <td><?php  $this->load->model('projectsmodel','',true); echo $this->projectsmodel->getcompanyname($val->company_id);?></td>
            <td><?php echo $val->from_date;?></td>
            <td><?php echo $val->to_date;?></td>
            <td><?php if($val->status==1) echo 'Active'; elseif($val->status==2) echo 'Inactive'; elseif($val->status==3) echo 'Completed';?></td>

            <td><?php echo $val->completed_date;?></td>
            <td class="ms"><div class="btn-group1">

                    
                      <a href="<?php echo site_url('home/completedprojectposts/id/'.$val->id);?>" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Assign Users">View Posts</i></a>


                    
                </div>
            </td>
        </tr>
        <?php
        }
        }
        ?><!--
        <tr>
            <td><label class="checkbox "><input type="checkbox"></label></td>
            <td><img class="thumbnail small" src="<?php echo base_url();?>img/message_avatar1.png"></td>
            <td class="to_hide_phone">Surrender your mysteries to Zoidberg!</td>
            <td class="to_hide_phone">
                <div class="row-fluid"><small><div class="span12"><strong>Size:</strong> 82 Kb</div></small></div>
                <div class="row-fluid"><small><div class="span12"><strong>Format:</strong> .jpg</div></small></div>
            </td>
            <td>Zoidberg</td>
            <td class="to_hide_phone">16,67% <span class="line">1,1,2,-1,-3,-2,2,4,5,2</span></td>
            <td >21</td>
            <td>6 Hours ago</td>

            <td class="ms"><div class="btn-group1">
                    <a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>
                    <a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="gicon-eye-open"></i></a>
                    <a class="btn btn-inverse btn-small" rel="tooltip" data-placement="bottom" data-original-title="Remove"><i class="gicon-remove icon-white"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="checkbox "><input type="checkbox"></label></td>
            <td><img class="thumbnail small" src="<?php echo base_url();?>img/message_avatar2.png"></td>
            <td class="to_hide_phone">The point is, by my standards, I won fair and square.</td>
            <td class="to_hide_phone">
                <div class="row-fluid"><small><div class="span12"><strong>Size:</strong> 392 Kb</div></small></div>
                <div class="row-fluid"><small><div class="span12"><strong>Format:</strong> .png</div></small></div>
            </td>
            <td>Bender</td>
            <td class="to_hide_phone">26,67% <span class="line">5,3,2,-1,-3,-2,2,3,5,2</span></td>
            <td >12</td>
            <td>11 Hours ago</td>

            <td class="ms"><div class="btn-group1">
                    <a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>
                    <a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="gicon-eye-open"></i></a>
                    <a class="btn btn-inverse btn-small" rel="tooltip" data-placement="bottom" data-original-title="Remove"><i class="gicon-remove icon-white"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="checkbox "><input type="checkbox"></label></td>
            <td><img class="thumbnail small" src="<?php echo base_url();?>img/message_avatar3.png"></td>
            <td class="to_hide_phone"> File not found?!</td>
            <td class="to_hide_phone">
                <div class="row-fluid"><small><div class="span12"><strong>Size:</strong> 403 Kb</div></small></div>
                <div class="row-fluid"><small><div class="span12"><strong>Format:</strong> .gif</div></small></div>
            </td>
            <td>Fry</td>
            <td class="to_hide_phone">7,32% <span class="line">5,3,2,-1,-3,-2,2,3,5,2</span></td>
            <td >2</td>
            <td>2 Days ago</td>

            <td class="ms"><div class="btn-group1">
                    <a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>
                    <a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="gicon-eye-open"></i></a>
                    <a class="btn btn-inverse btn-small" rel="tooltip" data-placement="bottom" data-original-title="Remove"><i class="gicon-remove icon-white"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="checkbox "><input type="checkbox"></label></td>
            <td><img class="thumbnail small" src="<?php echo base_url();?>img/message_avatar5.png"></td>
            <td class="to_hide_phone">I'm Santa Claus!</td>
            <td class="to_hide_phone">
                <div class="row-fluid"><small><div class="span12"><strong>Size:</strong> 546 Kb</div></small></div>
                <div class="row-fluid"><small><div class="span12"><strong>Format:</strong> .jpg</div></small></div>
            </td>
            <td>Simpson</td>
            <td class="to_hide_phone">48,33% <span class="line">5,3,2,-1,-3,-2,2,3,5,2</span></td>
            <td >17</td>
            <td>1 Week ago</td>

            <td class="ms"><div class="btn-group1">
                    <a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>
                    <a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="gicon-eye-open"></i></a>
                    <a class="btn btn-inverse btn-small" rel="tooltip" data-placement="bottom" data-original-title="Remove"><i class="gicon-remove icon-white"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="checkbox "><input type="checkbox"></label></td>
            <td><img class="thumbnail small" src="<?php echo base_url();?>img/message_avatar6.png"></td>
            <td class="to_hide_phone">And I'd do it again! And perhaps a third time!!</td>
            <td class="to_hide_phone">
                <div class="row-fluid"><small><div class="span12"><strong>Size:</strong> 294 Kb</div></small></div>
                <div class="row-fluid"><small><div class="span12"><strong>Format:</strong> .png</div></small></div>
            </td>
            <td>Fry</td>
            <td class="to_hide_phone">88,22% <span class="line">5,3,2,-1,-3,-2,2,3,5,2</span></td>
            <td >0</td>
            <td>2 Weeks ago</td>

            <td class="ms"><div class="btn-group1">
                    <a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>
                    <a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="gicon-eye-open"></i></a>
                    <a class="btn btn-inverse btn-small" rel="tooltip" data-placement="bottom" data-original-title="Remove"><i class="gicon-remove icon-white"></i></a>
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="checkbox "><input type="checkbox"></label></td>
            <td><img class="thumbnail small" src="<?php echo base_url();?>img/message_avatar7.png"></td>
            <td class="to_hide_phone">Perfectly symmetrical violence never solved anything.</td>
            <td class="to_hide_phone">
                <div class="row-fluid"><small><div class="span12"><strong>Size:</strong> 9.996 Kb</div></small></div>
                <div class="row-fluid"><small><div class="span12"><strong>Format:</strong> .psd</div></small></div>
            </td>
            <td>Leela</td>
            <td class="to_hide_phone">99,67% <span class="line">5,3,2,-1,-3,-2,2,3,5,2</span></td>
            <td >93</td>
            <td>1 Million Years ago</td>

            <td class="ms"><div class="btn-group1">
                    <a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>
                    <a class="btn btn-small" rel="tooltip" data-placement="top" data-original-title="View"><i class="gicon-eye-open"></i></a>
                    <a class="btn btn-inverse btn-small" rel="tooltip" data-placement="bottom" data-original-title="Remove"><i class="gicon-remove icon-white"></i></a>
                </div>
            </td>
        </tr>-->

        </tbody>
    </table>
    <div class="row-fluid control-group">
        <div class="pull-left span6" action="#">

            <div class=" ">

                <div class="controls inline input-large pull-left">
                    <!--<select data-placeholder="Bulk actions: " class="chzn-select  " id="default-select" >
                        <option value=""></option>
                        <option value="Bender">Edit</option>
                        <option value="Zoidberg">Regenerate thumbnails</option>
                        <option value="Kif Kroker">Delete Permanently</option>

                    </select>-->
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

                       <li><a href="<?php echo site_url('projects/listprojects/limit/'.$prev);?>">Prev</a></li>
                   <?php
                   }

                   ?>




                   <?php
                   for($k=1;$k<=$no_of_page;$k++)
                   {
                   ?>
                    <li><a href="<?php echo site_url('projects/listprojects/limit/'.$k);?>" <?php if($limit==$k) echo "style='font-weight:bold;'";?>><?php echo $k;?></a></li>
                   <?php
                         }
                   ?>

                   <?php
                   if($ii==2)
                   {
                       ?>
                       <li><a href="<?php echo site_url('projects/listprojects/limit/'.$next);?>">Next</a></li>
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

