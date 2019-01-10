<template>
    <div>
        <section class="card">
            <h4 class="card-header">
                Ajouter les projets du jury
            </h4>
            <div class="card-body">
                <div @keyup.enter="addProject">
                    <label for="name">Nom du projet&nbsp;:</label>
                    <input type="text"
                            name="name"
                            id="name"
                            v-model="currentProject"
                            class="form-control">
                    <ul class="list-group">
                        <li v-for="project in searchProjects" :project="project" :key="project.id" class="list-group-item list-group-item-action" @click="choice(project)">
                            {{project.name}}
                        </li>
                    </ul>
                    <hr>
                    <label for="description">Description du projet&nbsp;:</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" v-model="currentDescription"></textarea>
                </div>
                <br>
                <button class="btn btn-primary" @click="addProject">ajouter à la liste</button>
                <br>
                <br>
                <hr>
                <div>
                    <h5>Liste des projets ajouté</h5>
                    <ul>
                        <li v-for="(project, index) in allProjectsToDb">
                            {{project.name}} || <button class="btn btn-danger" @click="deleteProject(index, project.name)">supprimer</button>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <br>
        <section class="card">
            <h4 class="card-header">
                Cocher les projets pour chaque élèves
            </h4>
            <div class="card-body" v-for="student in allStudentsForProjects">
                <div class="card">
                    <p class="card-header">
                        {{student.name}}
                    </p>
                    <div class="card-body">
                        <div class="input-group mb-3" v-for="project in allProjectsToDb">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox"
                                           aria-label="Checkbox for following text input"
                                           :id="student.id + '$' + project.name">
                                </div>
                            </div>
                            <label :for="student.id + '$' + project.name"
                                   class="form-control"
                                   @click="addProjectToStudent({student: student.id, project: project.name, key:student.id + '$' + project.name})">
                                {{project.name}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <button class="btn btn-primary" @click="sendData">suivant</button>
        <br>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import router from '../../router';
    export default {
        name: "AddProjects",
        data(){
            return{
                currentProject: null,
                currentDescription: null,
                componentReady: false,
                allProjectsToDb: [],
                addToDb: [],
                implementations: []
            }
        },
        computed:{
            searchProjects() {
                if (this.currentProject) {
                    return this.allProjects.filter(project => {
                        return project.name.toLowerCase().match(this.currentProject.toLowerCase())
                    })
                }
            },
            ...mapState(['allProjects', 'allStudentsForProjects'])
        },
        methods:{
            addProjectToStudent(studentWithProject){
                const result = this.implementations.filter(implementation => implementation.student === studentWithProject.student && implementation.project === studentWithProject.project)

                if(result.length === 0){
                    this.implementations.push(studentWithProject)
                }else if(result.length > 0){
                    const index = this.implementations.findIndex(implementation => implementation.key === studentWithProject.key)
                    this.implementations.splice(index, 1)
                }

            },
            deleteProject(index,project){
                this.allProjectsToDb.splice(index, 1);
                //const index2 = this.implementations.findIndex(implementation => implementation.project === project)
                //this.implementations.splice(index2, 1)
            },
            choice(project){
                const toto = {name: project.name, description: project.description}
                this.allProjectsToDb.push(toto);
                this.currentProject = '';
                this.currentDescription = '';
            },
            addProject(){
                if(this.currentProject === '' || this.currentDescription === '' ){
                    return
                }
                const project = {name: this.currentProject, description: this.currentDescription}
                this.allProjectsToDb.push(project);
                this.addToDb.push(project);
                this.currentProject = '';
                this.currentDescription = '';
            },
            sendData(){
                window.axios.post('/addProject', {allProjects: this.addToDb})
                    .then(response => {
                        this.createImplementations()
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            createImplementations(){
                window.axios.post('/createImplementation', {implementations: this.implementations})
                    .then(response => {
                        router.push({name: 'jiriList'})
                    })
                    .catch(function(error){
                        console.log(error.response.data.message)
                    })
            }
        },

        mounted(){
            this.$store.dispatch('setAllProjects')
                .then(() => {
                    this.$store.dispatch('setAllStudentsForProjects')
                        .then(() => {
                            this.componentReady = true;
                        })

                })
        }
    }
</script>

<style scoped>

</style>
