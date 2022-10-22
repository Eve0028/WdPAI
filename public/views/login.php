<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>eDiary</title>
    <meta name="description" content="login page">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Amita&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="container">
    <header class="logo-container">
        <h1 class="logo"><em class="logo-prefix">e</em>Diary</h1>
    </header>
    <main class="login-container">
        <form class="login" action="" method="POST">
            <input name="email" type="text" placeholder="email address">
            <input name="password" type="password" placeholder="password">
            <button type="submit">Login</button>
        </form>
    </main>
    <div class="sign-up-container">
        <a href="signup.php" class="sign-up">Sign up</a>
    </div>
</div>
</body>