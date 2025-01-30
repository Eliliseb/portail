
<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    require "../connexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>school</title>
</head>
<body>
    <?php
        include("partials/header.php")
    ?>
    <div class="container-fluid">
        <h1>les établissements</h1>
        <a href="addschools.php" class="btn btn-success">ajouter</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Catégorrie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $schools = $bdd->query("SELECT etablissements.nom AS enom, etablissements.id AS eid, categories.nom AS cnom FROM etablissements INNER JOIN categories ON etablissements.categorie = categories.id");
                    while($don = $schools->fetch())
                    {
                        echo "<tr>";
                            echo "<td>".$don['eid']."</td>";
                            echo "<td>".$don['enom']."</td>";
                            echo "<td>".$don['cnom']."</td>";
                            echo "<td>";
                                echo "<a href='#' class='btn btn-warning mx-1'>modifier</a>";    
                                echo "<a href='#' class='btn btn-danger mx-1'>supprimer</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    $schools->closeCursor();
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>