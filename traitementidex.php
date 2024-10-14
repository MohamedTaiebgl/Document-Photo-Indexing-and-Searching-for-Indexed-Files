<html>
<head>
<meta charset="utf-8"/> 
</head>
<?php
$titre=$_POST['titre'];
$mots=$_POST["mot"];
$path='';
echo"<center>";

if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
{
        if ($_FILES['monfichier']['size'] <= 1000000)
        {
                $infosfichier = pathinfo($_FILES['monfichier']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('txt', 'ppt', 'pdf', 'doc', 'docx');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                     
                        if(!(empty($titre))){
                                if(!(empty($mots)))
                                {
                                        $path='C:/test/'.basename($_FILES['monfichier']['name']);
                                        $connexion=mysqli_connect("localhost", "root", "");

                                        if ($connexion){
                                        echo "<p>connexion réussie</p>";
                                        $bd = mysqli_select_db($connexion,"indexation");

                                        if ($bd){
                                        echo "<p> Connexion à la base de données effectuée </p>";
                                        move_uploaded_file($path,$_FILES['monfichier']['tmp_name']);
                
                                        $requete = "INSERT INTO document(doc_title,doc_path,doc_keys) VALUES ('".$titre."','".$path."','".$mots."')";
                                        $resultat = mysqli_query($connexion,$requete);

                                        if ($resultat)echo "<p>Requête executée</p>";
                                        
                                        else echo "<p>Requête incorrecte</p>";
                                        }
                                        else echo "<p>Base de données inconnue</p>";
                                        } 
                                        else echo "<p>Erreur de connexion</p>";
                                        mysqli_close($connexion);
                                }
                                else echo"<p>le champ mot indeX n'est pas rempli</p>";
                        }
                        else echo"<p>le titre n'est pas rempli</p>";
                
                }else echo"extension non autorisée";
        }else echo"<p>verifier le size</p>";
}else echo"<p>il faut inserer une fichier<p>";
echo"</center>";
?>
</html>