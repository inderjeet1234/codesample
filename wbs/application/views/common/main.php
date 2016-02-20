<div id="main">
    <div class="container" style="min-height: 600px">
        <div class="container_top" style="background:<?php echo $this->color; ?>">
            <div class="row-fluid ">
                <div class="top_bar_stats to_hide_tablet">
                    <div class="stats">
                        <span class="title">Active Projects: </span><?php echo $this->activeprojectcount; ?>
                    </div>
                    <div class="stats">
                        <span class="title">Active Posts:</span><?php echo $this->activepostcount; ?>
                    </div>
                </div>

                <div class="top_right">
                    <ul class="nav nav_menu">

                        <li class="dropdown">
                            <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                <span class="icon"><img src="<?php echo base_url();?>img/menu_top/profile-avatar.png"></span><span class="title"><?php if($this->session->userdata('name'))echo $this->session->userdata('name');else echo"Super Admin";?></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <?php if($this->session->userdata('username')!='manik')
{
?>
                                <li><a href="<?php echo site_url('profile');?>"><i class=" icon-user"></i> My Profile</a></li>
<?php
}
?>
                                <!--<li><a href="#"><i class=" icon-cog"></i>Settings</a></li>-->
                                <li><a href="<?php echo site_url("login/logout");?>"><i class=" icon-unlock"></i>Log Out</a></li>
                            </ul>
                        </li>
                        <li class="dropdown" id="notificationnew">

                        </li>
                    </ul>
                </div> <!-- End top-right -->

                <div class="span4">

                </div>
            </div>
        </div>
        <!-- End container_top -->

        <div id="container2">
            <div class="row-fluid">
                <div class="box gradient">
