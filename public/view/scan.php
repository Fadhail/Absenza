<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../js/jquery.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#cekkartu").load('bacakartu.php')
            },2000 );
        });
    </script>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'components/sidebar.php'?>

    <!-- Content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="container-fluid">
                <div id="cekkartu"></div>
            </div>
        </div>
    </div>
</body>
</html>