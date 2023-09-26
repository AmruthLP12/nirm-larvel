<?php
if(!isset($_SESSION)){ session_start();} 

include("../config.php");
if(!isset($_SESSION['login']) && ($_SESSION['login'] != 'true'))
{
header("location:../index.php");
}	
include_once('function.php');

if(isset($_POST['pageId']) && !empty($_POST['pageId']))
{
$id=$_POST['pageId'];
}
else
{
$id='0';
}
$i=1;
$pageLimit=PAGE_PER_NO*$id;
$sql="select * from client ORDER BY id ASC limit $pageLimit,".PAGE_PER_NO;
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result))
		{
									$id=$row['id'];
									$en_id=base64_encode($id);
									echo '
											<tr>
											<td>'.$i.'</td>
											<td>'.$row['client_name'].'</td>
											<td>'.$row['user_name'].'</td>
											<td>'.$row['email'].'</td>
											<td>'.$row['phone'].'</td>
											<td><a href="edit_client.php?id='.$en_id.'" ><i class="fa fa-pencil"></i></a></td>							
											<td><a href="#" id="'.$row['id'].'" onclick="delete_client(this.id)"><i class="fa fa-trash-o"></i></a></td>							
											</tr>
									';
									$i++;
								}
?>