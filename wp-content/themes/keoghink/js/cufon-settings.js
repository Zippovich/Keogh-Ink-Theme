function initCufon() {
	Cufon.replace('nav ul > li > a, .content nav ul a', { fontFamily: 'Banque', hover:true });
	Cufon.replace('.contact .tel, .title h1, .content h2', { fontFamily: 'Interstate400'});
	Cufon.replace('.sidebar .info span', { fontFamily: 'Interstate500'});
}

$(document).ready(function(){
	initCufon();
});