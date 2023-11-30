// Este es un ejemplo básico de cómo podrías implementar la lógica del tooltip
document.addEventListener("DOMContentLoaded", function() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    
    tooltips.forEach(tooltip => {
        const tooltipText = tooltip.getAttribute('data-tooltip');
        
        tooltip.addEventListener('mouseover', function() {
            const tooltipSpan = this.nextElementSibling;
            tooltipSpan.textContent = tooltipText;
        });
        
        tooltip.addEventListener('mouseout', function() {
            const tooltipSpan = this.nextElementSibling;
            tooltipSpan.textContent = '';
        });
    });
});
