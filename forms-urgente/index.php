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
    <textarea name="description1" cols="30" rows="1" placeholder="Descrição"></textarea>
    <button type="submit">Salvar</button>
  </form>

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