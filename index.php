<?php $io = 0; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#000000" id="themeColor">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>jQuery Tree Nav Example</title>
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <!--Font Awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--Tree Nav CSS-->
    <link rel="stylesheet" href="css/tree-nav.css" />
</head>
<body>
    <div class="tree-nav default">
        <ul class="main-items">
            <?php
                function generateDirList($dir) {
                    $items = scandir($dir);
                    echo "<ul>";
                    foreach ($items as $item) {
                        if ($item !== '.' && $item !== '..') {
                            $path = $dir . '/' . $item;
                            if (is_dir($path)) {
                                echo "<li data-type='folder' data-type='file'><a href='#'>$item</a>";
                                generateDirList($path);
                                echo "</li>";
                            } else {
                                switch (pathinfo($item, PATHINFO_EXTENSION)) {
                                    case 'php':
                                        echo "<li data-type='file'><a href='$path'><i class='fa-brands fa-php'>&nbsp</i>$item</a></li>";
                                        break;
                                    case 'js':
                                        echo "<li data-type='file'><a href='$path'><i class='fa-brands fa-js'>&nbsp</i>$item</a></li>";
                                        break;
                                    case 'png':
                                    case 'jpg'
                                        echo "<li data-type='file'><a href='$path'><i class='fa-sharp-duotone fa-solid fa-file-image'></i>&nbsp $item</a></li>";
                                        break;
                                    case 'html':
                                    case 'html5':
                                        echo "<li data-type='file'><a href='$path'><i class='fa-brands fa-html5'>&nbsp</i>$item</a></li>";
                                        break;
                                    case 'json':
                                        echo "<li data-type='file'><a href='$path'><i class='fa-solid fa-code'>&nbsp</i>$item</a></li>";
                                        break;
                                    case 'css':
                                        echo "<li data-type='file'><a href='$path'><i class='fa-solid fa-css3'>&nbsp</i>$item</a></li>";
                                        break;
                                    default:
                                        echo "<li data-type='file'><a href='$path'>📄<i class=''></i>$item</a></li>";
                                        break;
                                }
                            }
                        }
                    }
                    echo "</ul>";
                }
                generateDirList('../'); // Change this path as needed
            ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="js/jquery.treenav.js"></script>
    <script>
        $(document).ready(function(){
            $(".tree-nav").treeNav();

            // Filter functionality
            $('#fileFilter').on('input', function() {
                var filterValue = $(this).val().trim().toLowerCase();
                var count = 0;
                if (count == 0){
                    
                }
                // Hide all items first
                $('.main-items li').hide();
                
                // If filterValue is not empty, filter the items
                if (filterValue) {
                    $('.main-items li[data-type="file"]').each(function() {
                        var fileName = $(this).text().trim().toLowerCase();
                        // Hide file if it doesn't match the filter
                        if (fileName.endsWith(filterValue)) {
                            $(this).show(); // Show matching file
                            count++; // Increment count for matching files

                            // Show the parent folder of the matching file
                            $(this).closest('li[data-type="folder"]').show();
                            $(this).closest('ul').show(); // Show the folder containing the file
                        }
                    });
                } else {
                    // If no filter, show all items
                    $('.main-items li').show();
                    count = $('.main-items li[data-type="file"]').length; // Count all files
                }

                // Update the count display
                $('#fileCount').text(count);
            });
        });
    </script>
</body>
</html>
