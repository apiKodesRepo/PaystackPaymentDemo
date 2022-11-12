<?php
require('../backend/index.php');

if (isset($_POST['make_ussd_payment_btn'])) {
    if (
        isset($_POST['email'])
        && isset($_POST['amount']) && isset($_POST['bank'])
        && isset($_POST['display_name'])
    ) {
        

        $email = $_POST['email'];
        $amount = $_POST['amount'];
        $type = $_POST['bank'];
        $display_name = $_POST['display_name']; 

        $data = [
            "email" => $email, 
            "amount" => $amount,
            "ussd" => [ 
              "type"=> $type 
            ],
            "metadata"=> [
              "custom_fields"=>[
                "description"=> "Happy family",
                "display_name"=> $display_name,
              ]
            ]
        ]; 

        $initiate_ussd_payment = json_decode(ussd_payment($data));

        // echo $initiate_ussd_payment; exit();

        if ($initiate_ussd_payment->status === false) {
            $ussd_error_message = $initiate_ussd_payment->data->display_text;

            // do whatever you wish 

        }

        if ($initiate_ussd_payment->status === true) {
            $ussd_success_message = $initiate_ussd_payment->data->display_text;

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
                <h2 class="my-3 text-center">ApiKodes Paystack API implementations (USSD Payments)</h2>

                <div class="">
                    <?php
                    if (isset($ussd_error_message)) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= $ussd_error_message ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($ussd_success_message)) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= $ussd_success_message ?>
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
                            <label for="bank">Select Bank</label>
                            <select name="bank" class="form-control">
                                <option name="bank[]" value="">-- Select Bank --</option>
                                <option name="bank[]" value="737"> Guaranty Trust Bank </option>
                                <option name="bank[]" value="919"> United Bank of Africa </option>
                                <option name="bank[]" value="822"> Sterling Bank </option>
                                <option name="bank[]" value="966"> Zenith Bank </option>
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="amount">Amount</label>
                            <input name="amount" placeholder="Enter amount in 1000s" class="form-control" type="tel" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="display_name">Display Name</label>
                            <input name="display_name" placeholder="Enter Display Name" class="form-control" type="text" required />
                        </div>
                       
                        <div class="form-group my-2">
                            <label for="description">Payment Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter payment description"></textarea>
                        </div>
                        <div class="form-submit">
                            <button class="btn btn-primary" name="make_ussd_payment_btn" type="submit"> Submit </button>
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