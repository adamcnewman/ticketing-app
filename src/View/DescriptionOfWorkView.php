<div id="description-of-work" class="section">
    <h2 class="section-header">Description Of Work</h2>
    <div class="section-content">
    <div>
        <label for="tinymce">Description:</label>
        <textarea id="tinymce" name="tinymce">&lt;p&gt;&lt;/p&gt;</textarea>
    </div>
    <script>
      $('textarea#tinymce').tinymce({
        height: 250,
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
    </div>
</div>