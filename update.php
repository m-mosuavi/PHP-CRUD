<?php
require_once'dbconfig.php';
if(isset($_POST['update'])){


    $userId = intval($_GET['id']);
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = intval($_POST['phone']);

    $sql = 'UPDATE users set firstName=:firstname,lastName=:lastname,email=:email,phone=:phone,address=:address WHERE id=:id';

    $query = $conn->prepare($sql);

    $query->bindParam(':firstname', $fname, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':id', $userId, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('record updated successfully');</script>";
    echo "<script>window.location.href='index.php'</script>";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container border p-4 mt-4">

        <div class="row">
            <div class="col-md-12">
                <h3 class="p-4">ویرایش اطلاعات</h3>
                <hr />
            </div>
        </div>

        <?php
        
        $userId = intval($_GET['id']);
        $sql = "SELECT firstName,lastName,email,address,phone,id from users where id=:id";
        $query = $conn->prepare($sql);
        $query->bindParam(':id', $userId, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();        
        
        ?>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>نام</label>
                    <input type="text" name="firstName" class="form-control" value="<?php echo htmlentities( $result['firstName']) ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>نام خانوادگی</label>
                    <input type="text" name="lastName" class="form-control" value="<?php echo htmlentities( $result['lastName']) ?>">
                </div>
            </div>
            <div class="form-group">
                <label>ایمیل</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlentities( $result['email']) ?>">
            </div>
            <div class="form-group">
                <label>شماره</label>
                <input type="number" name="phone" class="form-control" value="<?php echo htmlentities( $result['phone']) ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>آدرس</label>
                    <textarea class="form-control" name="address"  rows="5">
                  <?php echo htmlentities( $result['address']) ?>
                    </textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-warning" value="ویرایش" name="update">
        </form>


    </div>
</body>
</html>