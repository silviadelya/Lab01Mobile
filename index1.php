<html>
<head>
  <title>Latihan API 1</title>
</head>

<body>
  <h2>Data Mahasiswa</h2>
  <table border="1px">
    <tr>
      <th>No.</th>
      <th>Nama</th>
    </tr>

    <?php
    $url = 'https://tifupb.id/data';
    $data = file_get_contents($url);
    $mahasiswa = json_decode($data, true);
    $no = 1;
    foreach ($mahasiswa as $item) {
      echo "<tr>";
      echo "<td>" . $no . "</td>";
      echo "<td>" . $item['Nama'] . "</td>";
      echo "</tr>";
      $no += 1;
    }
    ?>
  </table>
</body>
</html>