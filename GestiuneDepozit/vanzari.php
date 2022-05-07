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
                                            <li><a href="http://localhost/GestiuneDepozit/clienti.php">Clienti</a></li>
					    <li class="active"><a href="http://localhost/GestiuneDepozit/vanzari.php">Vanzari</a></li>	
					</ul>
				</li>
                                <?php } ?>
			</ul>
		</div>
	</header>
    
    <form action="http://localhost/GestiuneDepozit/vanzari.php" method="post" name = "search" id = "search">
        <label>Username:</label><input type="text" name="search">
        <input type="submit" name="submit" value="Search">
    </form>
    
    <form action="http://localhost/GestiuneDepozit/vanzari.php" method="post" name = "date" id = "date">
        <label>Filtrare data:</label><input type="text" name="date">
        <input type="submit" name="data" value="Inainte de">
        <input type="submit" name="data" value="Dupa">
    </form>
    
    
    <form action="vanzari.php" method="post" name = "sort" id = "sort">
                    <label>Ordonare dupa categorii</label>
                    
                    <input type="submit" name="s" value="Sort">
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
            <th>ID Vanzare</th>
            <th>Data vanzarii</th>
            <th>Cantitate vanduta</th>
            <th>ID Categorie</th>
            <th>Categorie</th>
            <th>ID Produs</th>
            <th>Denumire Produs</th>
            <th>Data Aparitiei</th>
            <th>Descriere</th>
            <th>ID Secificatii</th>
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
    $sql="SELECT cl.*, v.*, p.*, s.*, c.* FROM prod p, specif s, categ c, login cl, vanzare v WHERE v.vanzareID = s.vanzareID AND cl.id_user = v.id_user AND c.categID = p.categID AND s.produsID = p.produsID and cl.name = '".$search_value."'";
    
    
    }
    
    elseif(!empty($_POST["date"])){
        if($_POST["data"] === 'Inainte de'){
                $search_value=$_POST["date"];
                $sql="SELECT cl.*, v.*, p.*, s.*, c.* FROM prod p, specif s, categ c, login cl, vanzare v WHERE v.vanzareID = s.vanzareID AND cl.id_user = v.id_user AND c.categID = p.categID AND s.produsID = p.produsID and v.dataV < '".$search_value."'";
                
        }
        elseif($_POST["data"] === 'Dupa'){
                $search_value=$_POST["date"];
                $sql="SELECT cl.*, v.*, p.*, s.*, c.* FROM prod p, specif s, categ c, login cl, vanzare v WHERE v.vanzareID = s.vanzareID AND cl.id_user = v.id_user AND c.categID = p.categID AND s.produsID = p.produsID and v.dataV > '".$search_value."'";
                
        }
    }
    
     
    elseif(isset($_POST['s'])){
    
   
    $sql="SELECT cl.*, v.*, p.*, s.*, c.* FROM prod p, specif s, categ c, login cl, vanzare v WHERE v.vanzareID = s.vanzareID AND cl.id_user = v.id_user AND c.categID = p.categID AND s.produsID = p.produsID order by c.den";
    
    
    }
    else{
        $sql="SELECT cl.*, v.*, p.*, s.*, c.* FROM prod p, specif s, categ c, login cl, vanzare v WHERE v.vanzareID = s.vanzareID AND cl.id_user = v.id_user AND c.categID = p.categID AND s.produsID = p.produsID";
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
                <td><?php echo $row['vanzareID'] ?></td>
                <td><?php echo $row['dataV'] ?></td>
                <td><?php echo $row['cant'] ?></td>
                <td><?php echo $row['categID'] ?></td>
                <td><?php echo $row['den'] ?></td>
                <td><?php echo $row['produsID'] ?></td>
                <td><?php echo $row['denumire'] ?></td>
                <td><?php echo $row['dataAparitiei'] ?></td>
                <td><?php echo $row['descriere'] ?></td>
                <td><?php echo $row['specifID'] ?></td>
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
        
        
