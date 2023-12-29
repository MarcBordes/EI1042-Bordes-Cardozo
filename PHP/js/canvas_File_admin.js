/**
 * * Descripción: Mostrar imagen antes de subirla en el listado admin
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> 
 * * @author Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/



function mostrarFoto(nodo, imagen) {
  var reader = new FileReader();
  reader.addEventListener("load", function () {
      imagen.src = reader.result;
  });
  reader.readAsDataURL(nodo.files[0]);
}

function ready() {
  document.querySelector("table").addEventListener("change", function (event) {
      var fichero = event.target;
      if (fichero.classList.contains("foto_cliente")) {
          var imagen = document.createElement("img");
          imagen.setAttribute("width", "300px");
          imagen.setAttribute("height", "200px");
          imagen.setAttribute("background-color", "lightblue");
          imagen.setAttribute("id", "imagen");

          
          var parentCell = fichero.closest("td");
          var existingImage = parentCell.querySelector("img");
          
          if (existingImage) {
              existingImage.src = '';
              mostrarFoto(fichero, existingImage);
          } else {
              mostrarFoto(fichero, imagen);
              parentCell.appendChild(imagen);
          }
          activarCanvas(imagen);
      }
  });
}


ready();

var botonesInput = document.querySelectorAll(".foto_cliente");
botonesInput.forEach(function (botonInput) {
  botonInput.addEventListener("click", function () {
      ready();
  });
});
