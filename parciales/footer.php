    </main>
        <footer class="footer mt-auto py-2 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h5>Centro de Formación XRV</h5>
                        <p>© 2024 XRV Enterprise</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <h5>Contacto</h5>
                        <p class="mb-2">Sede Central: Calle del Saber, 123, 28009, Madrid</p>
                        <p class="mb-2">Email: info@xrv.com</p>
                        <p class="mb-0">Teléfono: +900 456 7890</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $("#tabla").DataTable({
                    "pageLength": 5,
                    lengthMenu:[5,10,20,50],
                    "language": {
                        "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                    }
                });
            });
        </script>
    </body>
</html>