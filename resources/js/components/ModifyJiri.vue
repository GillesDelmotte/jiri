<template>
<div v-if="componentReady === false">
    plz wait
</div>
<div v-else>
    <h1>Modification d'un jury</h1>
    <br>
    <section class="card">
        <h4 class="card-header">
            titre, date et heure du jury
        </h4>
        <div class="card-body">
            <label for="jiriTitle" class="">Titre&nbsp;:</label>
            <input class="form-control" type="text" name="jiriTitle" id="jiriTitle" :value="modifyJiri.name" >
            <hr>
            <label for="jiriDate" class="">Date&nbsp;:</label>
            <input class="form-control" type="date" name="jiriDate" id="jiriDate">
            <hr>
            <label for="jiriTime" class="">Heure&nbsp;:</label>
            <input class="form-control" type="time" name="jiriTime" id="jiriTime" :value="scheduleTime" >
        </div>
    </section>
    <br>
    <section class="card">
        <h4 class="card-header">
            ajouter / supprimer des jurés
        </h4>
        <div class="card-body">
            <h5>liste des jurés&nbsp;:</h5>
            <ul>
                <li v-for="(judge, index) in modifyJudges">
                    {{judge.name}} || {{judge.email}} || <button class="btn btn-danger" @click="deleteJudge(index)">supprimer</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5>Ajouter des nouveaux jurés</h5>
            <br>
            <div>
                <label for="judgeName">Nom du Juré&nbsp;:</label>
                <input type="text" name="judgeName" id="judgeName" v-model="currentJudgeName" class="form-control">
            </div>
            <ul class="list-group">
                <li v-for="judge in searchJudges" :judge="judge" :key="judge.id" class="list-group-item list-group-item-action">
                    {{judge.name}}
                </li>
            </ul>
            <br>
            <div>
                <label for="judgeEmail">Email du Juré&nbsp;:</label>
                <input type="text" name="judgeEmail" id="judgeEmail" v-model="currentJudgeEmail" class="form-control">
            </div>
            <br>
            <button class="btn btn-primary">Ajouter à la liste</button>
        </div>
    </section>
    <br>
    <section class="card">
        <h4 class="card-header">
            ajouter / supprimer des étudiants
        </h4>
        <div class="card-body">
            <h5>liste des étudiants&nbsp;:</h5>
            <ul>
                <li v-for="(student, index) in modifyStudents">
                    {{student.name}} || {{student.email}} || <button class="btn btn-danger" @click="deleteStudent(index)">supprimer</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5>Ajouter des nouveaux étudiants</h5>
            <br>
            <div>
                <label for="studentName">Nom de l'étudiant&nbsp;:</label>
                <input type="text" name="studentName" id="studentName" v-model="currentStudentName" class="form-control">
            </div>
            <ul class="list-group">
                <li v-for="student in searchStudents" :student="student" :key="student.id" class="list-group-item list-group-item-action">
                    {{student.name}}
                </li>
            </ul>
            <br>
            <div>
                <label for="StudentEmail">Email de l'étudiant&nbsp;:</label>
                <input type="text" name="studentEmail" id="studentEmail" v-model="currentStudentEmail" class="form-control">
            </div>
            <br>
            <button class="btn btn-primary">Ajouter à la liste</button>
        </div>
    </section>
    {{modifyProjects}}
</div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        name: "ModifyJiri",
        data(){
            return{
                componentReady: false,
                currentJudgeName: null,
                currentJudgeEmail: null,
                currentStudentName: null,
                currentStudentEmail: null
            }
        },
        computed: {
            ...mapState(['modifyJiri', 'modifyJudges', 'allUsers', 'modifyStudents', 'allStud', 'modifyProjects']),
            scheduleDate(){
                const optionsDate = { year:'numeric', month: 'numeric', day:'numeric'}
                return new Intl.DateTimeFormat('fr-BE', optionsDate).format(new Date(this.modifyJiri.scheduled_on))
            },
            scheduleTime(){
                const optionsTime = {hour: '2-digit', minute: '2-digit'}
                return new Intl.DateTimeFormat('fr-BE', optionsTime).format(new Date(this.modifyJiri.scheduled_on))
            },
            searchJudges(){
                if(this.currentJudgeName){
                    return this.allUsers.filter(judge => {
                        return judge.name.toLowerCase().match(this.currentJudgeName.toLowerCase())
                    })
                }
            },
            searchStudents() {
                if (this.currentStudentName) {
                    return this.allStud.filter(student => {
                        return student.name.toLowerCase().match(this.currentStudentName.toLowerCase())
                    })
                }
            },

        },
        methods:{
            deleteJudge(index){
                this.$store.state.modifyJudges.splice(index, 1)
            },
            deleteStudent(index){
                this.$store.state.modifyStudents.splice(index, 1)
            }
        },
        mounted() {
            this.$store.dispatch('setModifyJiri', this.$route.params.id)
                .then(() => {
                    this.$store.dispatch('setModifyJudges', this.$route.params.id)
                        .then(() => {
                            this.$store.dispatch('setAllUsers')
                                .then(() => {
                                    this.$store.dispatch('setModifyStudents', this.$route.params.id)
                                        .then(() => {
                                            this.$store.dispatch('setAllStud')
                                                .then(() => {
                                                    this.$store.dispatch('setModifyProjects', this.$route.params.id)
                                                        .then(() => {
                                                            this.componentReady = true
                                                        })
                                                })
                                        })
                                })
                        })
                })
        }
    }

</script>

<style scoped>

</style>
