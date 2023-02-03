<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>eDiary</title>
    <meta name="description" content="login page">
    <link rel="stylesheet" type="text/css" href="/public/scss/main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Amita&subset=latin,latin-ext" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <header class="logo-container">
        <h1 class="logo"><em class="logo-prefix">e</em>Diary</h1>
    </header>
    <main class="login-container">
        <form class="login form-vertical" action="login" method="POST">
            <input name="email" type="email" required placeholder="email address">
            <input name="password" type="password" required placeholder="password">

            <div class="warnings">
                <?php
                if (isset($warnings)) {
                    foreach ($warnings as $warning) {
                        echo $warning;
                    }
                }
                ?>
            </div>
            <div><?php if(isset($messages)) {
                foreach ($messages as $message){
                    echo "<p>$message</p>";
                }
            } ?></div>
            <button type="submit">Login</button>
        </form>
    </main>
    <a href="signup" class="sign-up">Sign up</a>
</div>
</body>