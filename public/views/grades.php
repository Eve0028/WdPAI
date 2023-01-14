<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>eDiary</title>
    <meta name="description" content="dashboard">
    <link rel="stylesheet" type="text/css" href="/public/scss/main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Amita&subset=latin,latin-ext" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container-tile-option">
    <a href="logout" class="sign-out">Sign out</a>
    <a class="logo-link" href="dashboard"><h1 class="logo"><em class="logo-prefix">e</em>Diary</h1></a>

    <div class="container">
        <a class="back-to-dashboard" href="dashboard"><-</a>
        <?php include __DIR__ . "/grades/{$userType}.php"; ?>
    </div>
</div>
</body>