<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>eDiary</title>
    <meta name="description" content="login page">
    <link rel="stylesheet" type="text/css" href="/public/scss/signup.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Amita&subset=latin,latin-ext" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
</head>

<body>
<div class="container">
    <header class="logo-container">
        <h1 class="logo"><em class="logo-prefix">e</em>Diary</h1>
        <h2>Registration</h2>
    </header>
    <main class="signup-container">
        <form class="signup form-horizontal" action="signup" method="POST">

            <section class="user-type-section form-section">
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
            </section>

            <section class="details-section form-section">
                <h3>User details</h3>
                <div class="line-in-form">
                    <div class="email-container input-container">
                        <input oninvalid="this.setCustomValidity('Enter email')"
                               oninput="this.setCustomValidity('')" name="email" type="email" required
                               placeholder="email address">
                        <p class="invalid-message"></p>
                    </div>
                </div>
                <div class="line-in-form">
                    <div class="password-container input-container">
                        <input name="password" type="password" required
                               placeholder="password">
                        <p class="invalid-message"></p>
                    </div>
                    <div class="confirm-password-container input-container">
                        <input name="confirmedPassword" type="password" required placeholder="repeat password">
                        <p class="invalid-message"></p>
                    </div>
                </div>
                <div class="line-in-form">
                    <input name="name" type="text" required placeholder="name">
                    <input name="surname" type="text" required placeholder="surname">
                </div>
                <div class="line-in-form">
                    <div class="pesel-container input-container">
                        <input name="pesel" type="text" pattern="[0-9]{11}" required
                               placeholder="pesel">
                        <p class="invalid-message"></p>
                    </div>
                </div>
            </section>

            <section class="birth-section form-section">
                <h3>Place and date of birth</h3>
                <div class="line-in-form">
                    <input name="placeOfBirth" type="text" required placeholder="place of birth">
                    <input name="dateOfBirth" type="date" required>
                </div>
            </section>

            <section class="address-section form-section">
                <h3>Address</h3>
                <div class="line-in-form">
                    <input name="locality" type="text" required placeholder="locality">
                    <input name="street" type="text" required placeholder="street">
                </div>
                <div class="line-in-form">
                    <input name="houseNumber" type="number" pattern="[0-9]{0-10}" required placeholder="house number">
                    <div class="postal-code-container input-container">
                        <input name="postalCode" type="text" pattern="[0-9]{5}" required
                               placeholder="five digit postal code">
                        <p class="invalid-message"></p>
                    </div>
                </div>

                <div class="line-in-form">
                    <div class="phone-container input-container">
                        <input name="phoneNumber" type="tel" pattern="[+]{1}[0-9]{11,14}" required
                               placeholder="phone number with exit code">
                        <p class="invalid-message"></p>
                    </div>
                </div>
            </section>

            <section class="gender-section form-section">
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
            </section>

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