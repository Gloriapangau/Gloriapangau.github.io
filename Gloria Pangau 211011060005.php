<?php
function isAccepted($word)
{
    $currentState = 0;
    $finalStates = [3];
    $accepted = false;

    for ($i = 0; $i < strlen($word); $i++) {
        switch ($currentState) {
            case 0:
                if ($word[$i] === 'a') {
                    $currentState = 1;
                } elseif ($word[$i] === 'b') {
                    $currentState = 2;
                } else {
                    return false;
                }
                break;
            case 1:
                if ($word[$i] === 'b') {
                    $currentState = 2;
                } else {
                    return false;
                }
                break;
            case 2:
                if ($word[$i] === 'a') {
                    $currentState = 3;
                } else {
                    return false;
                }
                break;
            case 3:
                if ($word[$i] === 'a') {
                    $currentState = 3;
                } else {
                    return false;
                }
                break;
        }
    }

    return ($currentState === 2 || $currentState === 3);
}

$word = isset($_POST['word']) ? $_POST['word'] : '';

if (!empty($word)) {
    $result = isAccepted($word) ? "Accepted" : "Not Accepted";
    $output = "Word: " . $word . "<br>Status: " . $result;
} else {
    $output = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>NFA Word Acceptance</title>
    <style>
        html, body {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-image: url("unsrat.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        h1 {
            margin-top: 0;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 200px;
        }

        button[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            font-weight: bold;
            margin-bottom: 20px;
        }

        img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>NFA Word Acceptance</h1>
        <form method="post">
            <label for="word">Enter a word:</label>
            <input type="text" name="word" id="word" required>
            <button type="submit">Check</button>
        </form>
        <div class="result">
            <?php echo $output; ?>
        </div>
    </div>
</body>
</html>
