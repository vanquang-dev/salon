<html>
<head>
    <style>
    .container {
        width: 300px;
        height: 100px;
        border: solid 1px;
        position: relative;
        margin: 200px auto;
    }
 
    h3 {position: absolute;top: 0px;left: 125px;font-weight: lighter;font-size: 15px;}
 
    h5 {
        position: absolute;
        bottom: -10%;
            left: 50%;
        transform: translateX(-50%);
    }
    body{
        background: black;
        color:white;
    }
    .border {
        border: 1px solid white;
        height: 10px;
        position: absolute;
        top: 50px;
        width: 100px;
        left: 50%;
        transform: translateX(-50%);
    }
    div#load{
        width: 100px;
        height: 10px;
        background-color: white;
        position: absolute;
    }
    </style>
<head>
<body>
    <div class="container">
        <h3 id="h3">Loading...</h3>
        <div class="border">
            <div id="load"></div>
        </div>
    </div>
    <script src="views/assets/js/library/jquery.min.js"></script>
    <script>
        var text = document.querySelector('h3#h3');
            var div = document.querySelector('div#load');
            // var num = document.querySelector('h5');
            var trangthai = "motcham";
            var x = 0;
            var w = 0;
            var loading = setInterval(cham,200);
            // var numberplus = setInterval(chay,20);
            var divplus = setInterval(daira,40);
            function cham(){
                    if(trangthai == 'motcham'){
                    text.innerHTML = 'Loading' + '.';
                    trangthai = 'haicham';
                    }
                    else if(trangthai == 'haicham'){
                    text.innerHTML = 'Loading' + '..';
                    trangthai = 'bacham';
                    }
                    else if(trangthai == 'bacham'){
                    text.innerHTML = 'Loading' + '...';
                    trangthai = 'motcham';
                    }
                    if(x == 100 && trangthai == 'motcham'){
                        clearInterval(loading);
                    }
    
            }
            function chay() {
                    x++;
                    num.innerHTML = x + '%';
                    if(x == 100){
                        clearInterval(numberplus);
                    }
            }
            function daira(){
                    w += 1;
                    div.style.width = w +'px';
                    if(w == 100){
                        clearInterval(divplus);
                    }
            }
    </script>
</body>
</html>
