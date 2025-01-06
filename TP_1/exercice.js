function ChangeNbrPersonne()
{
    entree = document.getElementssByName("select")[0];
    entree_selected = entree.value;

    if(entree_selected === "Aucun")
        document.getElementById("nb1").value = 0;
    else
    document.getElementById("nb1").value = 1;
}
