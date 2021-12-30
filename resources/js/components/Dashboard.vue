<template>
    <main>
        <div class="bg-gray-light  m-5" style="margin-top: 100px!important; height: 100vh">

            <section id="activities" class="my-5 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col bg-secondary rounded mb-4 pt-5">
                            <div class="info-header mb-5 mt-5">
                                <h1 class="text-info pb-3 fw-bold">
                                    Projects
                                </h1>
                                <p class="lead text-white">
                                   There are total two different projects. One of them is about a fullcalendar system and the other one is about ToDo List.
                                    Drag and Drop feature has been used in the projects! I hope you enjoy  projects.
                                </p>
                                <hr class="text-white">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 h-100 d-flex justify-content-center align-items-center">


                        <div class="col-lg-3 col-md-6">
                            <div class="card border-success shadow p-3 mb-5 bg-white rounded">
                                <div class="card-body">
                                    <img src="img/calendar.png" alt="" class="img-fluid
                      rounded-circle w-50 mb-3">
                                    <h3>Full Calendar</h3>
                                    <p>
                                       Fully manageable full calendar project.
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <div class="p-4">
                                            <a href="#">
                                                <i class="fab fa-facebook fa-2x text-primary"></i>
                                            </a>
                                        </div>

                                        <div class="p-4">
                                            <a href="#">
                                                <i class="fab fa-twitter fa-2x text-info"></i>
                                            </a>
                                        </div>

                                        <div class="p-4">
                                            <a href="#">
                                                <i class="fab fa-instagram fa-2x text-warning"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card border-warning shadow p-3 mb-5 bg-white rounded">
                                <div class="card-body">
                                    <img src="img/task.jpg" alt="" class="img-fluid
                          rounded-circle w-50 mb-3">
                                    <h3>To Do</h3>
                                    <p>
                                        Easy to manage all task with nice drag and drop feature!
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <div class="p-4">
                                            <a href="#">
                                                <i class="fab fa-facebook fa-2x text-primary"></i>
                                            </a>
                                        </div>

                                        <div class="p-4">
                                            <a href="#">
                                                <i class="fab fa-twitter fa-2x text-info"></i>
                                            </a>
                                        </div>

                                        <div class="p-4">
                                            <a href="#">
                                                <i class="fab fa-instagram fa-2x text-warning"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>



                </div>
            </section>


        </div>

    </main>
</template>

<script>
    export default {
        name: "Dashboard"
    }
</script>

<style scoped>

</style>
