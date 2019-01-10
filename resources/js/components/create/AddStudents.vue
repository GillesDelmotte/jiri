<template>
    <div>
        <section class="card">
            <h4 class="card-header">
                ajouter des étudiants au jury
            </h4>
            <div class="card-body">
                <div @keyup.enter="addStudent">
                    <label for="student" class="">Nom de l'étudiant&nbsp;:</label>
                    <input type="text"
                           name="student"
                           id="student"
                           placeholder="Gilles Delmotte"
                           v-model="currentStudent"
                           class="form-control">
                    <ul class="list-group">
                        <li v-for="student in searchStudents" :student="student" :key="student.id" class="list-group-item list-group-item-action" @click="choice(student)">
                            {{student.name}}
                        </li>
                    </ul>
                    <hr>
                    <label for="studentEmail" class="">Email&nbsp;:</label>
                    <input class="form-control"
                           type="email"
                           name="studentEmail"
                           id="studentEmail"
                           placeholder="gilles.delmotte@outlook.be"
                           v-model="currentEmail">
                </div>
                <br>
                <button class="btn btn-primary" @click="addStudent">ajouter à la liste</button>
                <br>
                <br>
                <hr>
                <div>
                    <h5>Liste des étudiants ajouté</h5>
                    <ul>
                        <li v-for="(student, index) in allStudents">
                            {{student.name}} || {{student.email}} || <button class="btn btn-danger" @click="deleteStudent(index)">supprimer</button>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <br>
        <button class="btn btn-primary" @click="sendData">suivant</button>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import router from '../../router';
    export default {
        name: "AddStudents",
        data(){
            return{
                currentStudent:null,
                currentEmail:null,
                allStudents: [],
                addToDb:[],
                componentReady: false,
            }
        },
        computed: {
            searchStudents() {
                if (this.currentStudent) {
                    return this.allStud.filter(student => {
                        return student.name.toLowerCase().match(this.currentStudent.toLowerCase())
                    })
                }
            },
            ...mapState(['allStud'])
        },
        methods:{
            addStudent(){
                if(this.currentEmail === '' || this.currentStudent === '' ){
                    return
                }
                const student = {name: this.currentStudent, email: this.currentEmail}
                this.allStudents.push(student);
                this.addToDb.push(student);
                this.currentStudent = '';
                this.currentEmail = '';
            },
            choice(student){
                const toto = {name: student.name, email: student.email}
                this.allStudents.push(toto);
                this.currentStudent = '';
                this.currentEmail = '';
            },
            sendData(){
                window.axios.post('/addStudents', {allStudents: this.addToDb, type: 'Student'})
                    .then(response => {
                        this.createPeople()
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            createPeople(){
                window.axios.post('/addPeopleStudents', {allStudents: this.allStudents, type: 'Student'})
                    .then(response => {
                       router.push({name:'addProjects'})
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            deleteStudent(index){
                this.allStudents.splice(index, 1);
            },
        },
        mounted() {
            this.$store.dispatch('setAllStud')
                .then(() => {
                    this.componentReady = true;
                })
        }
    }
</script>

<style scoped>

</style>
