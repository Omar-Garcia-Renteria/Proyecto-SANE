<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promoción Vertical en Educación Básica</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="header-content">
                <h1>Promoción Vertical en Educación Básica</h1>
                <h2>{{ date('Y') }}-{{ date('Y') + 1 }}</h2>
            </div>
        </header>
        <main>
            <div class="menu">
                
                <div class="menu-item" style="text-align: center;">
                    <img src="/images/Designer (3).png" alt="SANE" style="width:100px; height:125px">
                    <a href="upload">GENERAR ARCHIVO SANE</a>
                    </div>

                    <div class="menu-item" style="text-align: center;">
                    <img src="/images/Designer (2).jpeg" alt="Incentivo" style="width:100px; height:125px">
                    <a href="/upload">INCENTIVO 1</a> <br>
                </div> <br> <br>


            </div>
            <img src="{{ asset('images/sep.png') }}" alt="Secretaria De Educacion Estado De Zacatecas" style="display: block; margin: 0 auto; width: 200px; height: auto;">

        </main>
    </div>
    <footer>
        <p>Derechos Reservados &bull; Secretaría de Educación del Estado de Zacatecas </p> <br>
        <p>© {{ date('Y') }}-{{ date('Y') + 1 }} SEP</p>
    </footer>
</body>
</html>


<style>
/* General body and html styling to ensure full height */
html, body {
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
}

/* Wrapper to contain header, main content */
.wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Flex-grow pushes footer to the bottom if content is short */
main {
    flex: 1;
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Footer styling */
footer {
    text-align: center;
    padding: 10px 0;
    background-color: #f1f1f1;
}

/* Menu and menu items styling */
.menu {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.menu-item {
    width: 50%;
    margin-bottom: 20px;
    text-align: center;
}

.menu-item img {
    width: 50px;
    height: 50px;
}

.menu-item a {
    display: block;
    margin-top: 10px;
    text-decoration: none;
    color: #0077c8;
    font-weight: bold;
}

/* Additional styling for the header */
header {
    background-color: #0077c8;
    color: white;
    text-align: center;
    padding: 20px 0;
}

.header-content {
    max-width: 800px;
    margin: 0 auto;
}

footer p {
    margin: 0;
}



</style>
