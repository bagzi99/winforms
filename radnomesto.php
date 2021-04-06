<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleW.css">
    <title>WinForms</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
<nav class="navbar">
    <div class="content">
      <div class="logo">
        <a href="index.php">WinForms</a>
      </div>
      <ul class="menu-list">
        <div class="icon cancel-btn">
          <i class="fas fa-times"></i>
        </div>
        <li><a href="index.php">Zaposleni</a></li>
        <li><a href="radnomesto.php">Radno mesto</a></li>
        <li><a href="mesto.php">Mesto</a></li>
      </ul>
      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>
<!-- Pocetak stranice zaposeni -->
<div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                    <h2 class="display-6 m-4">Radno mesto</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="forma">
                        
                            
                         <form  method='post'>
                           <input type="text" name="id" id="id" readonly >
                                <div class="mb-3">
                                 <label for="exampleInputEmail1" class="form-label">Pozicija:</label>
                                 <input type="text" name="pozicija" class="form-control" id="pozicija"  >
                                                    
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Stručna sprema:</label>
                                    <select class="form-select" id="strucnaSprema" name="strucnaSprema" aria-label="Default select example">
                                    <option selected>Unesite stručnu spremu</option>
                                     <option value="Srednja škola">Srednja škola</option>
                                     <option value="Strukovne studije">Strukovne studije</option>
                                     <option value="Akademske studije">Akademske studije</option>
                                     <option value="Master studije">Master studije</option>
                                     <option value="Doktorske studije">Doktorske studije</option>

                                    </select>
                                </div>
                                        
                                <div class=mb-3>

                                               
                                 <label  class="form-label">Radno iskustvo:</label>
                                 <div class="form-check">
                                 <input  type="radio" name="radnoIskustvo"  value="Obavezno" >
                                 <label class="form-check-label" >
                                         Obavezno
                                 </label>
                                </div>
                                 <div class="form-check">
                                    <input  type="radio" name="radnoIskustvo"   value="Nije obavezno"  >
                                    <label class="form-check-label" >
                                         Nije obavezno

                                    </label>
                                 </div>
                                
                                <div class="mb-3">
                                        
                                    <button type="submit" id="dugme" name="unosRadnoMesto" class="btn btn-success">Unesi</button>
                                    <button type="submit" name='update' id="update"  class="btn btn-warning">Izmeni</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Obrisi</button>
                                </div>
                                        
                                        
                        </form>                      
                           
                            
                    </div>
                </div>
            </div>
                
        <div class="col-lg-9">
            <div class="tabela">
                
                 <?php 

include_once 'connection.php';


if (isset($_POST['unosRadnoMesto'])) {   //unosZaposleni je naziv dugmeta koje sluzi za unos
    
    $pozicija=$_POST['pozicija'];
    $strucnaSprema=$_POST['strucnaSprema'];
    $radnoIskustvo=$_POST['radnoIskustvo'];


    $sql="INSERT INTO radnoMesto(pozicija,strucnaSprema,radnoIskustvo)values('$pozicija','$strucnaSprema','$radnoIskustvo')";
    
    $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {
             die( print_r( sqlsrv_errors(), true));
        }

}
    


$sql = "SELECT radnoMestoID,pozicija,strucnaSprema,radnoIskustvo FROM radnoMesto ";

$stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
    }

    echo "<table id='tabelaBaze' class='tabelaIspis'>";
    echo " <tr class='red'><th>id</th> <th>Pozicija</th> <th>Stručna sprema</th><th>Radno iskustvo</th> </tr>";
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        
        
        echo "<tr id='redTabela'><td>". $row["radnoMestoID"] . "</td><td>" . $row["pozicija"] . "</td><td>" . $row["strucnaSprema"] . "</td><td>" . $row["radnoIskustvo"] . "</td></tr>";
         

       
       
    }
    echo "</table>";
    
        
    sqlsrv_free_stmt( $stmt);

        
            
    if(isset($_POST['update'])){
        $id=$_POST['id'];
        $pozicija=$_POST['pozicija'];
        $strucnaSprema=$_POST['strucnaSprema'];
        $radnoIskustvo=$_POST['radnoIskustvo'];

    

                $update= "UPDATE radnoMesto SET pozicija='$pozicija',strucnaSprema='$strucnaSprema',radnoIskustvo='$radnoIskustvo' WHERE radnoMestoID='$id'";
                $result=sqlsrv_query($conn,$update);
                echo "<meta http-equiv='refresh' content='0'>";
                
      }

            if(isset($_POST['delete'])){
                
                $id=$_POST['id'];
                

                $delete= "DELETE FROM radnoMesto  WHERE radnoMestoID='$id'";
                $result=sqlsrv_query($conn,$delete);
                echo "<meta http-equiv='refresh' content='0'>";
            }
        
        
  ?>  
        <script>
            // POPUNJAVA POLJA SA PODACIMA IZ TABELE U POLJA FORME

var tabelaBaze = document.getElementById('tabelaBaze');

for(var i = 1; i < tabelaBaze.rows.length; i++){
    tabelaBaze.rows[i].onclick = function() {
        document.getElementById("id").value = this.cells[0].innerHTML;
        document.getElementById("pozicija").value = this.cells[1].innerHTML;
        document.getElementById("strucnaSprema").value = this.cells[2].innerHTML;
        document.getElementById("radnoIskustvo").value = this.cells[3].innerHTML;
        

    }
}
        </script>
                            
            
                        
            </div>
         </div>
     </div>
 </div>           
      <!-- Kraj stranice zaposeni --> 
      
      <!-- Pocetak stranice radno mesto -->    
      
<script src="main.js"></script>





   
</body>
</html>