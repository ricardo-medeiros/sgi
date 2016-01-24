<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>:: File Upload ::</title>
</head>
<body>



<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

        <table align="center">
            <tr>
                <td style="font-weight: bold; size: 12px; color: blue;"
                    align="right">Select a file to upload: </td>
                <td><input type="file" name="file" size="50" /></td>
            </tr>
            <tr>
                <td><input type="button" value="Cancel"
                    style="font-size: 14px; color: blue;"></td>
                <td><input type="submit" name="submit" value="Upload File" style="font-size: 14px; color: blue;"></td>
            </tr>
        </table>
    </form>
    <p><?php echo $message;  ?></p>
</body>
</html>

    <?php

    $message="";
    if (isset($_POST['submit'])) {

        if($_FILES['image']['type'] == "image/png"){
            move_uploaded_file($_FILES['image']['tmp_name'], getenv('OPENSHIFT_DATA_DIR') . "/" . $_FILES['image']['name']);
        }else{
            $message="error";

        }
    }
    ?>