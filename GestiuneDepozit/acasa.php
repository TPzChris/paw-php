<?php 
require('connection.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestiune materiale de constructie</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <a href ="http://localhost/GestiuneDepozit/login.php">Sign out</a>
	<header>
		<div class="main">
			<ul>
				<li class="active"><a href="http://localhost/GestiuneDepozit/acasa.php">Acasa</a></li>
                                <li><a href="http://localhost/GestiuneDepozit/categChart.php">Categorii</a>
                                    <ul>
                                <?php 
                                $sql = "select den from categ";
                                $results = mysqli_query($con, $sql);
                                while($rows = $results->fetch_assoc()){
                                 ?>  
                                   <li><a href="http://localhost/GestiuneDepozit/produse.php?categ=<?php echo $rows['den'] ?>"><?php echo $rows['den'] ?></a></li> 
                               
                                <?php  
                               
    
                                }
                                ?>  
                                    </ul>
                                </li>
                                <?php 
                                session_start();
                               // echo $_SESSION["tip"];
                                if($_SESSION['tip'] == 'admin') { ?>
                                <li><a href="#">Meniu</a>	
					<ul>
                                            <li><a href="http://localhost/GestiuneDepozit/clienti.php">Clienti</a></li>
					    <li><a href="http://localhost/GestiuneDepozit/vanzari.php">Vanzari</a></li>	
					</ul>
				</li>
                                <?php } ?>
			</ul>
		</div>
	</header>
    
    <form action="http://localhost/GestiuneDepozit/acasa.php" method="post" name = "search" id = "search">
        <label>Denumire:</label><input type="text" name="search">
        <input type="submit" name="submit" value="Search">
    </form>
    
    
    
    
    
    <table border="2px solid" width="65%" align="center">
        <tbody>
        <tr>
       <?php   if($_SESSION['tip'] == 'admin') { ?>  <th>ID Categorie</th> <?php } ?>
            <th>Categorie</th>
       <?php   if($_SESSION['tip'] == 'admin') { ?>  <th>ID Produs</th> <?php } ?>
            <th>Denumire Produs</th>
            <th>Stoc</th>
            <th>Data Aparitiei</th>
            <th>Descriere</th>
       <?php   if($_SESSION['tip'] == 'admin') { ?>  <th>ID Secificatii</th> <?php } ?>
            <th>Culoare</th>
            <th>Utilizare</th>
            <th>Material</th>
            <th>Pret</th>
            <!--<th>Cantitate Disponibila</th>-->
            <th>Poza</th>
        </tr>
        
    <?php
    if(!empty($_POST["search"])){
    $search_value=$_POST["search"];
    $sql="SELECT p.*, s.*, c.* FROM prod p, specif s, categ c WHERE c.categID = p.categID AND s.produsID = p.produsID and p.denumire = '".$search_value."'";
    }
    else{
    $sql="SELECT p.*, s.*, c.* FROM prod p, specif s, categ c WHERE c.categID = p.categID AND s.produsID = p.produsID";
    
    }
    $resultSet = mysqli_query($con, $sql);
       if(mysqli_num_rows($resultSet)){
            while ($row = mysqli_fetch_assoc($resultSet)){ ?>
                
            <tr>
<?php   if($_SESSION['tip'] == 'admin') { ?>  <td><?php echo $row['categID'] ?></td> <?php  } ?>
                <td><?php echo $row['den'] ?></td>
<?php   if($_SESSION['tip'] == 'admin') { ?>  <td><?php echo $row['produsID'] ?></td> <?php } ?>
                <td><?php echo $row['denumire'] ?></td>
                <td><?php echo $row['stoc'] ?></td>
                <td><?php echo $row['dataAparitiei'] ?></td>
                <td><?php echo $row['descriere'] ?></td>
<?php   if($_SESSION['tip'] == 'admin') { ?>  <td><?php echo $row['specifID'] ?></td> <?php } ?>
                <td><?php echo $row['culoare'] ?></td>
                <td><?php echo $row['utiliz'] ?></td>
                <td><?php echo $row['material'] ?></td>
                <td><?php echo $row['pret'] ?></td>
                <!--<td><?php echo $row['cantDisp'] ?></td>-->
                <td><img src="data:image/jpeg;base64,<?php echo base64_encode( $row['imagine'] ); ?>"</td>
                
            </tr>
            
            
        <?php    }
        } 
    
    ?>
        </tbody>
        
    </table>
    
    
</body>
</html>
        
        
