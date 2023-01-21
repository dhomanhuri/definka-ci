( function ( $ ) {

	var charts = {
		init: function () {
			this.ajaxPostMap();
		},

		ajaxPostMap: function () {
			var urlPath =  window.location.protocol + '//' + window.location.hostname + '/post-maps';
			var request = $.ajax( {
				method: 'GET',
				url: urlPath
		} );

			request.done( function ( response ) {
				charts.createCompletedJobsMap( response );
			});
		},

		createCompletedJobsMap: function ( response ) {
			const data = response.data;
			data.forEach(push);
			
			function push(item)
			{
				var title = document.getElementById(item.place);
				var path = document.querySelector('[title="' + item.place + '"]');

				title.innerHTML = 'Jumlah Alumni: ' + item.count + '\nDaerah: ' + item.place
				if (item.count < 5) {
					path.classList.add('med-color');
				}
				else {
					path.classList.add('high-color');
				}
			}

		}
	};

	charts.init();

} )( jQuery );