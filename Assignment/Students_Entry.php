<?php
//error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
$id="";
$opr="";
if(isset($_GET['opr']))
	$opr=$_GET['opr'];

if(isset($_GET['rs_id']))
	$id=$_GET['rs_id'];
//--------------add data-----------------	
if(isset($_POST['btn_sub'])){
	$f_name=$_POST['fnametxt'];
	$l_name=$_POST['lnametxt'];
	$gender=$_POST['gender'];
	//$dob=$_POST['yy']."/".$_POST['mm']."/".$_POST['dd'];
	$dob=$_POST['text1'];
	$pob=$_POST['pobtxt'];
	$addr=$_POST['addrtxt'];
	$phone=$_POST['phonetxt'];
	$mail=$_POST['emailtxt'];
	$note=$_POST['notetxt'];	
$sql_ins=mysql_query("INSERT INTO stu_tbl 
						VALUES(
							NULL,
							'$f_name',
							'$l_name' ,
							'$gender',
							'$dob',
							'$pob',
							'$addr',
							'$phone',
							'$mail',
							'$note'
							)
					");
if($sql_ins==true)
	$msg="1 Row Inserted";
else
	$msg="Insert Error:".mysql_error();
	
}
//------------------uodate data----------
if(isset($_POST['btn_upd'])){
	$f_name=$_POST['fnametxt'];
	$l_name=$_POST['lnametxt'];
	$gender=$_POST['gender'];
	//$dob=$_POST['yy']."/".$_POST['mm']."/".$_POST['dd'];
	$dob=$_POST['text1'];
	$pob=$_POST['pobtxt'];
	$addr=$_POST['addrtxt'];
	$phone=$_POST['phonetxt'];
	$mail=$_POST['emailtxt'];
	$note=$_POST['notetxt'];	
	
	$sql_update=mysql_query("UPDATE stu_tbl SET 
								f_name='$f_name',
								l_name='$l_name' ,
								gender='$gender',
								dob='$dob',
								pob='$pob',
								address='$addr',
								phone='$phone',
								email='$mail',
								note='$note'
							WHERE
								stu_id=$id
							");
	/*if($sql_update==true)
		header("location:?tag=view_students");
	else
		$msg="Update Fail".mysql_error();*/
	if (headers_sent()) {
    die("<h1>Update Successfull.....!</h1>
	<link rel='stylesheet' type='text/css' href='css/style_entry.css' />
	       <div id='top_style_button'> 
       		<form method='post'>
            	<a href='?tag=view_students'><input type='button' name='btn_view' value='View Students'  title='Back' id='button_view' style='width:120px;'  /></a>
       		</form>
       </div>");
}
else{
    exit(header("location:?tag=view_students"));
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet"  type="text/css" href="css/style_entry.css" />
<link rel="stylesheet"  type="text/css" href="css/style_view.css" />
<title>::. Mumbai University .::</title>
</head>
<body onload='document.form1.text1.focus()'>
<?php
if($opr=="upd")
{
	$sql_upd=mysql_query("SELECT * FROM stu_tbl WHERE stu_id=$id");
	$rs_upd=mysql_fetch_array($sql_upd);
	list($y,$m,$d)=explode('-',$rs_upd['dob']);
?>
<!-- for form Upadte-->
<div id="top_style">
        <div id="top_style_text">
        Students Update </div>
        <!-- end of top_style_text-->
       <div id="top_style_button"> 
       		<form method="post">
            	<a href="?tag=view_students"><input type="button" name="btn_view" title="View Students" value="Back" id="button_view" style="width:70px;"  /></a>
             
       		</form>
       </div><!-- end of top_style_button-->
</div><!-- end of top_style-->

 
<div id="style_informations">
	<form method="post" name="form1" action="#">
    	<div>
    	<table border="0" cellpadding="4" cellspacing="0">
        	<tr>
            	<td>First Name:</td>
            	<td>
                	<input type="text" name="fnametxt" id="textbox" pattern="[A-Za-z]{3,15}" maxlength="15" value="<?php echo $rs_upd['f_name'];?>" required/>
                </td>
            </tr>
            
            <tr>
            	<td>Last Name:</td>
            	<td>
                	<input type="text" name="lnametxt" id="textbox" pattern="[A-Za-z]{3,15}" maxlength="15" value="<?php echo $rs_upd['l_name'];?>" required/>
                </td>
            </tr>
            
            <tr>
            	<td>Gender:</td>
                <td>
                	<input type="radio" name="gender" value="Male" <?php if($rs_upd['gender']=="Male") echo "checked";?> />Male
                    <input type="radio" name="gender" value="Female" <?php if($rs_upd['gender']=="Female") echo "checked";?>/>Female
                </td>
            </tr>
			
			<tr>
			<td>Date of Birth</td>
			<td><input type='text' name='text1' placeholder="Valid Date Format" reqiuired/></td>
			</tr>
            
            <!--<tr>
            	<td>Date Of Birth:</td>
                <td>
                	<select name="yy" >
                    	<option>years</option>
                    	
                        <?php
							$sel="";
							for($i=1985;$i<=2015;$i++){	
								if($i==$y){
									$sel="selected='selected'";}
								else
								$sel="";
							echo"<option value='$i' $sel>$i </option>";
							}	
						?>
                       
                	</select>
                    -
                    <select name="mm">
                    	<option>Month</option>
						<?php
							$sel="";
                            $mm=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","NOv","Dec");
                            $i=0;
                            foreach($mm as $mon){
                                $i++;
									if($i==$m){
										$sel=$sel="selected='selected'";}
									else
										$sel="";
                                echo"<option value='$i' $sel> $mon</option>";		
                            }
                        ?>
                    </select>
                    -
                    <select name="dd">
                    	<option>Date</option>
						<?php
						$sel="";
                        for($i=1;$i<=31;$i++){
							if($i==$d){
								$sel=$sel="selected='selected'";}
							else
								$sel="";
                        ?>
                        <option value="<?php echo $i ;?>"<?php echo $sel?> >
                        <?php
                        if($i<10)
                            echo"0"."$i" ;
                        else
                            echo"$i";  
						?>
						</option>	
						<?php 
						}?>
					</select>
                </td>
            </tr>-->
            
            <tr>
            	<td>Place Of Brith:</td>
                <td>
                	<input type="text" name="pobtxt" id="textbox" pattern="[A-Za-z]{3,15}" maxlength="15" value="<?php echo $rs_upd['pob'];?> " required/>
                
                </td>
            </tr>
            <tr>
            	<td>Address:</td>
            	<td>
                	<textarea name="addrtxt" cols="22" rows="3" pattern="[A-Za-z0-9 ]{10,150}"> <?php echo $rs_upd['address'];?></textarea>
    			</td>
        	</tr>
            
            <tr>
                <td colspan="2">
                	<input type="reset" value="Cancel" id="button-in"/>
                	<input type="submit" name="btn_upd" value="Update" id="button-in" onclick="validatedate(document.form1.text1)" />
                </td>
            </tr>
		</table>
   </div>
 
	<div>
    	<table border="0" cellpadding="4" cellspacing="0">
        	
            
            <tr>
            	<td>Phone:</td>
            	<td>
                	<input type="text" name="phonetxt" id="textbox" pattern="[0-9]{10}" maxlength="10" value="<?php echo $rs_upd['phone'];?>" required/>
                </td>
            </tr>
            
            <tr>
            	<td>E-mail:</td>
                <td>
                	<input type="text" name="emailtxt"  id="textbox" pattern="[a-zA-Z0-9-_\.]+@[a-zA-Z]+\.[a-zA-Z]{2,3}" value="<?php echo $rs_upd['email'];?> " required/>
                </td>
            </tr>
            
            <tr>
            	<td>Note:</td>
                <td>
                	<textarea name="notetxt" cols="22" rows="5"><?php echo $rs_upd['note'];?></textarea>
                </td>
            </tr>
    	</table>
  </div>
    </form>

</div><!-- end of style_informatios -->

<?php	
}
else
{
?>
<!-- for form Register-->
	
<div id="top_style">
        <div id="top_style_text">
        Students Entry
        </div><!-- end of top_style_text-->
       <div id="top_style_button"> 
       		<form method="post">
            	<a href="?tag=view_students"><input type="button" name="btn_view" title="View Students" value="View_Students" id="button_view" style="width:120px;"  /></a>
             
       		</form>
       </div><!-- end of top_style_button-->
</div><!-- end of top_style-->

<div id="style_informations">
	<form method="post" name="form1" method="#">
    <div>
   	  <table border="0" cellpadding="4" cellspacing="0">
        	<tr>
            	<td>First Name:</td>
            	<td>
                	<input type="text" name="fnametxt" id="textbox" pattern="[A-Za-z]{4,15}" maxlength="15" required/>
                </td>
            </tr>
            
            <tr>
            	<td>Last Name:</td>
            	<td>
                	<input type="text" name="lnametxt" id="textbox" pattern="[A-Za-z]{4,15}" maxlength="15" required/>
                </td>
            </tr>
            
            <tr>
            	<td>Gender:</td>
                <td>
                	<input type="radio" name="gender" value="Male" checked="checked" />Male
                    <input type="radio" name="gender" value="Female"/>Female
                </td>
            </tr>
            
			<tr>
				<td>Date of Birth</td>
				<td><input type='text' name='text1' placeholder="Valid Date Format" reqiuired/></td>
			</tr>
					
            <!--<tr>
            	<td>Date Of Birth:</td>
                <td>
                	<select name="yy" >
                    	<option>Year</option>
                        <?php
							for($i=1985;$i<=2015;$i++){	
							echo"<option value='$i'>$i</option>";
							}
						?>
               	  </select>
                    -
                    <select name="mm">
                    	<option>Month</option>
						<?php
                            $mm=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","NOv","Dec");
                            $i=0;
                            foreach($mm as $mon){
                                $i++;
                                echo"<option value='$i'> $mon</option>";		
                            }
                        ?>
                    </select>
                    -
                    <select name="dd">
                    	<option>Date</option>
						<?php
                        for($i=1;$i<=31;$i++){
                        ?>
                        <option value="<?php echo $i; ?>">
                        <?php
                        if($i<10)
                            echo"0".$i;
                        else
                            echo"$i";	  
						?>
						</option>	
						<?php 
						}?>
					</select>
              </td>
        </tr>-->
            
            <tr>
            	<td>Place Of Brith:</td>
                <td>
                	<input type="text" name="pobtxt" id="textbox" pattern="[A-Za-z]{4,15}" maxlength="15" required/>
                
                </td>
            </tr>
            <tr>
            	<td>Address:</td>
            	<td>
                	<textarea name="addrtxt" cols="22" rows="3" pattern="[a-zA-Z0-9 ]{10,150}" required></textarea>
    			</td>
        	</tr>
            
            <tr>
                <td colspan="2">
                	<input type="reset" value="Cancel" id="button-in"/>
                	<input type="submit" name="btn_sub" value="Register" id="button-in" onclick="validatedate(document.form1.text1)" />
                </td>
            </tr>
	  </table>
    </div>
 
	<div>
	  <table border="0" cellpadding="4" cellspacing="0">
	    <tr>
	      <td>Phone:</td>
	      <td><input type="text" name="phonetxt" id="textbox" pattern="[0-9]{10}" maxlength="10" required/></td>
        </tr>
	    <tr>
	      <td>E-mail:</td>
	      <td><input type="text" name="emailtxt"  id="textbox" pattern="[a-zA-Z0-9-_\.]+@[a-zA-Z]+\.[a-zA-Z]{2,3}" required/></td>
        </tr>
	    <tr>
	      <td>Note:</td>
	      <td><textarea name="notetxt" cols="22" rows="5" required></textarea></td>
        </tr>
      </table>
      
	</div>
    </form>

</div><!-- end of style_informatios -->
<?php
}
?>
<script src="date.js"></script>
</body>
</html>