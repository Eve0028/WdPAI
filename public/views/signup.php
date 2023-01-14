<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>eDiary</title>
    <meta name="description" content="login page">
    <link rel="stylesheet" type="text/css" href="/public/scss/signup.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Amita&subset=latin,latin-ext" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <header class="logo-container">
        <h1 class="logo"><em class="logo-prefix">e</em>Diary</h1>
        <h2>Registration</h2>
    </header>
    <main class="signup-container">
        <form class="signup form-horizontal" action="signup" method="POST">
            <h3>User type</h3>
            <div class="radio-group line-in-form">
                <?php
                if (isset($userTypes)) {
                    foreach ($userTypes as $value): ?>
                        <label class="form-control">
                            <input type="radio" name="userType" required
                                   value="<?php echo $value; ?>"> <?php echo $value; ?>
                        </label>
                    <?php endforeach;
                } ?>
            </div>


            <input oninvalid="this.setCustomValidity('Enter Uemaaail')"
                   oninput="this.setCustomValidity('')" name="email" type="email" required placeholder="email address">

            <div class="line-in-form">
                <input name="password" type="password" required placeholder="password">
                <input name="confirmedPassword" type="password" required placeholder="repeat password">
            </div>
            <div class="line-in-form">
                <input name="name" type="text" required placeholder="name">
                <input name="surname" type="text" required placeholder="surname">
            </div>

            <input class="line-in-form" name="pesel" type="text" pattern="[0-9]{11}" required placeholder="pesel">

            <h3>Place and date of birth</h3>
            <div class="line-in-form">
                <input name="placeOfBirth" type="text" required placeholder="place of birth">
                <label><input name="dateOfBirth" type="date" required></label>
            </div>

            <h3>Address</h3>
            <div class="line-in-form">
                <input name="locality" type="text" required placeholder="locality">
                <input name="street" type="text" required placeholder="street">
            </div>
            <div class="line-in-form">
                <input name="houseNumber" type="number" pattern="[0-9]{0-10}" required placeholder="house number">
                <input name="postalCode" type="text" pattern="[0-9]{5}" required placeholder="five digit postal code">
            </div>

            <input class="line-in-form" name="phoneNumber" type="tel" pattern="[+]{1}[0-9]{11,14}" required
                   placeholder="phone number with exit code">

            <h3>Gender</h3>
            <div class="radio-group line-in-form">
                <?php
                if (isset($genderTypes)) {
                    foreach ($genderTypes as $value): ?>
                        <label class="form-control">
                            <input type="radio" name="gender" required
                                   value="<?php echo $value; ?>"> <?php echo $value; ?>
                        </label>
                    <?php endforeach;
                } ?>
            </div>

            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>

            <button type="submit">Sign up</button>
        </form>
    </main>
    <a href="login" class="login">Login</a>
</div>
</body>