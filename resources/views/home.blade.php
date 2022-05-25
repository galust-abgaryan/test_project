@extends('layouts.app')

    @foreach($users as  $user)
        @php
            $count = count($users);
            $roll = explode(" ", $user['created_at'])[0];

        @endphp
    @endforeach


@section('content')
    <div id="app">
        <example-component></example-component>

    </div>

    <div class="wrapper" data-title="wrapper!">
        <h4
            data-hint="Hello! 👋this is wrapper 👋"
            data-hint-position="bottom-middle"
        ></h4>
        <canvas id='c'></canvas>
        <div class="label">text</div>
    </div>
    <p data-title="wrapper!" data-intro="this is wrapper 👋">Please mouse over the dots</p>

    <style>
        .wrapper {
            display: block;
            margin: 5em auto;
            border: 1px solid #555;
            width: 700px;
            height: 350px;
            position: relative;
        }
        p{text-align:center;}
        .label {
            height: 1em;
            padding: .3em;
            background: rgba(255, 255, 255, .8);
            position: absolute;
            display: none;
            color: #051589;

        }
    </style>
    <script>
        introJs().addHints();
        let label = document.querySelector(".label");
        let c = document.getElementById("c");
        let ctx = c.getContext("2d");
        let cw = c.width = 700;
        let ch = c.height = 350;
        let cx = cw / 2,
            cy = ch / 2;
        let rad = Math.PI / 180;
        let frames = 0;

        ctx.lineWidth = 1;
        ctx.strokeStyle = "#999";
        ctx.fillStyle = "#ccc";
        ctx.font = "14px monospace";

        let grd = ctx.createLinearGradient(0, 0, 0, cy);
        grd.addColorStop(0, "hsla(167,72%,60%,1)");
        grd.addColorStop(1, "hsla(167,72%,60%,0)");

        let oData = {


        "2022-02-15":51,
        "2022-03-02":1,
        "2022-07-10":18,
        "2025-03-10":11,
        "2028-03-10":100,


        };

        let valuesRy = [];
        let propsRy = [];
        for (let prop in oData) {

            valuesRy.push(oData[prop]);
            propsRy.push(prop);
        }


        let vData = 4;
        let hData = valuesRy.length;
        let offset = 50.5; //offset chart axis
        let chartHeight = ch - 2 * offset;
        let chartWidth = cw - 2 * offset;
        let t = 1 / 7; // curvature : 0 = no curvature
        let speed = 2; // for the animation

        let A = {
            x: offset,
            y: offset
        }
        let B = {
            x: offset,
            y: offset + chartHeight
        }
        let C = {
            x: offset + chartWidth,
            y: offset + chartHeight
        }

        /*
              A  ^
                |  |
                + 25
                |
                |
                |
                + 25
              |__|_________________________________  C
              B
        */

        // CHART AXIS -------------------------
        ctx.beginPath();
        ctx.moveTo(A.x, A.y);
        ctx.lineTo(B.x, B.y);
        ctx.lineTo(C.x, C.y);
        ctx.stroke();

        // vertical ( A - B )
        let aStep = (chartHeight - 50) / (vData);

        let Max = Math.ceil(arrayMax(valuesRy) / 10) * 10;
        let Min = Math.floor(arrayMin(valuesRy) / 10) * 10;
        let aStepValue = (Max - Min) / (vData);
        console.log("aStepValue: " + aStepValue); //8 units
        let verticalUnit = aStep / aStepValue;

        let a = [];
        ctx.textAlign = "right";
        ctx.textBaseline = "middle";
        for (let i = 0; i <= vData; i++) {

            if (i == 0) {
                a[i] = {
                    x: A.x,
                    y: A.y + 25,
                    val: Max
                }
            } else {
                a[i] = {}
                a[i].x = a[i - 1].x;
                a[i].y = a[i - 1].y + aStep;
                a[i].val = a[i - 1].val - aStepValue;
            }
            drawCoords(a[i], 3, 0);
        }

        //horizontal ( B - C )
        let b = [];
        ctx.textAlign = "center";
        ctx.textBaseline = "hanging";
        let bStep = chartWidth / (hData + 1);

        for (let i = 0; i < hData; i++) {
            if (i == 0) {
                b[i] = {
                    x: B.x + bStep,
                    y: B.y,
                    val: propsRy[0]
                };
            } else {
                b[i] = {}
                b[i].x = b[i - 1].x + bStep;
                b[i].y = b[i - 1].y;
                b[i].val = propsRy[i]
            }
            drawCoords(b[i], 0, 3)
        }

        function drawCoords(o, offX, offY) {
            ctx.beginPath();
            ctx.moveTo(o.x - offX, o.y - offY);
            ctx.lineTo(o.x + offX, o.y + offY);
            ctx.stroke();

            ctx.fillText(o.val, o.x - 2 * offX, o.y + 2 * offY);
        }
        //----------------------------------------------------------

        // DATA
        let oDots = [];
        let oFlat = [];
        let i = 0;

        for (let prop in oData) {
            oDots[i] = {}
            oFlat[i] = {}

            oDots[i].x = b[i].x;
            oFlat[i].x = b[i].x;

            oDots[i].y = b[i].y - oData[prop] * verticalUnit - 25;
            oFlat[i].y = b[i].y - 25;

            oDots[i].val = oData[b[i].val];

            i++
        }

        ///// Animation Chart ///////////////////////////
        //var speed = 3;
        function animateChart() {
            requestId = window.requestAnimationFrame(animateChart);
            frames += speed; //console.log(frames)
            ctx.clearRect(60, 0, cw, ch - 60);

            for (let i = 0; i < oFlat.length; i++) {
                if (oFlat[i].y > oDots[i].y) {
                    oFlat[i].y -= speed;
                }
            }
            drawCurve(oFlat);
            for (let i = 0; i < oFlat.length; i++) {
                ctx.fillText(oDots[i].val, oFlat[i].x, oFlat[i].y - 25);
                ctx.beginPath();
                ctx.arc(oFlat[i].x, oFlat[i].y, 3, 0, 2 * Math.PI);
                ctx.fill();
            }

            if (frames >= Max * verticalUnit) {
                window.cancelAnimationFrame(requestId);

            }
        }
        requestId = window.requestAnimationFrame(animateChart);

        /////// EVENTS //////////////////////
        c.addEventListener("mousemove", function(e) {
            label.innerHTML = "";
            label.style.display = "none";
            this.style.cursor = "default";

            let m = oMousePos(this, e);
            for (let i = 0; i < oDots.length; i++) {

                output(m, i);
            }

        }, false);

        function output(m, i) {
            ctx.beginPath();
            ctx.arc(oDots[i].x, oDots[i].y, 20, 0, 2 * Math.PI);
            if (ctx.isPointInPath(m.x, m.y)) {
                //console.log(i);
                label.style.display = "block";
                label.style.top = (m.y + 10) + "px";
                label.style.left = (m.x + 10) + "px";
                label.innerHTML = "<strong>" + propsRy[i] + "</strong>: " + valuesRy[i] + "%";
                c.style.cursor = "pointer";
            }
        }

        // CURVATURE
        function controlPoints(p) {
            // given the points array p calculate the control points
            let pc = [];
            for (let i = 1; i < p.length - 1; i++) {
                let dx = p[i - 1].x - p[i + 1].x; // difference x
                let dy = p[i - 1].y - p[i + 1].y; // difference y
                // the first control point
                let x1 = p[i].x - dx * t;
                let y1 = p[i].y - dy * t;
                let o1 = {
                    x: x1,
                    y: y1
                };

                // the second control point
                let x2 = p[i].x + dx * t;
                let y2 = p[i].y + dy * t;
                let o2 = {
                    x: x2,
                    y: y2
                };

                // building the control points array
                pc[i] = [];
                pc[i].push(o1);
                pc[i].push(o2);
            }
            return pc;
        }

        function drawCurve(p) {

            let pc = controlPoints(p); // the control points array

            ctx.beginPath();
            //ctx.moveTo(p[0].x, B.y- 25);
            ctx.lineTo(p[0].x, p[0].y);
            // the first & the last curve are quadratic Bezier
            // because I'm using push(), pc[i][1] comes before pc[i][0]
            ctx.quadraticCurveTo(pc[1][1].x, pc[1][1].y, p[1].x, p[1].y);

            if (p.length > 2) {
                // central curves are cubic Bezier
                for (let i = 1; i < p.length - 2; i++) {
                    ctx.bezierCurveTo(pc[i][0].x, pc[i][0].y, pc[i + 1][1].x, pc[i + 1][1].y, p[i + 1].x, p[i + 1].y);
                }
                // the first & the last curve are quadratic Bezier
                let n = p.length - 1;
                ctx.quadraticCurveTo(pc[n - 1][0].x, pc[n - 1][0].y, p[n].x, p[n].y);
            }

            //ctx.lineTo(p[p.length-1].x, B.y- 25);
            ctx.stroke();
            ctx.save();
            ctx.fillStyle = grd;
            ctx.fill();
            ctx.restore();
        }

        function arrayMax(array) {
            return Math.max.apply(Math, array);
        };

        function arrayMin(array) {
            return Math.min.apply(Math, array);
        };

        function oMousePos(canvas, evt) {
            let ClientRect = canvas.getBoundingClientRect();
            return { //objeto
                x: Math.round(evt.clientX - ClientRect.left),
                y: Math.round(evt.clientY - ClientRect.top)
            }
        }
    </script>
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
