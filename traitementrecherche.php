<!doctype html>
<html>
<head>
<meta charset="utf-8"/> 
</head>
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>
</head>
<body>

<?php
echo "<center>";
$mots=$_POST['mot'];
if(!(empty($mots)))
{
    $connexion=mysqli_connect("localhost", "root", "");
    if ($connexion){ 

        $bd = mysqli_select_db($connexion,"indexation");
        if ($bd){

            $requete ="SELECT doc_title,doc_path from document WHERE doc_keys LIKE '%$mots%'";
            $resultat = mysqli_query($connexion,$requete);
            if(mysqli_num_rows($resultat)>0){

                echo"<table width=60% class=styled-table>";
                echo"<tr><th>num</th><th>titre</th><th>adresse</th></tr>";
                $index=0;
                while($ligne =mysqli_fetch_row($resultat))
                {
                    $index=$index+1;
                    $title=$ligne[0];
                    $path=$ligne[1];

                    echo"<tr><td>$index</td><td>$title</td><td>$path</td></tr>";
                }
                echo"</table>";
                echo"<b>Recherche Terminée";
                echo"<p>il exist ".$index." fichier</p>";
            }
            else echo" <p><b>aucun document avec ce mot cle</p>";
        }else echo "<p>Base de données inconnue</p>";
    }else echo" <p><b>Erreur de connexion</p>";
}else echo"<p> la mot saisi est vide</p>";
echo "<center>";
?>
</body>
</html>