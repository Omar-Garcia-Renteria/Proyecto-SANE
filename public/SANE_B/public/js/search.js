document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe

        // Obtener el valor del campo de búsqueda
        var searchTerm = document.getElementById('search-input').value;

        // Aquí puedes realizar la acción de búsqueda, ya sea redireccionando a una página de resultados o haciendo una petición AJAX
        // Por ejemplo, redirigir a una página de resultados
        window.location.href = "/search?q=" + encodeURIComponent(searchTerm);
    });
});
