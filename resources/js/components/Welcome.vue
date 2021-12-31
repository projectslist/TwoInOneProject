<template>
    <main>
<Header />

        <div class="container-wrapper" >
            <div class="content" style="margin-bottom: 300px;">
                <div class="container-fluid">
                    <div class="row bg-gray-light">

                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
<Footer />
    </main>

</template>

<script>

    import Header from "./Header";
    import Footer from "./Footer";
    import Dashboard from "./Dashboard";


    export default {
        name: "Home",
        components: { Header,Dashboard, Footer},

    }
</script>

<style scoped>

</style>
