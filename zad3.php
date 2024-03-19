<?php
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    $agree = isset($_POST['agree']) ? $_POST['agree'] : '';

    $errors = validateForm($name, $email, $message, $agree);
}

function displayError($field, $errors) {
    if (!empty($errors) && in_array($field, array_keys($errors))) {
        echo "<p class='error'>" . $errors[$field] . "</p>";
    }
}

function validateForm($name, $email, $message, $agree) {
    $errors = array();

    if (empty($name)) {
        $errors['name'] = "Поле 'Имя' не заполнено";
    } elseif (strlen($name) < 3 || strlen($name) > 20 || !preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $name)) {
        $errors['name'] = "Поле 'Имя' должно содержать от 3 до 20 символов и состоять только из букв и пробелов";
    }
    if (empty($email)) {
        $errors['email'] = "Поле 'Email' не заполнено";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Некорректный формат email";
    }
    if (empty($message)) {
        $errors['message'] = "Поле 'Комментарий' не заполнено";
    }
    if (empty($agree)) {
        $errors['agree'] = "Вы не согласились с обработкой данных";
    }

    return $errors;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #CCCCCC;
            border-radius: 5px;
            padding: 10px;
        }

        header h2 {
            margin-right: auto;
            font-family: 'Times New Roman', Times, serif;
        }

        header nav.exit {
            margin-left: auto;
        }

        header nav {
            background-color: gray;
            border-radius: 5px;
            padding: 5px 10px;
            font-family: 'Times New Roman', Times, serif;
        }

        header nav:not(.exit) {
            margin-right: 15px;
        }

        .form label {
            display: block;
        }

        .error {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
<header>
    <h2>#myshop</h2>
    <nav class="home">Home</nav>
    <nav class="comments">Comments</nav>
    <nav class="exit">Exit</nav>
</header>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">

    <div class="form">
        <fieldset>
            <legend>#Write-comment</legend>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <?php displayError('name', $errors); ?>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <?php displayError('email', $errors); ?>
            <label for="message">Comment:</label><br>
            <textarea id="message" name="message" rows="4" cols="50"></textarea>
            <?php displayError('message', $errors); ?>
            <label for="agree">Do you agree with data processing?</label>
            <input type="checkbox" id="agree" name="agree">
            <?php displayError('agree', $errors); ?>
        </fieldset>
        <input type="submit" value="Send"><br>
    </div>
</form>
</body>
</html>
