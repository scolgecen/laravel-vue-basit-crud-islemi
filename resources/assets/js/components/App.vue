<template>
    <div id="app">
        <navbar />
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";

export default {
    components: {
        Navbar
    }
};
</script>
