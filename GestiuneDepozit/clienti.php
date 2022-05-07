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
				<li><a href="http://localhost/GestiuneDepozit/acasa.php">Acasa</a></li>
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
                                            <li class="active"><a href="http://localhost/GestiuneDepozit/clienti.php">Clienti</a></li>
					    <li><a href="http://localhost/GestiuneDepozit/vanzari.php">Vanzari</a></li>	
					</ul>
				</li>
                                <?php } ?>
			</ul>
		</div>
	</header>
    
    <form action="http://localhost/GestiuneDepozit/clienti.php" method="post" name = "search" id = "search">
        <label>Username:</label><input type="text" name="search">
        <input type="submit" name="submit" value="Search">
    </form>
    
    
    
    
    
    <table border="2px solid" width="65%" align="center">
        <tbody>
        <tr>
            <th>ID Client</th>
            <th>Username</th>
            <th>Email</th>
            <th>Numar telefon</th>
            <th>Sex</th>
            <th>Tara</th>
            <th>Tip cont</th>  
        </tr>
        
    <?php
    if(!empty($_POST["search"])){
    $search_value=$_POST["search"];
    $sql="SELECT c.* FROM login c WHERE c.name = '".$search_value."'";
    
    }
    else{
        
        $sql="SELECT c.* FROM login c";
       
    }
    $resultSet = mysqli_query($con, $sql);
       if(mysqli_num_rows($resultSet)){
            while ($row = mysqli_fetch_assoc($resultSet)){ ?>
                
            <tr>
                <td><?php echo $row['id_user'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['nr_telefon'] ?></td>
                <td><?php echo $row['sex'] ?></td>
                <td><?php echo $row['tara'] ?></td>
                <td><?php echo $row['tip'] ?></td>
                
                
            </tr>
            
            
        <?php    }
        } 
    
    ?>
        </tbody>
        
    </table>
     
    <form method="post" action="mypdfgenerator.php">
     <input type="submit" name="pdf" class="btn btn-success" value="PDF" />
    </form>
    <form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Excel" />
    </form>
    
</body>
</html>
        
        
