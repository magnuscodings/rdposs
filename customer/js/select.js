// Kapag nagbago ang pagpili sa dropdown menu
document.getElementById("categorySelect").addEventListener("change", function() {
    // Kunin ang napiling kategorya
    var selectedCategory = this.value;
    
    // Ipakita ang pangalan ng kategorya sa display
    document.getElementById("displayCategory").textContent = selectedCategory;
});