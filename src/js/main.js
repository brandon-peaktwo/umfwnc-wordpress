jQuery(document).ready(function($) {


	if($("#resource-hero-slideshow").length) {
		$("#resource-hero-slideshow").slick({
			dots: true,
			appendDots: $("#resource-hero-slideshow-nav .dots"),
			arrows: true,
			// infinite: false,
			autoplay: true,
			autoplaySpeed: 9000,
			prevArrow: $("#resource-hero-slideshow-nav .prev"),
			nextArrow: $("#resource-hero-slideshow-nav .next"),
		});

		// let firstBG = $(".slick-current").attr("data-bg");
		// $("#resource-slideshow-background").css({
		// 	"background-image": `url(${firstBG})`
		// });
		//
		// $("#resource-hero-slideshow").on('afterChange', function(slick, currentSlide) {
		// 	let currentBG = $(".slick-current").attr("data-bg");
		// 	$("#resource-slideshow-background").css({
		// 		"background-image": `url(${currentBG})`
		// 	});
		// });

		$(".background-changer:eq(0)").addClass("active");

		$("#resource-hero-slideshow").on('afterChange', function(slick, currentSlide) {
			console.log(currentSlide.currentSlide);
			$(".background-changer").each(function() {
				$(this).removeClass("active");
			});
			$(`.background-changer:eq(${currentSlide.currentSlide})`).addClass("active");
		});
	}



	if($(".resource-content").length) {
		$(".resource-content iframe").wrap("<div class='video-responsive'></div>");
	}




	function renderResources(data, type) {
		if(data.length > 0) {
			var output = '';

			if(type != "append") {
				$(".resources-archive").html("");
			}
			console.log(data);
			for(var i = 0; i < data.length; i++) {

				let title = data[i].title.rendered;
				let image = data[i].acf.preview_image.url
				let description = data[i].acf.preview_description;
				let link = data[i].link;
				let linkText = data[i].acf.preview_link_text;

				let cat = "";
				if(hasFundType(data[i])) {
					cat = data[i]._embedded["wp:term"][0][0].name;
				}

				output += `
					<div class="resource-entry">
						<div class="bg-image" style="background-image: url(${image});"></div>
						<div class="inner-content">
							<div>
								<label class="section_label">${cat}</label>
								<p><strong><a href="${link}">${title}</a></strong></p>
								<p>${description}</p>
							</div>
							<a href="${link}">
								${linkText}
							</a>
						</div>
					</div>
				`
			}

			$(".resources-archive").append(output);
		}
		else {
			$(".resources-archive").html("No Matching Resources Found");
		}
	}




	function renderChurchFunds(data, parent) {
		if(data.length > 0) {
			var output = '';
			$("#give-to-a-fund-loop").html("");

			for(var i = 0; i < data.length; i++) {

				let title = data[i].name;
				let description = data[i].description;
				let link = data[i].link;

				let cat = "";
				if(hasFundType(data[i])) {
					cat = data[i]._embedded["wp:term"][0][0].name;
				}

				output += `
					<div class="column col-4 col-md-6 col-sm-12 fund-block">
						<div class="fund-t"></div>
						<label class="section_label">
							${parent}
						</label>
						<a href="${link}" class="black-link">
							<p><strong>${title}</p></strong>
						</a>
						<p>${description}</p>
						<p>
							<a href="${link}">
								Learn more
							</a>
						</p>
					</div>
				`
			}

			$("#give-to-a-fund-loop").append(output);
		}
		else {
			$("#give-to-a-fund-loop").html("No Matching Client Found");
		}
	}



	function resetFunds() {
		if($(".reset-button").hasClass("reset-resources")) {
			var resetURL = siteURL + "/wp-json/wp/v2/resources/?per_page=12&page=1&orderby=title&order=asc&_embed=1";
		}
		else {
			var resetURL = siteURL + "/wp-json/wp/v2/funds/?per_page=12&page=1&orderby=title&order=asc&_embed=1";
		}
		$.ajax({
			url: resetURL,
			type: 'GET',
			success: function(data) {
				if($(".reset-button").hasClass("reset-resources")) {
					renderResources(data);
				}
				else {
					renderFunds(data);
				}
				if($(".fund-load-more").length) {
					$(".fund-load-more").attr("current", 2);
					$(".fund-load-more").show();
					$(".fund-load-more button").html("Load More");
				}
				$(".reset-button").hide();
				$("#give-to-a-fund-search input").val("");
			},
			error: function(data) {
				console.log(data);
			}
		});
	}



	$(".reset-button").click(function() {
		resetFunds();
	})


	function hasFundType(data) {
		if(!data._embedded) { return false; }
		if(!data._embedded["wp:term"]) { return false; }
		if(!data._embedded["wp:term"][0]) { return false; }
		if(!data._embedded["wp:term"][0][0]) { return false; }
		if(!data._embedded["wp:term"][0][0].name) { return false; }
		return true;
	}



	// output funds to page
	function renderFunds(data, renderType = "search") {
		if(data.length > 0) {

			if(renderType == "search") {
				$("#give-to-a-fund-loop").html("");
			}
			var fundOutput = '';
			for(var i = 0; i < data.length; i++) {
				fundOutput += '<div class="column col-4 col-md-6 col-sm-12 fund-block">';
				fundOutput += '<div class="fund-t"></div>';

				if(hasFundType(data[i])) {
					fundOutput += '<h6>' + data[0]._embedded["wp:term"][0][0].name + '</h6>'
				}
				else {
					fundOutput += '<h6>&nbsp;</h6>';
				}

				fundOutput += '<p><strong>' + data[i].title.rendered + '</p></strong>';
				fundOutput += data[i].content.rendered;
				fundOutput += '<p><a href="' + data[i].acf.fund_link.url + '" target="_blank">' + data[i].acf.fund_link.title + '</a></p>';
				fundOutput += '</div>';
			}
			if(renderType == "search") {
				$("#give-to-a-fund-loop").html(fundOutput);
			}
			else {
				$("#give-to-a-fund-loop").append(fundOutput);
			}
		}
		else {
			$("#give-to-a-fund-loop").html("No Matching Funds Found");
		}
	}



	// search for funds based on input value
	function searchFunds() {
		var searchTerm = $("#give-to-a-fund-search input").val();

		if($("#give-to-a-fund-search input").hasClass("resource-search")) {
			var searchURL = siteURL + "/wp-json/wp/v2/resources?search=" + searchTerm + "&_embed=1&orderby=title&order=asc";
		}
		else {
			var searchURL = siteURL + "/wp-json/wp/v2/funds?search=" + searchTerm + "&_embed=1&orderby=title&order=asc";
		}

		$(".fund-load-more").hide();
		$("#give-to-a-fund-loop").html("Searching...");
		$.ajax({
			url: searchURL,
			type: 'GET',
			success: function(data) {
				if($("#give-to-a-fund-search input").hasClass("resource-search")) {
					renderResources(data);
				}
				else {
					renderFunds(data);
				}
				$(".reset-button").show();
			},
			error: function(data) {
				$("#give-to-a-fund-loop").html("There was an error with your search.");
				$("#resources-archive").html("There was an error with your search.");
			}
		});
	}



	// load more funds, hide button if all funds are showing
	function loadMoreFunds() {
		$(".fund-load-more button").html("LOADING...");
		var current = $(".fund-load-more").attr("current");
		var perPage = $(".fund-load-more").attr("per-page");
		var max = $(".fund-load-more").attr("data-max");

		if(current * perPage >= max) {
			$(".fund-load-more").hide();
		}

		$(".fund-load-more").attr("current", parseInt(current) + 1);

		if($(".fund-load-more").hasClass("resource-load-more")) {
			var loadMoreURL = siteURL + "/wp-json/wp/v2/resources/?_embed&per_page="+perPage+"&page=" + current + "&_embed=1&orderby=title&order=asc";
		}
		else {
			var loadMoreURL = siteURL + "/wp-json/wp/v2/funds/?_embed&per_page="+perPage+"&page=" + current + "&_embed=1&orderby=title&order=asc";
		}

		$.ajax({
			url: loadMoreURL,
			type: 'GET',
			success: function(data) {
				if($(".fund-load-more").hasClass("resource-load-more")) {
					renderResources(data, "append");
				}
				else {
					renderFunds(data, "append");
				}
			},
			error: function(data) {
				// console.log(data);
				// $(".load-more-insights button").html("PROBLEM LOADING");
			}
		});
	}



	function getFundsByType(id, el) {
		if(id != "all") {
			if(el.hasClass("resource-select")) {
				var taxURL = siteURL + "/wp-json/wp/v2/resources?resource_categories=" + id + "&_embed=1&orderby=title&order=asc";
			}
			else if(el.hasClass("church-fund-select")) {
				var taxURL = siteURL + "/wp-json/wp/v2/church?parent=" + id;
			}
			else {
				var taxURL = siteURL + "/wp-json/wp/v2/funds?fund_types=" + id + "&_embed=1&orderby=title&order=asc";
			}
			$.ajax({
				url: taxURL,
				type: 'GET',
				success: function(data) {
					if(el.hasClass("resource-select")) {
						renderResources(data);
					}
					else if(el.hasClass("church-fund-select")) {
						renderChurchFunds(data, $(".select-selected").html().trim());
					}
					else {
						renderFunds(data);
					}
				},
				error: function(data) {
					// console.log(data);
					// $(".load-more-insights button").html("PROBLEM LOADING");
				}
			});
		}
		else {
			window.location.reload();
		}
	}



	// search submitted on pressing enter key inside form
	$("#give-to-a-fund-search input").bind("enterKey", function(e) {
		searchFunds();
	});
	$("#give-to-a-fund-search input").keyup(function(e){
		if(e.keyCode == 13) {
			$(this).trigger("enterKey");
		}
	});

	$("#give-to-a-fund-search .glass").click(function() {
		searchFunds();
	});



	// load more funds when clicking the load more funds button
	$(".fund-load-more").click(function() {
		loadMoreFunds();
	});



	// select category changed
	$('select').on('change', function() {
	  alert( this.value );
	});









	var x, i, j, l, ll, selElmnt, a, b, c;
	/* Look for any elements with the class "custom-select": */
	x = document.getElementsByClassName("custom-select");
	l = x.length;
	for (i = 0; i < l; i++) {
		selElmnt = x[i].getElementsByTagName("select")[0];
		ll = selElmnt.length;
		/* For each element, create a new DIV that will act as the selected item: */
		a = document.createElement("DIV");
		a.setAttribute("class", "select-selected");
		a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
		x[i].appendChild(a);
		/* For each element, create a new DIV that will contain the option list: */
		b = document.createElement("DIV");
		b.setAttribute("class", "select-items select-hide");
		for (j = 1; j < ll; j++) {
			/* For each option in the original select element,
			create a new DIV that will act as an option item: */
			c = document.createElement("DIV");
			c.innerHTML = selElmnt.options[j].innerHTML;
			c.addEventListener("click", function(e) {
				/* When an item is clicked, update the original select box,
				and the selected item: */
				var y, i, k, s, h, sl, yl;
				s = this.parentNode.parentNode.getElementsByTagName("select")[0];
				sl = s.length;
				h = this.parentNode.previousSibling;
				for (i = 0; i < sl; i++) {
					if (s.options[i].innerHTML == this.innerHTML) {
						s.selectedIndex = i;
						h.innerHTML = this.innerHTML;
						y = this.parentNode.getElementsByClassName("same-as-selected");
						yl = y.length;
						for (k = 0; k < yl; k++) {
							y[k].removeAttribute("class");
						}
						this.setAttribute("class", "same-as-selected");

						// *********
						// *********
						// AFTER CHANGE

						$(".reset-button").show();
						$(".fund-load-more").hide();
						$("#give-to-a-fund-search input").val("");
						getFundsByType($("select").val(), $("select"));

						// AFTER CHANGE
						// *********
						// *********

						break;
					}
				}
				h.click();
			});
			b.appendChild(c);
		}
		x[i].appendChild(b);
		a.addEventListener("click", function(e) {
			/* When the select box is clicked, close any other select boxes,
			and open/close the current select box: */
			e.stopPropagation();
			closeAllSelect(this);
			this.nextSibling.classList.toggle("select-hide");
			this.classList.toggle("select-arrow-active");
			$(".select-arrow").toggleClass("select-arrow-active");
		});
	}

	function closeAllSelect(elmnt) {
		/* A function that will close all select boxes in the document,
		except the current select box: */
		var x, y, i, xl, yl, arrNo = [];
		x = document.getElementsByClassName("select-items");
		y = document.getElementsByClassName("select-selected");
		xl = x.length;
		yl = y.length;
		for (i = 0; i < yl; i++) {
			if (elmnt == y[i]) {
				arrNo.push(i)
			} else {
				y[i].classList.remove("select-arrow-active");
				$(".select-arrow").removeClass("select-arrow-active");
			}
		}
		for (i = 0; i < xl; i++) {
			if (arrNo.indexOf(i)) {
				x[i].classList.add("select-hide");
			}
		}
	}

	/* If the user clicks anywhere outside the select box,
	then close all select boxes: */
	document.addEventListener("click", closeAllSelect);



})
