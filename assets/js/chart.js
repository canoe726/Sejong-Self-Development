
var CONST_SVG_URL = 'http://www.w3.org/2000/svg';
var VML_NAME_SPACE = 'urn:schemas-microsoft-com:vml'
var CONST_MAX_RADIUS = 100;
var CONST_DECREMENT = 20;
var CNT = 0;
var Nwagon = {

    chart: function(options){
        var isIE_old = false;
        if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) { //test for MSIE x.x;
            var ieversion = new Number(RegExp.$1); // capture x.x portion and store as a number
            if (ieversion <= 8){

                isIE_old = true;
                if(!document.namespaces['v']) {
                   document.namespaces.add('v', VML_NAME_SPACE);
                }
            }
        }
        var chartObj = new Object();
        chartObj.chartType = options['chartType'];
        chartObj.dataset = options['dataset'];
        chartObj.legend = options['legend'];
        chartObj.width = options['chartSize']['width'];
        chartObj.height = options['chartSize']['height'];
        chartObj.chart_div = options['chartDiv'];

        //************ values.length should be equal to names.length **************// 
        switch (chartObj.chartType)
        {
            case ('radar') :
                this.radar.drawRadarChart(chartObj);
                break;
            
            case ('multi_column') :
                if (options.hasOwnProperty('bottomOffsetValue')) chartObj.bottomOffsetValue = options['bottomOffsetValue']; 
                if (options.hasOwnProperty('leftOffsetValue')) chartObj.leftOffsetValue = options['leftOffsetValue']; 
                if (options.hasOwnProperty('topOffsetValue')) chartObj.topOffsetValue = options['topOffsetValue']; 
                if (options.hasOwnProperty('rightOffsetValue')) chartObj.rightOffsetValue = options['rightOffsetValue']; 
                if (options['maxValue']) chartObj.highest = options['maxValue'];
                if (options['increment']) chartObj.increment = options['increment'];
                
                this.column.drawColumnChart(chartObj);
                break;
        }
    },

    createChartArea: function(parentSVG, chartType, viewbox, width, height){

        var chartDiv = document.getElementById(parentSVG);
        var textArea = document.createElement('ul');
        textArea.className = 'accessibility';
        chartDiv.appendChild(textArea);
        var attr = {'version':'1.1', 'width':width, 'height':height, 'viewBox':viewbox, 'class':'Nwagon_' + chartType, 'aria-hidden':'true'};
        var svg = Nwagon.createSvgElem('svg', attr);
        chartDiv.appendChild(svg);

        return svg;
    },

    createSvgElem: function(elem, attr){
        var svgElem = document.createElementNS(CONST_SVG_URL, elem);
        Nwagon.setAttributes(svgElem, attr);
        return svgElem;
    },

    setAttributes: function(svgObj, attributes){
        var keys_arr = Object.keys(attributes);
        var len = keys_arr.length;
        
        for(var i = 0; i<len; i++){
            svgObj.setAttribute(keys_arr[i], attributes[keys_arr[i]]);
            
        }
    },

    getMax: function(a){
        var maxValue = 0;
        if(a.length){
            for (var j = 0; j < a.length; j++)
            {
                var a_sub = a[j];
                if(a_sub.length){
                    for(var k = 0; k<a_sub.length; k++){
                        if (typeof(a_sub[k]) == 'number' && a_sub[k] > maxValue) maxValue = a_sub[k];    
                    }
                }
                else{
                    if (typeof(a[j]) == 'number' && a[j] > maxValue) maxValue = a[j];
                }
            }
        }
        return maxValue;
    },

    createTooltip: function(){
        var tooltip = Nwagon.createSvgElem('g', {'class':'tooltip'});
        var tooltipbg = Nwagon.createSvgElem('rect', {});
        tooltip.appendChild(tooltipbg);

        var tooltiptxt = Nwagon.createSvgElem('text', {});
        tooltip.appendChild(tooltiptxt);

        return tooltip;
    },

    showToolTip: function(tooltip, px, py, value, height, ytextOffset, yRectOffset){
        return function(){
            tooltip.style.cssText = "display: block";
            var text_el = tooltip.getElementsByTagName('text')[0];
            text_el.textContent = ' '+value;
            Nwagon.setAttributes(text_el, {'x':px, 'y':py-ytextOffset, 'text-anchor':'middle'});
            var width = text_el.getBBox().width;
            Nwagon.setAttributes(tooltip.getElementsByTagName('rect')[0], {'x':(px-width/2)-5, 'y':py-yRectOffset, 'width':width+10,'height':height});
        }
    },

    hideToolTip: function(tooltip){
        return function(){
            tooltip.style.cssText = "display: none";
        }
    },

    getAngles: function(arr, angles){
                    
        var total = 0;
        for(var i=0; i<arr.length; i++){
            total+=arr[i];
        }
        for(i=0; i<arr.length; i++){
            var degree = 360 * (arr[i]/total);
            angles['angles'].push(degree);
            angles['percent'].push(arr[i]/total);
            angles['values'].push(arr[i]);
        }
        return angles;
    },
    getOpacity: function(opa, r, max_r){
                var len  = opa.length;
                var interval = max_r/len;
                var value = Math.ceil(r/interval);
                return opa[value-1];
    },    

    column:{

        drawColumnChart: function(obj){

            var width = obj.width, height = obj.height;
            var values = obj.dataset['values'];
            var LeftOffsetAbsolute =  obj.hasOwnProperty('leftOffsetValue') ? obj.leftOffsetValue : 50;
            var BottomOffsetAbsolute = obj.hasOwnProperty('bottomOffsetValue') ? obj.bottomOffsetValue : 80;
            var TopOffsetAbsolute =  obj.hasOwnProperty('topOffsetValue') ? obj.topOffsetValue : 0;
            var RightOffsetAbsolute = obj.hasOwnProperty('rightOffsetValue') ? obj.rightOffsetValue : 0;
            
            RightOffsetAbsolute = obj.dataset['fields'] ? (150 + RightOffsetAbsolute) : RightOffsetAbsolute;

            var viewbox = (-LeftOffsetAbsolute) + ' ' + (BottomOffsetAbsolute -height) + ' ' + width + ' ' + height;
            var svg =  Nwagon.createChartArea(obj.chart_div, obj.chartType, viewbox, width, height);
            var max = obj.highest ? obj.highest : Nwagon.getMax(values);

            this.drawBackground(svg, obj.legend['names'].length, obj.dataset, obj.increment, max, width-LeftOffsetAbsolute-RightOffsetAbsolute, height-BottomOffsetAbsolute-TopOffsetAbsolute);
            this.drawColumnForeground(obj.chart_div, svg, obj.legend, obj.dataset, obj.increment, max, width-LeftOffsetAbsolute-RightOffsetAbsolute, height-BottomOffsetAbsolute-TopOffsetAbsolute, obj.chartType);

        },

        drawColumn: function(parentGroup, width, height){

            var column = Nwagon.createSvgElem('rect', {'x':'0', 'y':-height, 'width':width, 'height':height});
            parentGroup.appendChild(column);

            return column;
        },

        drawLabels: function(x, y, labelText){

            var attributes = {'x':x, 'y':y, 'text-anchor':'end', 'transform':'rotate(315,'+ x +','+ y + ')'};
            var text = Nwagon.createSvgElem('text', attributes);
            text.textContent = labelText;

            return text;
        },

        getColorSetforSingleColumnChart: function(max, values, colorset){
            var numOfColors = colorset.length;
            var interval = max/numOfColors;
            var colors = [];
            
            for(var index = 0; index < values.length; index++){
                var colorIndex = Math.floor(values[index]/interval);
                if (colorIndex == numOfColors) colorIndex--;
                colors.push(colorset[colorIndex]);
            }
            return colors;
        },

        drawColumnForeground: function(parentDiv, parentSVG, legend, dataset, increment, max, width, height, chartType){

            var names = legend['names'];
            var numOfCols = names.length;
            var colWidth = (width/numOfCols).toFixed(3);
            var yLimit = (Math.ceil(max/increment)+1) * increment;
            var px = '', cw = '', ch = '';
            var data = dataset['values'];
            var chart_title = dataset['title'];
            var fields = dataset['fields'];

            var foreground = Nwagon.createSvgElem('g', {'class':'foreground'});
            parentSVG.appendChild(foreground);

            var columns = Nwagon.createSvgElem('g', {'class':'columns'});
            foreground.appendChild(columns);

            var labels = Nwagon.createSvgElem('g', {'class':'labels'});
            foreground.appendChild(labels);

            var tooltip = Nwagon.createTooltip();
            foreground.appendChild(tooltip);

            var drawColGroups = function(columns, ch, px, color, tooltipText, isStackedColumn, yValue){
                var colgroup  =  Nwagon.createSvgElem('g', {});
                columns.appendChild(colgroup);

                var column = Nwagon.column.drawColumn(colgroup, cw, ch);

                Nwagon.setAttributes(column, {'x':px, 'style':'fill:'+color});
                if(isStackedColumn)
                {
                    var py =  yValue - column.getBBox().y;
                    if ( py > 0 ) Nwagon.setAttributes(column, {'y':-py});
                    ch = py;
                }

                column.onmouseover = Nwagon.showToolTip(tooltip, px+cw/2, -ch, tooltipText, 14, 7, 18);
                column.onmouseout = Nwagon.hideToolTip(tooltip);

                column = null;  //prevent memory leak (in IE) 
            };

            var create_data_list = function(obj){
                var ul = document.getElementById(parentDiv).getElementsByTagName('ul')[0];
                if (ul){
                    for (var key in obj){
                        if(obj.hasOwnProperty(key)){
                            var li = document.createElement('li');
                            li.innerHTML = key;
                            var innerUL = document.createElement('ul');
                            li.appendChild(innerUL);
                            ul.appendChild(li);
                            var innerList = obj[key];
                            for (var k = 0; k< innerList.length; k++){
                                var innerLI = document.createElement('li');
                                innerLI.innerHTML = innerList[k];
                                innerUL.appendChild(innerLI);
                            }
                        }
                    }
                }
            };

            if(chartType == 'column')
            {
                var ul = document.getElementById(parentDiv).getElementsByTagName('ul')[0];
                if(ul){
                    ul.innerHTML = chart_title;
                }
                cw = (3/5*colWidth);
                var colors = Nwagon.column.getColorSetforSingleColumnChart(max, data, dataset['colorset']);

                for(var index = 0; index < data.length; index++){
                    px = (colWidth*(index+0.2));// + cw;
                    ch = data[index]/yLimit*height;
                    drawColGroups(columns, ch, px, colors[index], data[index]);

                    var text = Nwagon.column.drawLabels(px + cw/2, 15, names[index], false, 0);
                    labels.appendChild(text);

                    var innerLI = document.createElement('li');
                    innerLI.innerHTML = 'Label ' + names[index] + ', Value  '+ data[index];
                    if(ul){
                        ul.appendChild(innerLI);
                    }
                }
            }
            else if(chartType == 'multi_column')
            {
                var colors = dataset['colorset'];
                cw = (3/5*colWidth)/colors.length;
                var chart_data = {};
                for ( var k = 0; k<fields.length; k++){
                    chart_data[fields[k]] = [];
                }

                for(var i = 0; i < data.length; i++){
                    var one_data = data[i];
                    px = (colWidth*(i+0.2));

                    for(var index = 0; index < one_data.length; index++){
                        var pxx = px+ (index*(cw));
                        ch = one_data[index]/yLimit*height;
                        drawColGroups(columns, ch, pxx, colors[index], one_data[index], false, 0);
                        chart_data[fields[index]].push('Label ' + names[i] + ', Value  '+ one_data[index]);
                    }

                    var text = Nwagon.column.drawLabels(px + cw/2, 15, names[i]);
                    labels.appendChild(text);
                }
                create_data_list(chart_data);
            }
            else if(chartType == 'stacked_column')
            {
                cw = (3/5*colWidth);
                var colors = dataset['colorset'];
                var chart_data = {};
                for ( var k = 0; k<fields.length; k++){
                    chart_data[fields[k]] = [];
                }
                for(var i = 0; i < data.length; i++){
                    var one_data = data[i];
                    var yValue = 0;

                    for(var index = 0; index < one_data.length; index++){
                        px = (colWidth*(i+0.2));// + cw;
                        ch = one_data[index]/yLimit*height;

                        drawColGroups(columns, ch, px, colors[index], one_data[index], true, yValue);
                        chart_data[fields[index]].push('Label ' + names[i] + ', Value  '+ one_data[index]);
                        yValue +=ch;
                    }


                    var text = Nwagon.column.drawLabels(px + cw/2, 15, names[i]);
                    labels.appendChild(text);
                }
                create_data_list(chart_data);
            }
        },

        drawBackground: function(parentSVG, numOfCols, dataset, increment, max, width, height){

            var colWidth =(width/numOfCols).toFixed(3);
            var attributes = {};
            var px = '', yRatio = 1;

            var background = Nwagon.createSvgElem('g', {'class':'background'});
            parentSVG.appendChild(background);

            var numOfRows = Math.ceil(max/increment);
            rowHeight = height/(numOfRows+1);

            //Vertical lines
            for (var i = 0; i<=numOfCols; i++)
            {
                px = (i * colWidth).toString();
                attributes = {'x1':px, 'y1':'0', 'x2':px, 'y2':rowHeight-height, 'class':'v'};
                var line = Nwagon.createSvgElem('line', attributes);
                background.appendChild(line);
            }
            //Horizontal lines (draw 1 more extra line to accomodate the max value)
            var count = 0;
            for (var i = 0; i<=numOfRows; i++)
            {
                attributes = {'x1':'0', 'y1':'-'+ i*rowHeight, 'x2':(numOfCols*colWidth).toString(), 'y2':'-'+ i*rowHeight, 'class':'h'};
                var line = Nwagon.createSvgElem('line', attributes);
                background.appendChild(line);

                attributes = {'x':'-15', 'y':-((count*rowHeight)-3), 'text-anchor':'end'};
                var text = Nwagon.createSvgElem('text', attributes);
                text.textContent = (count*increment).toString();

                background.appendChild(text);
                count++;
            }
            //Field Names
            if(dataset['fields'])
            {
                var fields = Nwagon.createSvgElem('g', {'class':'fields'});
                background.appendChild(fields);

                var numOfFields = dataset['fields'].length;
                for (var i = 0; i<numOfFields; i++)
                {
                    px = width+20;
                    py = (30*i) - height + rowHeight;

                    attributes = {'x':px, 'y':py, 'width':20, 'height':15, 'fill':dataset['colorset'][i]};
                    var badge = Nwagon.createSvgElem('rect', attributes);
                    fields.appendChild(badge);

                    attributes = {'x':px+25, 'y':py+7, 'alignment-baseline':'central'};
                    var name = Nwagon.createSvgElem('text', attributes);
                    name.textContent = dataset['fields'][i];
                    fields.appendChild(name);
                }
            }
        }
    },

    

    radar: {

        drawRadarChart: function(obj){

            var width = obj.width, height = obj.height;
            var viewbox = '-' + width/2 + ' -' + height/2 + ' ' + width + ' ' + height;
            var svg =  Nwagon.createChartArea(obj.chart_div, obj.chartType, viewbox, width, height);

            this.drawBackground(svg, obj.legend['names'].length, obj.dataset['bgColor'], CONST_DECREMENT, CONST_MAX_RADIUS);
            this.drawLabels(svg, obj.legend, CONST_MAX_RADIUS);
            this.drawCoordinates(svg, CONST_DECREMENT, CONST_MAX_RADIUS);
            this.drawPolygonForeground(obj.chart_div, svg, obj.legend, obj.dataset);
        },

        drawCoordinates: function(parentSVG, decrement, maxRadius){

            var g = Nwagon.createSvgElem('g', {'class':'xAxis'});
            var i = maxRadius, y=0.0, point=0.0;

            while (i > 0)
            {
                point = i+',' + y;

                var attributes = {'points': point, 'x':i, 'y':y, 'text-anchor':'middle'};
                var text = Nwagon.createSvgElem('text', attributes);
                text.textContent = i.toString();
                g.appendChild(text);
                i-=decrement;
            }
            parentSVG.appendChild(g);
        },

        drawLabels: function(parentSVG, legend, maxRadius){

            var labels = Nwagon.createSvgElem('g', {'class':'labels'});
            var hrefs = legend['hrefs'], names = legend['names'];
            var numOfRadars = names.length;
            var attributes = {};

            for(var index = 0; index < names.length; index++){
                var angle = (Math.PI*2)/numOfRadars; // (2*PI)/numOfRadars
                var x = 0 + (maxRadius+12) * Math.cos(((Math.PI*2)/numOfRadars) * (index));
                var y = 0 + (maxRadius+12) * Math.sin(((Math.PI*2)/numOfRadars) * (index));
                var align = (x < 0) ? 'end' : 'start';
                if(x < 1 && x > -1) align = 'middle';

                if(hrefs){
                    attributes = {'onclick':'location.href="' + hrefs[index] + '"', 'x':x, 'y':y, 'text-anchor':align, 'class':'chart_label'};
                }else{
                    attributes = {'x':x, 'y':y, 'text-anchor':align, 'class':'chart_label'};
                }
                var text = Nwagon.createSvgElem('text', attributes);
                text.textContent = names[index];

                labels.appendChild(text);
            }
            parentSVG.appendChild(labels);
        },

        drawPie: function(parentGroup, numOfRadars, maxRadius, decrement, bg_color){
            /* Draw outer solid line and then inner dotted lines  */

            var angle = (Math.PI*2)/numOfRadars;
            var p0='', p1='', p2='';
            var attributes = {}, points ='';
            var radius = maxRadius;

            var pie = Nwagon.createSvgElem('g', {'class':'pie'});

            while (radius > 0)
            {
                p0 = radius+',0'; //'100,0';
                p1 = '0,0';
                p2 = (radius*Math.sin(angle)/Math.tan(angle)) + ',' + (-radius*Math.sin(angle));

                if (radius == maxRadius)
                {
                    points = p0 + ' ' + p1 + ' ' + p2;
                    var lr = Nwagon.createSvgElem('polyline', {'points':points, 'fill': bg_color});
                    pie.appendChild(lr);
                }

                points = p0 + ' ' + p2;
                attributes =  {'points':points, 'stroke-dasharray':'2px,2px', 'fill': bg_color};
                var la = Nwagon.createSvgElem('polyline', attributes);

                pie.appendChild(la);
                radius-=decrement;
            }

            parentGroup.appendChild(pie);
            return pie;

        },

        drawBackground: function(parentSVG, numOfRadars, bg_color, decrement, maxRadius){
            var bg = bg_color ?  bg_color : '#F9F9F9';
            var angle = 360/numOfRadars;

            var background = Nwagon.createSvgElem('g', {'class':'background'});
            parentSVG.appendChild(background);

            for(var j=1; j<=numOfRadars; j++)
            {
                var current_pie = this.drawPie(background, numOfRadars, maxRadius, decrement, bg);
                current_pie.setAttribute('transform','rotate('+angle * (j-1)+')');
            }
        },

        dimmedPie: function(parentGroup, index, length)
        {
            var angle = (360/length) * index;
            var last_pie = this.drawPie(parentGroup, length, CONST_MAX_RADIUS, CONST_DECREMENT);
            last_pie.setAttribute('transform','rotate('+angle +')');
            var polylines = last_pie.querySelectorAll('polyline');
            for(var i = 0; i<polylines.length; i++){
                polylines[i].setAttribute('class','dim');
            }

            if (((index+1)%length)== 0)
            {
                this.drawPie(parentGroup, length, CONST_MAX_RADIUS, CONST_DECREMENT);
            }
            else
            {
                angle = (360/length) * (index+1);
                last_pie = this.drawPie(parentGroup, length, CONST_MAX_RADIUS, CONST_DECREMENT);
                last_pie.setAttribute('transform','rotate('+angle +')');
            }
            
            var polylines = last_pie.querySelectorAll('polyline');
            for(var i = 0; i<polylines.length; i++){
                polylines[i].setAttribute('class','dim');
            }
        },

        drawPolygonForeground: function(parentDiv, parentSVG, legend, data){

            var dataGroup = data['values'];
            var title = data['title'];            
            var fg_color = data['fgColor'] ? data['fgColor'] : '#30A1CE';
            if(CNT==1) fg_color = 'red';
            var istooltipNeeded = (dataGroup.length == 1) ? true : false;
            var names = legend['names'];

            var ul = document.getElementById(parentDiv).getElementsByTagName('ul')[0];
            if(ul){
                ul.innerHTML = title;
            }

            for(var i=0; i<dataGroup.length; i++){
                if(ul)
                {
                    var textEl = document.createElement('li');
                    textEl.innerHTML = 'Data set number ' + (i+1).toString();
                    var innerUL = document.createElement('ul');
                    textEl.appendChild(innerUL);
                    ul.appendChild(textEl);
                }
                var dataset = dataGroup[i];
                var length = dataset.length;
                var coordinate = [];
                var angle = (Math.PI/180)*(360/length);
                var pointValue = 0.0, px=0.0; py=0, attributes = {};
                var vertexes = [], tooltips =[];

                var foreground = Nwagon.createSvgElem('g', {'class':'foreground'});
                parentSVG.appendChild(foreground);

                var polygon = Nwagon.createSvgElem('polyline', {'class':'polygon'});
                foreground.appendChild(polygon);

                var tooltip = {};
                if (istooltipNeeded)
                {
                    tooltip = Nwagon.createTooltip();
                }

                for(var index =0; index < dataset.length; index++){
                    if(innerUL){
                        var innerLI = document.createElement('li');
                        innerLI.innerHTML = names[index] + ': ' + dataset[index];
                        innerUL.appendChild(innerLI);
                    }
                    pointValue = dataset[index];
                    pointDisplay = dataset[index];
                    if (typeof(dataset[index]) != 'number')
                    {
                        Nwagon.radar.dimmedPie(foreground, index, length);
                        pointValue = 0;
                        pointDisplay = dataset[index];
                    }

                    px = (index == 0) ? pointValue : pointValue*Math.sin(angle*index)/Math.tan(angle*index);
                    py = (index == 0) ? 0 : pointValue*Math.sin(angle*index);
                    coordinate.push(px + ',' + py);
                    if(CNT==1) fg_color = 'red';
                    attributes = {'cx':px, 'cy':py, 'r':3, 'stroke-width':8, 'stroke':'transparent', 'fill': fg_color};
                    var vertex = Nwagon.createSvgElem('circle', attributes);

                    if (istooltipNeeded)
                    {
                        vertex.onmouseover = Nwagon.showToolTip(tooltip, px, py, names[index] + ' : ' +  pointDisplay, 20, 15, 28);
                        vertex.onmouseout = Nwagon.hideToolTip(tooltip);
                    }
                    foreground.appendChild(vertex);
                    vertex = null;
                }

                var coordinates = coordinate.join(' ');
                if(CNT==1) fg_color = 'red';
                var attributes = {'points':coordinates, 'class':'polygon', 'fill': fg_color, 'stroke':fg_color,'num':2};
                
                Nwagon.setAttributes(polygon, attributes);
                
                if (istooltipNeeded) foreground.appendChild(tooltip);
                CNT++;
            }
        }
    }
};
