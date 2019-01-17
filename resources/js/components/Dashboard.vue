<template>
    <div v-if="componentReady === false">
        wait plz
    </div>
    <div v-else>
        <h1 style="text-align: center">
            {{currentJiri.name}}
        </h1>
        <br>
        <div>
            <div>
                <div v-for="student in dashboard" class="list-group-item mb-3">
                    <div class="d-flex justify-content-between flex-wrap align-content-start">
                        <h3>
                            {{student.name}}
                        </h3>
                        <p style="font-size: 20px">
                            Moyenne de l'étudiant&nbsp;:{{student.implementations_for_current_jiri_with_projects_and_scores[0].result}}
                        </p>
                    </div>
                    <hr>
                    <div class="d-flex flex-wrap">
                        <div v-for="implementation in student.implementations_for_current_jiri_with_projects_and_scores"
                             class="card p-2 flex-fill">
                            <div class="card-body">
                                <h4>
                                    {{implementation.project.name}}
                                </h4>
                                <p style="color:rgb(50, 50, 255);">
                                    {{implementation.project.description}}
                                </p>
                                <div v-for="score in implementation.scores" >
                                    <hr>
                                    <h4>
                                        {{getUser(score.user_id)}}
                                    </h4>
                                    <p>
                                        <b> score :</b> {{score.score}}
                                    </p>
                                    <p>
                                        <b>commentaire : </b>{{score.comment}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    export default {
        name: "Dashboard",
        data(){
            return{
                componentReady: false
            }
        },
        computed:{
            ...mapState(['dashboard', 'dashboardUser', 'currentJiri'])
        },
        methods:{
            getUser(id){
                const user = this.dashboardUser.find( element => {
                    return element.id === id
                })
                return user.name
            }
        },
        mounted: function () {
            this.$store.dispatch('setDashboard')
                .then(() => {
                    this.$store.dispatch('setUserForCurrentJiri')
                        .then(() => {
                            this.$store.dispatch('setCurrentJiri')
                                .then(() =>{
                                    this.componentReady = true
                                })
                        })
                })
        }
    }
</script>

<style scoped>

</style>
