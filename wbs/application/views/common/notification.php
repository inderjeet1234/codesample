<a id="dLabel" role="button" data-toggle="dropdown" data-target="#"  >
    <span class="icon"><img src="<?php echo base_url();?>img/menu_top/profile-messages.png"></span><span class="notifications"><?php echo $totalcount; ?></span>
</a>
<ul class="dropdown-menu messages" aria-labelledby="dLabel">
    <div class="container">
        <div class="heading">
            <span class="title"><i class="icon-comments"></i>Notifications</span><span class="link"></span>
        </div>
        <ul>



<?php

if($totalcounts>0)
{
foreach ($data as $val) {

 
?>
<li>



        <div style="cursor: pointer;<?php if($val->status==1)echo 'font-weight:bold;' ?>"  class="container" onclick="notifystatus(<?php echo $val->id;?>,'<?php $dolu=1; if(!empty($val->link_fld)){ echo site_url($val->link_fld);}else echo $dolu;?>',this)"  >

            <i class="icon-share-alt"></i> <?php echo $val->msg; ?><br/>
            <span class="date"><?php echo $val->created_at; ?></span>
        </div>

</li>
<?php
}
}
            else
            {
                ?>
                <div class="container" >

                    <i class="icon-share-alt"></i>No notification yet<br/>

                </div>
            <?php

            }
?>

        </ul>
        <div class="footer">
            <a class="see_all" href="<?php echo site_url('home/notify');?>">See All Notifications<i class="icon-chevron-right"></i></a>
        </div>
    </div>
</ul>