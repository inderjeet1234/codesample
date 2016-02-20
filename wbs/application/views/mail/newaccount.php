<html>
<body>


<table  width="500" border="0" cellspacing="5" cellpadding="5">
           <tr>
			 <td height="22" colspan="2" align="left" valign="top" style="font-size:14px;">Hi <?php echo $name;?></td>
		   </tr>
		   <tr>
			 <td height="22" colspan="2" align="left" valign="top" style="font-size:14px;">Your account has been created on the <?php echo $this->session->userdata('admin_company');?> Event Management Portal.</td>
		   </tr>
		   
		   <tr>
                <td height="22" colspan="2" align="left" valign="top" style="font-size:14px; font-weight:bold;">Your login credentials are:</td>
           </tr>
		   
		   <tr>
				<td width="153" height="28" align="right" valign="top">Username:</td>
				<td width="321" align="left" valign="top"  style=" padding-left:60px;"><?php echo $username;?></td>
          </tr>
		   <tr>
				<td width="153" height="28" align="right" valign="top">Password:</td>
				<td width="321" align="left" valign="top"  style=" padding-left:60px;"><?php echo $this->input->post('password');?></td>
          </tr>
		  
		  <tr>
              <td width="153" height="28" colspan="2" align="left" valign="top">Regards,<br/><?php echo $this->session->userdata('admin_company');?></td>
         </tr>




</table>
</body>
</html>
