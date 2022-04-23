<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовая задание</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">
                Форма
            </h1>
            
            <div id="result" class="mb-5"></div>

            <div class="field">
                <input class="input is-primary" type="text" placeholder="Ведите текст">
            </div>
            <button class="button is-primary">Отправить</button>
        </div>
    </section>

    <script>
        $(() => {
            $('button').click(() => {
                $.ajax({
                    url: '/ajax.php',
                    type: 'POST',
                    data: {
                        text: $('input').val()
                    },
                    success: (data) => {
                        console.log(data);
                        $('#result').html(data);
                    }
                });
            });
        })
    </script>
</body>
</html>