<div id="sidebar" class="collapse">
    <div class="logo">
    <?php
	if($this->logo)
	{
	?>
        <img src="<?php echo base_url();?>img/company/<?php echo $this->logo; ?>">
        <?php
		}
		else
		{
		?>
          <img src="<?php echo base_url();?>img/logo.png">
        <?php
		}
		?>
    </div>

    <ul id="sidebar_menu" class="navbar nav nav-list sidebar_box">
        <?php if($this->session->userdata('role')==1)
        {
            if($this->session->userdata('checkcompany')==1)
            {
                $title="Manage Company";
                $url=site_url("company/manage/cid/".$this->session->userdata('maincompany'));
            }
            else
            {
                $title="Create Company";
                $url=site_url("company/create");

            }
            ?>
            <li class="accordion-group active">
                <a class="dashboard" href="<?php echo $url;?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png"><?php echo $title; ?></a>
            </li>
        <?php
        }
        else
        {
            ?>


            <li class="accordion-group <?php if($this->selectedmenu==1)echo 'active';?>">
                <a class="dashboard" href="<?php echo site_url("home");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Latest Posts</a>
            </li>

          <!--  <li class="accordion-group <?php if($this->selectedmenu==6)echo 'active';?>">
                <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse3"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Posts</a>
                <ul id="collapse3" class="accordion-body collapse">
                    <li><a href="<?php echo site_url("posts/create");?>">Create new Post</a></li>
                    <li><a href="<?php echo site_url("posts/drafts");?>">My Drafts</a></li>
                    <li><a href="<?php echo site_url("posts/pending");?>">Pending Posts</a></li>
                </ul>
            </li>-->


            <li class="accordion-group <?php if($this->selectedmenu==21)echo 'active';?>">
                <a class="dashboard" href="<?php echo site_url("posts/create");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Create new Post</a>
            </li>
            <li class="accordion-group <?php if($this->selectedmenu==22)echo 'active';?>">
                <a class="dashboard" href="<?php echo site_url("posts/drafts");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">My Drafts</a>
            </li>
            <?php
            if($this->session->userdata('company_type')!=3)
            {
                ?>

            <li class="accordion-group <?php if($this->selectedmenu==23)echo 'active';?>">
                <a class="dashboard" href="<?php echo site_url("posts/pending");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Pending Posts(<?php echo $this->totglobalpending; ?>)</a>
            </li>
                <?php
            }
                ?>






            <li class="accordion-group <?php if($this->selectedmenu==7)echo 'active';?>">
                <a class="dashboard" href="<?php echo site_url("projects/completed");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Completed Projects</a>
            </li>

            <li class="accordion-group <?php if($this->selectedmenu==8)echo 'active';?>">
                <a class="dashboard" href="<?php echo site_url("projects/inactive");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Inactive Projects</a>
            </li>

            <?php
            if($this->session->userdata('company_type')==1 && $this->session->userdata('role')==2)
            {?>
                <li class="accordion-group <?php if($this->selectedmenu==2)echo 'active';?>">
                    <a class="dashboard" href="<?php echo site_url("mainuser/users");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Users</a>
                </li>


                <li class="accordion-group <?php if($this->selectedmenu==3)echo 'active';?>">
                    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Clients</a>
                    <ul id="collapse1" class="accordion-body collapse">
                        <li><a href="<?php echo site_url("clientcompany");?>">Client Companies</a></li>
                        <li><a href="<?php echo site_url("clientuser/users");?>">Client Users</a></li>
                    </ul>
                </li>

                <li class="accordion-group <?php if($this->selectedmenu==4)echo 'active';?>">
                    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Vendors</a>
                    <ul id="collapse2" class="accordion-body collapse">
                        <li><a href="<?php echo site_url("vendorcompany");?>">Vendor Companies</a></li>
                        <li><a href="<?php echo site_url("vendoruser/users");?>">Vendor Users</a></li>
                    </ul>
                </li>

                <li class="accordion-group <?php if($this->selectedmenu==5)echo 'active';?>">
                    <a class="dashboard" href="<?php echo site_url("projects");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Projects</a>
                </li>
            <?php
            }
            ?>

        <?php
        }
        ?>

            <!--<li class="accordion-group">
                <a class="dashboard" href="<?php echo site_url("login/logout");?>"><img src="<?php echo base_url();?>img/menu_icons/dashboard.png">Logout</a>
            </li> -->

    </ul>
    <!-- End sidebar_box -->

    <!-- End sidebar_box -->
    <?php 
	if($this->session->userdata('company_type') && $this->session->userdata('company_type')!='1')
	{?>
    <p style="float: right; margin-right: 20px;">Licensed by <a href="http://thewednesday.in" target="_blank"> <img width="105" src="<?php echo base_url();?>img/logo.png"/></a></p>    
    <?php
	}
	?>
    <p style="float: left; margin-right: 20px;">Powered by <a href="http://www.wegile.com" target="_blank">Wegile</a></p>
</div>


