<template>
    <main>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">MyLogo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <router-link class="nav-link" to="Dashboard">Home</router-link>
                        <router-link class="nav-link" to="Calendar">Calendar</router-link>
                        <router-link class="nav-link" to="ToDo">ToDo</router-link>


                    </div>
                </div>
            </div>
        </nav>
    </main>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>

</style>
