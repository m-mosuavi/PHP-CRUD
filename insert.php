<?php

require_once'dbconfig.php';

if (isset($_POST['insert'])) {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = intval($_POST['phone']);

    $sql = "INSERT INTO users(firstName,lastName,email,address,phone) VALUES(:firstname,:lastname,:email,:address,:phone)";

    $query = $conn->prepare($sql);
    $query->bindParam(':firstname', $fname, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $conn->lastInsertId();

    if ($lastInsertId) {
        // echo "<script>alert('record insert successfully');</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Error');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style type="text/css">

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container border p-4 mt-4">

        <div class="row">
            <div class="col-md-12">
                <h3 class="p-4">وارد کردن اطلاعات</h3>
                <hr />
            </div>
        </div>

        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>نام</label>
                    <input type="text" class="form-control" name="firstName" placeholder="مثال : علی" required  oninvalid="this.setCustomValidity('نام را وارد کنید')">
                </div>
                <div class="form-group col-md-6">
                    <label>نام خانوادگی</label>
                    <input type="text" class="form-control" name="lastName" placeholder="مثال : کریمی" required>
                </div>
            </div>
            <div class="form-group">
                <label>ایمیل</label>
                <input type="email" class="form-control" name="email" placeholder="مثال : ali@gmail.com" required>
            </div>
            <div class="form-group">
                <label>شماره</label>
                <input type="number" class="form-control" name="phone" placeholder="مثال : 0912813774" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>آدرس</label>
                    <textarea class="form-control" name="address" rows="5" required></textarea>
                </div>
            </div>
           <input type="submit" class="btn btn-success" value="ثبت" name="insert">
        </form>
    </div>
</body>

</html>