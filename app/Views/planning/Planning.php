<div class="bg">
    <div class="vh-100 d-flex justify-content-center align-items-center text-center">
        <div class="container m-5">
            <!-- Planning Navigation -->
            <div class="row justify-content-md-center mt-3">
                <div class="col-2 col-md-1 d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-secondary" id="prev-week"><</button>
                </div>
                <div class="col-8 d-none d-md-flex">
                    <div class="row w-100">
                        <div class="col text-center fw-bold">Lundi</div>
                        <div class="col text-center fw-bold">Mardi</div>
                        <div class="col text-center fw-bold">Mercredi</div>
                        <div class="col text-center fw-bold">Jeudi</div>
                        <div class="col text-center fw-bold">Vendredi</div>
                        <div class="col text-center fw-bold">Samedi</div>
                        <div class="col text-center fw-bold">Dimanche</div>
                    </div>
                </div>
                <div class="col-8 d-md-none text-center">
                    <h5 id="current-day">Lundi</h5>
                </div>
                <div class="col-2 col-md-1 d-flex justify-content-center align-items-center">
                    <button class="btn btn-outline-secondary" id="next-week">></button>
                </div>
            </div>

            <!-- Planning Content -->
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <!-- Week Planning for Large Screens -->
                    <div class="d-none d-md-block">
                        <div class="row">
                            <div class="col text-center border p-3">Tâche Lundi</div>
                            <div class="col text-center border p-3">Tâche Mardi</div>
                            <div class="col text-center border p-3">Tâche Mercredi</div>
                            <div class="col text-center border p-3">Tâche Jeudi</div>
                            <div class="col text-center border p-3">Tâche Vendredi</div>
                            <div class="col text-center border p-3">Tâche Samedi</div>
                            <div class="col text-center border p-3">Tâche Dimanche</div>
                        </div>
                    </div>
                    <!-- Day Planning for Small Screens -->
                    <div class="d-md-none">
                        <div id="day-planning" class="border p-3">
                            <!-- Content for the current day -->
                            <p>Tâches du jour</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
