var imports = ['jquery-1.8.3.js','qwrap.js','jquery.form.js','utf8.js','validate.js','jquery.dialog.js','jquery.cookie.js','selectbeautify.js','util.js'];
(function(){
	var imports = window.imports || [];
	for (var i = 0; i < imports.length; i++) {
		document.write('<script src="'+ global_static_url +'/js/'+imports[i]+'"></script>');
	};
}());
