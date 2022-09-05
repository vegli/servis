<?php
    include "database.php";
?>
<!DOCTYPE htmml>
<html>
<head>
    <title>Auto Servis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <header id="header">
        <section id="branding">
            <h1><span class="highlight">Auto servis</span></h1>
        </section>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Pocetna</a></li>
            <li class="dropdown"><a href="#" >Servis centri</a>
                <ul class="submenu">
                    <li><a href="#scp">Prikazi</a></li>
                    <li><a href="#scu">Unesi novi</a></li>
                    <li><a href="#sci">Izmeni</a></li>
                    <li><a href="#sco">Obrisi</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#" >Servisirani automobili</a> 
                <ul class="submenu">
                    <li><a href="#sap">Prikazi</a></li>
                    <li><a href="#sau">Unesi novi</a></li>
                    <li><a href="#sao">Obrisi</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <section id="showcase"></section>
    <section id="scp">
        <div class="container">
            <h3>Prikazi sve servis centre</h3>
            <button id="scpb">Prikazi</button>
            <div class="scp" id="tabela_servisi"></div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#scpb").click(function (){
                            $(".scp").load("obrada.php");
                        })
                    });
                </script>
                <script>
                    $(document).ready(function(){
                        $(document).on('click', '.column_sort', function(){
                            var column_name = $(this).attr("id");
                            var order = $(this).data("order");
                            $.ajax({
                                url:"obrada1v2.php",
                                method:"POST",
                                data:{column_name:column_name, order:order},
                                success:function(data){
                                    $('#tabela_servisi').html(data);
                                }
                            })
                        })
                    })
                </script>
        </div>
    </section>
    <section id="scu">
        <div class="container">
            <h3>Unesi novi servis centar</h3>
            <form method="post" action="">
                <ul class="wrapper">
                    <li class="form-row">
                        <label>Naziv:</label></br>
                        <input type="text" name="naziv" required>
                    </li>
                    <li class="form-row">
                        <label>Lokacija:</label></br>
                        <input type="text" name="lokacija" required>
                    </li>
                    <li class="form-row">
                        </br>
                        <button type="submit" name="unos" value="Ubaci">Unesi</button>
                    </li>
                </ul>
            </form>
        </div>
<?php
if (isset($_POST["unos"])){
    if (isset($_POST['naziv']) && isset($_POST['lokacija'])){
        $naziv = $_POST['naziv'];
        $lokacija = $_POST['lokacija'];
        $sql="INSERT INTO servisi (naziv, lokacija) VALUES ('".$naziv."', '".$lokacija."')";
        if ($mysqli->query($sql)){
            echo "<p>Servis je ubacen!</p>";
        } else {
            echo "<p>Servis nije ubacen!</p>";
        }
    } else {
        echo "Nisu prosleđeni parametri!";
    }
    //header("location: index.php");
    //$mysqli->close();
}
?>
    </section>
    <section id="sci">
        <div class="container">
            <h3>Izmeni servis centar</h3>
            <form method="post" action="">
                <ul class="wrapper">
                    <li class="form-row">
                        <label>ID izmene:</label></br>
                        <input type="text" name="idp" required>
                    </li>
                    <li class="form-row">
                        <label">ID:</label></br>
                        <input type="text" name="id" required>
                    </li>
                    <li class="form-row">
                        <label>Naziv:</label></br>
                        <input type="text" name="naziv" required>
                    </li>
                    <li class="form-row">
                        <label>Lokacija:</label></br>
                        <input type="text" name="lokacija" required>
                    </li>
                    <li class="form-row">
                        </br>
                        <button type="submit" name="izmeni" value="Izmeni">Izmeni</button>
                    </li>
                </ul>
            </form>
<?php
if (isset($_POST["izmeni"])){
    if (isset($_POST['id']) && isset($_POST['naziv']) && isset($_POST['naziv']) && isset($_POST['idp'])){
        $idp = $_POST['idp'];
        $id = $_POST['id'];
        $naziv = $_POST['naziv'];
        $lokacija = $_POST['lokacija'];
        $sql="UPDATE servisi SET id='".$id."', naziv='".$naziv."', lokacija='".$lokacija."' WHERE id=".$idp;
        if ($mysqli->query($sql)){
            if ($mysqli->affected_rows > 0 ){
                echo "<p>Servis je izmenjen.</p>";
            } else {
                echo "<p>Servis nije izmenjen.</p>";
            }
        } else {
            echo "<p>Greska!</p>";
        }
    } else {
        echo "<p>Nisu prosledjeni parametri!</p>";
    }
            
}
?>

        </div>
    </section>
    <section id="sco">
        <div class="container">
            <h3>Obrisi servis centar</h3>
            <form method="post" action="">
                <ul class="wrapper">
                    <li class="form-row">
                        <label for="name">ID:</label></br>
                        <input type="text" name="id" required>
                    </li>
                    <li class="form-row">
                        </br>
                        <button type="submit" name="obrisi" value="Obrisi">Obrisi</button>
                    </li>
                </ul>
            </form>
