<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>Nama_product_1</th>
                <th>Nama_product_2</th>
                <th>Harga_Promo</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $koneksi = mysqli_connect("localhost", "root", "", "db_wakimart3");

            $query = "SELECT pr.product1_id AS Nama_product_1, pr.product2_id AS Nama_product_2, hr.price AS Harga_Promo FROM product p INNER JOIN promo pr ON p.id = pr.id INNER JOIN harga_promo hr ON pr.id = hr.id;";

            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['Nama_product_1'] ?></td>
                    <td><?= $row['Nama_product_2'] ?></td>
                    <td><?= $row['Harga_Promo'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>