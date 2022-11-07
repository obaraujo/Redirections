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
  <table>
    <thead>
      <th>Link</th>
      <th>Original</th>
      <th>Descrição</th>
    </thead>
    <tbody>
      <tr>
        <td></td>
      </tr>
      <?php
      foreach ($data as $row) {
        echo "  
          <tr>
            <td>https://stagon.in/r?id={$row[1]}</td>
            <td>{$row[4]}</td>
            <td>{$row[5]}</td>
          </tr>
          ";
      }
      ?>
    </tbody>

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