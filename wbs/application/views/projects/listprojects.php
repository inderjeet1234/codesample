


<div class="title">

    <h2>
        <i class=" icon-bar-chart"></i> <span>Manage Projects</span>
    </h2>

</div><!-- End .title -->

<div class="content top">
<div class="row-fluid control-group">
    <div class="pull-left span6" action="#" style="width: 210px;">

        <div class=" " style="width: 210px;">

            <div class="controls inline input-large pull-left">
                <!--<select data-placeholder="Bulk actions: " class="chzn-select  " id="default-select" >
                    <option value=""></option>
                    <option value="Bender">Edit</option>
                    <option value="Zoidberg">Regenerate thumbnails</option>
                    <option value="Kif Kroker">Delete Permanently</option>

                </select>-->
            </div>
            <button type="button" class="btn inline" onclick="window.location='<?php echo site_url("projects/create");?>'">Create New Project</button>

        </div>

    </div>

    <div class="form-row control-group" style="float:right; width:545px; margin: 0;">
<?php if($this->session->userdata('company_type')==1)
        {
            ?>

        <div class="controls " style="float:left;width:140px; margin-right:5px; ">
            <select  data-placeholder="Choose your favorite character..." class="chzn-select" id="companiesfilters" name="companiesfilters" style=" margin-left:10px;"  onchange="window.location='<?php echo site_url('projects/index/filtersbycompanies') ?>'+'/'+this.value">
                <option value="all">All Companies</option>
                <?php
                if($companiesfilters)
                {
                    foreach($companiesfilters as $cvompany)
                    {


                        ?>
                        <option <?php if($this->uri->segment(3)=='filtersbycompanies' && $this->uri->segment(4)==$cvompany->id)echo "selected='selected'";?> value="<?php echo $cvompany->id; ?>"><?php echo $cvompany->company_name; ?></option>
                    <?php
                    }
                }
                ?>

            </select>
        </div>
        <?php
        }
        ?>
        <div class="controls " style="float:left">
            <form action="<?php echo site_url("projects"); ?>" method="post" id="search">
                <label>Search By Project Name: <input type="text" aria-controls="datatable_example" name="searchfil" value="<?php echo $searchfill;?>"></label>
            </form>
        </div>
        </div>


    </div>
</div><!-- End .content -->
    <table  class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
        <thead>
        <tr>
            <!--<th class="jv no_sort"><label class="checkbox "><input type="checkbox"></label></th>-->
           
            <th class="no_sort">Project Name</th>
            <th class="no_sort">Company</th>
            <th class="no_sort">From Date</th>
             <th class="no_sort">To Date</th>
            <th class="no_sort">Status</th>

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


            <td class="ms"><div class="btn-group1">
                    <a href="<?php echo site_url('projects/create/id/'.$val->id);?>" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Edit "><i class="gicon-edit"></i></a>
                    
                      <a href="<?php echo site_url('assignprojects/create/id/'.$val->id.'/cid/'.$val->company_id);?>" class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title=" Assign Users">Assign Users</i></a>

                    <a onclick="deleteUser()" class="btn btn-inverse btn-small" rel="tooltip" data-placement="bottom" data-original-title="Remove"><i class="gicon-remove icon-white"></i></a>
                    
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

                       <li><a href="<?php echo site_url('projects/index/limit/'.$prev);?>">Prev</a></li>
                   <?php
                   }

                   ?>




                   <?php
                   for($k=1;$k<=$no_of_page;$k++)
                   {
                   ?>
                    <li><a href="<?php echo site_url('projects/index/limit/'.$k);?>" <?php if($limit==$k) echo "style='font-weight:bold;'";?>><?php echo $k;?></a></li>
                   <?php
                         }
                   ?>

                   <?php
                   if($ii==10 && $next<=$no_of_page)
                   {
                       ?>
                       <li><a href="<?php echo site_url('projects/index/limit/'.$next);?>">Next</a></li>
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

