//при случайном удалении страниц в админке
//подтверждение удаления в любых частях админпанели
function confirmDelete() {
    if (confirm("Delete this item?")) {
        return true;
    } else {
        return false;
    }
}