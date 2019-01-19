<template>
    <div class="list-group-item">
       <div class="d-flex justify-content-between">
           <h3>
               {{jiri.name}}
           </h3>
           <small>Planifié le {{scheduleDate}} à {{scheduleTime}}</small>
       </div>
        <hr>
        <div v-if="jiri.is_active">
            <button class="btn btn-danger" @click="stopJiri(jiri.id)">Mettre fin a ce jury</button>
            <button class="btn btn-light">Accéder au dashboard</button>
        </div>
        <div v-else>
            <button class="btn btn-primary" @click="startJiri(jiri.id)">Démarrer ce jury</button>
            <button class="btn btn-secondary" @click="modifyJiri(jiri.id)">Modifier ce jury</button>
            <button class="btn btn-danger" @click="deleteJury(jiri.id)">supprimer ce jury</button>
        </div>
    </div>
</template>

<script>
    import router from '../router';
    export default {
        name: "jiriListItem",
        props: {
            jiri: Object
        },
        data(){
            return{}
        },
        computed:{
            scheduleDate(){
                const optionsDate = {weekDay: 'long', year:'numeric', month: 'long', day:'numeric'}
                return new Intl.DateTimeFormat('fr-BE', optionsDate).format(new Date(this.jiri.scheduled_on))
            },
            scheduleTime(){
                const optionsTime = {hour: '2-digit', minute: '2-digit'}
                return new Intl.DateTimeFormat('fr-BE', optionsTime).format(new Date(this.jiri.scheduled_on))
            }
        },
        methods:{
            modifyJiri(id){
                router.push({path: `modify/${id}`});
            },
            deleteJury(id){
                window.axios.post('/deleteJury', {id: id})
                    .then(response => {
                        router.go()
                    })
                    .catch(error => console.error(error))
            },
            startJiri(id){
                window.axios.post('/startJiri', {id: id})
                    .then(response => {
                        router.go()
                    })
                    .catch (error => console.error(error))
            },
            stopJiri(id){
                window.axios.post('/stopJiri', {id: id})
                    .then(response => {
                        router.go()
                    })
                    .catch(error => console.error(error))
            }
        }
    }
</script>

<style scoped>

</style>
