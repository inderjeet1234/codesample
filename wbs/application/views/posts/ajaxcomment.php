  <?php
                 
                      $udata=$this->postsmodel->getuserdeatils($val['user_id']);
                      $userdata=$udata[0];

                  ?>
<div class="post_replies" id="axcd<?php echo  $val['id']; ?>"><!---postreplies---->
                        <div class="post_reply">
                            <a  class="avatar popup" rel="popuprel3" profid="<?php echo $val['user_id']; ?>" >
                            <img class="thumbnail small"  style=" width:50px; height: 50px; both" src="<?php echo base_url();?>img/admincompany/<?php if(!empty($userdata->pic))echo $userdata->pic;else echo "default.jpg"; ?>"/>
                                </a>
                            <div class="reply_info">
                                <div class="text"><!---text-->
                                    <p><?php echo $val['comment_msg'];?></p>
                                    <div class="imgupload">
                                    <?php if(!empty($val['attachment']))
									{
									$img=explode(",",$val['attachment']);
									foreach($img as $vall)
									{
                                        $extensiond=array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
                                        $diskjo=explode(".",$vall);
                                        if(in_array($diskjo[1],$extensiond))
                                        {
									?>

                                      <a rel="lightbox" href="<?php echo base_url();?>/uploads/<?php echo $vall;?>" target="_blank">  <img src="<?php echo base_url();?>/uploads/<?php echo $vall;?>"    style="width:300px;border:1px solid #eee;padding:5px;"/></a>
                                       <?php
                                        }
                                        else
                                        {
                                         ?>
                                            <a href="<?php echo base_url();?>/uploads/<?php echo $vall;?>" target="_blank">  <img src="<?php echo base_url();?>/img/doc.png"     style="width:50px;border:1px solid #eee;padding:5px;"/></a>

                                        <?php
                                        }
                                        }
									   }
									   ?>
                                    </div>
                                    <span class="time"><?php echo $val['created_date'];?>&nbsp;-&nbsp;<?php echo  $val['location'];?> </span>
                                    <span class="time">Posted by <?php if(!isset($userdata->name))echo 'unknown';else echo $userdata->name;?></span>
                                </div><!---text-->
                            </div>
                            <div class="dellt" style="float:left"><?php if($val['user_id']==$this->session->userdata('user_id')){?><a rel="axcd<?php echo $val['id']; ?>" cid="<?php echo $val['id']; ?>" class="deletecomment"  style="color:#cfcfcf">X</a><?php }?> </div>
                        </div>
                    </div><!---postreplies---->
