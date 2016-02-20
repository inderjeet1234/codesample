<!-- End .content -->
</div>
<!-- End .box -->
</div>
<!-- End .span6 -->
</div>

</div>
<!-- End #container -->
</div>
<div id="footer">
</div>
</div>
<!-- /container -->




<script type="text/javascript">
num=2;
    function notification()
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("home/notification"); ?>',
            data:{'val':1},

            success:function(data){
                // alert(data);
                $('#notificationnew').html(data);
            },
            error: function(data) { // if error occured
              //  alert("Error occured.please try again");
               // alert(data);
            },

            dataType:'html'
        });
    }

    function gettime()
    {
        var ss;
        num=num-1;
        ss=num;
        if(ss==1)
        {

            notification();
            num=155;
        }

        setTimeout("gettime()",1000);

    }


   function mango()
   {

        $("a[rel=mango]").live('click',function(){
            alert('hhh');

        });

   }


function notifystatus(id,url,dugs)
{

    $.ajax({
        type: 'POST',
        url: '<?php echo site_url("home/changenotifystatus"); ?>',
        data:{'val':id},

        success:function(data){
            if(url=='1')
            {
                $(dugs).css('font-weight','normal');
            }
            else
            {
                window.location=url;
            }

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
        $("input:checkbox, input:radio, input:file").uniform();

        $("#logo a, #sidebar_menu a:not(.accordion-toggle), a.ajx").click(function() {
            event.preventDefault();
            newLocation = this.href;
            $('body').fadeOut(500, newpage);
        });
        function newpage() {
            window.location = newLocation;
        }
        // Chosen select plugin
        $(".chzn-select").chosen({
            disable_search_threshold: 10
        });
    });

</script>

</body>
</html>