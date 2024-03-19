<?php
function displayError($field, $errors) {
    if (!empty($errors) && isset($errors[$field])) {
        echo "<p class='error'>" . $errors[$field] . "</p>";
    }
}

$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $radio = isset($_POST['radio']) ? $_POST['radio'] : '';
    $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : '';

    $errors = validateForm($name, $radio, $checkbox);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Документ</title>
    <style>
        fieldset label {
            display: block;
            margin-bottom: 10px;
        }
        form {
            background-color: gainsboro;
            font-weight: bolder;
        }
        .error {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <fieldset>
            <legend>Приветствуем</legend>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name">
                <?php displayError('name', isset($errors) ? $errors : []); ?>
            </div>
            <div class="form-group">
                <label for="radio">Выберите</label>
                <input type="radio" id="radio" name="radio">
                <?php displayError('radio', isset($errors) ? $errors : []); ?>
            </div>
            <div class="form-group">
                <label for="checkbox">Отметьте</label>
                <input type="checkbox" id="checkbox" name="checkbox">
                <?php displayError('checkbox', isset($errors) ? $errors : []); ?>
            </div>
        </fieldset>
        <input type="submit" value="Отправить">
    </form>

<?php
function validateForm($name, $radio, $checkbox) {
    $errors = array();

    if(empty($name)) {
        $errors["name"] = "Поле 'Имя' не заполнено";
    }

    if (empty($radio)) {
        $errors["radio"] = "Выберите 'Выберите'";
    }

    if(empty($checkbox)) {
        $errors["checkbox"] = "Отметьте 'Отметьте' ";
    } 
    
    return $errors;

}
?>
</body>
</html>
