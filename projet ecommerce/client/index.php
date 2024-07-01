<?php require_once 'commandes.php'; ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <!-- Vos balises meta et liens CSS/JS ici -->
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: 1fr;
        }

        .background-one {
            background-color: #151515;
        }

        .background-two {
            background-color: #151515;
        }

        .background-three {
            background-color: #151515;
        }

        .link-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: relative;
            z-index: 0;
        }

        a {
            font-family: "Bungee", cursive;
            font-size: 2.5em;
        }

        .link-one {
            color: #53d9d1;
            transition: color 1s cubic-bezier(0.32, 0, 0.67, 0);
            line-height: 1em;
        }

        .link-one:hover {
            color: #111;
            transition: color 1s cubic-bezier(0.33, 1, 0.68, 1);
        }

        .link-one::before {
            content: "";
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            background-color: #53d9d1;
            clip-path: circle(0% at 50% calc(50%));
            transition: clip-path 1s cubic-bezier(0.65, 0, 0.35, 1);
        }

        .link-one:hover::before {
            clip-path: circle(100% at 50% 50%);
        }

        .link-one::after {
            content: "";
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            background-color: #151515;
            clip-path: polygon(
                40% 0%,
                60% 0%,
                60% 0%,
                40% 0%,
                40% 100%,
                60% 100%,
                60% 100%,
                40% 100%
            );
            transition: clip-path 1s cubic-bezier(0.65, 0, 0.35, 1);
        }

        .link-one:hover::after {
            clip-path: polygon(
                40% 10%,
                60% 10%,
                60% 35%,
                40% 35%,
                40% 90%,
                60% 90%,
                60% 65%,
                40% 65%
            );
        }

        .link-two {
            color: #f27b9b;
            transition: color 1s cubic-bezier(0.32, 0, 0.67, 0);
        }

        .link-two:hover {
            color: #111;
            transition: color 1s cubic-bezier(0.33, 1, 0.68, 1);
        }

        .link-two::before {
            content: "";
            position: absolute;
            z-index: -2;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            clip-path: polygon(
                0% -20%,
                100% -30%,
                100% -10%,
                0% 0%,
                0% 130%,
                100% 120%,
                100% 100%,
                0% 110%
            );
            background-color: #f27b9b;
            transition: clip-path 1s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .link-two:hover::before {
            clip-path: polygon(
                0% 10%,
                100% 0%,
                100% 20%,
                0% 30%,
                0% 100%,
                100% 90%,
                100% 70%,
                0% 80%
Here's the continuation of the modified HTML code:

```php
            );
        }

        .link-two::after {
            content: "";
            position: absolute;
            z-index: -2;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            clip-path: polygon(
                0% -20%,
                100% -30%,
                100% -10%,
                0% 0%,
                0% 130%,
                100% 120%,
                100% 100%,
                0% 110%
            );
            background-color: #151515;
            transition: clip-path 1s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .link-two:hover::after {
            clip-path: polygon(
                0% 10%,
                100% 0%,
                100% 20%,
                0% 30%,
                0% 100%,
                100% 90%,
                100% 70%,
                0% 80%
            );
        }

        .link-three {
            color: #ffd700;
            transition: color 1s cubic-bezier(0.32, 0, 0.67, 0);
        }

        .link-three:hover {
            color: #111;
            transition: color 1s cubic-bezier(0.33, 1, 0.68, 1);
        }

        .link-three::before {
            content: "";
            position: absolute;
            z-index: -3;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            clip-path: polygon(
                0% -30%,
                100% -20%,
                100% 0%,
                0% 10%,
                0% 100%,
                100% 110%,
                100% 130%,
                0% 120%
            );
            background-color: #ffd700;
            transition: clip-path 1s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .link-three:hover::before {
            clip-path: polygon(
                0% -10%,
                100% 0%,
                100% 20%,
                0% 30%,
                0% 90%,
                100% 100%,
                100% 80%,
                0% 70%
            );
        }

        .link-three::after {
            content: "";
            position: absolute;
            z-index: -3;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            clip-path: polygon(
                0% -30%,
                100% -20%,
                100% 0%,
                0% 10%,
                0% 100%,
                100% 110%,
                100% 130%,
                0% 120%
            );
            background-color: #151515;
            transition: clip-path 1s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .link-three:hover::after {
            clip-path: polygon(
                0% -10%,
                100% 0%,
                100% 20%,
                0% 30%,
                0% 90%,
                100% 100%,
                100% 80%,
                0% 70%
            );
        }
    </style>
</head>
<body>
    <div class="background-one">
        <div class="link-container">
            <a class="link-one" href="categorie.php?id=1">Femme</a>
        </div>
    </div>
    <div class="background-two">
        <div class="link-container">
            <a class="link-two" href="categorie.php?id=2">Homme</a>
        </div>
    </div>
    <div class="background-three">
        <div class="link-container">
            <a class="link-three" href="categorie.php?id=3">Enfant</a>
        </div>
    </div>
</body>
</html>