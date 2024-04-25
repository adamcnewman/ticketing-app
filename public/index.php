<!DOCTYPE html>
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <!-- jQuery, TinyMCE -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.tiny.cloud/1/eaq3tqh0gtcu2g4zqwj8d0r8q07m615oaxddq98hnhaucd3h/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>

    <title>Ticketing App</title>
</head>
<body>
    <h3>Bonjour</h3>
    <div>
        <textarea id="tiny">&lt;p&gt;&lt;/p&gt;</textarea>
    </div>
    <script>
      $('textarea#tiny').tinymce({
        height: 300,
        menubar: false,
        plugins: [
          'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
          'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
          'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist outdent indent | removeformat | help'
      });
    </script>

    <?php
    //     require_once(realpath(__DIR__ . "/../src/Core/Database.php"));
    //     $db = new Database();
    //     $connection = $db->getConnection();
    //     $stmt = $connection->prepare("DROP DATABASE ticketing_app");
    //     $stmt->execute();
    //     $stmt->close();
    ?>
</body>
</html>