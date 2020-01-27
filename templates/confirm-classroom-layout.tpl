<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="./js/constants.js"></script>    
    <script type="text/javascript" src="./js/string.js"></script> 
     <script type="text/javascript" src="./js/classroomLayout.js"></script>
     <title>レイアウト確認</title>
</head>
<body>
    <div>
        <canvas id="canvas" height="600" width=800"></canvas>
    </div>
    
    <script  type="text/javascript">
        var data = {$seat_info|@json_encode};
        init(data);
     </script>
</body>
</html>