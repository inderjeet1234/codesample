<html>
<body>


<table  width="500" border="0" cellspacing="5" cellpadding="5">
           <tr>
			 <td height="22" colspan="2" align="left" valign="top" style="font-size:14px;">Hi <?php echo $name;?></td>
		   </tr>
		   <tr>
			 <td height="22" colspan="2" align="left" valign="top" style="font-size:14px;">A new post - <b><?php echo $post_title;?></b> has been created in the project - <b><?php echo $project_name;?></b>.</td>
		   </tr>
		  
		  <tr>
              <td width="153" height="28" colspan="2" align="left" valign="top">Regards,<br/><?php echo $this->session->userdata('admin_company');?></td>
         </tr>




</table>
</body>
</html>
