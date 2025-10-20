function agregarMateria() {
    const contenedor = document.getElementById("contenedor-materias");

    const nuevoCampo = document.createElement("div");
    nuevoCampo.classList.add("materias");
    nuevoCampo.innerHTML = `
        <div>
            <input type="text" name="materia[]" placeholder="Ej. Física" required>
        </div>
        <div>
            <input type="text" name="codigo[]" placeholder="Ej. FIS-102" required>
        </div>
        <div>
            <input type="number" name="nota[]" min="0" max="100" placeholder="91" required>
        </div>
    `;

    const boton = document.querySelector(".add_materia");
    contenedor.insertBefore(nuevoCampo, boton);
}

// Limpiar materias adicionales al hacer reset
document.addEventListener("DOMContentLoaded", () => {
    const resetBtn = document.getElementById("resetBtn");
    const contenedor = document.getElementById("contenedor-materias");

    resetBtn.addEventListener("click", () => {
        const materias = contenedor.querySelectorAll(".materias");
        // Mantiene solo la primera
        materias.forEach((materia, index) => {
            if (index > 0) materia.remove();
        });
        // Limpia los campos de la primera también
        const inputs = materias[0].querySelectorAll("input");
        inputs.forEach(input => input.value = "");
    });
});
