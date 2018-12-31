<template>
    <div class="nav nav-tabs justify-content-center">
        <router-link :to="{name:'jiriList'}"
                      active-class="active"
                        class="nav-link"
                        exact
        >Tous mes jurys</router-link>
        <router-link :to="{name:'basicInfos'}"
                     active-class="active"
                     class="nav-link"
                     exact
        >Creer un jury</router-link>
        <router-link :to="{name:'Dashboard'}"
                     active-class="active"
                     class="nav-link"
                     exact
        >Dashboard</router-link>
    </div>
</template>

<script>
    export default {
        name: "Navigation"
    }
</script>

<style scoped>

</style>
