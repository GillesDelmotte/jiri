<template>
    <div class="list-group-item">
       <h2>
           {{jiri.name}}
       </h2>
        <hr>
        <div v-if="jiri.is_active">

            <button class="btn btn-danger">Mettre fin a ce jury</button>
            <button class="btn btn-light">Accéder au dashboard</button>
        </div>
        <div v-else>
            <button class="btn btn-primary">Démarrer ce jury</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "jiriListItem",
        props: {
            jiri: Object
        },
        data(){
            return{}
        },
        computed:{}
    }
</script>

<style scoped>

</style>
