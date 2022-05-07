<?php  
require('connection.php');
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT c.id_user, c.name, c.email, c.nr_telefon, c.sex, c.tara, c.tip FROM login c";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                        <th>ID Client</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Numar telefon</th>
                        <th>Sex</th>
                        <th>Tara</th>
                        <th>Tip cont</th>    
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["id_user"].'</td>  
                         <td>'.$row["name"].'</td>  
                         <td>'.$row["email"].'</td>  
                         <td>'.$row["nr_telefon"].'</td>  
                         <td>'.$row["sex"].'</td>  
                         <td>'.$row["tara"].'</td>
                         <td>'.$row["tip"].'</td>
</tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>