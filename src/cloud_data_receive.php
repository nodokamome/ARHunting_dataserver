<?php
if ($_FILES["file"]["type"]=="text/csv") {
    if ($_FILES["file"]["error"] > 0) {
        //echo "Return Code:" . $_FILES["file"]["error"] . "";
    } else {
        //echo "Upload:" . $_FILES["file"]["name"] . " ";
        //echo "Type:" . $_FILES["file"]["type"] . " ";
        //echo "Size:" . ($_FILES["file"]["size"] / 1024) . "Kb ";
        //echo "Temp file:" . $_FILES["file"]["tmp_name"] . " ";

        // サーバー上に既にファイルが存在していないか確認
        if (file_exists("csv/" . $_FILES["file"]["name"])) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "csv/" . $_FILES["file"]["name"]);
            echo "successfully overwrite";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "csv/" . $_FILES["file"]["name"]);
            echo "successfully upload";
        }
    }
} else {
    echo "Invalid file";
}
