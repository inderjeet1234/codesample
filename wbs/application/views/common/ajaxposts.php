




                  <?php
                  $ii=$nextlimit;
                  if($total_rows>0)
                  {
                  foreach($data as $val)
                  {
                  $ii++;

                      $udata=$this->postsmodel->getuserdeatils($val->user_id);
                      $userdata=$udata[0];
                      $totalcomments=$this->postsmodel->gettotalcomments($val->id);
                  ?>
                <li class="from_user left">
                   <a  class="avatar popup" rel="popuprel3" profid="<?php echo $val->user_id; ?>"  style="text-align: center;width: 50px;text-decoration: none;
line-height: 10px;">
                        <img class="thumbnail small"  style=" width:50px; height: 50px; both" src="<?php echo base_url();?>img/admincompany/<?php if(!empty($userdata->pic))echo $userdata->pic;else echo "default.jpg"; ?>"/>

<span class="time" style="color: #7E838B;font-size: 10px;"><?php echo $userdata->name; ?></span>
                   </a>  

                <div class="message_wrap">
                      <span class="arrow"></span>
                      <div class="info">
                        <a class="name" href="<?php echo site_url('home/notify/id/'.$val->id)?>"><?php echo $val->title; ?></a><br/>
                          <span class="time pubsus" >Published Date&nbsp;-:&nbsp;<?php echo $val->published_date; ?></span>
                        <span class="time  cresus" style="margin-left:10px;">Created Date&nbsp;-:&nbsp;<?php echo $val->created_date; ?></span><br/>

                        <span class="time" style="margin-top:-4px">Locations&nbsp;-:&nbsp;<?php echo $val->location; ?></span><br/>
                     











                          <!--  Share Flags-->


                          <span class="time" style="margin-top:8px"> Shared With -:</span>
                          <?php
                          if($val->wbs_visible==1)
                          {

                              ?>
                              <a class="shareanchor" rel="admin<?php echo $ii; ?>" ><img  src="<?php echo base_url();?>img/wbs-flag.png" style="margin: 10px 0;" /></a>
                          <?php
                          }
                          ?>
                          <?php
                          if($val->client_visible==1)
                          {

                              ?>
                              <a class="shareanchor" rel="client<?php echo $ii; ?>" ><img  src="<?php echo base_url();?>img/client-flag.png" style="margin: 10px 0;" /></a>
                          <?php
                          }
                          ?>
                          <?php
                          if($val->vendor_visible==1)
                          {

                              ?>
                              <a class="shareanchor" rel="vendor<?php echo $ii; ?>" ><img  src="<?php echo base_url();?>img/vendor-flag.png" style="margin: 10px 0;" /></a>
                          <?php
                          }
                          ?>
                          <?php
                          $jackpot=1;
                          if($val->wbs_visible==1)
                          {
                              $adminshareusers=$this->postsmodel->getsharedusers(1,$val->project_id);
                              ?>

                              <div id="admin<?php echo $ii; ?>" class="sharedadminnames<?php echo $jackpot; ?>">
                                  <ul>
                                      <?php
                                      if($adminshareusers)
                                      {
                                          foreach($adminshareusers as $adminvalue)
                                          {

                                              ?>
                                              <li><?php echo $this->postsmodel->getuserfullname($adminvalue->username); ?></li>
                                          <?php
                                          }
                                      }
                                      ?>

                                  </ul>
                              </div>
                              <?php
                              $jackpot++;
                          }
                          if($val->client_visible==1)
                          {
                              $clientshareusers=$this->postsmodel->getsharedusers(2,$val->project_id);

                              ?>


                              <div id="client<?php echo $ii; ?>" class="sharedadminnames<?php echo $jackpot; ?>">
                                  <ul>
                                      <?php
                                      if($clientshareusers)
                                      {
                                          foreach($clientshareusers as $clientvalue)
                                          {

                                              ?>
                                              <li><?php echo $this->postsmodel->getuserfullname($clientvalue->username); ?></li>
                                          <?php
                                          }
                                      }
                                      ?>

                                  </ul>

                              </div>

                              <?php
                              $jackpot++;
                          }
                          if($val->vendor_visible==1)
                          {
                              $vendorshareusers=$this->postsmodel->getsharedusers(3,$val->project_id);

                              ?>
                              <div id="vendor<?php echo $ii; ?>" class="sharedadminnames<?php echo $jackpot; ?>">

                                  <ul>
                                      <?php
                                      if($vendorshareusers)
                                      {
                                          foreach($vendorshareusers as $vendorvalue)
                                          {

                                              ?>
                                              <li><?php echo $this->postsmodel->getuserfullname($vendorvalue->username); ?></li>
                                          <?php
                                          }
                                      }
                                      ?>

                                  </ul>

                              </div>
                              <?php
                              $jackpot++;
                          }



                          ?>





                          <!--  Share Flags-->












                      </div>
























                      <div class="text" style="margin-bottom:10px; clear: both;">
                          <?php echo $val->description; ?>
                        
                      </div>
   <?php if(!empty($val->attachments)){?>
                  <!--  <a rel="lightbox"  href="<?php echo base_url();?>img/posts/<?php echo $val->attachments; ?>" >   <img  style="width:300px;border:1px solid #eee;padding:5px; display:block;clear:both;" src="<?php echo base_url();?>img/posts/<?php echo $val->attachments; ?>"/></a>-->
                            <?php
							}
							?>

                      <?php if(!empty($val->attachments))
                      {
                          $imgta=explode(",",$val->attachments);
                          foreach($imgta as $tavall)
                          {
                              $extensiond=array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
                              $diskjota=explode(".",$tavall);
                              if(isset($diskjota[1]))
                              {
                                  if(in_array($diskjota[1],$extensiond))
                                  {
                                      ?>
                                      <a rel="lightbox"  href="<?php echo base_url();?>img/posts/<?php echo $tavall;?>" >  <img src="<?php echo base_url();?>img/posts/<?php echo $tavall;?>"    style="width:300px;border:1px solid #eee;padding:5px; display:block;clear:both;"/></a>
                                  <?php
                                  }
                                  else
                                  {
                                      ?>
                                      <a href="<?php echo base_url();?>img/posts/<?php echo $tavall;?>" target="_blank">  <img src="<?php echo base_url();?>/img/doc.png"    style="width:50px;border:1px solid #eee;padding:5px; display:block;clear:both;"/></a>
                                  <?php

                                  }
                              }
                          }
                      }
                      ?>











                          <input type="hidden" name="totalcomments<?php echo $val->id;?>" id="totalcomments<?php echo $val->id;?>"  value="<?php echo $totalcomments;?>" />



















                      <div>

                        <?php
                        if($this->postsmodel->getnoofcomments($val->id)>0)
                        {?>

                            <a style="clear: both;display: block;" href="javascript:morecomments(<?php echo $val->id;?>,'commentscom_<?php echo $ii; ?>')" id="viewmore<?php echo $val->id;?>">view more comments</a>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="commentscom_<?php echo $ii; ?>">

                       <?php
                        $datacomment=$this->postsmodel->getcomments($val->id);

                        if($datacomment)
                        {$jj=0;
                            $datacomment=array_reverse($datacomment,true);
                            foreach($datacomment as $tdsf)
                            {

                                $udata1=$this->postsmodel->getuserdeatils($tdsf->user_id);
                                $userdata1=$udata1[0];
                                ?>

                                <div class="post_replies" id="cd<?php echo $ii,$jj; ?>"><!---postreplies---->
                                    <div class="post_reply">
                                        <a  class="avatar popup" rel="popuprel3" profid="<?php echo $tdsf->user_id; ?>" >
                                        <img class="thumbnail small"  style=" width:50px; height: 50px; both" src="<?php echo base_url();?>img/admincompany/<?php if(!empty($userdata1->pic))echo $userdata1->pic;else echo "default.jpg"; ?>"/>
                                            </a>
                                        <div class="reply_info">
                                            <div class="text"><!---text-->
                                                <p><?php echo $tdsf->comment_msg;?></p>
                                                <div class="imgupload">
                                                    <?php if(!empty($tdsf->attachment))
                                                    {
                                                        $img=explode(",",$tdsf->attachment);
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
                                                                <a href="<?php echo base_url();?>/uploads/<?php echo $vall;?>" target="_blank">  <img src="<?php echo base_url();?>/img/doc.png"    style="width:50px;border:1px solid #eee;padding:5px;"/></a>
                                                           <?php

                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <span class="time"><?php echo $tdsf->created_date;?>&nbsp;-&nbsp;<?php echo $tdsf->location;?> </span>
                                                <span class="time">Posted by <?php if(!isset($userdata1->name))echo 'unknown';else echo $userdata1->name;?></span>
                                            </div><!---text-->

                                        </div>
                                        <div class="dellt" style="float:left"><?php if($tdsf->user_id==$this->session->userdata('user_id')){?><a rel="cd<?php echo $ii,$jj; ?>" class="deletecomment" cid="<?php echo $tdsf->id; ?>" style="color:#cfcfcf">X</a><?php }?> </div>
                                    </div>
                                </div><!---postreplies---->


                            <?php
                                $jj++;
                            }
                        }
                           ?>

                    </div>


                    <form   enctype="multipart/form-data" method="post" id="com_<?php echo $ii; ?>">
							  <div class="innerwrap"><!----innerwrap-->
						          <textarea  rel="comments" name="cm" id="cm" placeholder="Write a comment..."></textarea>
                                  <input type="hidden" name="post_id" value="<?php echo $val->id; ?>" />
                                    <?php
                                            if($this->session->userdata('company_type')!=3)
                                            {
                                                ?>

								  <div class="UFIPhotoAttachLinkWrapper _m" id="js_36">
								  <i class="UFICommentPhotoIcon"><input  class="_n"  type="file" name="images<?php echo $ii; ?>" id="images<?php echo $ii; ?>" /></i>

								  </div>

                                  <div id="responseimages<?php echo $ii; ?>"></div>
                                  <ul id="image-listimages<?php echo $ii; ?>" style="margin-top: 20px;">
                                      <li><img  src="<?php echo base_url();?>img/loading.gif" id="loadingimages<?php echo $ii; ?>" style="width:16px;display: none;" /></li>

                                  </ul>
                                                <?php
                                            }
                                                ?>


                                  <button altt="images<?php echo $ii; ?>" pid="<?php echo $val->id; ?>" style="clear: both;display: block;" type="submit" rel="com_<?php echo $ii; ?>" class="commentsub" >Post</button>

						      </div><!----innerwrap-->
                    </form>
                </div>
                </li>
                  <?php

                  }
                     ?>
                      <li style="text-align: center;"><img  src="<?php echo base_url();?>img/loading.gif" id="loadmoreimages" style="width:16px;display: none;" /><a rel="<?php echo $nextlimit+5;?>"  id="loadmore" >Load more</a> </li>
                  <?php
                  }
                  else{
                    //  echo "No Posts yet...";
                  }
                  ?>








                  <!-- Validation plugin -->
                  <script src="<?php echo base_url();?>js/jquery.js"></script>












                  <script src="<?php echo base_url();?>js/scripts.js"></script>


















          <script type='text/javascript'>
                  $(window).load(function() {
                      $('#loading').fadeOut();
                  });
                  $(document).ready(function() {
                      $('body').css('display', 'none');
                      $('body').fadeIn(500);


                      $("#logo a, #sidebar_menu a:not(.accordion-toggle), a.ajx").click(function() {
                          event.preventDefault();
                          newLocation = this.href;
                          $('body').fadeOut(500, newpage);
                      });
                      function newpage() {
                          window.location = newLocation;
                      }

                  });
                  $(document).ready(function() {
                      var date = new Date();
                      var d = date.getDate();
                      var m = date.getMonth();
                      var y = date.getFullYear();
                      var calendar = $('#calendar').fullCalendar({
                          header: {
                              left: 'prev,next today',
                              center: 'title',
                              right: 'month,agendaWeek,agendaDay'
                          },
                          selectable: true,
                          selectHelper: true,
                          select: function(start, end, allDay) {
                              var title = prompt('Event Title:');
                              if (title) {
                                  calendar.fullCalendar('renderEvent',
                                      {
                                          title: title,
                                          start: start,
                                          end: end,
                                          allDay: allDay
                                      },
                                      true // make the event "stick"
                                  );
                              }
                              calendar.fullCalendar('unselect');
                          },
                          editable: true,
                          events: [
                              {
                                  title: 'All Day Event',
                                  start: new Date(y, m, 1)
                              },
                              {
                                  title: 'Long Event',
                                  start: new Date(y, m, d+5),
                                  end: new Date(y, m, d+7)
                              },
                              {
                                  id: 999,
                                  title: 'Repeating Event',
                                  start: new Date(y, m, d-3, 16, 0),
                                  allDay: false
                              },
                              {
                                  id: 999,
                                  title: 'Repeating Event',
                                  start: new Date(y, m, d+4, 16, 0),
                                  allDay: false
                              },
                              {
                                  title: 'Meeting',
                                  start: new Date(y, m, d, 10, 30),
                                  allDay: false
                              },
                              {
                                  title: 'Lunch',
                                  start: new Date(y, m, d, 12, 0),
                                  end: new Date(y, m, d, 14, 0),
                                  allDay: false
                              },
                              {
                                  title: 'Birthday Party',
                                  start: new Date(y, m, d+1, 19, 0),
                                  end: new Date(y, m, d+1, 22, 30),
                                  allDay: false
                              },
                              {
                                  title: 'Click for PixelGrade',
                                  start: new Date(y, m, 28),
                                  end: new Date(y, m, 29),
                                  url: 'http://pixelgrade.com/'
                              }
                          ]
                      });
                  });
              </script>
              <script type="text/javascript" charset="utf-8">
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
                          "aaSorting": [[ 4, "asc" ]],
                          "bPaginate": false,
                          "bJQueryUI": false,
                          "aoColumns": dontSort
                      } );
                      $.extend( $.fn.dataTableExt.oStdClasses, {
                          "s`": "dataTables_wrapper form-inline"
                      } );
                  } );
              </script>

              <script type="text/javascript">
                  $(function () {

                      var sin = [], cos = [], tes = [];
                      for (var i = 0; i < 14; i += 1) {
                          sin.push([i, Math.sin(i)*Math.random()*0.9]);
                          cos.push([i, Math.cos(i)*Math.random()*1.4]);
                          tes.push([i, Math.cos(i)*Math.random()*0.4]);
                      }
                      var plot = $.plot($("#placeholder"),
                          [  { data: sin, label: "Google+", color:"#ef4723", shadowSize:0 }, { data: cos, label: "Envato", color:"#a1d14d", shadowSize:0},  { data: tes, label: "Facebook", color:"#4a8cf7", shadowSize:0 } ], {
                              series: {
                                  lines: { show: true, fill:true },
                                  points: { show: true, fill:true },
                              },
                              grid: { hoverable: true, clickable: true, autoHighlight: false, borderWidth:0,  backgroundColor: { colors: ["#fff", "#fbfbfb"] } },
                              yaxis: { min: -1.5, max: 1.5 },
                          });
                      function showTooltip(x, y, contents) {
                          $('<div id="tooltip">' + contents + '</div>').css( {
                              position: 'absolute',
                              display: 'none',
                              top: y + 5,
                              left: x + 5,
                              border: '1px solid #ccc',
                              padding: '2px 6px',
                              'background-color': '#fff',
                              opacity: 0.80
                          }).appendTo("body").fadeIn(200);
                      }
                      var previousPoint = null;
                      $("#placeholder").bind("plothover", function (event, pos, item) {
                          $("#x").text(pos.x.toFixed(2));
                          $("#y").text(pos.y.toFixed(2));
                          if (item) {
                              if (previousPoint != item.dataIndex) {
                                  previousPoint = item.dataIndex;
                                  $("#tooltip").remove();
                                  var x = item.datapoint[0].toFixed(2),
                                      y = item.datapoint[1].toFixed(2);
                                  showTooltip(item.pageX, item.pageY,
                                      item.series.label + " of " + x + " = " + y);
                              }
                          }
                      });
                  });
                  $(function () {
                      var data = [];
                      var series = Math.floor(Math.random()*5)+1;
                      data[0] = { label: "Google+", data:42, color: "#cb4b4b" };
                      data[1] = { label: "Envato", data:27, color: "#4da74d"};
                      data[2] = { label: "Pinterest", data:9, color: "#edc240"};
                      data[3] = { label: "Facebook", data:22, color: "#5e96ea"};
                      // DONUT
                      $.plot($("#donut"), data,
                          {
                              series: {
                                  pie: {
                                      show: true,
                                      innerRadius: 0.42,
                                      highlight: {
                                          opacity: 0.3
                                      },
                                      radius: 1,
                                      stroke: {
                                          color: '#fff',
                                          width: 4
                                      },
                                      startAngle: 0,
                                      combine: {
                                          color: '#353535',
                                          threshold: 0.05
                                      },
                                      label: {
                                          show: true,
                                          radius: 1,
                                          formatter: function(label, series){
                                              return '<div class="chart-label">'+label+'&nbsp;'+Math.round(series.percent)+'%</div>';
                                          }
                                      }
                                  },
                                  grow: { active: false}
                              },
                              legend:{show:true},
                              grid: {
                                  hoverable: true,
                                  clickable: true
                              },
                          });
                  });
              </script>


