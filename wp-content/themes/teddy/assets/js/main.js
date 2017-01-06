jQuery(document).ready(function($){



	initHeadline();

	$('.nav_trigger').on('click', function(event){
		event.preventDefault();
		if($(this).hasClass("active")){
			toggleNav(false);
		}else{
			toggleNav(true);
		}
		$(this).toggleClass("active");
	});
	
	/*
	$('.nav li').on('click', function(event){
		event.preventDefault();
		var target = $(this),
			//detect which section user has chosen
			sectionTarget = target.data('menu');
		if( !target.hasClass('selected') ) {
			//if user has selected a section different from the one alredy visible
			//update the navigation -> assign the .cd-selected class to the selected item
			target.addClass('selected').siblings('.selected').removeClass('selected');
			//load the new section
			//loadNewContent(sectionTarget);
		} else {
			// otherwise close navigation
			toggleNav(false);
			if($('.nav_trigger').hasClass("active")){
				$('.nav_trigger').removeClass("active");
			}
		}
	});
	*/

	$("#article_img .effect_p").hover(
		function () {
			$('.background_article').addClass('background_normal');
		},
		function () {
			$('.background_article').removeClass('background_normal');
		}
	);




});

function toggleNav(bool) {
	$('.nav_container, .overlay').toggleClass('is_visible', bool);
	$('#menu_icon').removeClass('nav_visible');
}



// SCROLL SMOOTH
$(function() {
  $('a[href*=#]:not([href=#], #menu_logo)').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
/******************** HOME EFFECT ROTATE *****************************************/
//set animation timing
var animationDelay = 2500,
	//loading bar effect
	barAnimationDelay = 3800,
	barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
	//letters effect
	lettersDelay = 50,
	//type effect
	typeLettersDelay = 150,
	selectionDuration = 500,
	typeAnimationDelay = selectionDuration + 800,
	//clip effect 
	revealDuration = 600,
	revealAnimationDelay = 1500;

function initHeadline() {
	//insert <i> element for each letter of a changing word
	singleLetters($('.headline.letters').find('b'));
	//initialise headline animation
	animateHeadline($('.headline'));
}
function singleLetters($words) {
	$words.each(function(){
		var word = $(this),
			letters = word.text().split(''),
			selected = word.hasClass('is-visible');
		for (i in letters) {
			if(word.parents('.rotate-2').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
			letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
		}
	    var newLetters = letters.join('');
	    word.html(newLetters).css('opacity', 1);
	});
}
function animateHeadline($headlines) {
	var duration = animationDelay;
	$headlines.each(function(){
		var headline = $(this);
		
		if(headline.hasClass('loading-bar')) {
			duration = barAnimationDelay;
			setTimeout(function(){ headline.find('.words-wrapper').addClass('is-loading') }, barWaiting);
		} else if (headline.hasClass('clip')){
			var spanWrapper = headline.find('.words-wrapper'),
				newWidth = spanWrapper.width() + 10
			spanWrapper.css('width', newWidth);
		} else if (!headline.hasClass('type') ) {
			//assign to .words-wrapper the width of its longest word
			var words = headline.find('.words-wrapper b'),
				width = 0;
			words.each(function(){
				var wordWidth = $(this).width();
			    if (wordWidth > width) width = wordWidth;
			});
			headline.find('.words-wrapper').css('width', width);
		};

		//trigger animation
		setTimeout(function(){ hideWord( headline.find('.is-visible').eq(0) ) }, duration);
	});
}
function hideWord($word) {
	var nextWord = takeNext($word);
	
	if($word.parents('.headline').hasClass('type')) {
		var parentSpan = $word.parent('.words-wrapper');
		parentSpan.addClass('selected').removeClass('waiting');	
		setTimeout(function(){ 
			parentSpan.removeClass('selected'); 
			$word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
		}, selectionDuration);
		setTimeout(function(){ showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);
	
	} else if($word.parents('.headline').hasClass('letters')) {
		var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
		hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
		showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);

	}  else if($word.parents('.headline').hasClass('clip')) {
		$word.parents('.words-wrapper').animate({ width : '2px' }, revealDuration, function(){
			switchWord($word, nextWord);
			showWord(nextWord);
		});

	} else if ($word.parents('.headline').hasClass('loading-bar')){
		$word.parents('.words-wrapper').removeClass('is-loading');
		switchWord($word, nextWord);
		setTimeout(function(){ hideWord(nextWord) }, barAnimationDelay);
		setTimeout(function(){ $word.parents('.words-wrapper').addClass('is-loading') }, barWaiting);

	} else {
		switchWord($word, nextWord);
		setTimeout(function(){ hideWord(nextWord) }, animationDelay);
	}
}
function showWord($word, $duration) {
	if($word.parents('.headline').hasClass('type')) {
		showLetter($word.find('i').eq(0), $word, false, $duration);
		$word.addClass('is-visible').removeClass('is-hidden');

	}  else if($word.parents('.headline').hasClass('clip')) {
		$word.parents('.words-wrapper').animate({ 'width' : $word.width() + 10 }, revealDuration, function(){ 
			setTimeout(function(){ hideWord($word) }, revealAnimationDelay); 
		});
	}
}
function hideLetter($letter, $word, $bool, $duration) {
	$letter.removeClass('in').addClass('out');
	
	if(!$letter.is(':last-child')) {
	 	setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);  
	} else if($bool) { 
	 	setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
	}

	if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
		var nextWord = takeNext($word);
		switchWord($word, nextWord);
	} 
}
function showLetter($letter, $word, $bool, $duration) {
	$letter.addClass('in').removeClass('out');
	
	if(!$letter.is(':last-child')) { 
		setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration); 
	} else { 
		if($word.parents('.headline').hasClass('type')) { setTimeout(function(){ $word.parents('.words-wrapper').addClass('waiting'); }, 200);}
		if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
	}
}
function takeNext($word) {
	return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
}
function takePrev($word) {
	return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
}
function switchWord($oldWord, $newWord) {
	$oldWord.removeClass('is-visible').addClass('is-hidden');
	$newWord.removeClass('is-hidden').addClass('is-visible');
}
/*
function initPortfolio(){
	if($('.grid_portfolio').is(':visible')){




		imagesLoaded( document.querySelector('#list_projects'), function( instance ) {
 
			$('#list_projects ul li').each(function(){ 
				
				var image = new Image;
				var result = $(this).find('.folio').attr('src');
				image.src = result;
				var colorThief = new ColorThief();
				var color = colorThief.getColor(image);
				var palette = colorThief.getPalette(image)[3];
				//var dominantColor = colorThief.getDominantColor(image);
				console.log(palette[1]);
				$(this).find('a').css('background','rgb('+color[0]+','+color[1]+','+color[2]+')');
				$(this).find('h2').css('color','rgb('+palette[0]+','+palette[1]+','+palette[2]+')')
				if( (color[0] <= 50) || (color[1] <= 50) || (color[2] <= 50) ){
					$(this).find('span').css('color','#fff');
				}
			});

			console.log('all images are loaded');
		});
	}
	
	//$('.parallax-window').parallax();
}
*/


