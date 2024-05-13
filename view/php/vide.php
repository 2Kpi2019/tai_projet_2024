<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Engrenages</title>
<style>
    body {
        background-color: #f0f0f0;
        overflow: hidden;
    }

    .gear {
        position: absolute;
        width: 100px; /* Largeur de l'engrenage */
        height: 100px; /* Hauteur de l'engrenage */
    }

    #center-gear {
        top: 50%;
        left: 50%;
        margin-top: -50px;
        margin-left: -50px;
        z-index: 3;
        animation: rotateClockwise 5s linear infinite; /* Animation de rotation dans le sens horaire */
    }

    .peripheral-gear {
        width: 50px; /* Largeur de l'engrenage périphérique */
        height: 50px; /* Hauteur de l'engrenage périphérique */
        z-index: 2;
        animation: rotateClockwise 5s linear infinite; /* Animation de rotation dans le sens horaire */
    }

    .peripheral-gear:nth-child(2) {
        top: 50%;
        left: 35%;
        transform-origin: center center;
    }

    .peripheral-gear:nth-child(3) {
        top: 35%;
        left: 50%;
        transform-origin: center center;
    }

    .peripheral-gear:nth-child(4) {
        top: 50%;
        left: 65%;
        transform-origin: center center;
    }

    .peripheral-gear:nth-child(5) {
        top: 65%;
        left: 50%;
        transform-origin: center center;
    }

    .peripheral-gear:nth-child(6) {
        top: 50%;
        left: 15%;
        transform-origin: center center;
    }

    @keyframes rotateClockwise {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
</head>
<body>

<img src="/figs/roue3.png" class="gear" id="center-gear">

<img src="/figs/roue3.png" class="gear peripheral-gear">
<img src="/figs/roue3.png" class="gear peripheral-gear">
<img src="/figs/roue3.png" class="gear peripheral-gear">
<img src="/figs/roue3.png" class="gear peripheral-gear">
<img src="/figs/roue3.png" class="gear peripheral-gear">

</body>
</html>
