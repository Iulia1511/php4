<?php
$errors = []; 

function displayError($field, $errors) {
    if (!empty($errors) && isset($errors[$field])) {
        echo "<p class='error'>" . $errors[$field] . "</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $review = isset($_POST["review"]) ? $_POST["review"] : '';
    $comment = isset($_POST["comment"]) ? $_POST["comment"] : '';

    function IsValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Поле 'Ваше имя' не заполнено";
    }
    if (empty($comment)) {
        $errors['comment'] = "Поле 'Комментарий' не заполнено";
    }

    if (empty($email)) {
        $errors['email'] = "Поле 'Ваш e-mail' не заполнено";
    } elseif (!IsValidEmail($email)) {
        $errors['email'] = "Некорректный формат email";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="form">
 <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
 <fieldset>
 <legend>Оставьте отзыв!</legend>
 <div id="main_info" style="display: flex; flex-direction:
column; gap: 10px;">
 <div>
 <label for="name">Имя:
 <input type="text" name="name"/>
 </label>
 <?php displayError('name', $errors); ?> <!-- Передаем массив ошибок $errors в функцию displayError -->
 </div>
 <div>
 <label for="email">Email:
 <input type="email" name="email"/>
 </label>
 <?php displayError('email', $errors); ?> <!-- Передаем массив ошибок $errors в функцию displayError -->
 </div>
 </div>
 <div id="extra_info">
 <div>
 <p><label for="review">Оцените наш сервис!</label></p>
 <div style="display: flex; flex-direction: column;">
 <p><input id="review" type="radio" name="review"
value="10" checked>Хорошо</p>
 <p><input id="review" type="radio" name="review"
value="8">Удовлетворительно</p>
 <p><input id="review" type="radio" name="review"
value="5">Плохо</p>
 </div>
 </div>
 </div>
 <div id="message_info">
 <div>
 <p><label for="comment">Ваш комментарий: </label></p>
 <textarea id="comment" name="comment" cols="30"
rows="10" class="comment"></textarea>
 <?php displayError('comment', $errors); ?> <!-- Передаем массив ошибок $errors в функцию displayError -->
 </div>
 </div>
 <div id="buttons" style="display: flex; flex-direction: row;
gap: 10px; margin-top: 10px;">
 <input type="submit" value="Отправить"/>
 <input type="reset" value="Удалить"/>
 </div>
 </fieldset>
 </form>
 <?php
 // Проверяем, была ли отправлена форма, и выводим сообщение об успешной отправке или ошибки
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($errors)) {
        // Если есть ошибки, выводим их
        echo "<div id='error_message'>";
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
        echo "</div>";
    } else {
        // Если ошибок нет, выводим сообщение об успешной отправке
        echo "<div id='result'>";
        echo "<p>Спасибо за ваш отзыв!</p>";
        echo "</div>";
    }
 }
 ?>
</div>
</body>
</html>

