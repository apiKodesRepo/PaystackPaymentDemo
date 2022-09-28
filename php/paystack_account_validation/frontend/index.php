<?php
require('../backend/index.php');

$all_banks = getAllBanks();

$decode_all_banks_data = json_decode($all_banks);

if(isset($_POST['validate_account_btn'])){
    if (
        isset($_POST['account_number']) && isset($_POST['banks'])
        && isset($_POST['account_name']) && isset($_POST['account_type']) 
        && isset($_POST['document_type']) && isset($_POST['document_number'])  
    ) {
        $account_number = $_POST['account_number'];
        $bank_code = $_POST['banks'];
        $account_name = $_POST['account_name'];
        $account_type = $_POST['account_type'];
        $document_type = $_POST['document_type'];
        $document_number = $_POST['document_number'];

        $data = [
            'bank_code' => $bank_code,
            'country_code' => 'ZA', // its just a constant value since they only offer the service to South Africa
            'account_number' => $account_number,
            'account_name' => $account_name,
            'account_type' => $account_type,
            'document_type' => $document_type,
            'document_number' => $document_number
        ];

        $validate_account_fn = validate_account($data);
        
        // {
        //     "status": true,
        //     "message": "Personal Account Verification attempted",
        //     "data": {
        //       "verified": true,
        //       "verificationMessage": "Account is verified successfully"
        //     }
        //   }


        // echo $validate_account_fn; exit();

        $decode_validate_account_fn = json_decode($validate_account_fn);

        if($decode_validate_account_fn->status === true){
            $validate_account_success_message = $decode_validate_account_fn->data['verificationMessage'];
        }

        // $validate_account_error_message = "";

        if ($decode_validate_account_fn->status === false) {
            $validate_account_error_message = $decode_validate_account_fn->message;
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
                <h2 class="my-3 text-center">ApiKodes Paystack API implementations (Validate Account Number - South Africa Only) </h2>

                <div class="">
                    <?php
                    if (isset($validate_account_success_message)) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?=$validate_account_success_message?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    } else {
                    ?>

                    <?php
                    if (isset($validate_account_error_message)) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$validate_account_error_message?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }}
                    ?>
                    <form method="POST" action="" class="px-3">
                        <div class="form-group my-2">
                            <label for="account_name">Account Name </label>
                            <input name="account_name" class="form-control form-input" placeholder="Enter account name i.e John Doe" type="text" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="account_number">Account Number</label>
                            <input name="account_number" class="form-control form-input" placeholder="Enter account number" type="tel" required />
                        </div>

                        <div class="form-group my-2">
                            <label for="banks">Select Bank</label>
                            <select name="banks" class="form-control">
                                <option name="banks[]" value="">-- Select Recipient's bank --</option>
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
                            <label for="account_type">Account Type</label>
                            <select name="account_type" class="form-control">
                                <option name="account_type[]" value="">-- Select Recipient's Account Type --</option>
                                <option name="account_type[]" value="personal"> Personal </option>
                                <option name="account_type[]" value="business"> Business </option>
                            </select>
                        </div>
                        
                        <div class="form-group my-2">
                            <label for="document_type">Document Type</label>
                            <select name="document_type" class="form-control">
                                <option name="document_type[]" value="">-- Select Recipient's Document Type --</option>
                                <option name="document_type[]" value="identityNumber"> Identity Number </option>
                                <option name="document_type[]" value="passportNumber"> Passport Number </option>
                                <option name="document_type[]" value="businessRegistrationNumber"> Business Registration Number </option>
                            </select>
                        </div>

                        <div class="form-group my-2">
                            <label for="document_number">Document Number</label>
                            <input name="document_number" class="form-control form-input" placeholder="Enter document number" type="tel" required />
                        </div>

                        

                        <div class="form-submit">
                            <button class="btn btn-primary" name="validate_account_btn" type="submit"> Validate Account </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="./index.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>