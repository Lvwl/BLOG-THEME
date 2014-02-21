<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

	<title>啊，404~</title>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="http://www.kylen314.com/wp-content/themes/inove/404.css" type="text/css" media="screen">
</head>

<body>

	
<div id="container">

  
	<canvas id="c" width="1024" height="768"></canvas>
			<div id="code">
				勇敢的少年，欢迎来到比特之理的里世界——传说中的<span class="keyword">404之殿</span><br />
        您会到达这个页面证明您刚刚点击了<span class="keyword">失效</span>的链接。<br />
		    当然， 也可能是我搞错了............<br />
	所以呢，<br />
				你可以选择<br />
				(a) 点击浏览器上的<span class="keyword"> '返回' </span>按钮并尝试通过其他方式进入我们的页面。。。<br />
				或者...<br />
				 (b) 点击<span class="keyword">下方</span>的链接转跳到博客的首页。<br />
				另外，<br />
				如果你<span class="keyword">确定</span>博客里面有失效页面，麻烦您到<span class="keyword">留言板</span><br />
				哦，顺便友情告知一声。。。。<br />
				这个页面会慢慢<span class="keyword">蚕食</span>你的<span class="keyword">内存</span>。。。<br />
				所以与其等这些字慢慢显示完成。。。<br />
				我更加建议你<span class="keyword">赶紧</span>返回。。。<br />
				不然你难道真的想等我慢慢把这些字显示完？<br />
				呵呵，少年，我建议你还是别太逞强了。。。<br />
				因为我可以。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。<br />
				好吧，不玩了，放过你吧。。<br />
				<div class="back">
			<a href="http://www.kylen314.com">Back</a>
		</div><br />
				.......................真的没东西了...............<br />
				看........真的没有了.......还不信？<br />
				骗你干嘛。。。。。。。。。。<br />
				你没听到你的内存君在哀鸣么。。。。。<br />
				end!!!!!!!!!!!<br />
		</div>
		<div class="demo">
    <p><span>4</span><span>0</span><span>4</span></p>
  </div>

</div>
<script>
   (function($) {
	$.fn.typewriter = function() {
		this.each(function() {
			var $ele = $(this), str = $ele.html(), progress = 0;
			$ele.html('');
			var timer = setInterval(function() {
				var current = str.substr(progress, 1);
				if (current == '<') {
					progress = str.indexOf('>', progress) + 1;
				} else {
					progress++;
				}
				$ele.html(str.substring(0, progress) + (progress & 1 ? '_' : ''));
				if (progress >= str.length) {
					clearInterval(timer);
				}
			}, 75);
		});
		return this;
	};
})(jQuery);

$("#code").typewriter();

var b = document.body;
			var c = document.getElementsByTagName('canvas')[0];
			var a = c.getContext('2d');
			document.body.clientWidth; 
		
c.width = 900;
  c.height = 350;

  a.font = "bold 150pt Arial";
  a.fillStyle = "rgb(255,255,255)";
  a.fillText("比特之理", 0, 250);          

  var px = [];

  var imgData=a.getImageData(0,0,c.width,c.height);
          
  for(x=0; x<imgData.width; x++)
  {
    for(y=0 ; y<imgData.height; y++)
    {
      if(getPixel(imgData,x,y)[3] > 0)
      {
        px.push( [x,y] );
      }
    }
  }
   
   
  var iID = setInterval(draw, 10);
	
  var max = 40;
  
  var tt = new Array();
  
  function tendril()
  {
    this.init = function(x, y)
    {   
      this.x = x;
      this.y = y;
      this.angle = Math.random()*2*Math.PI - Math.PI;
      this.v = 0;
      this.length = 0;
    };
    this.grow = function(distance, curl, step)  //distance=3.0, curl=1.0, step=0.02
    {
      if(this.length < max)
      {
        this.x += Math.cos(this.angle) * distance;
        this.y += Math.sin(this.angle) * distance;
        this.v += Math.random() * step - step/2;
        this.v *= 0.9 + curl*0.1;
        this.angle += this.v;   
        if(this._x != undefined)
        {
          aa = this.length/max;
                    
          r = 8;
          g = parseInt(aa * 255);
          b = 32;
         
          a.beginPath();
          a.strokeStyle="rgba("+r+","+g+","+b+","+(1-aa)+")";
          a.moveTo(this._x,this._y);
          a.lineTo(this.x,this.y);
          a.closePath();
          a.stroke();
                    
        }
        this._x = this.x;
        this._y = this.y;
        this.length++;

      }
    };
  };
  
	function draw()
	{    
    for(p in px)
    {
      if(Math.random() > 0.9999)
      { 
        var t = new tendril();
        t.init(px[p][0],px[p][1]);  
        tt.push ( t );
      }
    }

    // grow actuals tendrils
    
    if(tt.length > 0)
    {
      for(t in tt)
      {
        tt[t].grow(1, 1.0, 0.02);    
      }
    }

  }
  

  function getPixel(imgData, x, y) {
    var offset = (x + y * imgData.width) * 4;
    var r = imgData.data[offset+0];
    var g = imgData.data[offset+1];
    var b = imgData.data[offset+2];
    var a = imgData.data[offset+3];
    
    return [r,g,b,a];
  }  



  </script>
</body>
</html>
