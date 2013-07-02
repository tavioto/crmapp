<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<body>
<div id="instagram">
	
</div>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>
	$(document).ready(function(){
		var tweets = [];
		var grams = [];
		var howManyEach = 2;
	
		$.ajax({
            type: "GET",
            dataType: "jsonp",
            cache: true,
            url: "https://api.instagram.com/v1/users/367885804/media/recent/?access_token=205967069.1b319d0.69bfc8cdb6e14069a82d2632fecf0739&count=3",
            success: function(data) {
            	var qtty = data.data.length;
                for (var i = 0; i < qtty; i++) {
                	$("#instagram").append("<div class='instagram-placeholder slide'><a target='_blank' href='" + data.data[i].link +"'><img class='instagram-image' src='" + data.data[i].images.standard_resolution.url +"' /></a></div>");
                    
                }
            }
        });
        
        $.ajax({
            type: "GET",
            dataType: "jsonp",
            cache: true,
            url: "https://api.instagram.com/v1/tags/thetombs/media/recent/?access_token=205967069.1b319d0.69bfc8cdb6e14069a82d2632fecf0739&count=6",
            success: function(data) {
            	var qtty = data.data.length;
                for (var i = 0; i < qtty; i++) {
                	$("#instagram").append("<div class='instagram-placeholder slide'><a target='_blank' href='" + data.data[i].link +"'><img class='instagram-image' src='" + data.data[i].images.standard_resolution.url +"' /></a></div>");
                   
                }
            }
        });
        
    });

		
</script>
</body>
</html>