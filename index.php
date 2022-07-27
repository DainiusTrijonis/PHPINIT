<?php
    // Start the session
    session_start();

    //unset($_SESSION['users']);
    if(isset($_POST['Submit'])){
        $input = $_POST['fName'].$_POST['lName'];
        $message = $_POST['fName'].' '.$_POST['lName'];
        $_SESSION['users'][] = [[$_POST['fName'],$_POST['lName']],false];
    }
    if(isset($_REQUEST['remove'])) {
        $unique_id = $_POST['index'];
        if($unique_id!==false) {
            unset($_SESSION['users'][$unique_id]);
            $_SESSION["users"] = array_values($_SESSION["users"]);
        }
    }

    $return = "";
    if(isset($_POST['update'])) {
        $unique_id = $_POST["index"];
        $_SESSION["users"][$unique_id][1] = true;
    }
    if(isset($_POST['submitUpdate'])) {
        $unique_id = $_POST["index"];
        $_SESSION["users"][$unique_id][0] = [$_POST['0'],$_POST['1']];
        $_SESSION["users"][$unique_id][1] = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <form action="" method="post">
        <input type="text" name="fName"/>
        <input type="text" name="lName"/>
        <input type="submit" name="Submit"/>
    </form>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody> 
            <?php 
                $array = $_SESSION["users"];
                foreach($array as $index => $value) {
            ?>
                <tr id= '<?= $index ?>' >
                    <form action='' method='post'>
                        <?php foreach($value[0] as $key => $user) {
                        ?>
                            <?php if($value[1]): ?>
                                <td id= <?= $key?> > <input type='text' name='<?= $key ?>' value= '<?= $user?>'/> </td>
                            <?php else:?>
                                <td id= <?= $key?> > <?= $user ?> </td>
                            <?php endif;?>
                        <?php } ?>
                        <td>
                                <input hidden  type='text' name='index' value='<?= $index ?>'/>
                                <input type='submit' name='remove' value='REMOVE'/>
                                <?php if($value[1]): ?>
                                    <input type='submit' id='submitUpdate' name='submitUpdate' value='SUBMITUPDATE'/>
                                <?php else: ?>
                                    <input type='submit' id='update' name='update' value='UPDATE'/>
                                <?php endif; ?>
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>