<?php
require('../backend/index.php');

$all_banks = getAllBanks();

$decode_all_banks_data = json_decode($all_banks);

// echo var_dump($decode_all_banks_data->data[0]);

if (
    isset($_POST['name'])
    && isset($_POST['account_number']) && isset($_POST['banks'])
    && isset($_POST['reason'])
) {

    $name = $_POST['name'];
    $account_number = $_POST['account_number'];
    $amount = $_POST['amount'];
    $reason = $_POST['reason'];
    $type = "nuban";
    $bank_code = $_POST['banks'];
    $currency = "NGN";

    $data = [
        'type' => $type,
        'name' => $name,
        'account_number' => $account_number,
        'bank_code' => $bank_code,
        'currency' => $currency
    ];

    $trans_recipient_data = createTransferRecipient($data);

    // {"status":true,"message":"Transfer recipient created successfully","data":
    //     {"active":true,"createdAt":"2022-09-14T12:29:30.219Z","currency":"NGN",
    //         "domain":"test","id":38640961,"integration":827676,"name":"Chinonso Kalu",
    //             "recipient_code":"RCP_wa4y0ei5ojtkycf","type":"nuban","updatedAt":"2022-09-14T12:29:30.219Z",
    //                 "is_deleted":false,"isDeleted":false,
    //                     "details":{"authorization_code":null,"account_number":"0693858447",
    //                         "account_name":"CHINONSO JOHN KALU","bank_code":"044","bank_name":"Access Bank"}}}

    $decode_transfer_recipient_data = json_decode($trans_recipient_data);

    $recipient_code = $decode_transfer_recipient_data->data->recipient_code;

    $field_data = [
        'source' => "balance",
        'amount' => $amount,
        'recipient_code' => $recipient_code,
        'reason' => $reason
    ];

    $initiate_transfer = json_decode(initiate_transfer($field_data));


    // now we can 

    if ($initiate_transfer->status === false) {
        $transfer_error_message = $initiate_transfer->message;
    }

    // echo $transfer_error_message;
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
                <h2 class="my-3 text-center">ApiKodes Paystack API implementations (Accept Payments)</h2>

                <div class="">
                    <?php
                    if ($transfer_error_message) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$transfer_error_message?>
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
                            <label for="banks">Select Bank</label>
                            <select name="banks" class="form-control">
                                <option name="banks[]" value="">-- Select Receipient's bank --</option>
                                <?php
                                if ($decode_all_banks_data && $decode_all_banks_data->data && is_array($decode_all_banks_data->data)) {
                                    foreach ($decode_all_banks_data->data as $key => $bank) {
                                ?>
                                        <option name="banks[]" value=<?= $bank->code ?>><?= $bank->name; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group my-2">
                            <label for="amount">Amount</label>
                            <input name="amount" placeholder="Enter amount in 1000s" class="form-control" type="tel" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="amount">Account Number</label>
                            <input name="account_number" placeholder="Enter Recipient Account Number" class="form-control" type="tel" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="name">Full Name</label>
                            <input name="name" placeholder="Enter Full Name" class="form-control" type="text" />
                        </div>
                        <div class="form-group my-2">
                            <label for="phone_number">Phone Number</label>
                            <input name="phone_number" placeholder="Enter Phone Number" class="form-control" type="text" />
                        </div>
                        <div class="form-group my-2">
                            <label for="reason">Reason for transfer</label>
                            <textarea name="reason" class="form-control" placeholder="Enter Reason for Transfer"></textarea>
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