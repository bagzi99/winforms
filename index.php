
<?php 
    include_once 'connection.php';
    $query1="SELECT mestoID,naziv FROM mesto";
    $result1=sqlsrv_query($conn,$query1); 
    //selektujemo tabelu mesto, i tako u pri unosu u tabelu zaposleni za polje mesto dobijamo ponudjena mesta koja su vec uneta u tabelu mesto
    $query2="SELECT radnoMestoID,pozicija FROM radnoMesto";
    $result2=sqlsrv_query($conn,$query2);
    //selektujemo tabelu radnoMesto, i tako u pri unosu u tabelu zaposleni za polje pozicija,na radnom mestu dobijamo ponudjene pozicije koje su vec unete u tabelu radnoMesto

?>

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
            <div class="row" >
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                    <h2 class="display-6 m-4">Zaposleni</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                 <div class="m-5">
                    <div class="forma">
                        
                            
                         <form  method='post'>
                           <input type="text" name="id" id="id" readonly >
                                <div class="mb-3">
                                 <label for="exampleInputEmail1" class="form-label">Ime:</label>
                                 <input type="text" name="ime" class="form-control" id="ime"  >
                                                    
                                </div>
                                <div class="mb-3">
                                 <label for="exampleInputPassword1" class="form-label">Prezime:</label>
                                 <input type="text" name="prezime"class="form-control" id="prezime">
                                                    
                                </div>
                                <div class="mb-3">
                                 <label for="exampleInputPassword1" class="form-label">Datum rodjenja:</label>
                                 <input type="date"  name="datumRodjenja" class="form-control" id="datumRodjenja">
                                                    
                                </div>
                                                
                                                
                                <div class=mb-3>

                                               
                                 <label  class="form-label">Bračni status:</label>
                                 <div class="form-check">
                                 <input  type="radio" name="bracniStatus"  value="U braku" >
                                 <label class="form-check-label" >
                                         Ozenjen/udata
                                 </label>
                                </div>
                                 <div class="form-check">
                                    <input  type="radio" name="bracniStatus"   value="Nije u braku"  >
                                    <label class="form-check-label" >
                                         Neozenjen/neudata

                                    </label>
                                 </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Pozicija na poslu:</label>
                                    <select class="form-select" id="pozicija" name="pozicija" aria-label="Default select example">
                                    <option selected>Unesite poziciju na poslu</option>
                                     <?php while($row=sqlsrv_fetch_array($result2)):; ?>
                                     
                                     <option><?php echo $row['pozicija']; ?></option>
                                        <?php endwhile; ?>
                                     <option>--Ukoliko je nema unesite je provo u tabelu radno mesto--</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mesto stanovanja:</label>
                                    <select class="form-select" id="mestoStanovanja" name="mestoStanovanja" aria-label="Default select example">
                                    <option selected>Unesite mesto stanovanja</option>
                                    <?php while($row=sqlsrv_fetch_array($result1)):; ?>
                                        
                                        <option><?php echo $row['naziv']; ?></option>
                                        <?php endwhile; ?>
                                        <option>--Ukoliko ga nema unesite ga prvo u tabelu mesto--</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                        
                                    <button type="submit" id="dugme" name="unosZaposleni" class="btn btn-success">Unesi</button>
                                    <button type="submit" name='update' id="update"  class="btn btn-warning">Izmeni</button>
                                    <button type="submit" name="delete" class="btn btn-danger">Obrisi</button>
                                </div>
                                        
                                        
                        </form>                      
                           
                      </div>      
                    </div>
                </div>
            </div>
                
        <div class="col-lg-8">
            <div class="tabela">
                <div class="display-7">
                 <?php 

include_once 'connection.php';


if (isset($_POST['unosZaposleni'])) {   //unosZaposleni je naziv dugmeta koje sluzi za unos
    
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $datumRodjenja=$_POST['datumRodjenja'];
    $bracniStatus=$_POST['bracniStatus'];

    $pozicija=$_POST['pozicija'];
    $pozicijaID="SELECT radnoMestoID FROM radnoMesto WHERE pozicija='$pozicija'";
    $pozicijaRes=sqlsrv_query($conn,$pozicijaID);
    while($row=sqlsrv_fetch_array($pozicijaRes)):;
        $pozicijaRes1=$row['radnoMestoID'];
        endwhile;

    $mesto=$_POST['mestoStanovanja'];
    $mestoID="SELECT mestoID FROM mesto WHERE naziv='$mesto'";
    $mestoRes=sqlsrv_query($conn,$mestoID); 
    while($row=sqlsrv_fetch_array($mestoRes)):;
        $mestoRes1=$row['mestoID'];
         endwhile;
    

    $sql="INSERT INTO zaposleni(ime,prezime,godRodjenja,bracniStatus,radnoMestoID,mestoID)values('$ime','$prezime','$datumRodjenja','$bracniStatus','$pozicijaRes1','$mestoRes1')";
    
    $stmt = sqlsrv_query( $conn, $sql);
        if( $stmt === false ) {
             die( print_r( sqlsrv_errors(), true));
        }

}
 // ISPIS PODATAKA U TABELU
 
 

