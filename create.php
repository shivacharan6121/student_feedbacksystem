<?php
// include connection
include 'db_connection.php';

// declare varibales and initialize with empty values
$nameErr = $addressErr = $classErr = $phoneErr = $feedbackErr = "";
$name = $address = $class = $phone = $feedback = "";

// processing form data when form is submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "*This field is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if fname contains only letters
        if (!ctype_alpha($name)) {
            $nameErr = "Only letters are allowed";
        }
    }

    if (empty($_POST["address"])) {
        $addressErr = "*This field is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["class"])) {
        $classErr = "*This field is required";
    } else {
        $class = test_input($_POST["class"]);
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "*This field is required";
    } else {
        $phone = test_input($_POST["phone"]);
    }

    if (empty($_POST["feedback"])) {
        $feedbackErr = "*This field is required";
    } else {
        $feedback = test_input($_POST["feedback"]);
    }

    // if no errors then insert data into databse
    if (empty($nameErr) && empty($addressErr) && empty($classErr) && empty($phoneErr) && empty($feedbackErr)) {

        $sql = "INSERT INTO records (name, address, class, phone, feedback) VALUES ('$name', '$address', '$class', '$phone', '$feedback')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New record created successfully');</script>";
            echo "<script>window.location.href='http://localhost/b21cs195l(external)/index2.php';</script>";
            exit();
        }
    }
    mysqli_close($conn);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style123.css" rel="stylesheet">
    <title>Create Data - PHP CRUD</title>
</head>

<body>
    <!-- submit form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h3 class="mb-4 text-center">FEEDBACK</h3>
                <div class="form-body bg-light p-4">
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">name*</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                                <small class="text-danger"><?= $nameErr; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="address" class="form-label">address*</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= $address; ?>">
                                <small class="text-danger"><?= $addressErr; ?></small>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="class" class="form-label">class*</label>
                                <input type="class" class="form-control" id="class" name="class" value="<?= $class; ?>">
                                <small class="text-danger"><?= $classErr; ?></small>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="phone" class="form-label">phone*</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?= $phone; ?>">
                                <small class="text-danger"><?= $phoneErr; ?></small>
                            </div>
                            <br>
                            <div class="col-lg-6 mb-3">
                                <label for="feedback" class="form-label">feedback*</label>
                                <textarea class="form-control" id="feedback" name="feedback" rows="5" cols="20" value="<?= $feedback; ?>"></textarea>
                                <small class="text-danger"><?= $feedbackErr; ?></small>
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary form-control" name="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>