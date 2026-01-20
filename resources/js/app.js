import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const consoles = window.CONSOLES || [];
    const gamesGlobal = window.GAMES || [];

    function showCatalog(slug) {
        // Redirige a la lista filtrada por consola en el servidor
        window.location.href = '/games?console=' + encodeURIComponent(slug);
    }

    document.querySelectorAll('.console-card').forEach(card => {
        card.addEventListener('click', () => showCatalog(card.dataset.slug));
    });

    const backBtn = document.getElementById('catalogo-back');
    if (backBtn) {
        backBtn.addEventListener('click', () => {
            document.getElementById('catalogo').style.display = 'none';
            document.getElementById('consolas').style.display = 'block';
        });
    }
});
