$(function() {
	'use strict';

	// preloader
	$('.preloader').fadeOut();

	// sidebar
	$('.sidebar').sideNav();

	$('.sidebar-search').sideNav({
		edge: 'right',
	});

	// slider
	$('.slide-show').owlCarousel({
		items: 1,
		navigation: true,
		slideSpeed: 1000,
		dots: true,
		smartSpeed: 700,
		paginationSpeed: 400,
		singleItem: true,
		autoplay: true,
		loop: true,
	});

	// tabs
	$('ul.tabs').tabs();

	// collapse
	$('.collapsible').collapsible();

	$('.dropdown-button').dropdown({
		inDuration: 300,
		outDuration: 225,
		constrainWidth: false, // Does not change width of dropdown to that of the activator
		hover: false, // Activate on hover
		gutter: 0, // Spacing from edge
		belowOrigin: true, // Displays dropdown below the button
		alignment: 'left', // Displays dropdown with edge aligned to the left of button
		stopPropagation: false, // Stops event propagation
	});
});

listYoutube();

function listYoutube() {
	axios
		.get(`https://www.googleapis.com/youtube/v3/playlistItems`, {
			params: {
				// company_id: company_id,
				key: 'AIzaSyCKGrDkWWXQktgTyneI6jvG1RYkX530jWw',
				part: 'snippet',
				playlistId: 'UUGJ9oxiBJvWK3hWT63M6CHw',
				maxResults: 50,
				fields: 'items/snippet',
			},
			// headers: {
			// 	Authorization: `Bearer AIzaSyCKGrDkWWXQktgTyneI6jvG1RYkX530jWw`,
			// },
		})
		.then(function(response) {
			console.log(response.data.items);
			let item = '';
			$(response.data.items).map((i, one) => {
				item += `<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="content">
								<a class="image" href="" style="margin-right:3em;">
									<iframe width="400" height="315" src="https://www.youtube.com/embed/${one.snippet
										.resourceId
										.videoId}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
									<!--<div class="time">04:11</div>-->
								</a>
								
								<p>
									<h5>${one.snippet.title}</h5>
								</p>
								<!--<p>
									<a href="">John Doe</a>
								</p>
								<p class="date">
									<span>22 Views</span>
									10 minute ago
								</p>-->
							</div>
						</div>`;
				// console.log(one.snippet);
			});
			$('#newvids').append(item);
			// let newArr = response.data.items.map((item) => {
			// 	return item.id;
			// });
			// console.log(newArr);
		})
		.catch(function(error) {
			console.log(error);
		})
		.then(function() {
			// always executed
		});
}
