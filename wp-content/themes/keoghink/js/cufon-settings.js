function initCufon() {
	Cufon.replace('nav ul > li > a, .content nav ul a', { fontFamily: 'Banque', hover:true });
	Cufon.replace('.contact .tel, .title h1, .content h2, .image-description', { fontFamily: 'Interstate400'});
	Cufon.replace('.sidebar .info span', { fontFamily: 'Interstate500'});
        Cufon.replace('.image-description', {fontFamily: 'myriadpro-ci'});
}

$(document).ready(function(){
	initCufon();
});