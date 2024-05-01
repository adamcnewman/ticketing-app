<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery, TinyMCE -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous" x-content-type-options></script>
    <script src="https://cdn.tiny.cloud/1/eaq3tqh0gtcu2g4zqwj8d0r8q07m615oaxddq98hnhaucd3h/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>

    <script src="./js/script.js" ></script>
    <link rel="stylesheet" href="./css/style.css"></link>
    <title>Ticketing App</title>
</head>
<body>
    <div id="title-banner" class="container">
        <h2>Edit Ticket</h2>
    </div>
    <form class="container">
        <?php 
        // Project Section
        require_once __DIR__ . "/../src/Controller/ProjectController.php";
        $projectController = new ProjectController();
        $customers = $projectController->getCustomers();
        $jobs = $projectController->getJobs();
        $locations = $projectController->getLocations();
        include_once __DIR__ . "/../src/View/ProjectView.php";

        // Description of Work Section
        include __DIR__ . "/../src/View/DescriptionOfWorkView.php";

        // Labour Section
        include __DIR__ . "/../src/View/LabourView.php";

        // Truck Section
        include __DIR__ . "/../src/View/TruckView.php";
        
        // Miscellaneous Section
        include __DIR__ . "/../src/View/MiscView.php" ;
        ?>
        <button type="submit">Finish</button>
    </form>
</body>
</html>