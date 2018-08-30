<?php
//$id = $_GET['id'];
//$shot = "5SEd6I8YTVY";
/*
$shot = $id;

//$json = file_get_contents('https://api.openload.co/1/file/dlticket?file='.$shot.'&login=3ace733f71aac13f&key=nburV8VU');
$json = file_get_contents('http://192.168.0.100/s.php?id='.$id.'');
$data = json_decode($json, true);
$tickete =$data->{'result'}->{'ticket'};
$captcha_url =$data->{'result'}->{'captcha_url'};
print $captcha_url; // 12345
echo $tickete; // 12345


$url2 = file_get_contents('http://192.168.0.100/s.php?id='.$shot.'' ); 

//LINK1
$tickete = explode('"ticket":"', $url2); 
$tickete = explode('",', $tickete[1]); 	

$captcha_url = explode('https:\/\/openload.co\/dlcaptcha\/', $url2); 
$captcha_url = explode('",', $captcha_url[1]); 

*/


$id = $_GET['id'];
$shot = $id;
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openload.co/1/file/dlticket?file=".$id."&login=3ace733f71aac13f&key=nburV8VU");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "https://api.openload.co/1/file/dlticket?file=".$id."&login=3ace733f71aac13f&key=nburV8VU");

$response = curl_exec($ch);
curl_close($ch);

//var_dump($response);



$data = json_decode($response);
$tickete =$data->{'result'}->{'ticket'};
$captcha_url =$data->{'result'}->{'captcha_url'};
//print $captcha_url; // 12345
//echo $tickete; // 12345*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8"/>
<meta name="robots" content="noindex" />
<META NAME="GOOGLEBOT" CONTENT="NOINDEX" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://content.jwplatform.com/libraries/mhjDEa4R.js"></script>
<link href="//ssl.p.jwpcdn.com/player/v/7.2.3/skins/roundster.css" rel="stylesheet" type="text/css" />
<style type="text/css">

#container{position:absolute;width:99.5%!important;height:99%!important}
#captcha{margin:0;padding:0;    position: sticky;}



</style>
<script>
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
</script>
<center><div id="container"></div>


<div id="captcha">
<h1 style="color:green;">Rellena El Codigo para ver la Pelicula</h1>
<!--span id="img_captcha"><img src="https://openload.co/dlcaptcha/<?php echo $captcha_url[0];?>" height="70px" width="140px"></span><br><br-->
<span id="img_captcha"><img src="<?php echo $captcha_url;?>" height="70px" width="140px"></span><br><br>
  <input id="nhap_captcha" placeholder="Ingrese el Captcha..." class="input-captcha" type="text" name="captcha" required>
  <button id="captcha_reload" class="button-captcha"><i class="fa fa-refresh" aria-hidden="true"></i></button>
  <button id="captcha_click" class="button-captcha">Enviar Captcha</button>
  <p>Su Captcha es importante para solicitar un nuevo TOKEN !</p>
  </div>
      <script>!function(e,t,r,n,c,a,l){function i(t,r){return r=e.createElement('div'),r.innerHTML='<a href="'+t.replace(/"/g,'&quot;')+'"></a>',r.childNodes[0].getAttribute('href')}function o(e,t,r,n){for(r='',n='0x'+e.substr(t,2)|0,t+=2;t<e.length;t+=2)r+=String.fromCharCode('0x'+e.substr(t,2)^n);return i(r)}try{for(c=e.getElementsByTagName('a'),l='/cdn-cgi/l/email-protection#',n=0;n<c.length;n++)try{(t=(a=c[n]).href.indexOf(l))>-1&&(a.href='mailto:'+o(a.href,t+l.length))}catch(e){}for(c=e.querySelectorAll('.__cf_email__'),n=0;n<c.length;n++)try{(a=c[n]).parentNode.replaceChild(e.createTextNode(o(a.getAttribute('data-cfemail'),0)),a)}catch(e){}}catch(e){}}(document);</script>
	  <script type="text/javascript">
	  function load_captcha() {
		var d = new Date();
		var n = d.getTime();	
		//var img_ca = "https://openload.co/dlcaptcha/<?php echo $captcha_url[0];?>";
		var img_ca = "<?php echo $captcha_url;?>";
		$("#img_captcha").html("<img src="+img_ca+" width='140px' height='70px'>");
		document.location.reload();
	  }
	  
	  function player() {
		  var code = $("#nhap_captcha").val();
			$.getJSON("https://openloadrx.herokuapp.com/s2.php?id=<?php echo $shot;?>&ticket=<?php echo $tickete;?>&captcha_response="+code, function(data) {
			
				var stt = data.status;
				if(stt=="200"){
				 var url= data.result.url;	
				 var playerInstance = jwplayer("container");
				 playerInstance.setup({
					 image: "https://content.jwplatform.com/thumbs/3XnJSIm4-640.jpg",
					 sources:[{file:url, type:"mp4"}],
					 width: "100%",
							height: "100%",
					 aspectratio: "16:9",
					 autostart: true,
					 preload: "auto",
					 abouttext: "Descargar Video",
                        aboutlink: "https://openload.co/f/<?php echo $shot;?>/",
					 skin: {url: "/jwplayer/theme/thin.css?1506772159",name: "thin",}
				});
					
					var now = new Date();
					var time = now.getTime();
					time += 3600 * 1000;
					now.setTime(time);
					document.cookie = '<?php echo $shot;?>=' + url + '; expires=' + now.toUTCString() + '; path=/';
					$("#captcha").remove();
				}
				
				else{alert("Wrong captcha, please enter again !");load_captcha();}
		
			})
	
			
	  }
	  
		
		var cookie_check = readCookie("<?php echo $shot;?>");
		if(cookie_check == null){
			
		$("#nhap_captcha").keydown(function (e){
			if(e.keyCode == 13){
				player();
			}
		})

		$("#captcha_click").click(function(){	 
			player();
		});
		
		 $("#captcha_reload").click(function(){	 
			load_captcha();
			//document.location.reload();
		 });
					
					
		}
	else{
		var url = readCookie("<?php echo $shot;?>");
		var playerInstance = jwplayer("container");
				  playerInstance.setup({
				  image: "https://content.jwplatform.com/thumbs/3XnJSIm4-640.jpg",
				   sources:[{file:url, type:"mp4"}],
					width: "100%",
							height: "100%",
					aspectratio: "16:9",
					preload: "auto",
					abouttext: "Descargar Video",
                        aboutlink: "https://openload.co/f/<?php echo $shot;?>/",
					skin: {url: "/jwplayer/theme/thin.css?1506772159",name: "thin",}
					});
		$("#captcha").remove();
	}
			
		

/*
	playerInstance.on("error", function(){
	var cr = playerInstance.getPosition();
	playerInstance.load();
	playerInstance.play().seek(cr);
	});	*/	

    </script>
  
