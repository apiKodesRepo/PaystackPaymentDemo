<?php
require('../backend/index.php');

if(isset($_POST['resolve_card_bin_btn'])){
    if (
        isset($_POST['bin']) 
    ) {
        $bin = $_POST['bin'];
    
        $data = [
            'bin' => $bin
        ];

        $resolve_card_bin_fn = resolve_card_bin($data);
        
        // echo $resolve_card_bin_fn; exit();

        $decode_resolve_card_bin_fn = json_decode($resolve_card_bin_fn);

        if($decode_resolve_card_bin_fn->status === true){
            $resolve_card_bin_success_message = $decode_resolve_card_bin_fn->message;
        }

        // $resolve_card_bin_error_message = "";

        if ($decode_resolve_card_bin_fn->status === false) {
            $resolve_card_bin_error_message = $decode_resolve_card_bin_fn->message;
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
                <h2 class="my-3 text-center">ApiKodes Paystack API implementations (Resolve Card BIN)</h2>

                <div class="">
                    <?php
                    if (isset($resolve_card_bin_success_message)) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?=$resolve_card_bin_success_message?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    } else {
                    ?>

                    <?php
                    if (isset($resolve_card_bin_error_message)) {
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?=$resolve_card_bin_error_message?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }}
                    ?>
                    <form method="POST" action="" class="px-3">
                        <div class="form-group my-2">
                            <label for="bin">Bank Identification Number</label>
                            <input name="bin" class="form-control form-input" placeholder="Enter bin i.e first 6 digits on your card" type="tel" required />
                        </div>
                        <div class="form-submit">
                            <button class="btn btn-primary" name="resolve_card_bin_btn" type="submit"> Verify </button>
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