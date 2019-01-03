<template>
    <div>
        <section class="card">
            <h4 class="card-header">
                ajouter des jurés au jury
            </h4>
            <div class="card-body">
                <div @keyup.enter="addJudge">
                    <label for="judge" class="">Nom du Juge&nbsp;:</label>
                    <input type="text"
                           name="judge"
                           id="judge"
                           placeholder="Gilles Delmotte"
                           v-model="currentJudge"
                           class="form-control test">
                    <ul class="list-group">
                        <li v-for="judge in searchJudges" :judge="judge" :key="judge.id" class="list-group-item list-group-item-action" @click="choice(judge)">
                            {{judge.name}}
                        </li>
                    </ul>
                    <hr>
                    <label for="judgeEmail" class="">Email&nbsp;:</label>
                    <input class="form-control"
                           type="email"
                           name="judgeEmail"
                           id="judgeEmail"
                           placeholder="gilles.delmotte@outlook.be"
                           v-model="currentEmail">
                </div>
                <br>
                <button class="btn btn-primary" @click="addJudge">ajouter à la liste</button>
                <br>
                <br>
                <hr>
                <div>
                    <h5>Liste des jurés ajouté</h5>
                    <ul>
                        <li v-for="(judge, index) in allJudges">
                            {{judge.name}} || {{judge.email}} || <button class="btn btn-danger" @click="deleteJudge(index)">supprimer</button>
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
        name: "AddJudges",
        data(){
            return{
                componentReady: false,
                currentJudge: null,
                currentEmail: null,
                allJudges: [],
                addToDb: []
            }
        },
        computed: {
            searchJudges(){
                if(this.currentJudge){
                    return this.allUsers.filter(judge => {
                        return judge.name.toLowerCase().match(this.currentJudge.toLowerCase())
                    })
                }
            },
            ...mapState(['allUsers'])
        },
        methods: {
            addJudge(){
                if(this.currentEmail === '' || this.currentJudge === '' ){
                    return
                }
                const judge = {name: this.currentJudge, email: this.currentEmail}
                this.allJudges.push(judge);
                this.addToDb.push(judge);
                this.currentJudge = '';
                this.currentEmail = '';


            },
            deleteJudge(index){
                this.allJudges.splice(index, 1);
            },
            sendData(){
                window.axios.post('/addJudges', {allJudges: this.addToDb, type: 'judge'})
                    .then(response => {
                        console.log(response)
                        this.createPeople()
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            createPeople(){
                window.axios.post('/people', {allJudges: this.allJudges, type: 'judge'})
                        .then(response => {
                            router.push({name: 'addStudents'})
                    })
                    .catch(function (error) {
                        console.log(error.response.data.message);
                    });
            },
            choice(judge){
                const toto = {name: judge.name, email: judge.email}
                this.allJudges.push(toto);
                this.currentJudge = '';
                this.currentEmail = '';
            }
        },
        mounted() {
            this.$store.dispatch('setAllUsers')
                .then(() => {
                    this.componentReady = true;
                })
        }
    }
</script>

<style scoped>

</style>
