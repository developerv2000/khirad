<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Маркази Хирад</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: rgb(155, 255, 222);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: rgba(39, 29, 95, 255);
            width: 350px;
            height: 680px;
            padding: 20px;
            border-radius: 30px;
            position: relative;
            margin: 10px 0px;
        }

        .header {
            display: inline;
        }

        .header i {
            width: 35px;
            padding: 10px;
            text-align: center;
            border-radius: 10px;
            background: rgba(170, 170, 170, 0.37);
            color: rgb(12, 134, 248);
        }

        p {
            color: rgb(197, 197, 197);
            padding: 20px 35px;
            text-align: center;
        }

        img {
            width: 80%;
            transform: rotate(-3deg);
            height: 250px;
            margin-left: 20px;
        }

        h2 {
            color: rgb(197, 197, 197);
            text-align: center;
        }

        hr {
            width: 60%;
            margin: 25px auto;
            border: 1px solid rgb(98, 98, 98);
        }

        .social_link {
            display: flex;
            width: 200px;
            margin-left: 76px;
        }

        a i {
            padding: 5px;
            background: rgba(170, 170, 170, 0.37);
            font-size: 20px;
            color: #fff;
            border-radius: 5px;
            margin: 15px;
        }

        a span {
            color: #eee;
            display: flex;
            margin-top: -5px;
            justify-content: center;
        }

        button {
            border-radius: 10px;
            border: none;
            background-color: rgb(10, 219, 246);
            width: calc(100% - 56px);
            text-align: center;
            color: #000;
            outline: none;
            height: 45px;
            position: absolute;
            font-size: 22px;
            bottom: 25px;
            cursor: pointer;
            left: 20px;
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://raw.githubusercontent.com/webcreator12/paymentpage/main/img/card.png" alt="card image" />
        <h2>Пардохти Шумо бо муваффақият қабул гардид</h2>
        <p>Барои хондани китоб ба барнома баргардед</p>
        <hr>

        <button onclick="doSomething()">Кушодани барнома</button>
    </div>

    <script>
        window.onload = function() {
            doSomething();
        }

        function doSomething() {
            alert("Do something!");
        }
    </script>
</body>

</html>