<?php
if(isset($_POST["obrisi"])){
    if (isset ($_POST['id'])){
    $id = $_POST['id'];
    $upit = "DELETE FROM servisi WHERE id=".$id;
    if ($mysqli->query($upit)){
        echo "<p>Servis je izbrisan!</p>";
    } else {
    echo "<p>Servis nije izbrisan!</p>";
    }
}
}
?>
        </div>
    </section>
    <section id="sap">
        <div class="container">
            <h3>Prikazi servisirane automobile</h3>
            <button id="sapb">Prikazi</button>
            <div class="sap" id="tabela_automobili"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#sapb").click(function (){
                        $(".sap").load("obrada2.php");
                    })
                });
            </script>
            <script>
                $(document).ready(function(){
                    $(document).on('click', '.column_sort2', function(){
                        var column_name = $(this).attr("id");
                        var order = $(this).data("order");
                        $.ajax({
                            url:"obrada2v2.php",
                            method:"POST",
                            data:{column_name:column_name, order:order},
                            success:function(data){
                                $('#tabela_automobili').html(data);
                            }
                        })
                    })
                })
                </script>
        </div>
    </section>
    <section id="sau">
        <div class="container">
            <h3>Unesi novi servisirani automobil</h3><form method="post" action="">
                <ul class="wrapper">
                    <li class="form-row">
                        <label>Marka:</label></br>
                        <select name="marka" id= "1" required>
                            <option selected = "selected" >Izaberi marku</option>
                            <option value="1">Citroen</option>
                            <option value="2">Peugeot</option>
                            <option value="3">Renault</option>
                        </select>
                    </li>
                    <li class="form-row">
                        <label>Model:</label></br>
                        <select name="model" id="2" required>
                            <option selected = "selected" ></option>
                        </select>
                    </li>
                    <li class="form-row">
                        <label>ID servisa:</label></br>
                        <select name="id4" id="3" required>
            <?php
                $sql=mysqli_query($mysqli, "SELECT id FROM servisi");
                while ($row = $sql->fetch_assoc()){
                    echo '<option value="' .$row['id']. '">' .$row['id']. '</option>';
                }
            ?>
                        </select>
                    </li>
                    <li class="form-row">
                        <label>Datum:</label></br>
                        <input class="input4" type="Date" name="date" required><br>
                    </li>
                    <li class="form-row">
                        </br>
                        <button type="submit" name="submit2" value="Obrisi">Unesi</button>
                    </li>
                </ul>
            </form>
        </div>
<?php
if (isset($_POST["submit2"])){
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $valueMarka = array("1" => "Citroen", "2" => "Peugeout", "3" => "Renault");
    if ($marka==1){
        $valueModel =array("1" => "C2", "2" => "C3", "3" => "C4", "4" => "C6");
    } elseif ($marka==2){
        $valueModel =array("1" => "206", "2" => "307", "3" => "407", "4" => "RCZ");
    } else{
        $valueModel =array("1" => "Clio", "2" => "Megane", "3" => "Laguna", "4" => "Scenic");
    }

    $marka_text = $valueMarka[$marka];
    $model_text = $valueModel[$model];
    $id = $_POST['id4'];
    $date = $_POST['date'];
    $stmt = $mysqli->prepare("INSERT INTO automobili (marka, model, datum, servis_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param( "ssss", $marka_text, $model_text, $date, $id);
    $stmt->execute();
}
?>
<script>
    var Citroen = ["C2","C3","C4","C6"];
    var Peugeot = ["206","307","407","RCZ"];
    var Renault = ["Clio","Megane","Laguna","Scenic"];

    document.getElementById("1").addEventListener("change", function(e){
            var select2 = document.getElementById("2");
            select2.innerHTML = "";
            var aItems = [];
        if(this.value == "2"){
            aItems = Peugeot;
        } else if (this.value == "3") {
            aItems = Renault;
        } else if(this.value == "1") {
            aItems = Citroen;
        }
        for(var i=0,len=aItems.length; i<len;i++) {
            var option = document.createElement("option");
            option.value= (i+1);
            var textNode = document.createTextNode(aItems[i]);
            option.appendChild(textNode);
            select2.appendChild(option);
        }
        
    }, false);
</script>
    </section>
    <section id="sao">
        <div class="container">
            <h3>Obrisi servisirani automobil</h3>
            <form method="post" action="">
                <ul class="wrapper">
                    <li class="form-row">
                        <label>ID:</label>
                        <input type="text" name="id" required>
                    </li>
                    <li class="form-row">
                        </br>
                        <button type="submit" name="obrisia" value="Obrisi">Obrisi</button>
                    </li>
                </ul>
            </form>
<?php
if(isset($_POST["obrisia"])){
    if (isset ($_POST['id'])){
    $id = $_POST['id'];
    $upit = "DELETE FROM automobili WHERE id=".$id;
    if ($mysqli->query($upit)){
        echo "<p>Servisirani automobil je izbrisan!</p>";
    } else {
    echo "<p>Servisirani automobil nije izbrisan!</p>";
    }
}
}
?>
        </div>
    </section>
    <footer>
        <p>Auto servis, Copyright &copy; 2022</p>
    </footer>


</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>