<?php
require('../backend/index.php');

if (isset($_POST['make_mobile_money_payment_btn'])) {
    if (
        isset($_POST['email'])
        && isset($_POST['amount']) 
        && isset($_POST['provider'])
        && isset($_POST['phone'])
    ) {
        $email = $_POST['email'];
        $amount = $_POST['amount'];
        $phone = $_POST['phone'];
        $provider = $_POST['provider'];

        $data = [
            "amount" => $amount,
            "email" => $email,
            "currency" => "GHS", // this is a constant because it currently only works in GHANA 
            "mobile_money" => [
              "phone" => $phone,
              "provider" => $provider
            ]
        ];

        $initiate_mobile_money_payment = json_decode(mobile_money_payment($data));

        // echo $initiate_mobile_money_payment; exit();

        if ($initiate_mobile_money_payment->status === false) {
            $mobile_money_error_message = $initiate_mobile_money_payment->message;

            // do whatever you wish 

        }

        if ($initiate_mobile_money_payment->status === true) {
            $mobile_money_success_message = $initiate_mobile_money_payment->message;

            // do what ever you wish 
        }

        // webhook continues the job

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
                <h2 class="my-3 text-center">ApiKodes Paystack API implementations (Mobile Money Payments)</h2>

                <div class="">
                    <?php
                    if (isset($mobile_money_error_message)) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= $mobile_money_error_message ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($mobile_money_success_message)) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= $mobile_money_success_message ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                    <form method="POST" action="" class="px-3">
                        <div class="form-group my-2">
                            <label for="email">Email Address</label>
                            <input name="email" class="form-control form-input" placeholder="Enter Email Address" type="email" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="provider">Select Provider</label>
                            <select name="provider" class="form-control">
                                <option name="provider[]" value="">-- Select Provider --</option>
                                <option name="provider[]" value="mtn"> MTN </option>
                                <option name="provider[]" value="vod"> Vodafone </option>
                                <option name="provider[]" value="tgo"> Airtel/Tigo </option>
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="amount">Amount</label>
                            <input name="amount" placeholder="Enter amount in 1000s" class="form-control" type="tel" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="phone">Phone Number</label>
                            <input name="phone" placeholder="Enter Phone Number" class="form-control" type="tel" required />
                        </div>
                    
                        <div class="form-submit">
                            <button class="btn btn-primary" name="make_mobile_money_payment_btn" type="submit"> Submit </button>
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