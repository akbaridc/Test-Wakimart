<?php

if (isset($_POST['cekPalindrome'])) {

    $palindrome = $_POST['palindrome'];

    //hapus semua string yang ada spasi
    $palindrome = str_replace(' ', '', $palindrome);

    //ubah string ke huruf kecil
    $palindrome = strtolower($palindrome);

    //balikan kata dari string
    $newPalindrome = strrev($palindrome);

    if ($palindrome == $newPalindrome) {
        $result = "Benar Palindrome";
    } else {
        $result = "Bukan Palindrome";
    }
}

if (isset($_POST['cekAnagram'])) {
    $anagram1 = $_POST['anagram1'];
    $anagram2 = $_POST['anagram2'];


    $resul = count_chars($anagram1, 1) == count_chars($anagram2, 1);

    if ($resul) {
        $resultA = "Benar Anagram";
    } else {
        $resultA = "Bukan Anagram";
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Palindrome</title>
</head>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Cek String Palindrome</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Your Input" name="palindrome" id="palindrome">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" name="cekPalindrome">Cek Palindrome</button>
                                </div>
                            </div>
                        </form>
                        <div>
                            <?php if (isset($result)) { ?>
                                <div class="alert alert-success" role="alert">
                                    <p>String yang diinput : <?= $_POST['palindrome'] ?></p>
                                    <p>Hasil Cek Palindrome : <?= $result ?></p>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    <p>Masukkan Inputan terlebih dahulu untuk cek apakah palindrome</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Cek String Anagram</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Your Text one" name="anagram1" id="anagram1">
                                <input type="text" class="form-control" placeholder="Your Text two" name="anagram2" id="anagram2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" name="cekAnagram">Cek Anagram</button>
                                </div>
                            </div>
                        </form>
                        <div>
                            <?php if (isset($resultA)) { ?>
                                <div class="alert alert-success" role="alert">
                                    <p>String yang diinput : ['<?= $_POST['anagram1'] ?>'], ['<?= $_POST['anagram2'] ?>']</p>
                                    <p>Hasil Cek Anagram : <?= $resultA ?></p>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    <p>Masukkan Inputan terlebih dahulu untuk cek apakah anagram</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>