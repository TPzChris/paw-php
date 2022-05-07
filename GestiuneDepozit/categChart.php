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
					    <li><a href="http://localhost/GestiuneDepozit/vanzari.php">Vanzari</a></li>	
					</ul>
				</li>
                                <?php } ?>
			</ul>
		</div>
	</header>
    
    
    <?php 
    $sql="SELECT c.den, count(*) as number FROM prod p, specif s, categ c WHERE c.categID = p.categID AND s.produsID = p.produsID group by c.den";
    $resultSet = mysqli_query($con, $sql);
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Categorie', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($resultSet))  
                          {  
                               echo "['".$row["den"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Pondere categorii',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  
    
   
    <br /><br />  
           <div style="width:900px;">  
                <h3 align="center">Make Simple Pie Chart by Google Chart API with PHP Mysql</h3>  
                <br />  
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
           </div>  
    
</body>
</html>
        
        
