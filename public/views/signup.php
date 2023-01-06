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
<div class="container-signup">
    <header class="logo-container">
        <h1 class="logo"><em class="logo-prefix">e</em>Diary</h1>
    </header>
    <main class="container">
        <form class="signup form-horizontal" action="signup" method="POST">
            <h3>User type</h3>
            <div class="radio-group">
                <?php
                if (isset($userTypes)) {
                    foreach ($userTypes as $value): ?>
                        <label class="form-control">
                            <input type="radio" name="userType" value="<?php echo $value; ?>"> <?php echo $value; ?>
                        </label>
                    <?php endforeach;
                } ?>
            </div>

            <div>
                <input name="email" type="email" required placeholder="email address">
                <input name="password" type="password" required placeholder="password">
                <input name="confirmedPassword" type="password" required placeholder="repeat password">
            </div>
            <div>
                <input name="name" type="text" required placeholder="name">
                <input name="surname" type="text" required placeholder="surname">
                <input name="pesel" type="text" pattern="[0-9]{11}" required placeholder="pesel">
            </div>

            <label>date of birth<br><input name="dateOfBirth" type="date" required></label>
            <input name="placeOfBirth" type="text" required placeholder="place of birth">
            <input name="postalCode" type="text" pattern="[0-9]{5}" required placeholder="five digit postal code">
            <input name="street" type="text" required placeholder="street">
            <input name="locality" type="text" required placeholder="locality">
            <input name="houseNumber" type="number" required placeholder="house number">
            <input name="phoneNumber" type="tel" pattern="[+]{1}[0-9]{11,14}" required
                   placeholder="phone number with exit code">

            <input name="gender" type="text" placeholder="gender">

            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>

            <button type="submit">Login</button>
        </form>
    </main>
    <a href="signup.php" class="sign-up">Sign up</a>
</div>
</body>