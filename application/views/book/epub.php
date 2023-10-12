<?php
foreach ($filerow as $item):
    $ext = pathinfo($item['file_name'], PATHINFO_EXTENSION);
    $ext = strtoupper($ext);
    $filename = 'data/books/bk' . $id . '/' . $item['file_name'];
    if (file_exists($filename)) {
        if ($ext == 'EPUB'){
            $link = $filename;
        }

    }
endforeach;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <script src="<?php echo base_url('cssjs/jszip.min.js'); ?>"></script>
        <script src="<?php echo base_url('cssjs/epub.min.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('cssjs/w3.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('cssjs/examples.css'); ?>">

        <style type="text/css">

            .epub-container {
                min-width: 320px;
                margin: 0 auto;
                position: relative;
            }

            .epub-container .epub-view > iframe {
                background: white;
                box-shadow: 0 0 4px #ccc;
                /*margin: 10px;
                padding: 20px;*/
            }

        </style>
    </head>
    <body>
        <div class="w3-container w3-center w3-gray w3-margin">
            <ul>
            <?php echo anchor('book/details/'.remove_bracket($title).'/'.$id, '<li class="w3-button">Back</li>'); ?>
        </ul>
        </div>
        <div id="viewer"></div>

        <script>
            var currentSectionIndex = 1;
            var params = URLSearchParams && new URLSearchParams(document.location.search.substring(1));
            var url = params && params.get("url") && decodeURIComponent(params.get("url"));
            var currentSectionIndex = (params && params.get("loc")) ? params.get("loc") : undefined;
            // Load the opf
            var book = ePub(url || "<?php echo base_url($link); ?>");
            var rendition = book.renderTo(document.body, {
                manager: "continuous",
                flow: "scrolled",
                width: "60%"
            });
            var displayed = rendition.display();


            displayed.then(function (renderer) {
                // -- do stuff
            });

            // Navigation loaded
            book.loaded.navigation.then(function (toc) {
                // console.log(toc);
            });


        </script>

    </body>
</html>
