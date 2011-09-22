$(document).ready(function() {
  // $("li.clicker").click(function(){
  //   window.location=$(this).find("a").attr("href");
  //   return false;
  // });
  
/*
  $( '[data-role=page]' ).live('pageshow', function(event){
    //console.log(event.target);
    var $et = $( event.target ), pageID = '#location';
    if( $et.is( pageID )  || $et.children(0).is( pageID ) ){
      options = {
        address:'1174+Fischer+Blvd+Toms+River,NJ',
        zoom:14,
        markers: [{address:'1174+Fischer+Blvd+Toms+River,NJ',html: 'Madama JJ Academy<br>1174 Fischer Blvd<br>Toms River, NJ'}]
      };
      $('#map').gMap(options);
    }
  });
*/
  var map, latlng;
  
  function initialize(lat,lng) {
		latlng = new google.maps.LatLng(lat, lng);
		var myOptions = {
			zoom: 16,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
        
    if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
			  createMarker("daddr=39.991029,-74.149132&saddr="+position.coords.latitude+","+position.coords.longitude);
			});
		} else {
		  createMarker("daddr=39.991029,-74.149132");
		}
	}
	
	function createMarker(map_link) {
	  var marker = new google.maps.Marker({
			position: latlng,
			map: map
		});
		
	  var infoWindow = new google.maps.InfoWindow({
			content: 'Madama JJ Academy<br>1174 Fischer Blvd<br>Toms River, NJ<br><a href="http://maps.google.com/maps?'+map_link+'">Get Directions</a>',
			position: latlng
		});

		infoWindow.open(map, marker);
	}
	
	$('#location').live("pagecreate", function() {
	  
  });
	
  $('#location').live("pageshow", function() {
    initialize(39.991029,-74.149132);
    $('#location').height("100%");
    //google.maps.event.trigger(map, 'resize');
  });
  // 
  // $('#location').live("pagecreate", function() {
  //  $('#map_canvas').gmap({'center':'59.3426606750, 18.0736160278'}).bind('init', function(evt, map) {
  //    $('#map_canvas').gmap('addMarker', {'position': map.getCenter(), 'animation': google.maps.Animation.DROP }).click(function() { 
  //      $('#map_canvas').gmap('openInfoWindow', { 'content': 'Hello world!'}, this);
  //    });
  //  });
  // });
	

  

  // $( '[data-role=page]' ).live('pageshow', function(event){
  //   //console.log(event.target);
  //   var $et = $( event.target ), pageID = '#location';
  //   if ( $et.is( pageID )  || $et.children(0).is( pageID ) ) {
  //     var latlng = new google.maps.LatLng(39.991029,-74.149132);
  //     $('#map_canvas').gmap({'zoom': 16, 'center': latlng, 
  //       'callback': function () {
  //         $('#map_canvas').gmap('addMarker', {'position': latlng, 'title': 'Madama Jiu-Jitsu Academy'});
  //       }
  //     });
  //   }
  // });

});

