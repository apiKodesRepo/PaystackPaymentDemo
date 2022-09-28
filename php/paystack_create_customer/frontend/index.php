<?php
require('../backend/index.php');

if(isset($_POST['create_customer_btn'])){
    if (
        isset($_POST['email']) 
        && isset($_POST['first_name']) && isset($_POST['last_name'])
        && isset($_POST['phone'])
    ) {
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];

        $data = [
            "email" => $email,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "phone" => $phone
        ];

        $create_customer_fn = create_customer($data);
        
        // echo $create_customer_fn; exit();

        $decode_create_customer_fn = json_decode($create_customer_fn);

        if($decode_create_customer_fn->status === true){
            $create_customer_success_message = $decode_create_customer_fn->message;
        }

        // {"status":true,"message":"Customer created","data":
        //     {"transactions":[],"subscriptions":[],"authorizations":[],"first_name":"Kalu","last_name":"Chinonso",
        //         "email":"tripletens.kc@gmail.com","phone":null,"metadata":null,"domain":"test","customer_code":"CUS_87bxf1ar6sb4081",
        //         "risk_action":"default","id":90518038,"integration":827676,
        //     "createdAt":"2022-08-13T14:05:19.000Z","updatedAt":"2022-09-26T09:35:58.000Z","identified":false,"identifications":null}}

        // $create_customer_error_message = "";
        if ($decode_create_customer_fn->status === false) {
            $create_customer_error_message = $decode_create_customer_fn->message;
        }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles.css" type="text/css" rel="stylesheet" />
    <title>Paystack CakePHP Implementation</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 col-md-12 col-lg-12 my-3">
                <h2 class="my-3 text-center">ApiKodes Paystack API implementations (Create Customer)</h2>

                <div class="">
                    <?php
                    if (isset($create_customer_success_message)) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?=$create_customer_success_message?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    } else {
                    ?>

                    <?php
                    if (isset($create_customer_error_message)) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$create_customer_error_message?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }}
                    ?>
                    <form method="POST" action="" class="px-3">
                        <div class="form-group my-2">
                            <label for="email">Email Address</label>
                            <input name="email" class="form-control form-input" placeholder="Enter email address" type="email" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="first_name">First Name</label>
                            <input name="first_name" class="form-control form-input" placeholder="Enter first name" type="text" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="last_name">Last Name</label>
                            <input name="last_name" class="form-control form-input" placeholder="Enter last name" type="text" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="phone">Phone Number</label>
                            <input name="phone" class="form-control form-input" placeholder="Enter phone number" type="tel" required />
                        </div>
                        <div class="form-submit">
                            <button class="btn btn-primary" name="create_customer_btn" type="submit"> Verify </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>