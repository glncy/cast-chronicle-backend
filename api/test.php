<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p id="content"></p>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
    function testRequest(){
        $.ajax({
            url: "post.php",
            type: "GET",
            dataType: 'json',
            data: {
                article_id:'7'
            },
            success: function (r) {
                var str = JSON.stringify(r);
                var obj = JSON.parse(str);
                console.log(obj);
                console.log(obj[0].body);
                $("#content").html(obj[0].body);
            }
        });
    }
    </script>
</body>
</html>