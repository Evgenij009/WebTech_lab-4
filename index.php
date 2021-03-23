<?php
include("processingLines.php");
define("TEXT_EXTENSIONS", array('txt', 'tex', 'bat'));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lab-4</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>

<body>

    <header>
        <h1>Word processing</h1>
    </header>

    <div class="basic">

        <form action="index.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" id="" class="input__file" accept="text/plain" required>
            <div class="container">
                <button calss="btn" type="submit">Run</button>
            </div>
        </form>

        <?php
        $is_submit = $_SERVER['REQUEST_METHOD'] === 'POST';
        if ($is_submit) {
            if (isset($_FILES["file"])) {
                $file = $_FILES["file"];
                $file_path_data = explode('.', $file['name']);
                $extension = strtolower(end($file_path_data));
                $path = "files/" . $_FILES['file']['name'];
                copy($_FILES['file']['tmp_name'], $path);
                $created_file = fopen($path, "r");
                echo "<textarea name='source' class=\"textarea__source\">";
                $str = "";
                while (!feof($created_file)) {
                    $str .= htmlentities(fgets($created_file));
                }
                echo $str;
                fclose($created_file);
                //echo "</textarea>";
                $strResult = handlingString($str);
                //echo " <textarea class=\"textarea__result\"> $strResult </textarea>";
            }
        }

        ?>

    </div>

</body>

</html>