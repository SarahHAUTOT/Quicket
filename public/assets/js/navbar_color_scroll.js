window.addEventListener('scroll', function() {
	const navbar = document.querySelector('.navbar');
	const btn    = document.getElementById('btnSearch');
	console.log("Hey")

	if (window.scrollY > 40) { 


		if (btn != undefined)
		{
			btn.classList.add('btn-outline-dark');
			btn.classList.add('bg-light');
		}

		navbar.classList.add('navbar-light');
		navbar.classList.add('bg-light');
	} else {
		if (btn != undefined)
			{
				btn.classList.remove('btn-outline-dark');
				btn.classList.remove('bg-light');
			}

		navbar.classList.remove('navbar-light');
		navbar.classList.remove('bg-light');
	}
});