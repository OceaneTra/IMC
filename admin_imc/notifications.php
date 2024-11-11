<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/notif_style.css">
</head>

<body>

    <div class="notifications-container">
        <div class="notifications-header">
            <h2>Notifications <span class="notification-badge">3 nouvelles</span></h2>
            <div class="filter-buttons">
                <button class="filter-btn active">Toutes</button>
                <button class="filter-btn">Non lues</button>
                <button class="filter-btn">Déjà lues</button>
            </div>
        </div>

        <div class="notification-list">
            <div class="notification-card unread">
                <div class="notification-icon icon-urgent">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">Nouvel avis de la part de l'utilisateur xxxx</div>
                    <div class="notification-text">Contenu de l'avis</div>
                    <div class="notification-time">Il y a 5 minutes</div>
                </div>
                <div class="notification-actions">
                    <button class="action-btn mark-read">Marquer comme lu</button>
                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            </div>

            <div class="notification-card unread">
                <div class="notification-icon icon-info">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">Nouvelle souscription au plan basic</div>
                    <div class="notification-text">La clinique xxxxx souscrit au plan basic</div>
                    <div class="notification-time">Il y a 1 heure</div>
                </div>
                <div class="notification-actions">
                    <button class="action-btn mark-read">Marquer comme lu</button>
                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            </div>

            <div class="notification-card">
                <div class="notification-icon icon-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">Nouvelle clinique partenaire</div>
                    <div class="notification-text">La Clinique Saint Jean a rejoint notre réseau de partenaires.</div>
                    <div class="notification-time">Hier à 14:30</div>
                </div>
                <div class="notification-actions">
                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            </div>

            <div class="notification-card">
                <div class="notification-icon icon-info">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">Rappel - Réunion mensuelle</div>
                    <div class="notification-text">La réunion mensuelle des gestionnaires aura lieu demain à 9h00.</div>
                    <div class="notification-time">Hier à 10:15</div>
                </div>
                <div class="notification-actions">
                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>



    <script src="/Ivoire_Medical_Center/IMC/admin_imc/assets/js/notifications.js"></script>
</body>

</html>