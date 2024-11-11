<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Document</title>
    <link rel="stylesheet" href="/Ivoire_Medical_Center/IMC/admin_imc/assets/css/dashboard_styles.css">
</head>

<body>

    <!----Principal----->
    <h2 id="first">Général</h2>
    <div class="cards-container-principal">
        <div class="card">
            <div class="title">
                <h2>Nombre de visite</h2>
                <i class="fa-solid fa-user-group fa-2x"></i>
            </div>
            <div class="number">
                <h1>10,525</h1>
            </div>
            <div class="subtitles">
                <h3>Nombre de visite par jours</h3>
            </div>

        </div>


        <div class="card">
            <div class="title">
                <h2>Nombre de cliniques</h2>
                <i class="fa-regular fa-hospital fa-2x"></i>
            </div>
            <div class="number">
                <h1>4,125</h1>
            </div>
            <div class="subtitles">
                <h3>Nombre de clinique ajoutées</h3>
            </div>

        </div>


    </div>

    <!----Gestion des forfaits----->

    <h2>Forfaits</h2>
    <div class="cards-container-secondary">
        <div class="card">
            <div class="title">
                <h2>Basic plan</h2>
                <i class="fa-solid fa-users fa-2x"></i>
            </div>
            <div class="number">
                <h1>3,500</h1>
            </div>
            <div class="subtitles">
                <h3>Cliniques bénéficiant du forfait basic plan</h3>
            </div>

        </div>

        <div class="card">
            <div class="title">
                <h2>Business plan</h2>
                <i class="fa-solid fa-business-time fa-2x"></i>
            </div>
            <div class="number">
                <h1>1,254</h1>
            </div>
            <div class="subtitles">
                <h3>Cliniques bénéficiant du forfait business plan</h3>
            </div>

        </div>

        <div class="card">
            <div class="title">
                <h2>Entreprise plan</h2>
                <i class="fa-solid fa-user-tie fa-2x"></i>
            </div>
            <div class="number">
                <h1>7,241</h1>
            </div>
            <div class="subtitles">
                <h3>Cliniques bénéficiant du forfait entreprise plan</h3>
            </div>

        </div>
    </div>

    <!------Diagramme----->
    <div class="charts-container">
        <div class="chart-header">
            <h2>Statistiques des forfaits</h2>
            <div class="chart-legend">
                <div class="legend-item">
                    <div class="legend-basic"></div>
                    <span>Basic plan</span>
                </div>
                <div class="legend-item">
                    <div class="legend-business"></div>
                    <span>Business plan</span>
                </div>
                <div class="legend-item">
                    <div class="legend-entreprise"></div>
                    <span>Entreprise plan</span>
                </div>
            </div>
        </div>
        <div class="graph" style="text-align:center;">
            <canvas id="myChart" style="height:100%; width:100%;"></canvas>
        </div>
    </div>






    <script src="/Ivoire_Medical_Center/IMC/admin_imc/assets/js/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>