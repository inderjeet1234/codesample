




          <div class="row-fluid">
            <div class="title">
              <h4>
              <i class="icon-eye-open"></i>
              <span>Post Details</span>
              </h4>
            </div>
            <!-- End .title -->
            <div class="content">


              <ul class="messages_layout">
                  <?php
                  $ii=0;

                  foreach($data as $val)
                  {
                  $ii++;

                      $udata=$this->postsmodel->getuserdeatils($val->user_id);
                      $userdata=$udata[0];
                      $totalcomments=$this->postsmodel->gettotalcomments($val->id);
                  ?>
                <li class="from_user left">
                <a href="#" class="avatar">
                        <img class="thumbnail small"  style=" width:50px; height: 50px; both" src="<?php echo base_url();?>img/admincompany/<?php if(!empty($userdata->pic))echo $userdata->pic;else echo "default.jpg"; ?>"/>
                   </a>
                <div class="message_wrap">
                      <span class="arrow"></span>
                      <div class="info">
                        <a class="name"><?php echo $val->title; ?></a><br/>
                          <span class="time" >Published Date&nbsp;-:&nbsp;<?php echo $val->published_date; ?></span><br/>
                          <span class="time" style="margin-top:-4px">Created Date&nbsp;-:&nbsp;<?php echo $val->created_date; ?></span><br/>
                        <span class="time" style="margin-top:-4px"><?php echo $val->location; ?></span><br/>
                        <span class="time" style="margin-top:-4px">Posted by <?php echo $userdata->name; ?></span>
                      </div>
                      <div class="text">
                          <?php echo $val->description; ?>
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
                      </div>
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
                                        <img class="thumbnail small"  style=" width:50px; height: 50px; both" src="<?php echo base_url();?>img/admincompany/<?php if(!empty($userdata1->pic))echo $userdata1->pic;else echo "default.jpg"; ?>"/>
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
                                                                <a rel="lightbox" href="<?php echo base_url();?>/uploads/<?php echo $vall;?>" >  <img src="<?php echo base_url();?>/uploads/<?php echo $vall;?>"    style="width:300px;border:1px solid #eee;padding:5px;"/></a>
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

								  <div class="UFIPhotoAttachLinkWrapper _m" id="js_36">
								  <i class="UFICommentPhotoIcon"><input accept="image/*" class="_n"  type="file" name="images<?php echo $ii; ?>" id="images<?php echo $ii; ?>" /></i>

								  </div>

                                  <div id="responseimages<?php echo $ii; ?>"></div>
                                  <ul id="image-listimages<?php echo $ii; ?>" style="margin-top: 20px;">

                                  </ul>


                                  <button altt="images<?php echo $ii; ?>" pid="<?php echo $val->id; ?>" style="clear: both;display: block;" type="submit" rel="com_<?php echo $ii; ?>" class="commentsub" >Post</button>

						      </div><!----innerwrap-->
                    </form>
                </div>
                </li>
                  <?php


                  }

                  ?>

              </ul>
            </div>
            <!-- End .content -->
          </div>

        <!-- End .span6 -->


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

          <script src="<?php echo base_url();?>js/lightbox.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/wysihtml5-0.3.0.min.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.peity.min.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.uniform.min.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/textarea-autogrow.js"></script>
              <!--  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/character-limit.js"></script>-->
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/jquery.maskedinput-1.3.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/chosen/chosen/chosen.jquery.min.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/bootstrap-datepicker.js"></script>
              <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/bootstrap-colorpicker.js"></script>

              <!-- <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.stack.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.pie.js"></script>
            <script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/plugins/flot/jquery.flot.resize.js"></script>-->




              <script src="<?php echo base_url();?>js/plugins/validation/dist/jquery.validate.min.js" type="text/javascript"></script>


              <script src="<?php echo base_url();?>js/scripts.js"></script>


            <!--  <script type="text/javascript" >
                  $(document).ready(function() {
                      $('#photoimg').change(function(){
                          $("#preview").html('');
                          $("#preview").html('<img src="<?php echo base_url();?>loader.gif" alt="Uploading...."/>');
                          $("#tweethis").ajaxForm({
                              target: '#preview'
                          }).submit();
                          return false; // prevent normal submit
                      });
                  });
              </script>-->
              <script type="text/javascript">
                  $('input[type=file]').live('click',function(){

                      var idef=$(this).attr('id');
              (function () {

              var input = document.getElementById(idef),
              formdata = false;

              function showUploadedItem (source) {
              var list = document.getElementById("image-list"+idef);
              li   = document.createElement("li");
                  li.style.float="left";
                  li.style.width="100px";
                  li.style.margin="0 10px 0 0";
              img  = document.createElement("img");
              img.src = source;
                  img.width="100";
                  img.height="100";

              li.appendChild(img);
              list.appendChild(li);
              }

              if (window.FormData) {
              formdata = new FormData();
             // document.getElementById("btn").style.display = "none";
              }

              input.addEventListener("change", function (evt) {
              //document.getElementById("response").innerHTML = "Uploading . . ."
              var i = 0, len = this.files.length, img, reader, file;

            for ( ; i < len; i++ ) {
              file = this.files[i];

              if (!!file.type.match(/image.*/)) {
              if ( window.FileReader ) {
              reader = new FileReader();
              reader.onloadend = function (e) {
              showUploadedItem(e.target.result, file.fileName);
              };
              reader.readAsDataURL(file);
              }
              if (formdata) {
              formdata.append("images[]", file);
              }
              }
              }

              if (formdata) {
              $.ajax({
              url: "<?php echo site_url()."/posts/addcomment";?>",
              type: "POST",
              data: formdata,
              processData: false,
              contentType: false,
              success: function (res) {
              //document.getElementById("response"+idef).innerHTML = res;
                  $("#response"+idef).append(res);
              }
              });
              }

                  this.removeEventListener('change', arguments.callee, false);

              }, false);
              }());

              });


              </script>

              <script type="text/javascript">
                 $(document).ready(function() {
                   /*   $("textarea[rel=comments]").click(function(){


                          $(this).parent().parent().attr('id','tweethis');

                      });*/

                      $(document).on('click','.commentsub',function() {

                          var fid=$(this).attr('rel');
                          var tid=$(this).attr('altt');
                          var pid=$(this).attr('pid');

                     // $("#"+fid).live('submit',function() {
                        //  $(document).on('submit',"#"+fid,function(e) {

                          //console.log( $(this).serialize() );
                      $.post('<?php echo site_url()."/posts/commentsave";?>', $("#"+fid).serialize(), function(html) {

                          $("#comments"+fid).append(html);
                          $("#response"+tid).empty();
                          $("#image-list"+tid).empty();
                          $("textarea").val('');
                          var uu=parseInt($('#totalcomments'+pid).val())+1;
                          $('#totalcomments'+pid).val(uu);


                      });


                      return false; // prevent normal submit

                     //         e.preventDefault();
                     // });


                      });




                  });

              </script>

              <script type="text/javascript">
                  $(document).ready(function(){

                      $(".deletecomment").live('click',function(){
                                    var idd=$(this).attr('cid');
                          var sd= "#"+$(this).attr('rel');
                          $.ajax({
                              url: "<?php echo site_url()."/posts/deletecomment";?>",
                              type: "POST",
                              data: {val:idd},

                              success: function (res) {
                                  //document.getElementById("response"+idef).innerHTML = res;
                                  if(res=='1')
                                  {

                                     // alert(sd);
                                      $(sd).remove();
                                  }

                              }
                          });

                      });


                  });
              </script>

              <script type="text/javascript">
                  function morecomments(id,did)
                  {
                     var totallimit=parseInt($('#totalcomments'+id).val());
                      var limit=0
                      $("#"+did+"  .post_replies").each(function(){
                          limit++;
                      });

                      $.ajax({
                          url: "<?php echo site_url()."/posts/getmorecomment";?>",
                          type: "POST",
                          data: {'val':id,'limit':limit},

                          success: function (res) {
                              //document.getElementById("response"+idef).innerHTML = res;
                              $("#"+did).prepend(res);

                              if(totallimit<=(parseInt(limit)+5))
                                  $("#viewmore"+id).hide();



                          }
                      });
                  }

              </script>





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