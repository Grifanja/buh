//<script src="node_modules/react/index.js"></script>
//    <script src="node_modules/react-dom/index.js"></script>
window.onload = function() {

    var graph = {
        'Joined':{},
        'Left'  :{}
    };
    console.log(Date.parse(new Date()).toString('yyyy-MM-dd H:i:s'));

    var date_start = Date.parse(new Date("2019-02-01 00:00:00"));
    var date_end   = Date.parse(new Date());

    for (date_start ; date_start < date_end; ) {
        graph.Joined[date_start] = parseInt( Math.random()*200 );
        graph.Left[date_start]   = parseInt( Math.random()*30 );
        date_start += 60*60*24*1000;
    }


    var cube             = 6;
    var min_x            = cube;
    var min_y            = cube;
    var maxFollowers     = 261;
    var countHeihtStep   = 7;
    var minCountDayStep  = 2;
    var heightStep       = maxFollowers / countHeihtStep;
    heightStep           = heightStep > 1 ? heightStep+(Math.abs(heightStep%10 - 10)) : 0.5;
    var drawingCanvas    = document.getElementById('clip');
    var height           = min_x * 100;
    var width            = min_y * 100;
    var objLeft          = Object.keys(graph.Left)
    objLeft              = objLeft.slice( objLeft.length-1-(cube*minCountDayStep), objLeft.length-1);
    var months           = ["Jan", "Feb", "Mar","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];


    drawingCanvas.width  = width;
    drawingCanvas.height = height+50;

    if(drawingCanvas && drawingCanvas.getContext) {
        var context = drawingCanvas.getContext('2d');

        context.beginPath();

        for(var i = 0;i<=cube;i++){
         //   console.log(i);
            var date = new Date(Number(objLeft[i*2]));
            console.log(date.format('DD-MMM-YYYY'));
            console.log(new Date(Number(objLeft[i*2])));



            context.fillText((height/100-i)*heightStep, 5, i*100-10);
            context.fillText(months[date.getMonth()]+' '+date.getDate(), i*100 + 10, width+10);
            context.fillRect(0,i*100-1,width,1);
        }




        context.closePath();
        context.stroke();
        context.fill();

    }




}






ReactDOM.render(
    React.createElement(
        'h1',
        null,
        'Hello World!'
    ),
    document.getElementById('root')
);