<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php
/**
 * Created by PhpStorm.
 * User: isaelemoigne
 * Date: 18/01/2017
 * Time: 14:24
 */
$dbh = new PDO('mysql:host=localhost;dbname=phalcon-td0', 'root', 'root');
?>

</br></br>

<div class="container">
<th>Roles: </th>
<input type="button" name="Ajouter un role" value="Ajouter un role" OnClick="http://localhost:8888/s4-userManagement-0/roles/add.php"/>
</div>

</br></br>

<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Name<a href="?col=1&tri=up"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
                <a href="?col=1&tri=down"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
            </th>
            <th>nbUsers<a href="?col=2&tri=up"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
                <a href="?col=2&tri=down"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a></th>
            </th>
            <th>
                Actions
            </th>
        </tr>

<?php

if(!isset($_GET['col'])||!isset($_GET['tri'])){
    $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by name');
}else{
    if($_GET['col']=='1'){
        if($_GET['tri']=='up'){
            $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by name desc');
        }else{
            $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by name');
        }

    }else{
        if($_GET['tri']=='up'){
            $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by count(idrole) desc');
        }else{
            $stmt = $dbh->prepare('SELECT name, count(idrole), role.id FROM role JOIN user ON user.idrole = role.id GROUP BY role.id, name ORDER by count(idrole)');
        }
    }

}

$stmt->execute();

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo '<tr><td> '.$result['name'].'<br></td><td> '.$result['count(idrole)'].'<br></td><td> '.'<a href="http://localhost:8888/s4-userManagement-0/roles/show.php"><span class="glyphicon glyphicon-eye-open"></span></a>'.'<a href="http://localhost:8888/s4-userManagement-0/roles/update.php"><span class="glyphicon glyphicon-option-horizontal"></span></a>'.'<a href="http://localhost:8888/s4-userManagement-0/roles/delete.php"><span class="glyphicon glyphicon-trash"></span></a>'.'<br></td></tr>';
};
echo'</table>';
?>

