<?php

require("../index.php");

if (isset($_POST['make_payment_btn'])) {
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];


    $data = [
        "email" => $email,
        "amount" => $amount * 100, // all values are in kobo
        "reference" => "TEST-" . rand(0, 9999999),
        "metadata" => [
            "display_name" => $first_name . ' ' . $last_name,
            "variable_name" => "mobile_number",
            "value" => $phone_number
        ],
        // "channels" => ['card','bank']
    ];

    $initialize_payment_response = json_decode(initialize_payment($data));

    # check if the status is true 
    if ($initialize_payment_response->status == true) {
        $redirect_url = $initialize_payment_response->data->authorization_url;
        $reference = $initialize_payment_response->data->reference;

        # save the credentials then redirect to the payment modal 
        header("Location:" . $redirect_url);
    }

    # check if the status is false 
    if ($initialize_payment_response->status == false) {
       # do whatever you wish here 
    }
}

# verify transaction

if (isset($_GET['trxref'])) {

    $transaction_ref = $_GET['trxref'];

    $verify_transaction_response = json_decode(verify_transaction($transaction_ref));

    # successful verification
    if ($verify_transaction_response->status === true) {
        $transaction_status = $verify_transaction_response->message;
        $transaction_message = $verify_transaction_response->message;
    }

    # failed verification
    if (!$verify_transaction_response->status) {
        $transaction_status = $verify_transaction_response->status;
        $transaction_message = $verify_transaction_response->message;
        # do whatever you wish with this data 
        
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="styles.css" type="text/css" rel="stylesheet"/>
    <title>Paystack CakePHP Implementation</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 col-md-12 col-lg-12 my-3">
                <h2 class="my-3 text-center">ApiKodes Paystack API implementations (Accept Payments)</h2>

                <div class="form-div">
                    <form method="POST" action="" class="mx-auto d-flex flex-column justify-content-center align-items-center">
                        <?php
                        if (isset($transaction_status)) {
                            if ($transaction_status == true) {
                        ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong><?= "Payment " . $transaction_message ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            <?php
                            }
                            if ($transaction_status == false) {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong><?= "Payment " . $transaction_message ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <div class="form-group my-2">
                            <label for="email">Email Address</label>
                            <input name="email" class="form-control" placeholder="Enter Email Address" type="email" id="email-address" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="amount">Amount</label>
                            <input name="amount" placeholder="Enter amount in 1000s" class="form-control" type="tel" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="last_name">First Name</label>
                            <input name="first_name" placeholder="Enter First Name" class="form-control" type="text" />
                        </div>
                        <div class="form-group my-2">
                            <label for="last_name">Last Name</label>
                            <input name="last_name" placeholder="Enter Last Name" class="form-control" type="text" />
                        </div>
                        <div class="form-group my-2">
                            <label for="phone_number">Phone Number</label>
                            <input name="phone_number"  placeholder="Enter Phone Number"  class="form-control" type="text" />
                        </div>
                        <div class="form-submit">
                            <button class="btn btn-primary" name="make_payment_btn" type="submit"> Pay </button>
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