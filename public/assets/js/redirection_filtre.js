const titreInput = document.getElementById('titre-recherche')

console.log(document.cookie)
// METTRE LES VALEURS SELON LES COOKIES Ou juste par défauts
function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);

	console.log(decodedCookie)
	let ca = decodedCookie.split(';');

	for(let i = 0; i <ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

console.log("Hey " + getCookie("titre"))
console.log("Hey " + getCookie("trierPar"))
console.log("Hey " + getCookie("ordre"))













titreInput.addEventListener('keyup', 
    (event) =>
    {
        if (event.key === 'Enter')
            redirection_recherche()
    }
);

function redirection_recherche()
{
	
	trierPar = document.getElementById('trier-par').value;	
	ordre    = document.getElementById('ordre').value;	
	titre    = titreInput.value;

	if (!titre || titre.trim().length === 0)
		location.replace("?trierPar=" + trierPar + "&ordre=" + ordre);
	else
		location.replace("?titre=" + titre + "&trierPar=" + trierPar + "&ordre=" + ordre);
}

