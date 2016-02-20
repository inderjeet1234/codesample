
<div style="clear: both; margin-left: 120px;">

    <img class="thumbnail small" style="clear: both" src="<?php echo base_url();?>img/admincompany/<?php if(!empty($val['pic']))echo $val['pic'];else echo "default.jpg"; ?>"/>


</div>


<div style="clear: both; margin:20px 0 0 50px;">
<div style="clear: both;">
    <div style="float: left; width: 150px; font-weight: bold">
           Name</div>

    <div style="float: left">  <?php echo $val['name'];?></div>

    </div>


<div style="clear: both;">
    <div style="float: left; width: 150px; font-weight: bold">
        Designation</div>

    <div style="float: left">    <?php  echo $val['designation'];?></div>

</div>


<div style="clear: both;">
    <div style="float: left; width: 150px; font-weight: bold">
        Contact Number</div>

    <div style="float: left">   <?php echo $val['contact_number'];?></div>

</div>


<div style="clear: both;">
    <div style="float: left; width: 150px; font-weight: bold">
        Email address</div>

    <div style="float: left">  <?php echo $val['email'];?></div>

</div>


</div>



































