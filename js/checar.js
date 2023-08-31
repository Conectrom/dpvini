var especificarDeficiencia = document.getElementById('especificar-deficiencia');
var especificarHabilitacao = document.getElementById('especificar-habilitacao');
var deficiencia1 = document.getElementById('deficiencia-1');
var habilitacao1 = document.getElementById('habilitacao-1');
var radios = document.getElementsByName('deficiencia');

for (var i = 0; i < radios.length; i++) {
  radios[i].addEventListener('change', function() {
    if (deficiencia1.checked) {
      especificarDeficiencia.style.display = 'block';
    } else {
      especificarDeficiencia.style.display = 'none';
    }
  });
}

var radios = document.getElementsByName('habilitacao');

for (var i = 0; i < radios.length; i++) {
  radios[i].addEventListener('change', function() {
    if (habilitacao1.checked) {
      especificarHabilitacao.style.display = 'block';
    } else {
      especificarHabilitacao.style.display = 'none';
    }
  });
}