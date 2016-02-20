<html>
<body>


<table  width="500" border="0" cellspacing="5" cellpadding="5">
           <tr>
			 <td height="22" colspan="2" align="left" valign="top" style="font-size:14px;">Hi <?php echo $name;?></td>
		   </tr>
		   <tr>
			 <td height="22" colspan="2" align="left" valign="top" style="font-size:14px;">Your post - <b><?php echo $post_title;?></b> has been rejected by the approver.</td>
		   </tr>
           <tr>
			 <td height="22" colspan="2" align="left" valign="top" style="font-size:14px;">Please login to the portal to view the reason for rejection of your post.</td>
		   </tr>
		 
		  
		  <tr>
              <td width="153" height="28" colspan="2" align="left" valign="top">Regards,<br/><?php echo $this->session->userdata('admin_company');?></td>
         </tr>




</table>
</body>
</html>
