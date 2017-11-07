(function($) {

	$.fn.mygallery = function ( options ) {

		this.addClass("mygallery");

		var config = $.extend({
			grid : 3
		}, options );

		return this.each(function(i,val) {

			$(this).children("a").each(function(i,val){
				$(this).addClass("photo"+i);
				$(this).attr("data-id",+i);
			});
			if(config.grid != 0 || config.grid != "" || config.grid != false) {
				$(this).children("a").width($(this).width() / config.grid).css("padding","10px");

				if($(this).find("img").height() < $(this).find("img").width()) {
					$(this).children("a").height($(this).children("a").width());
					$(this).find("img").css({"max-width" : "none", "max-height" : "200px","max-width": "100%"});
				}
				else if($(this).find("img").height() > $(this).find("img").width()) {
					$(this).children("a").width($(this).children("a").height());
					$(this).find("img").css({"max-height" : "none", "max-width" : "200px","max-width": "100%"});
				}
			}
			else {
				$(this).children("a").addClass("no-grid").css({"max-width":"200px","padding":"10px","padding":"10px"});
			}


			$(this).children("a").click(function(e){e.preventDefault();openPopup($(this),$(this).attr("data-id"))});
		});
	}

	$.fn.justlightbox = function ( ) {

		this.addClass("justlightbox").css({"width":"200px"});

		return this.each(function(i,val) {
			$(this).click(function(e){
				e.preventDefault();
				var popup = '<div class="mygallery"><div class="popup-wrapper">';
				var imgsrc = $(this).attr("href");
				var imgtitle = $(this).attr("title");
					popup += '<div class="popup active">';
					popup += '<a href="#" class="popup-close"><span class="fa fa-times"></span></a>';
					popup += '<img src="'+imgsrc+'"/>';
					popup += '<div class="caption">'+imgtitle+'</div>';
					popup += '</div>';
					popup += '</div></div>';
				$(this).parent().prepend(popup);
				$(".popup-wrapper").animate({opacity: "1"});
				// Close popup
				$(".mygallery .popup-close").click(function(e) {
					e.preventDefault();
					$(".popup-wrapper").animate({opacity: "0"}).remove();
				});
			});
		});
	}

	function openPopup(a,active) {
		var popup = '<div class="popup-wrapper">';

		var parent = a.parent();

		parent.children("a").each(function(i,val){
			var imgsrc = $(this).attr("href");
			var id =  $(this).attr("data-id");
			var imgtitle = $(this).attr("title");
			var current;
			if(active == id) {
				current = " active";
			}
			else {
				current = "";
			}
			popup += '<div class="popup'+current+'" id="photo'+id+'" data-id="'+id+'">';
			popup += '<a href="#" class="popup-close">X</a>';
			popup += '<img src="'+imgsrc+'"/>';

			var nextsrc = $(this).next().attr("href");
			var prevsrc = $(this).prev().attr("href");

			if(nextsrc != null) {
				popup += '<a class="next" href="'+nextsrc+'">></a>';
			}
			if(prevsrc != null) {

				popup += '<a class="prev" href="'+prevsrc+'"><</a>';
			}
			popup += '<div class="caption">'+imgtitle+'</div>';
			popup += '</div>';


		});

		popup += '</div>';
		a.parent().prepend(popup);
		$(".popup-wrapper").animate({opacity: "1"});
		// Close popup
		$(".mygallery .popup-close").click(function(e) {
			e.preventDefault();
			$(".popup-wrapper").delay("slow").animate({opacity: "0"}).remove();
		});

		$(".mygallery .next").click(function(e) {
			e.preventDefault();
			nextto($(this).parent().attr("data-id"));
		});

		$(".mygallery .prev").click(function(e) {
			e.preventDefault();
			prevto($(".active").attr("data-id"));
		});


	}

	function nextto(activeid) {
		$("#photo"+activeid).removeClass("active");
		$("#photo"+activeid).next().addClass("active");
	}
	function prevto(activeid) {
		$("#photo"+activeid).removeClass("active");
		$("#photo"+activeid).prev().addClass("active");
	}

	document.onkeydown = navigatebykey;
	function navigatebykey() {
		var next = $(".active").next().attr("data-id");
		 var prev = $(".active").prev().attr("data-id") ;
    if (event.keyCode == '27') {
        // Close popup
        $(".popup-wrapper").animate({opacity: "0"}).remove();
    }

	if(prev != null) {
		if (event.keyCode == '37') {
	       // left arrow
			prevto($(".active").attr("data-id"));
		}
    }

	if(next != null) {
    	if (event.keyCode == '39') {
       // right arrow
			nextto($(".active").attr("data-id"));
		}
    }

    function nextpopup(a,currentimg) {
    		var imgsrc = a.next().attr("href");
			var imgtitle = a.next().attr("title");


			$(".popup-wrapper").find("img").attr("src",imgsrc);
			$(".popup-wrapper").find(".caption").text(imgtitle);
			$(".popup-wrapper").find("#prev").attr("href",currentimg);

			var nextsrc = a.next().next().attr("href");

			if(nextsrc != null) {
				$(".popup-wrapper").find("#next").attr("href",nextsrc);
			}
			else {
				$(".popup-wrapper").find("#next").remove();
			}
    }

}

}(jQuery));
