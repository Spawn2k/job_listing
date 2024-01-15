<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="/assets/js/main.js" defer></script>
</head>

<body>
    <main>
        <div class="container py-5">
            <h1></h1>
            <button class="btn btn-secondary">Click</button>
            <form action="/upload" method="POST" enctype="multipart/form-data">
                <input type="file" name="pic">
                <button>uploaded</button>
                <?php  ?>
            </form>
        </div>
    </main>
</body>

</html>
