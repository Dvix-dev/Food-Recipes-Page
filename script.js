// Obtener los modales y botones
const modal = document.getElementById("addRecipeModal");
const filterModal = document.getElementById("filterModal");
const addRecipeBtn = document.getElementById("addRecipeBtn");
const filterBtn = document.getElementById("filterBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
const closeFilterModalBtn = document.getElementById("closeFilterModalBtn");

// Abrir el modal para añadir receta
addRecipeBtn.onclick = function() {
    modal.style.display = "flex";
}

// Abrir el modal para filtrar recetas
filterBtn.onclick = function() {
    filterModal.style.display = "flex";
}

// Cerrar el modal para añadir receta
closeModalBtn.onclick = function() {
    modal.style.display = "none";
}

// Cerrar el modal para filtrar recetas
closeFilterModalBtn.onclick = function() {
    filterModal.style.display = "none";
}

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == filterModal) {
        filterModal.style.display = "none";
    }
}