<?php

/* Check the given image and change it */
function SaveImage($name, $path)
{
    $width = 300;
    $height = 300;
    $extension = "";
    if (isset($_FILES[$name]) && $_FILES[$name]["error"] == 0)
    {
        if ($_FILES[$name]["size"] < 8 * 1000 * 1000)
        {
            $extension = pathinfo($_FILES[$name]["name"])["extension"];
            if ($extension == "png")
            {
                move_uploaded_file($_FILES[$name]["tmp_name"], $path);

                $img = imagecreatefrompng($path);
                $size = getimagesize($path);
                $new_img = imagecreatetruecolor($width, $height);
                imagecopyresampled ($new_img, $img, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                imagepng($new_img, $path);
            }
        }
    }
}