$sql="SELECT zaposleni.zaposleniID,zaposleni.ime,zaposleni.prezime,zaposleni.godRodjenja,zaposleni.bracniStatus,zaposleni.radnoMestoID,zaposleni.mestoID,radnoMesto.radnoMestoID,radnoMesto.pozicija,mesto.mestoID,mesto.naziv FROM zaposleni,radnoMesto,mesto WHERE zaposleni.radnoMestoID=radnoMesto.radnoMestoID AND zaposleni.mestoID=mesto.mestoID";
      

//$sql = "SELECT zaposleniID,ime,prezime ,godRodjenja ,bracniStatus,radnoMestoID,mestoID FROM zaposleni ";

$stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
    }

    echo "<table id='tabelaBaze' class='tabelaIspis'>";
    echo " <tr class='red'><th>#</th> <th>Ime</th> <th>Prezime</th><th>Datum rodjenja</th> <th>Bračni status</th> <th>Pozicija</th> <th>Mesto stanovanja</th></tr>";
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
         echo "<tr id='redTabela'><td>". $row["zaposleniID"] . "</td><td>" . $row["ime"] . "</td><td>" . $row["prezime"] . "</td><td>" . $row["godRodjenja"] . "</td><td>" . $row["bracniStatus"] . "</td><td>" .$row["pozicija"]. "</td><td>" . $row["naziv"] . "</td></tr>";
     }
    echo "</table>";   
    sqlsrv_free_stmt( $stmt);   
         

       
       
    
    
        
    

        
            
    if(isset($_POST['update'])){
    $id=$_POST['id'];           
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $datumRodjenja=$_POST['datumRodjenja'];
    $bracniStatus=$_POST['bracniStatus'];

    $pozicija=$_POST['pozicija'];
    $pozicijaID="SELECT radnoMestoID FROM radnoMesto WHERE pozicija='$pozicija'";
    $pozicijaRes=sqlsrv_query($conn,$pozicijaID);
    while($row=sqlsrv_fetch_array($pozicijaRes)):;
        $pozicijaRes1=$row['radnoMestoID'];
        endwhile;

    $mesto=$_POST['mestoStanovanja'];
    $mestoID="SELECT mestoID FROM mesto WHERE naziv='$mesto'";
    $mestoRes=sqlsrv_query($conn,$mestoID); 
    while($row=sqlsrv_fetch_array($mestoRes)):;
        $mestoRes1=$row['mestoID'];
         endwhile;

                $update= "UPDATE zaposleni SET ime='$ime',prezime='$prezime',godRodjenja='$datumRodjenja',bracniStatus='$bracniStatus',radnoMestoID='$pozicijaRes1',mestoID='$mestoRes1' WHERE zaposleniID='$id'";
                $result=sqlsrv_query($conn,$update);
                echo "<meta http-equiv='refresh' content='0'>";
                
      }

            if(isset($_POST['delete'])){
                
                $id=$_POST['id'];
                

                $delete= "DELETE FROM zaposleni  WHERE zaposleniID='$id'";
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
        document.getElementById("ime").value = this.cells[1].innerHTML;
        document.getElementById("prezime").value = this.cells[2].innerHTML;
        document.getElementById("datumRodjenja").value = this.cells[3].innerHTML;
        //document.getElementById("bracniStatus").value = this.cells[4].innerHTML;
        document.getElementById("pozicija").value = this.cells[5].innerHTML;
        document.getElementById("mestoStanovanja").value = this.cells[6].innerHTML;

    }
}
    </script>
                            
             </div>
                        
            </div>
         </div>
     </div>


      




 </div>           
      <!-- Kraj stranice zaposeni --> 
      
      <!-- Pocetak stranice radno mesto -->    
      
<script src="main.js"></script>





   
</body>
</html>