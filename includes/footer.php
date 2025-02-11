<section class="footer-card">
    <div class="container mt-5">
        <footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
            
            <div class="row row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
                <div class="col-sm-3">
                    <h4>Voyage</h4>
                    <ul class="unstyled">
                        <li class="lead">Hadj</li>
                        <li class="lead">Oumra</li>
                        <li class="lead">Visite et découverte</li>
                        <li class="lead">Hotel</li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>Entreprise</h4>
                    <ul class="unstyled">
                        <li class="lead">Fad Cart</li>
                        <li class="lead">Service</li>
                        <li class="lead">Blog</li>
                        <li class="lead">Contact</li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>Autres liens</h4>
                    <ul class="unstyled">
                        <li class="lead">Tourisme</li>
                        <li class="lead">Immigration</li>
                        <li class="lead">Voyage d'affaire</li>
                        <li class="lead">Culte</li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>New Letters</h4>
                    <form action="" method="post">
                        <div class="form-group mb-2">
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Souscrire</button>
                    </form>
                </div>
            </div>
        
            <hr>
            <p class="text-center mt-5 lead pied">&copy; 2025 GreenFad Airlines</p>
        </footer>
    </div>
</section>

<style>
    section.footer-card{
        padding: 40px;
        background-color: white;
        /* background: linear-gradient(to left, #356c7e, #356c7e, cadetblue); */
    }
    h4{
        color: #356c7e;
        font-weight: 700;
    }
    .form-group input{
        border: 1px solid #356c7e;
    }
    li.lead, p.pied{
        color: gray;
    }

    /* Media */
    @media screen and (max-width:768px) {
        section.footer-card{
            padding: 20px;
        }
        li.lead{
            font-size: 16px;
        }
        h4{
            font-size: 19px;
        }
        ul{
            padding: 0;
        }
        p.pied{
            font-size: 17px;
        }
    }
</style>
</body>
</html>