function supprimerLigne(button) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette ligne ?")) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
        }
