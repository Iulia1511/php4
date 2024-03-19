<?php
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    function IsValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if (empty($_POST["name"])) {
        $errors[] = "Поле 'Имя' не заполнено";
    }

    if (empty($_POST["email"])) {
        $errors[] = "Поле 'Email' не заполнено";
    } elseif (!IsValidEmail($_POST["email"])) {
        $errors[] = "Некорректный формат email";
    }

    if (empty($_POST["number"])) {
        $errors[] = "Поле 'Оцените нас' не заполнено";
    }

    if (empty($_POST["select"])) {
        $errors[] = "Поле 'Выберите город' не заполнено";
    }

}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Документ</title>
    <style>
        .form {
            width: 300px;
            border-radius: 5px;
            background-color: #f9f9f9 ;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid gray;
        }

        .form label {
            font-weight: bold;
        }

        .form input[type="text"],
        .form input[type="email"],
        .form input[type="number"],
        .form select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            box-sizing:border-box;
        }

        .form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        .form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        legend {
            color: black;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <fieldset>
            <legend>Приветствуем</legend>
            <label for="name">Имя</label>
            <input type="text" id="name" name="name">
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && in_array("Поле 'Имя' не заполнено", $errors)) { ?>
                <span class="error">Поле 'Имя' не заполнено</span><br>
            <?php } ?>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && in_array("Поле 'Email' не заполнено", $errors)) { ?>
                <span class="error">Поле 'Email' не заполнено</span><br>
            <?php } elseif ($_SERVER['REQUEST_METHOD'] == "POST" && in_array("Некорректный формат email", $errors)) { ?>
                <span class="error">Некорректный формат email</span><br>
            <?php } ?>
            <label for="number">Оцените нас</label>
            <input type="number" id="number" name="number" min="0" max="10">
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && in_array("Поле 'Оцените нас' не заполнено", $errors)) { ?>
                <span class="error">Поле 'Оцените нас' не заполнено</span><br>
            <?php } ?>
            <label for="select">Выберите город</label>
            <select name="select" id="select">
                <option value="">Выберите город</option>
                <option value="Кишинев">Кишинев</option>
                <option value="Бельцы">Бельцы</option>
                <option value="Кагул">Кагул</option>
                <option value="Орхей">Орхей</option>
            </select>
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && in_array("Поле 'Выберите город' не заполнено", $errors)) { ?>
                <span class="error">Поле 'Выберите город' не заполнено</span><br>
            <?php } ?>
        </fieldset>
        <input type="submit" value="Отправить">
    </form>
</div>
</body>
</html>


