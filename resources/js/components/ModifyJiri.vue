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
            <input class="form-control" type="text" name="jiriTitle" id="jiriTitle" :value="modifyJiri.name">
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
                    {{judge.name}} || {{judge.email}} || <button class="btn btn-danger" @click="deleteJudge(index, judge)">supprimer</button>
                </li>
            </ul>
        </div>
        <div class="card-body" @keyup.enter="addJudge">
            <h5>Ajouter des nouveaux jurés</h5>
            <br>
            <div>
                <label for="judgeName">Nom du Juré&nbsp;:</label>
                <input type="text" name="judgeName" id="judgeName" v-model="currentJudgeName" class="form-control">
            </div>
            <ul class="list-group">
                <li v-for="judge in searchJudges" :judge="judge" :key="judge.id" class="list-group-item list-group-item-action" @click="choiceJudge(judge)">
                    {{judge.name}}
                </li>
            </ul>
            <br>
            <div>
                <label for="judgeEmail">Email du Juré&nbsp;:</label>
                <input type="text" name="judgeEmail" id="judgeEmail" v-model="currentJudgeEmail" class="form-control">
            </div>
            <br>
            <button class="btn btn-primary" @click="addJudge">Ajouter à la liste</button>
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
                    {{student.name}} || {{student.email}} || <button class="btn btn-danger" @click="deleteStudent(index, student)">supprimer</button>
                </li>
            </ul>
        </div>
        <div class="card-body" @keyup.enter="addStudent">
            <h5>Ajouter des nouveaux étudiants</h5>
            <br>
            <div>
                <label for="studentName">Nom de l'étudiant&nbsp;:</label>
                <input type="text" name="studentName" id="studentName" v-model="currentStudentName" class="form-control">
            </div>
            <ul class="list-group">
                <li v-for="student in searchStudents" :student="student" :key="student.id" class="list-group-item list-group-item-action" @click="choiceStudent(student)">
                    {{student.name}}
                </li>
            </ul>
            <br>
            <div>
                <label for="studentEmail">Email de l'étudiant&nbsp;:</label>
                <input type="text" name="studentEmail" id="studentEmail" v-model="currentStudentEmail" class="form-control">
            </div>
            <br>
            <button class="btn btn-primary" @click="addStudent">Ajouter à la liste</button>
        </div>
    </section>
    <br>
    <section class="card">
        <h4 class="card-header">
            ajouter / supprimer des projets
        </h4>
        <div class="card-body" @keyup.enter="addProject">
            <h5>
                liste des projets
            </h5>
            <ul>
                <li v-for="(project, index) in modifyProjects">
                    {{project.name}} || <button class="btn btn-danger" @click="deleteProject(index, project)">supprimer</button>
                </li>
            </ul>
            <br>
            <div>
                <label for="ProjectName">Nom du projet&nbsp;:</label>
                <input type="text" name="ProjectName" id="ProjectName" v-model="currentProjectName" class="form-control">

                <ul class="list-group">
                    <li v-for="project in searchProjects" :project="project" :key="project.id" class="list-group-item list-group-item-action" @click="choiceProject(project)">
                        {{project.name}}
                    </li>
                </ul>
            </div>
            <br>
            <div>
                <label for="projectDesc">Description du projet&nbsp;:</label>
                <input type="text" name="projectDesc" id="projectDesc" v-model="currentProjectDesc" class="form-control">
            </div>
            <br>
            <button class="btn btn-primary" @click="addProject">ajouter à la liste</button>
        </div>
    </section>
    <br>
    <section class="card">
        <h4 class="card-header">
            choisissez les projets pour chaque élèves
        </h4>
        <div class="card-body">
            <div class="card mb-3" v-for="(student, index) in modifyStudents">
                <h5 class="card-header">
                    {{student.name}}
                </h5>
                <div class="card-body">
                    <div class="input-group mb-3" v-for="project in modifyProjects">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox"
                                       aria-label="Checkbox for following text input"
                                       :id="student.id + '$' + project.name"
                                       @change="addProjectToStudent({student: student, project: project, key:student.id + '$' + project.name})">
                            </div>
                        </div>
                        <label :for="student.id + '$' + project.name"
                               class="form-control">
                            {{project.name}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <button class="btn btn-primary" @click="sendData">enregister</button>
    <br>
</div>
</template>

<script>
    import {mapState} from 'vuex'
    import router from '../router';
    export default {
        name: "ModifyJiri",
        data(){
            return{
                componentReady: false,
                currentJudgeName: null,
                currentJudgeEmail: null,
                currentStudentName: null,
                currentStudentEmail: null,
                currentProjectName: null,
                currentProjectDesc: null,
                implementations: [],
                deleteJudges: [],
                addJudgesToDb: [],
                allJudgesForImplementations: [],
                deleteStudents: [],
                addStudentsToDb: [],
                allStudentsForImplementations: [],
                deleteProjects: [],
                addProjectsToDb: [],
                allProjectsForImplementations: [],
            }
        },
        computed: {
            ...mapState(['modifyJiri', 'modifyJudges', 'allUsers', 'modifyStudents', 'allStud', 'modifyProjects', 'allProjects']),
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
            searchProjects() {
                if (this.currentProjectName) {
                    return this.allProjects.filter(project => {
                        return project.name.toLowerCase().match(this.currentProjectName.toLowerCase())
                    })
                }
            }
        },
        methods:{
            deleteJudge(index,judge){
                this.$store.state.modifyJudges.splice(index, 1)
                this.deleteJudges.push(judge)

                const index2 = this.allJudgesForImplementations.findIndex(judges => judges.email === judge.email)
                this.allJudgesForImplementations.splice(index2, 1);
                const index3 = this.addJudgesToDb.findIndex(judges => judges.email === judge.email)

                if(index3 !== -1){
                    this.addJudgesToDb.splice(index3, 1);
                }

            },
            addJudge(){
                if(this.currentJudgeEmail === '' || this.currentJudgeName === '' ){
                    return
                }

                const id = Math.floor(Math.random() * Math.floor(1000))
                const judge = {id: id, name: this.currentJudgeName, email: this.currentJudgeEmail}

                this.$store.state.modifyJudges.push(judge)
                this.addJudgesToDb.push(judge);
                this.allJudgesForImplementations.push(judge);
                this.currentJudgeEmail = '';
                this.currentJudgeName = '';
            },
            choiceJudge(judge){
                const toto = {name: judge.name, email: judge.email}
                this.$store.state.modifyJudges.push(toto);
                this.allJudgesForImplementations.push(toto);
                this.currentJudgeName = '';
                this.currentJudgeEmail = '';
            },
            deleteStudent(index, student){
                this.$store.state.modifyStudents.splice(index, 1)
                this.deleteStudents.push(student)

                const index2 = this.allStudentsForImplementations.findIndex(students => students.email === student.email)
                this.allStudentsForImplementations.splice(index2, 1);
                const index3 = this.addStudentsToDb.findIndex(students => students.email === student.email)

                if(index3 !== -1){
                    this.addStudentsToDb.splice(index3, 1);
                }

            },
            addStudent(){
                if(this.currentStudentEmail === '' || this.currentStudentName === '' ){
                    return
                }

                const id = Math.floor(Math.random() * Math.floor(1000))
                const student = {id: id ,name: this.currentStudentName, email: this.currentStudentEmail}

                this.$store.state.modifyStudents.push(student)
                this.addStudentsToDb.push(student);
                this.allStudentsForImplementations.push(student);
                this.currentStudentEmail = '';
                this.currentStudentName = '';
            },
            choiceStudent(student){
                const toto = {name: student.name, email: student.email}
                this.$store.state.modifyStudents.push(toto);
                this.allStudentsForImplementations.push(toto);
                this.currentStudentName = '';
                this.currentStudentEmail = '';
            },
            deleteProject(index, project){
                this.$store.state.modifyProjects.splice(index, 1)
                this.deleteProjects.push(project)

                const index2 = this.allProjectsForImplementations.findIndex(projects => projects.email === project.name)
                this.allProjectsForImplementations.splice(index2, 1);
                const index3 = this.addProjectsToDb.findIndex(projects => projects.name === project.name)

                if(index3 !== -1){
                    this.addProjectsToDb.splice(index3, 1);
                }
            },
            addProject(){
                if(this.currentProjectName === '' || this.currentProjectDesc === '' ){
                    return
                }
                const id = Math.floor(Math.random() * Math.floor(1000))
                const project = {id: id ,name: this.currentProjectName, description: this.currentProjectDesc}

                this.$store.state.modifyProjects.push(project)
                this.addProjectsToDb.push(project);
                this.allProjectsForImplementations.push(project);
                this.currentProjectDesc = '';
                this.currentProjectName = '';
            },
            choiceProject(project){
                const toto = {name: project.name, email: project.description}
                this.$store.state.modifyProjects.push(toto);
                this.allProjectsForImplementations.push(toto);
                this.currentProjectName = '';
                this.currentProjectDesc = '';
            },
            addProjectToStudent(studentWithProject){
                const result = this.implementations.filter(implementation => implementation.student === studentWithProject.student && implementation.project === studentWithProject.project)

                if(result.length === 0){
                    this.implementations.push(studentWithProject)
                }else if(result.length > 0){
                    const index = this.implementations.findIndex(implementation => implementation.key === studentWithProject.key)
                    this.implementations.splice(index, 1)
                }
            },
            sendData(){
                let jiriName = document.querySelector('#jiriTitle').value
                let jiriDate = document.querySelector('#jiriDate').value
                let jiriTime = document.querySelector('#jiriTime').value

                window.axios.post('/modifyJiriBasicInfos', {id: this.$route.params.id, jiriName: jiriName, jiriDate: jiriDate, jiriTime: jiriTime})
                    .then( response =>{
                        this.addToDb()
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            addToDb(){
                window.axios.post('/addJudgesAndStudents', {newStudents: this.addStudentsToDb, newJudges: this.addJudgesToDb})
                    .then(response => {
                        this.deleteFromDb()
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            deleteFromDb(){
                window.axios.post('/deletePeopleForJiri', {id: this.$route.params.id, judges: this.deleteJudges, students: this.deleteStudents })
                    .then(response => {
                        this.addPeopleToDb()
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });

            },
            addPeopleToDb(){
                window.axios.post('/addPeopleToDb', {id: this.$route.params.id, students: this.modifyStudents, judges: this.modifyJudges})
                    .then(response => {
                        this.modifyImplementations()
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            modifyImplementations(){
                window.axios.post('/modifyImplementations', {id: this.$route.params.id, newImplementations: this.implementations})
                    .then(response => {
                        router.push({name: 'jiriList'})
                    })
                    .catch(function(error){
                        console.log(error.response.message)
                    })
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
                                                            this.$store.dispatch('setAllProjects')
                                                                .then(() =>{
                                                                    this.componentReady = true
                                                                })
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
