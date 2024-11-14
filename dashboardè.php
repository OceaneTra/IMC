D'accord, je vais adapter la solution à votre CSS existant. Voici uniquement les modifications à apporter au niveau de la partie photo dans le fichier dashboard_secretaire.php :

php
<div class="personal">
    <img 
        src="./IMC/img/<?php echo htmlspecialchars($photo_utilisateur); ?>" 
        alt="Photo de profil"
        onerror="this.src='./IMC/img/default.jpg'"
        style="object-fit: cover;"
    >
    <div class="info">
        <h3 class="nom"><?= htmlspecialchars($nom_utilisateur) . ' ' . htmlspecialchars($prenom_utilisateur) ?></h3>
        <h5 class="fonction"><?= ucfirst($user_type) ?></h5>
    </div>
</div>


Et ajoutez ces quelques lignes à votre CSS existant (à la suite de votre code CSS actuel) :

css
/* Ajoutez ces styles spécifiques pour la photo */
.personal img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-right: 12px;
    background-color: #eee;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}


Les principales modifications sont :
1. Changement du chemin d'accès à l'image (./IMC/img/)
2. Ajout de l'attribut onerror pour l'image par défaut
3. Ajout de object-fit: cover pour une meilleure gestion des proportions
4. Ajout d'une ombre et d'une bordure subtile pour améliorer l'apparence

Assurez-vous que :
1. Vous avez une image default.jpg dans le dossier IMC/img/
2. Le dossier IMC est au même niveau que votre fichier dashboard_secretaire.php
3. Les permissions des dossiers sont correctes

Ces modifications devraient résoudre le problème de vibration et améliorer l'affichage de la photo tout en respectant votre style CSS existant.