//drawing the characters
function draw(){
	//Black BG for the canvas
	//translucent BG to show trail
	ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
	ctx.fillRect(0, 0, c.width, c.height);
	
	ctx.fillStyle = "#0F0"; //green text
	ctx.font = font_size + "px arial";
	//looping over drops
	for(var i = 0; i < drops.length; i++)
	{
		//a random chinese character to print
		var text = chinese[Math.floor(Math.random()*chinese.length)];
		//x = i*font_size, y = value of drops[i]*font_size
		ctx.fillText(text, i*font_size, drops[i]*font_size);
		
		//sending the drop back to the top randomly after it has crossed the screen
		//adding a randomness to the reset to make the drops scattered on the Y axis
		if(drops[i]*font_size > c.height && Math.random() > 0.975)
			drops[i] = 0;
		
		//incrementing Y coordinate
		drops[i]++;
	}
}

if($('body').hasClass('error404')){
	console.log("hey");
	var c = document.getElementById("error");
	var ctx = c.getContext("2d");

	//making the canvas full screen
	c.height = window.innerHeight;
	c.width = window.innerWidth;

	//chinese characters - taken from the unicode charset
	var chinese = "error404";
	//converting the string into an array of single characters
	chinese = chinese.split("");

	var font_size = 10;
	var columns = c.width/font_size; //number of columns for the rain
	//an array of drops - one per column
	var drops = [];
	//x below is the x coordinate
	//1 = y co-ordinate of the drop(same for every drop initially)
	for(var x = 0; x < columns; x++)
		drops[x] = 1; 

	setInterval(draw, 33);
}


/*
$(window).on('resize', function(e) {
	setInterval(draw, 33);
});
*/








(function() {
	/* In animations (to close icon) */
	var beginAC = 80,
	    endAC = 320,
	    beginB = 80,
	    endB = 320;
	function inAC(s) {
	    s.draw('80% - 240', '80%', 0.3, {
	        delay: 0.1,
	        callback: function() {
	            inAC2(s)
	        }
	    });
	}
	function inAC2(s) {
	    s.draw('100% - 545', '100% - 305', 0.6, {
	        easing: ease.ease('elastic-out', 1, 0.3)
	    });
	}
	function inB(s) {
	    s.draw(beginB - 60, endB + 60, 0.1, {
	        callback: function() {
	            inB2(s)
	        }
	    });
	}
	function inB2(s) {
	    s.draw(beginB + 120, endB - 120, 0.3, {
	        easing: ease.ease('bounce-out', 1, 0.3)
	    });
	}
	function outAC(s) {
	    s.draw('90% - 240', '90%', 0.1, {
	        easing: ease.ease('elastic-in', 1, 0.3),
	        callback: function() {
	            outAC2(s)
	        }
	    });
	}
	function outAC2(s) {
	    s.draw('20% - 240', '20%', 0.3, {
	        callback: function() {
	            outAC3(s)
	        }
	    });
	}
	function outAC3(s) {
	    s.draw(beginAC, endAC, 0.7, {
	        easing: ease.ease('elastic-out', 1, 0.3)
	    });
	}
	function outB(s) {
	    s.draw(beginB, endB, 0.7, {
	        delay: 0.1,
	        easing: ease.ease('elastic-out', 2, 0.4)
	    });
	}
	var pathA = document.getElementById('pathA'),
		pathB = document.getElementById('pathB'),
		pathC = document.getElementById('pathC'),
		segmentA = new Segment(pathA, beginAC, endAC),
		segmentB = new Segment(pathB, beginB, endB),
		segmentC = new Segment(pathC, beginAC, endAC),
		trigger = document.getElementById('button_icon'),
		toCloseIcon = true,
		//dummy = document.getElementById('dummy'),
		wrapper = document.getElementById('menu_icon');

	wrapper.style.visibility = 'visible';

	trigger.onclick = function() {
		if (toCloseIcon) {
			inAC(segmentA);
			inB(segmentB);
			inAC(segmentC);

			toggleNav(true);
		} else {
			outAC(segmentA);
			outB(segmentB);
			outAC(segmentC);
			
			toggleNav(false);
		}
		toCloseIcon = !toCloseIcon;
	};

	function addScale(m) {
		m.className = 'menu_icon scaled';
	}
	function removeScale(m) {
		m.className = 'menu_icon';
	}
})();