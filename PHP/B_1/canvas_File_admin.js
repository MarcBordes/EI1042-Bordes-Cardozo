function mostrarFoto(nodo, imagen) {
  var reader = new FileReader();
  reader.addEventListener("load", function () {
      imagen.src = reader.result;
  });
  reader.readAsDataURL(nodo.files[0]);
}

function ready() {
  // Attach the change event to a common ancestor (e.g., the table)
  document.querySelector("table").addEventListener("change", function (event) {
      var fichero = event.target;
      if (fichero.classList.contains("foto_cliente")) {
          var imagen = document.createElement("img");
          imagen.setAttribute("width", "300px");
          imagen.setAttribute("height", "200px");
          imagen.setAttribute("background-color", "lightblue");
          imagen.setAttribute("id", "imagen");

          

          // Find the parent cell (td)
          var parentCell = fichero.closest("td");

          // Check if the cell already contains an image
          var existingImage = parentCell.querySelector("img");
          
          if (existingImage) {
              // If an image exists, replace its source
              existingImage.src = '';
              mostrarFoto(fichero, existingImage);
          } else {
              // If no image exists, append the new image
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
