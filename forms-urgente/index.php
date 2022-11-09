<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Links</title>
</head>

<body>
  <form name="form">
    <input type="url" name="original_link" placeholder="URL Original">
    <textarea name="description" cols="30" rows="1" placeholder="Descrição"></textarea>
    <button type="submit">Salvar</button>
  </form>

  <?php
  include("../core/index.php");

  $data = $conn->query("SELECT * FROM `links`")->fetch_all();

  ?>

  <style>
    table {
      border-collapse: collapse;
      background: #FFFFF0;
      border: solid green 1px;
    }

    table tr:nth-child(even) {
      background: #F0FFFF;
    }

    table td a {
      display: block;
      width: 100%;
      text-decoration: none;
    }

    td,
    th {
      padding: 10px;
      text-align: center;
    }

    td.limited {
      width: 200px;
      height: 15px;
      overflow-x: scroll;

      display: flex;
      flex-wrap: nowrap;
    }
  </style>
  <table>
    <thead>
      <th>Original</th>
      <th>Descrição</th>
      <th>Link</th>
      <th>Clicks</th>
    </thead>
    <tbody>
      <?php
      foreach ($data as $row) {
        echo "  
          <tr>
            <td class='limited'>{$row[4]}</td>
            <td>{$row[5]}</td>
            <td>https://stagon.in/r?id={$row[1]}</td>
            <td>{$conn->query("SELECT COUNT(*) FROM `clicks` WHERE link_id = " .$row[0])->fetch_row()[0]}</td>
          </tr>
          ";
      }
      ?>
    </tbody>
    <tfoot>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo $conn->query("SELECT COUNT(*) FROM `clicks`")->fetch_row()[0] ?></td>
    </tfoot>

  </table>
  <script>
    document.form.addEventListener('submit', (e) => {

      e.preventDefault()

      fetch("/r/new/", {
        method: "POST",
        body: new FormData(e.target),
      }).then(r => r.json()).then(r => {
        console.log(r.status);
      }).catch(err => alert(err.message))
    })
  </script>
</body>

</html>