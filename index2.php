<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan API 2</title>
  </body>
  <style>
    /* Kode CSS untuk halaman web untuk menjadi lebih menarik*/
    
    h1 {
      text-align: center;
    }

    .table {
      font-family: 'Open Sans', sans-serif;
      border-collapse: collapse;
      width: 100%;
      background-color: #fff;
      border: 2px solid #ddd;
      margin: auto;
      margin-top: 50px;
      margin-bottom: 50px;
      overflow-x: auto;
    }

    .table th,
    .table td {
      text-align: center;
      padding: 10px 15px;
    }

    .table th {
      font-weight: bold;
      color: #fff;
      background-color: #181717;;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .table tr:hover {
      background-color: #b4b4ec;
    }

    @media only screen and (max-width: 600px) {
      .table {
        font-size: 14px;
      }

      .table th,
      .table td {
        padding: 5px;
      }
    }

    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
    }

    .pagination a,
    .pagination span {
      display: inline-block;
      padding: 10px;
      margin: 0 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
      color: #333;
      text-decoration: none;
      font-size: 14px;
    }

    .pagination a:hover {
      background-color: #f5f5f5;
    }

    .pagination span {
      background-color: #181717;
      color: #fff;
      border-color: #181717;
    }
  </style>
</head>
<body>

<!-- Header halaman -->
  <div>
    <nav class="navbar bg-black">
      <div class="container-fluid">
      </div>
    </nav>
  </div>
  <h1>ABSENSI KELAS TI.21.A.1</h1>
  <?php
  // Untuk nilai jumlah data perhalaman
  $items_per_page = 10;

  // Mengambil data dari API
  $json_data = file_get_contents("https://tifupb.id/tugas1");
  $data = json_decode($json_data, true);

  // Perulangan untuk mengubah kode menjadi data kehadiran
  foreach ($data as &$item) {
    foreach ($item as &$value) {
      if ($value === "M") {
        $value = "M";
      }
      if ($value === "I") {
        $value = "I";
      }
      if ($value === "S") {
        $value = "S";
      }
      if ($value === "-") {
        $value = "A";
      }
    }
  }

  // Menghitung total data yang ada
  $total_items = count($data);

  // Menghitung jumlah halaman bedasarkan data
  $total_pages = ceil($total_items / $items_per_page);

  // mendapatkan nomor halaman saat ini
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

  // menghitung nilaiuntuk halaman saat ini
  $offset = ($current_page - 1) * $items_per_page;

  // Potongan data bedasarkan halaman tabel
  $sliced_data = array_slice($data, $offset, $items_per_page);

  // Menampilkan data ditabel
  echo "<table class='table'>";
  echo "
<thead>
<tr>
<th>No.</th>
<th>NIM</th>
<th>Nama</th>
<th>Pertemuan 1</th>
<th>Pertemuan 2</th>
<th>Pertemuan 3</th>
<th>Pertemuan 4</th>
</tr>
</thead>
<tbody>";

  // Perulangan dari potongan data, dan menampilkan ditabel
  $no = $offset + 1;
  foreach ($sliced_data as $item) {

    echo "<tr>";

    echo "<td>" . $no . "</td>";
    echo "<td>" . $item['NIM'] . "</td>";
    echo "<td>" . $item['Nama'] . "</td>";
    echo "<td>" . $item['1'] . "</td>";
    echo "<td>" . $item['2'] . "</td>";
    echo "<td>" . $item['3'] . "</td>";
    echo "<td>" . $item['4'] . "</td>";

    echo "</tr>";
    $no++;
  }
  echo "</tbody></table>";

  // Kode Pagination untuk berpindah halaman selanjutnya.
  echo "<div class='pagination'>";
  for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $current_page) {
      echo "<span>$i</span>";
    } else {
      echo "<a href='?page=$i'>$i</a>";
    }
  }
  echo "</div>";

  ?>
</html>